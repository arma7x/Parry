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

$routes->get('/internal-users', 'Dashboards\InternalUsers::index', ['filter' => 'checkMinLevel:0|hasReadPerm']);
$routes->get('/internal-users/get', 'Dashboards\InternalUsers::get', ['filter' => 'checkMinLevel:0|hasReadPerm']);
$routes->get('/internal-users/create', 'Dashboards\InternalUsers::create', ['filter' => 'checkMinLevel:0|hasCreatePerm']);
$routes->get('/internal-users/update', 'Dashboards\InternalUsers::update', ['filter' => 'checkMinLevel:0|hasUpdatePerm']);
$routes->get('/internal-users/update-password', 'Dashboards\InternalUsers::updatePassword', ['filter' => 'checkMinLevel:0|hasUpdatePerm']);
$routes->get('/internal-users/delete', 'Dashboards\InternalUsers::delete', ['filter' => 'checkMinLevel:0|hasDeletePerm']);

$routes->get('/test-logged-in', 'Dashboard::testLoggedIn', ['filter' => 'checkLoginStatus:1']);
$routes->get('/test-guest', 'Dashboard::testGuest', ['filter' => 'checkLoginStatus:0']);
$routes->get('/test-level', 'Dashboard::testLevel', ['filter' => 'checkMinLevel:0']);
$routes->get('/test-create', 'Dashboard::testCreate', ['filter' => 'hasCreatePerm']);
$routes->get('/test-read', 'Dashboard::testRead', ['filter' => 'hasReadPerm']);
$routes->get('/test-update', 'Dashboard::testUpdate', ['filter' => 'hasUpdatePerm']);
$routes->get('/test-delete', 'Dashboard::testDelete', ['filter' => 'hasDeletePerm']);
