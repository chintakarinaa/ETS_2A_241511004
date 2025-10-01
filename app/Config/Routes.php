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
    $routes->get('stock', 'gudang\Stock::index');
    $routes->get('stock/create', 'gudang\Stock::create');
    $routes->post('stock/store', 'gudang\Stock::store');
    $routes->get('stock/edit/(:num)', 'gudang\Stock::edit/$1');
    $routes->post('stock/update/(:num)', 'gudang\Stock::update/$1');
    $routes->get('stock/delete/(:num)', 'gudang\Stock::delete/$1');


    $routes->get('stock', 'gudang\Stock::index');
    $routes->get('stock/create', 'gudang\Stock::create');
    $routes->post('stock/store', 'gudang\Stock::store');
    $routes->get('stock/edit/(:num)', 'gudang\Stock::edit/$1');
    $routes->post('stock/update/(:num)', 'gudang\Stock::update/$1');
    $routes->get('stock/delete/(:num)', 'gudang\Stock::delete/$1');
});