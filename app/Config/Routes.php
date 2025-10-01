<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::attemptLogin');
$routes->get('logout', 'Auth::logout');

$routes->get('/', 'Dashboard::index', ['filter' => 'auth']);

$routes->group('gudang', ['filter' => 'role:gudang'], function ($routes) {
    $routes->get('stock', 'gudang\stocks::index');
    $routes->get('stock/create', 'gudang\stocks::create');
    $routes->post('stock/store', 'gudang\stocks::store');
    $routes->get('stock/edit/(:num)', 'gudang\stocks::edit/$1');
    $routes->post('stock/update/(:num)', 'gudang\stocks::update/$1');
    $routes->get('stock/delete/(:num)', 'gudang\stocks::delete/$1');

    $routes->get('stock', 'gudang\stocks::index');
    $routes->get('stock/create', 'gudang\stocks::create');
    $routes->post('stock/store', 'gudang\stocks::store');
    $routes->get('stock/edit/(:num)', 'gudang\stocks::edit/$1');
    $routes->post('stock/update/(:num)', 'gudang\stocks::update/$1');
    $routes->get('stock/delete/(:num)', 'gudang\stocks::delete/$1');
});