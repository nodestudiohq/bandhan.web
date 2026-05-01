<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


// ── Public routes (no auth required) ─────────────────────────────────
$routes->get('auth/login', 'Auth::login');
$routes->post('auth/login', 'Auth::loginProcess');
$routes->get('auth/logout', 'Auth::logout');
$routes->post('api/attendance/punch', 'Attendance::apiPunch');       // Android + Web

// Home: shows landing page if guest, dashboard if logged in
$routes->get('/', 'Dashboard::home');



$routes->group('', ['filter' => 'auth'], function ($routes) {
    // Dashboard (auth required)
    $routes->get('/dashboard', 'Dashboard::index');


    // ── Staff ─────────────────────────────────────────────────────────────────────
    $routes->get('staff', 'Staff::index');
    $routes->get('staff/create', 'Staff::create');
    $routes->post('staff/store', 'Staff::store');
    $routes->get('staff/(:num)', 'Staff::show/$1');
    $routes->get('staff/edit/(:num)', 'Staff::edit/$1');
    $routes->post('staff/update/(:num)', 'Staff::update/$1');
    $routes->post('staff/delete/(:num)', 'Staff::delete/$1');
    $routes->get('staff/idcard/(:num)', 'Staff::idcard/$1');
    $routes->get('staff/salary-structure/(:num)', 'Staff::salaryStructure/$1');
    $routes->post('staff/salary-structure/save/(:num)', 'Staff::saveSalaryStructure/$1');

    // ── Attendance ───────────────────────────────────────────────────────────────
    $routes->get('attendance', 'Attendance::index');
    $routes->get('punch', 'Attendance::webPunch');       // web punch station
    $routes->get('attendance/staffSearch', 'Attendance::staffSearch');    // AJAX search
    $routes->post('attendance/manualSet', 'Attendance::manualSet');
    $routes->post('attendance/revertAuto', 'Attendance::revertAuto');
    $routes->post('attendance/recompute', 'Attendance::recompute');
    $routes->get('attendance/punchLog', 'Attendance::punchLog');       // AJAX
    $routes->get('attendance/report', 'Attendance::report');

    // ── Salary ─────────────────────────────────────────────────────────────────────
    $routes->get('salary', 'Salary::index');
    $routes->get('salary/generate', 'Salary::generateForm');
    $routes->post('salary/generate', 'Salary::generateProcess');
    $routes->get('salary/edit/(:num)', 'Salary::edit/$1');
    $routes->post('salary/update/(:num)', 'Salary::update/$1');
    $routes->post('salary/approve/(:num)', 'Salary::approve/$1');
    $routes->post('salary/approve-all', 'Salary::approveAll');
    $routes->post('salary/disburse/(:num)', 'Salary::disburse/$1');
    $routes->post('salary/disburse-all', 'Salary::disburseAll');
    $routes->post('salary/hold/(:num)', 'Salary::hold/$1');
    $routes->get('salary/slip/(:num)', 'Salary::slip/$1');

    // ── Invoice ────────────────────────────────────────────────────────────────────
    $routes->get('invoice/productSearch', 'Invoice::productSearch');   // AJAX autocomplete
    $routes->get('invoice/medicineSearch', 'Invoice::medicineSearch');  // AJAX medicine autocomplete
    $routes->get('invoice', 'Invoice::index');
    $routes->get('invoice/create', 'Invoice::create');
    $routes->post('invoice/store', 'Invoice::store');
    $routes->get('invoice/(:num)', 'Invoice::show/$1');
    $routes->get('invoice/edit/(:num)', 'Invoice::edit/$1');
    $routes->post('invoice/update/(:num)', 'Invoice::update/$1');
    $routes->post('invoice/delete/(:num)', 'Invoice::delete/$1');
    $routes->get('invoice/print/(:num)', 'Invoice::print/$1');

    // ── Products / Services ───────────────────────────────────────────────
    $routes->get('products', 'Product::index');
    $routes->get('products/create', 'Product::create');
    $routes->post('products/store', 'Product::store');
    $routes->get('products/edit/(:num)', 'Product::edit/$1');
    $routes->post('products/update/(:num)', 'Product::update/$1');
    $routes->post('products/delete/(:num)', 'Product::delete/$1');
    $routes->post('products/toggle/(:num)', 'Product::toggleStatus/$1');


    // ── Users ─────────────────────────────────────────────────────────
    $routes->get('users', 'User::index');
    $routes->get('users/create', 'User::create');
    $routes->post('users/store', 'User::store');
    $routes->get('users/edit/(:num)', 'User::edit/$1');
    $routes->post('users/update/(:num)', 'User::update/$1');
    $routes->post('users/delete/(:num)', 'User::delete/$1');
    $routes->post('users/toggle/(:num)', 'User::toggleStatus/$1');


});


