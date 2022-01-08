<?php

namespace App\Controllers;

class Dashboard extends Base\DashboardController
{
	public function index()
	{
		try {
			//var_dump($authenticator->getAllUsers([], 10, 20));
			//var_dump($authenticator->getAllUsers(['id' => 1], 10, 20));
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
			//foreach(['create_permission', 'read_permission', 'update_permission', 'delete_permission'] as $type) {
				//var_dump($authenticator->hasPermission($user['id'], $type, 1));
			//}
			//var_dump();
			//var_dump($this->user);
		} catch(\Exception $e) {
			//var_dump($e->getMessage());
		}
		$menus = [];
		if ($this->user) {
			$menus = [
				['text' => 'Manage Internal Users', 'href' => '/internal-users'],
				['text' => 'Manage Firebase Users', 'href' => '/firebase-users'],
			];
		}
		$this->render(['dashboard/main/index'], ['namespace' => get_parent_class($this), 'menus' => $menus]);
	}

	public function login()
	{
		$json = $this->request->getJSON(true);
		try {
			$uid = $this->authenticator->login($json['username'] ?? null, $json['password'] ?? null);
			return $this->response->setStatusCode(200)->setJSON(['message' => $uid]);
		} catch(\Exception $e) {
			// Send anonymous message instead of $e->getMessage()
			return $this->response->setStatusCode(400)->setJSON(['message' => 'Login Error']);
		}
	}

	public function updatePassword()
	{
		$json = $this->request->getJSON(true);
		try {
			$this->authenticator->updatePassword($this->user, $json['old_password'] ?? null, $json['new_password'] ?? null);
			return $this->response->setStatusCode(200)->setJSON(['message' => 'Success']);
		} catch(\Exception $e) {
			return $this->response->setStatusCode(400)->setJSON(['message' => $e->getMessage()]);
		}
	}

	public function logout()
	{
		$this->authenticator->logout();
		return $this->response->setStatusCode(200)->setJSON(['message' => 'Ok']);
	}

}
