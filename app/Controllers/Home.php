<?php

namespace App\Controllers;

class Home extends Base\PublicController
{
	public function index()
	{
		$this->render(['public/main/index'], ['namespace' => get_parent_class($this)]);
	}

	public function login()
	{
		$firebaseAuth = \Config\Services::firebase()->createAuth();
		try {
			helper('cookie');
			$oneWeek = 60 * 60 * 24 * 14;
			$token = $this->request->getJSON(true)['token'];
			$verifiedIdToken = $firebaseAuth->verifyIdToken($token, TRUE);
			$firebaseToken = $firebaseAuth->createSessionCookie($token, $oneWeek);
			$secure = !str_contains(ENVIRONMENT, 'development');
			delete_cookie('firebase_token');
			set_cookie('firebase_token', $firebaseToken, $oneWeek, '', '/' , '', $secure, true);
			return $this->response->setStatusCode(200)->setJSON(['message' => 'Ok']);
		} catch(\Exception $e) {
			return $this->respond(['message' => $e->getMessage()], 400);
		}
	}

	public function logout()
	{
		if (isset($_COOKIE['firebase_token'])) {
			unset($_COOKIE['firebase_token']); 
			setcookie('firebase_token', null, -1, '/');
		}
		return $this->response->setStatusCode(200)->setJSON(['message' => 'Ok']);
	}

	public function verifyToken()
	{
		return $this->response->setStatusCode(200)->setJSON(['message' => $this->request->fetchGlobal('__user__')]);
	}
}
