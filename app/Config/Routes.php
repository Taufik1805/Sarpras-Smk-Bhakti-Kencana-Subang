<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// =======================
// 🔐 AUTH (PUBLIC)
// =======================
$routes->get('/', 'Auth::login');
$routes->get('login', 'Auth::login');
$routes->post('login/process', 'Auth::process');
$routes->get('logout', 'Auth::logout');

// 🔧 DEBUG (hapus nanti)
$routes->get('generate', 'Auth::generate');


// =======================
// 🔒 PROTECTED (WAJIB LOGIN)
// =======================
$routes->group('', ['filter' => 'auth'], function($routes) {

    // ===================
    // 📊 DASHBOARD
    // ===================
    $routes->get('dashboard', 'Dashboard::index');

    // ===================
    // 📦 DATA BARANG
    // ===================
    $routes->get('items', 'Item::index');
    $routes->get('items/create', 'Item::create');
    $routes->post('items/store', 'Item::store');
    $routes->get('items/edit/(:num)', 'Item::edit/$1');
    $routes->post('items/update/(:num)', 'Item::update/$1');
    $routes->post('items/delete/(:num)', 'Item::delete/$1');

    // ===================
    // 🛒 PENGADAAN
    // ===================
    $routes->get('pengadaan', 'Pengadaan::index');
    $routes->get('pengadaan/create', 'Pengadaan::create');
    $routes->post('pengadaan/store', 'Pengadaan::store');
    $routes->get('pengadaan/delete/(:num)', 'Pengadaan::delete/$1');

    // ===================
    // 📋 REPORTS
    // ===================
    $routes->get('reports', 'Report::index');
    $routes->get('reports/create', 'Report::create');
    $routes->post('reports/store', 'Report::store');

    // 🔥 EXPORT PDF
    $routes->get('reports/pdf', 'Report::exportPdf');

});