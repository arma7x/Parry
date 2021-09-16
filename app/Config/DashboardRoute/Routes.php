<?php

namespace Config\DashboardRoute;

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Dashboard');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
//$routes->setAutoRoute(true);

$routes->get('/', 'Dashboard::index');
$routes->post('/login', 'Dashboard::login');
$routes->post('/update_password', 'Dashboard::updatePassword');
$routes->post('/logout', 'Dashboard::logout');
