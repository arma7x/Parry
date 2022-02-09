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
          helper('cookie');
          $verifiedToken = NULL;
          if (get_cookie('firebase_token') !== NULL) {
            $token = get_cookie('firebase_token');
            $verifiedToken = $firebaseAuth->verifySessionCookie($token, TRUE);
          } else if (isset($this->request->getJSON(true)['token'])) {
            $token = $request->getJSON(true)['token'];
            $verifiedToken = $firebaseAuth->verifyIdToken($token, TRUE);
          } else {
            return Services::response()->setStatusCode(401)->setJSON(['message' => '401 Unauthorized']);
          }
          $request->setGlobal('__user__', $verifiedToken->claims()->all());
        } catch (FailedToVerifyToken $e) {
          return Services::response()->setStatusCode(401)->setJSON(['message' => $e->getMessage()]);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
