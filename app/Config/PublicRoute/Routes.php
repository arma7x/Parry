<?php

namespace Config\PublicRoute;

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
//$routes->setAutoRoute(true);

$routes->get('/', 'Home::index');
$routes->post('/firebase/submit_token', 'Home::submitToken');
$routes->post('/firebase/remove_token', 'Home::removeToken');
