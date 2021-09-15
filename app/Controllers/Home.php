<?php

namespace App\Controllers;

use Kreait\Firebase\Factory;

class Home extends Base\PublicController
{
	public function index()
	{
		try {
			$db = \Config\Database::connect();
			$authenticator = \Config\Services::authenticator();
			//var_dump($authenticator->getAllUsers([], 10, 20));
			//var_dump($authenticator->getAllUsers(['id' => 1], 10, 20));
			$user = $authenticator->findUser(['id' => '8afceafda40a53']);
			//var_dump($user);
			//$data = [
				//'username' => strtolower('test'),
				//'email' => strtolower('test@email.com'),
				//'password' => '1234567890',
				//'level' => 255,
				//'status' => 1,
				//'create_permission' => 0,
				//'read_permission' => 0,
				//'update_permission' => 0,
				//'delete_permission' => 0
			//];
			//var_dump($authenticator->addUser($data));
			//var_dump($authenticator->verifyPassword('1234567890', $user['password_hash']));
			//var_dump($authenticator->updatePassword($user['id'], '1234567890', '1234567890'));
			foreach(['create_permission', 'read_permission', 'update_permission', 'delete_permission'] as $type) {
				var_dump($authenticator->hasPermission($user['id'], $type, 1));
			}
		} catch(\Exception $e) {
			var_dump($e->getMessage());
		}
		die;
		$this->render(['public_content'], ['namespace' => get_parent_class($this)]);
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
			return $this->respond(['message' => $e->getMessage()], 400);
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
