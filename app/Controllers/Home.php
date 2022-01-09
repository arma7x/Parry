<?php

namespace App\Controllers;

class Home extends Base\PublicController
{
	public function index()
	{
		$this->render(['public/main/index'], ['namespace' => get_parent_class($this)]);
	}

	public function verifyToken()
	{
		return $this->response->setStatusCode(200)->setJSON(['message' => $this->request->fetchGlobal('__user__')]);
	}
}
