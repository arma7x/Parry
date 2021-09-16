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
		$this->render(['dashboard_content'], ['namespace' => get_parent_class($this)]);
	}

	public function login()
	{
		try {
			$uid = $this->authenticator->login('arma7x', '1234567890');
			return $this->response->setStatusCode(200)->setJSON(['message' => $uid]);
		} catch(\Exception $e) {
			return $this->response->setStatusCode(400)->setJSON(['message' => $e->getMessage()]);
		}
	}

	public function updatePassword()
	{
		try {
			$user = $this->authenticator->isLoggedIn();
			if ($user === FALSE) {
				return $this->response->setStatusCode(200)->setJSON(['message' => 'You are not logged in']);
			}
			$this->authenticator->updatePassword($user, '1234567890', '1234567890');
			return $this->response->setStatusCode(200)->setJSON(['message' => $user['id']]);
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
