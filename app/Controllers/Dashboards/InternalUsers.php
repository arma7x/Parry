<?php

namespace App\Controllers\Dashboards;

class InternalUsers extends \App\Controllers\Base\DashboardController
{

	public function index()
	{
		return $this->render(['dashboard/internal_users/index'], ['title' => 'Internal Users', 'users' => $this->_search()]);
	}

	public function search()
	{
		return $this->response->setStatusCode(200)->setJSON($this->_search());
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
			$data[$field] = $json[$field] ?? null;
		}
		var_dump($data);
		$validation->run($data);
		var_dump( $validation->getErrors());
		die;
		//var_dump($this->authenticator->addUser($data));
		return $this->response->setStatusCode(200)->setJSON(['message' => __FUNCTION__]);
	}

	public function update()
	{
		return $this->response->setStatusCode(200)->setJSON(['message' => __FUNCTION__]);
	}

	public function updatePassword()
	{
		return $this->response->setStatusCode(200)->setJSON(['message' => __FUNCTION__]);
	}

	public function delete()
	{
		return $this->response->setStatusCode(200)->setJSON(['message' => __FUNCTION__]);
	}

	protected function _search() {
		$filters = [];
		$list = ['keyword', 'level', 'status', 'level', 'create_permission', 'read_permission', 'update_permission', 'delete_permission'];
		foreach($list as $n) {
			$value = $this->request->getGet($n);
			if ($value !== NULL && $value !== '')
				$filters[$n] = $value;
		}
		$page = (int) $this->request->getGet('page');
		$page = $page <= 0 ? 1 : $page;
		return $this->authenticator->getAllUsers($filters, 10, $page);
	}

}
