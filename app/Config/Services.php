<?php

namespace Config;

use CodeIgniter\Config\BaseService;
use Kreait\Firebase\Factory;
use App\Libraries\Auth\Authentication;
use CodeIgniter\Database\BaseConnection;
use CodeIgniter\Session\SessionInterface;

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

	public static function authenticator(BaseConnection $db, SessionInterface $session): Authentication
	{
		return new Authentication($db, $session);
	}
}
