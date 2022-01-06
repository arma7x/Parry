<?php

namespace App\Filters\Dashboard;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Config\Services;

class LoggedInFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();
        $this->authenticator = \Config\Services::authenticator($this->db, $this->session);
        $user = $this->authenticator->isLoggedIn();
        if ($user !== FALSE && (int) $arguments[0] === 0)
          return Services::response()->setStatusCode(403)->setJSON(['message' => '403 Forbidden']);
        if ($user === FALSE && (int) $arguments[0] === 1)
          return Services::response()->setStatusCode(401)->setJSON(['message' => '401 Unauthorized']);
        $request->setGlobal('__user__', $user === FALSE ? [1] : $user);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
