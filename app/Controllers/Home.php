<?php

namespace App\Controllers;

use Kreait\Firebase\Factory;

class Home extends Base\PublicController
{
	public function index()
	{
		$this->render(['public/main/index'], ['namespace' => get_parent_class($this)]);
	}

	public function submitToken()
	{
		$firebaseAuth = \Config\Services::firebase()->createAuth();
		try {
			helper('cookie');
			$token = $this->request->getJSON(true)['token'];
			$verifiedIdToken = $firebaseAuth->verifyIdToken($token, TRUE);
			$secure = !str_contains(ENVIRONMENT, 'development');
			$tz = new \DateTimeZone(app_timezone());
			$exp = $verifiedIdToken->claims()->get('exp')->setTimezone($tz)->getTimestamp();
			delete_cookie('firebase_token');
			set_cookie('firebase_token', $token, ($exp - time()), '', '/' , '', $secure, true);
			return $this->response->setStatusCode(200)->setJSON(['message' => 'Ok']);
		} catch(\Exception $e) {
			return $this->response->setStatusCode(400)->setJSON(['message' => $e->getMessage()]);
		}
	}

	public function removeToken()
	{
		if (isset($_COOKIE['firebase_token'])) {
			unset($_COOKIE['firebase_token']); 
			setcookie('firebase_token', null, -1, '/');
		}
		return $this->response->setStatusCode(200)->setJSON(['message' => 'Ok']);
	}
}
