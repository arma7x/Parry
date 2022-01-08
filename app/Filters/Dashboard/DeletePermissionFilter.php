<?php

namespace App\Filters\Dashboard;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Config\Services;

class DeletePermissionFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();
        $this->authenticator = \Config\Services::authenticator($this->db, $this->session);
        $user = $request->fetchGlobal('__user__');
        if (COUNT($user) === 0) {
          $user = $this->authenticator->isLoggedIn();
        }
        if ($user === FALSE)
          return Services::response()->setStatusCode(401)->setJSON(['message' => '401 Unauthorized']);
        if ((int) $user['delete_permission'] !== 1)
          return Services::response()->setStatusCode(403)->setJSON(['message' => '403 Forbidden']);
        $request->setGlobal('__user__', $user);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
