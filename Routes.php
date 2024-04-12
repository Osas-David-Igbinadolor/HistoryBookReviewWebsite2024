<?php

namespace Config;

use CodeIgniter\Config\Services;
use CodeIgniter\Router\RouteCollection;

// Initialize a new RouteCollection object
$routes = Services::routes();

// Homepage route
$routes->get('/', 'Book::index');

// Authentication routes
$routes->group('', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/login', 'Auth::login');
    $routes->post('/login', 'Auth::attemptLogin');
    $routes->get('/register', 'Auth::register');
    $routes->post('/register', 'Auth::attemptRegister');
    $routes->get('/logout', 'Auth::logout');
});

// Book routes
$routes->group('', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/books', 'Book::index');
    $routes->get('/books/(:num)', 'Book::show/$1');
});

// Comment routes
$routes->post('/comments', 'Comment::store');

// Additional Routing
// Include additional routing configurations based on the environment if available
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

// Return the configured routes
return $routes;
