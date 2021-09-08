<?php

namespace App\Controllers;

class Home extends Base\PublicController
{
	public function index()
	{
		$db = \Config\Database::connect();
		$this->render(['public_content'], ['namespace' => get_parent_class($this)]);
	}
}
