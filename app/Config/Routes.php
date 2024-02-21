<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->group('', ['namespace' => 'Modules\Auth\Controllers'], function ($routes) {
    $routes->get('auth', 'Auth::index');
});

$routes->group('auth', ['namespace' => 'Modules\Auth\Controllers'], function ($routes) {
    $routes->get('/', 'Auth::index');
    $routes->get('logout', 'Auth::logout');
    $routes->post('login', 'Auth::index');
    $routes->match(['get', 'post'], 'loginAuth', 'Auth::loginAuth');
});
$routes->group('user', ['namespace' => 'Modules\User\Controllers'], function ($routes) {
    $routes->get('/', 'User::list_users',['filter' => 'authGuard']);
    $routes->get('create', 'User::index',['filter' => 'authGuard']);
    $routes->match(['get', 'post'], 'validate_data', 'User::validate_data',['filter' => 'authGuard']);
});
$routes->group('inspections', ['namespace' => 'Modules\Inspections\Controllers'], function ($routes) {
    $routes->match(['get', 'post'],'/', 'Inspections::load_table',['filter' => 'authGuard']);
    $routes->match(['get', 'post'],'search', 'Inspections::table_search',['filter' => 'authGuard']);
    $routes->match(['get', 'post'],'create', 'Inspections::get_form',['filter' => 'authGuard']);
    $routes->match(['get', 'post'], 'save', 'Inspections::save_form',['filter' => 'authGuard']);
    $routes->match(['get', 'post'], 'link', 'Inspections::link_small_business',['filter' => 'authGuard']);
    $routes->get('exportToExcel', 'Inspections::exportToExcel',['filter' => 'authGuard']);
    $routes->get('edit/(:any)', 'Inspections::edit/$1',['filter' => 'authGuard']);
    $routes->post('import', 'Inspections::importFromExcel',['filter' => 'authGuard']);
    $routes->get('link/add/(:any)/(:any)', 'Inspections_links::add_link/$1/$2',['filter' => 'authGuard']);
    $routes->get('delete/(:any)', 'Inspections::delete_record/$1',['filter' => 'authGuard']);
});

$routes->group('small_business', ['namespace' => 'Modules\Small_business\Controllers'], function ($routes) {
    $routes->get('/', 'Small_business::get_table',['filter' => 'authGuard']);
    $routes->match(['get', 'post'],'create', 'Small_business::get_form',['filter' => 'authGuard']);
    $routes->match(['get', 'post'], 'save', 'Small_business::save_form',['filter' => 'authGuard']);
    $routes->get('edit/(:any)', 'Small_business::edit/$1',['filter' => 'authGuard']);
    $routes->get('get_table/(:any)', 'Small_business::get_table/$1',['filter' => 'authGuard']);
    $routes->get('delete/(:any)', 'Small_business::delete_record/$1',['filter' => 'authGuard']);
});
$routes->group('templates', ['namespace' => 'Modules\Templetes\Controllers'], function ($routes) {
    $routes->get('/loading', 'Index::loading');
});
