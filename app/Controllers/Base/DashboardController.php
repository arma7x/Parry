<?php

namespace App\Controllers\Base;

use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class DashboardController
 *
 * DashboardController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends DashboardController
 *
 * For security be sure to declare any new methods as protected or private.
 */

class DashboardController extends BaseController
{
	/**
	 * Instance of the main Request object.
	 *
	 * @var IncomingRequest|CLIRequest
	 */
	protected $request;

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend DashboardController.
	 *
	 * @var array
	 */
	protected $helpers = [];

	protected $templateView = 'widgets/templates/dashboard_template';

	protected $data = [
		'title' => 'Dashboard',
		'description' => 'CodeIgniter4 starter app',
	];

	/**
	 * Constructor.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param LoggerInterface   $logger
	 */
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		$this->db = \Config\Database::connect();
		$this->session = \Config\Services::session();
		$this->authenticator = \Config\Services::authenticator($this->db, $this->session);
		$this->user = $this->authenticator->isLoggedIn();
		$this->data['__user__'] = $this->user;
		$this->data['__app_js_ts__'] = filemtime(realpath(FCPATH.implode(DIRECTORY_SEPARATOR, ['', 'assets', 'js', 'app.js'])));
	}

}
