<?php

namespace App\Controllers\Dashboards;

class FirebaseUsers extends \App\Controllers\Base\DashboardController
{
	public function index()
	{
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
