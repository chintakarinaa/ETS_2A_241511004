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
});
