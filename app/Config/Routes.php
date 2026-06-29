<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Auth::login');
$routes->get('login', 'Auth::login');
$routes->post('login/process', 'Auth::process');
$routes->get('logout', 'Auth::logout');
$routes->get('generate', 'Auth::generate');

$routes->group('', ['filter' => 'auth'], function ($routes) {

    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('dashboard-guru', 'Dashboard::guru');
    $routes->get('dashboard-kepsek', 'Dashboard::kepsek');

    $routes->get('items', 'Item::index');
    $routes->get('items/create', 'Item::create');
    $routes->post('items/store', 'Item::store');
    $routes->get('items/edit/(:num)', 'Item::edit/$1');
    $routes->post('items/update/(:num)', 'Item::update/$1');
    $routes->post('items/delete/(:num)', 'Item::delete/$1');

    $routes->get('pengadaan', 'Pengadaan::index');
    $routes->get('pengadaan/create', 'Pengadaan::create');
    $routes->post('pengadaan/store', 'Pengadaan::store');
    $routes->get('pengadaan/edit/(:num)', 'Pengadaan::edit/$1');
    $routes->post('pengadaan/update/(:num)', 'Pengadaan::update/$1');
    $routes->get('pengadaan/delete/(:num)', 'Pengadaan::delete/$1');

    $routes->get('peminjaman', 'Peminjaman::index');
    $routes->get('peminjaman/create', 'Peminjaman::create');
    $routes->post('peminjaman/store', 'Peminjaman::store');
    $routes->get('peminjaman/edit/(:num)', 'Peminjaman::edit/$1');
    $routes->post('peminjaman/update/(:num)', 'Peminjaman::update/$1');
    $routes->get('peminjaman/delete/(:num)', 'Peminjaman::delete/$1');

    $routes->get('pengembalian', 'Pengembalian::index');
    $routes->get('pengembalian/create', 'Pengembalian::create');
    $routes->post('pengembalian/store', 'Pengembalian::store');

    $routes->get('reports', 'Report::index');
    $routes->get('reports/pdf', 'Report::exportPdf');

    $routes->get('users', 'User::index');
    $routes->get('users/create', 'User::create');
    $routes->post('users/store', 'User::store');
    $routes->get('users/edit/(:num)', 'User::edit/$1');
    $routes->post('users/update/(:num)', 'User::update/$1');
    $routes->get('users/delete/(:num)', 'User::delete/$1');
});