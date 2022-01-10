<?php

namespace App\Controllers\Dashboards;

class InternalUsers extends \App\Controllers\Base\DashboardController
{
	public function index()
	{
		$filters = [];
		$list = ['id', 'username', 'email', 'level', 'status', 'level', 'create_permission', 'read_permission', 'update_permission', 'delete_permission'];
		foreach($list as $n) {
			$value = $this->request->getGet($n);
			if ($value !== NULL && $value !== '')
				$filters[$n] = $value;
		}
		$page = (int) $this->request->getGet('page');
		$page = $page <= 0 ? 1 : $page;
		$result = $this->authenticator->getAllUsers($filters, 10, $page);
		foreach ($result['result']->getResult() as $row) {
			// var_dump($row);
		}
		//die;
		return $this->render(['dashboard/main/index'], ['namespace' => __FUNCTION__]);
		return $this->response->setStatusCode(200)->setJSON(['message' => __FUNCTION__]);
	}

	public function get()
	{
		return $this->render(['dashboard/main/index'], ['namespace' => __FUNCTION__]);
		return $this->response->setStatusCode(200)->setJSON(['message' => __FUNCTION__]);
	}

	public function create()
	{
		$json = $this->request->getJSON(true);
		$validation = \Config\Services::validation();
		$validation->setRules([
			'username' => ['label' => 'Username', 'rules' => 'required|min_length[5]'],
			'email' => ['label' => 'Email', 'rules' => 'required|valid_email'],
			'password' => ['label' => 'Password', 'rules' => 'required|min_length[10]'],
			'level' => ['label' => 'Level', 'rules' => 'required|less_than[256]'],
			'status' => ['label' => 'Status', 'rules' => 'required|in_list[0,1]'],
			'create_permission' => ['label' => 'Create Permission', 'rules' => 'required|in_list[0,1]'],
			'read_permission' => ['label' => 'Read Permission', 'rules' => 'required|in_list[0,1]'],
			'update_permission' => ['label' => 'Update Permission', 'rules' => 'required|in_list[0,1]'],
			'delete_permission' => ['label' => 'Delete Permission', 'rules' => 'required|in_list[0,1]'],
		]);
		$data = [];
		foreach ($validation->getRules() as $field => $_value) {
			if (in_array($field, ['username', 'email']))
				$data[$field] = strtolower($json[$field] ?? null);
			else
				$data[$field] = $json[$field] ?? null;
		}
		var_dump($data);
		$validation->run($data);
		var_dump( $validation->getErrors());
		die;
		//var_dump($this->authenticator->addUser($data));
		return $this->render(['dashboard/main/index'], ['namespace' => __FUNCTION__]);
		return $this->response->setStatusCode(200)->setJSON(['message' => __FUNCTION__]);
	}

	public function update()
	{
		return $this->render(['dashboard/main/index'], ['namespace' => __FUNCTION__]);
		return $this->response->setStatusCode(200)->setJSON(['message' => __FUNCTION__]);
	}

	public function updatePassword()
	{
		return $this->render(['dashboard/main/index'], ['namespace' => __FUNCTION__]);
		return $this->response->setStatusCode(200)->setJSON(['message' => __FUNCTION__]);
	}

	public function delete()
	{
		return $this->render(['dashboard/main/index'], ['namespace' => __FUNCTION__]);
		return $this->response->setStatusCode(200)->setJSON(['message' => __FUNCTION__]);
	}

}
