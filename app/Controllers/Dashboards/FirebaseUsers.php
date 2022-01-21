<?php

namespace App\Controllers\Dashboards;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;
use Kreait\Firebase\Util\JSON;

class FirebaseUsers extends \App\Controllers\Base\DashboardController
{
	public function index()
	{
		//$firebase = (new Factory)->withServiceAccount(urldecode(env("FIREBASE_CREDENTIALS")));
		//$httpClient = $firebase->createApiClient([
		//	'base_uri' => 'https://www.googleapis.com/identitytoolkit/v3/relyingparty/',
		//]);
		//$authApiClient = new Auth\ApiClient($httpClient);
		//$response = $authApiClient->downloadAccount(10, null);
		//$json = JSON::decode((string) $response->getBody(), true);
		//var_dump($json);
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
