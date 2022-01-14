<?php

namespace App\Controllers;

class Dashboard extends Base\DashboardController
{
	public function index()
	{
		$menus = [];
		if ($this->user) {
			if ((int) $this->user['level'] <= 0){
				$menus = [
					['text' => 'Manage Internal Users', 'href' => '/internal-users'],
					['text' => 'Manage Firebase Users', 'href' => '/firebase-users'],
				];
			}
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
			return $this->response->setStatusCode(400)->setJSON(['message' => 'Wrong password or invalid user']);
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
