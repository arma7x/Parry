<?php

namespace Config\PublicRoute;

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// $routes->setAutoRoute(true);

$routes->get('/', 'Home::index');
$routes->post('/auth/login', 'Home::login');
$routes->post('/auth/logout', 'Home::logout');
$routes->post('/auth/verify-token', 'Home::verifyToken', ['filter' => 'verifyToken']);
