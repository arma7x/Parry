<?php

namespace Config\DashboardRoute;

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Dashboard');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// $routes->setAutoRoute(true);

$routes->get('/', 'Dashboard::index');
$routes->post('/login', 'Dashboard::login');
$routes->post('/update_password', 'Dashboard::updatePassword');
$routes->post('/logout', 'Dashboard::logout');

$routes->get('/test-logged-in', 'Dashboard::testLoggedIn', ['filter' => 'checkLoginStatus:1']);
$routes->get('/test-guest', 'Dashboard::testGuest', ['filter' => 'checkLoginStatus:0']);
$routes->get('/test-level', 'Dashboard::testLevel', ['filter' => 'checkMinLevel:0']);
$routes->get('/test-create', 'Dashboard::testCreate', ['filter' => 'hasCreatePerm']);
$routes->get('/test-read', 'Dashboard::testRead', ['filter' => 'hasReadPerm']);
$routes->get('/test-update', 'Dashboard::testUpdate', ['filter' => 'hasUpdatePerm']);
$routes->get('/test-delete', 'Dashboard::testDelete', ['filter' => 'hasDeletePerm']);
