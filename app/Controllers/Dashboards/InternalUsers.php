<?php

namespace App\Controllers\Dashboards;

class InternalUsers extends \App\Controllers\Base\DashboardController
{
	public function index()
	{
		return $this->response->setStatusCode(200)->setJSON(['message' => __FUNCTION__]);
	}

	public function get()
	{
		return $this->response->setStatusCode(200)->setJSON(['message' => __FUNCTION__]);
	}

	public function create()
	{
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

}