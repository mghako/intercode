<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

service('auth')->routes($routes);

$routes->get('employee', 'EmployeeController::index');
$routes->get('employee/create', 'EmployeeController::create');
$routes->post('employee/store', 'EmployeeController::store');
$routes->get('employee/edit/(:num)', 'EmployeeController::edit/$1');
$routes->post('employee/update', 'EmployeeController::update');
$routes->get('employee/delete/(:num)', 'EmployeeController::delete/$1');

$routes->get('employee/export', 'EmployeeController::export');
$routes->post('employee/import', 'EmployeeController::import');

