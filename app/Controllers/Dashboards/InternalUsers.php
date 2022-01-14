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
		$result = $this->_search();
		$result['tbody'] = view('dashboard/internal_users/users_tbody_widget', ['users' => $result]);
		$result['pagination'] = view('dashboard/internal_users/users_pagination_widget', ['users' => $result]);
		return $this->response->setStatusCode(200)->setJSON($result);
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
		$validation->run($data);
		$errors = $validation->getErrors();
		if (COUNT($errors) > 0) {
			return $this->response->setStatusCode(400)->setJSON(['validation' => $errors]);
		}
		try {
			$this->authenticator->addUser($data);
			return $this->response->setStatusCode(200)->setJSON(['message' => 'Success']);
		} catch(\Exception $e) {
			return $this->response->setStatusCode(400)->setJSON(['message' => $e->getMessage()]);
		}
	}

	public function update()
	{
		$json = $this->request->getJSON(true);
		//$json['id'] = '12ssss';
		//$json['password'] = '12ssssssssssssssssss';
		$validation = \Config\Services::validation();
		$rules = [
			'id' => ['label' => 'ID', 'rules' => 'required'],
			'password' => ['label' => 'Password', 'rules' => 'min_length[10]'],
			'level' => ['label' => 'Level', 'rules' => 'less_than[256]'],
			'status' => ['label' => 'Status', 'rules' => 'in_list[0,1]'],
			'create_permission' => ['label' => 'Create Permission', 'rules' => 'in_list[0,1]'],
			'read_permission' => ['label' => 'Read Permission', 'rules' => 'in_list[0,1]'],
			'update_permission' => ['label' => 'Update Permission', 'rules' => 'in_list[0,1]'],
			'delete_permission' => ['label' => 'Delete Permission', 'rules' => 'in_list[0,1]'],
		];
		$validation->setRule('id', $rules['id']['label'], $rules['id']['rules']);
		$data = [];
		foreach ($rules as $field => $value) {
			if (isset($json[$field])) {
				$validation->setRule($field, $value['label'], $value['rules']);
				$data[$field] = $json[$field];
			}
		}
		$validation->run($data);
		$errors = $validation->getErrors();
		if (COUNT($errors) > 0) {
			return $this->response->setStatusCode(400)->setJSON(['validation' => $errors]);
		}
		$uid = $data['id'];
		if ($this->user['id'] === $uid)
			return $this->response->setStatusCode(403)->setJSON(['message' => 'Fail']);
		if ($data['password'])
			$data['password'] = $this->authenticator->generatePasswordSafeLength($data['password']);
		unset($data['id']);
		return $this->response->setStatusCode(200)->setJSON(['message' => __FUNCTION__]);
	}

	public function delete()
	{
		$json = $this->request->getJSON(true);
		$validation = \Config\Services::validation();
		$validation->setRules([
			'id' => ['label' => 'ID', 'rules' => 'required'],
		]);
		$data = [];
		foreach ($validation->getRules() as $field => $_value) {
			$data[$field] = $json[$field] ?? null;
		}
		$validation->run($data);
		$errors = $validation->getErrors();
		if (COUNT($errors) > 0) {
			return $this->response->setStatusCode(400)->setJSON(['validation' => $errors]);
		}
		if ($this->user['id'] === $data['id'])
			return $this->response->setStatusCode(403)->setJSON(['message' => 'Fail']);
		if ($this->authenticator->deleteUser($data['id']) === TRUE)
			return $this->response->setStatusCode(200)->setJSON(['message' => 'Success']);
		return $this->response->setStatusCode(400)->setJSON(['message' => 'Fail']);
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
