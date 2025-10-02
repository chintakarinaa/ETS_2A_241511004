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
    $routes->get('stocks', 'gudang\Stocks::index');
    $routes->get('stocks/create', 'gudang\Stocks::create');
    $routes->post('stocks/store', 'gudang\Stocks::store');
    $routes->get('stocks/edit/(:num)', 'gudang\Stocks::edit/$1');
    $routes->post('stocks/update/(:num)', 'gudang\Stocks::update/$1');
    $routes->get('stocks/delete/(:num)', 'gudang\Stocks::delete/$1');
});

$routes->group('dapur', ['filter' => 'role:dapur'], function ($routes) {
    $routes->get('requests', 'dapur\Requests::index');
    $routes->get('requests/create', 'dapur\Requests::create');
    $routes->post('requests/store', 'dapur\Requests::store');
});
