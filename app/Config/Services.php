<?php

namespace Config;

use CodeIgniter\Config\BaseService;
use Kreait\Firebase\Factory;
use App\Libraries\Auth\Authentication;
use CodeIgniter\Database\BaseConnection;
use CodeIgniter\Session\SessionInterface;
use Config\Filters as FiltersConfig;
use Config\Services as AppServices;
use App\Libraries\Filters\Filters;

use Lcobucci\Clock\SystemClock;
use Lcobucci\JWT\Token;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Rsa\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Validation\Constraint\IssuedBy;
use Lcobucci\JWT\Validation\Constraint\PermittedFor;
use Lcobucci\JWT\Validation\Constraint\SignedWith;
use Lcobucci\JWT\Validation\Constraint\ValidAt;
use Kreait\Firebase\Util\DT;
use Kreait\Firebase\Exception\Auth\RevokedIdToken;
use GuzzleHttp\Client;

/**
 * Services Configuration file.
 *
 * Services are simply other classes/libraries that the system uses
 * to do its job. This is used by CodeIgniter to allow the core of the
 * framework to be swapped out easily without affecting the usage within
 * the rest of your application.
 *
 * This file holds any application-specific services, or service overrides
 * that you might need. An example has been included with the general
 * method format you should use for your service methods. For more examples,
 * see the core Services file at system/Config/Services.php.
 */
class Services extends BaseService
{
	public static function firebase(): Factory
	{
		return (new Factory)->withServiceAccount(urldecode(env("FIREBASE_CREDENTIALS")));
	}
	public static function verifySessionCookie(String $token): Token
	{
		try {
			$firebaseAuth = \Config\Services::firebase()->createAuth();
			$client = new Client(['base_uri' => 'https://www.googleapis.com/identitytoolkit/v3/relyingparty/publicKeys']);
			$res = $client->get('');
			$keys = json_decode((string) $res->getBody(), true);
			$clock = SystemClock::fromSystemTimezone();
			$leeway = new \DateInterval('PT300S');
			$credential = json_decode(urldecode(env("FIREBASE_CREDENTIALS")));
			$configuration = Configuration::forSymmetricSigner(new Sha256(), InMemory::plainText(''));
			$verifiedToken = $configuration->parser()->parse($token);
			$configuration->validator()->assert($verifiedToken, ...[
					new ValidAt($clock, $leeway),
					new PermittedFor($credential->project_id),
					new IssuedBy(...["https://session.firebase.google.com/{$credential->project_id}", "https://securetoken.google.com/{$credential->project_id}"]),
					new SignedWith($configuration->signer(), InMemory::plainText($keys[$verifiedToken->headers()->get('kid', '')])),
			]);
			$user = $firebaseAuth->getUser($verifiedToken->claims()->get('sub'));
			$validSince = $user->tokensValidAfterTime;
			if (!($validSince instanceof \DateTimeImmutable)) {
				return $verifiedToken;
			}
			$tokenAuthenticatedAt = DT::toUTCDateTimeImmutable($verifiedToken->claims()->get('auth_time'));
			$tokenAuthenticatedAtWithLeeway = $tokenAuthenticatedAt->modify('-300 seconds');
			$validSinceWithLeeway = DT::toUTCDateTimeImmutable($validSince)->modify('-300 seconds');
			if (!($tokenAuthenticatedAtWithLeeway->getTimestamp() < $validSinceWithLeeway->getTimestamp())) {
				return $verifiedToken;
			}
			throw new RevokedIdToken($verifiedToken);
		} catch (RequiredConstraintsViolated $e) {
			throw new Exception($e);
		}
	}

	public static function authenticator(BaseConnection $db, SessionInterface $session): Authentication
	{
		return new Authentication($db, $session);
	}

	public static function filters(?FiltersConfig $config = null, bool $getShared = true)
	{
		if ($getShared) {
			return static::getSharedInstance('filters', $config);
		}
		$config = $config ?? config('Filters');
		return new Filters($config, AppServices::request(), AppServices::response());
	}
}
