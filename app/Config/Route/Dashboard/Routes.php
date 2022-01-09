<?php

namespace Config\DashboardRoute;

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Dashboard');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// $routes->setAutoRoute(true);

$routes->get('/', 'Dashboard::index');
$routes->post('/auth/login', 'Dashboard::login');
$routes->post('/auth/update_password', 'Dashboard::updatePassword');
$routes->post('/auth/logout', 'Dashboard::logout');

$routes->get('/internal-users', 'Dashboards\InternalUsers::index', ['filter' => 'checkLoginStatus:1|checkMinLevel:0|hasReadPerm']);
$routes->get('/internal-users/get', 'Dashboards\InternalUsers::get', ['filter' => 'checkMinLevel:0|hasReadPerm']);
$routes->get('/internal-users/create', 'Dashboards\InternalUsers::create', ['filter' => 'checkMinLevel:0|hasCreatePerm']);
$routes->get('/internal-users/update', 'Dashboards\InternalUsers::update', ['filter' => 'checkMinLevel:0|hasUpdatePerm']);
$routes->get('/internal-users/update-password', 'Dashboards\InternalUsers::updatePassword', ['filter' => 'checkMinLevel:0|hasUpdatePerm']);
$routes->get('/internal-users/delete', 'Dashboards\InternalUsers::delete', ['filter' => 'checkMinLevel:0|hasDeletePerm']);

$routes->get('/firebase-users', 'Dashboards\FirebaseUsers::index', ['filter' => 'checkLoginStatus:1|checkMinLevel:0|hasReadPerm']);
$routes->get('/firebase-users/get', 'Dashboards\FirebaseUsers::get', ['filter' => 'checkMinLevel:0|hasReadPerm']);
$routes->get('/firebase-users/create', 'Dashboards\FirebaseUsers::create', ['filter' => 'checkMinLevel:0|hasCreatePerm']);
$routes->get('/firebase-users/update', 'Dashboards\FirebaseUsers::update', ['filter' => 'checkMinLevel:0|hasUpdatePerm']);
$routes->get('/firebase-users/update-password', 'Dashboards\FirebaseUsers::updatePassword', ['filter' => 'checkMinLevel:0|hasUpdatePerm']);
$routes->get('/firebase-users/delete', 'Dashboards\FirebaseUsers::delete', ['filter' => 'checkMinLevel:0|hasDeletePerm']);
