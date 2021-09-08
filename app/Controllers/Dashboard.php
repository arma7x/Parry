<?php

namespace App\Controllers;

class Dashboard extends Base\DashboardController
{
	public function index()
	{
		$db = \Config\Database::connect();
		$this->render(['dashboard_content'], ['namespace' => get_parent_class($this)]);
	}
}
