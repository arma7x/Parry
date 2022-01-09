<?php

namespace App\Filters\Publics;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Config\Services;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;

class FirebaseTokenValidatorFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $firebaseAuth = \Config\Services::firebase()->createAuth();
        try {
          $token = $request->getJSON(true)['token'];
          $verifiedIdToken = $firebaseAuth->verifyIdToken($token, TRUE);
          $request->setGlobal('__user__', $verifiedIdToken->claims()->all());
        } catch (FailedToVerifyToken $e) {
          return Services::response()->setStatusCode(401)->setJSON(['message' => $e->getMessage()]);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
