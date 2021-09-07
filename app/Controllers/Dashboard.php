<?php

namespace App\Controllers;

class Dashboard extends Base\DashboardController
{
	public function index()
	{
		$db = \Config\Database::connect();
		$this->render(['welcome_message'], ['namespace' => get_parent_class($this)]);
	}
}
