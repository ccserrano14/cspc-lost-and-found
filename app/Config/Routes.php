<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');                // Default route to dashboard
$routes->get('home', 'Home::index');             // Dashboard route

// Item Management Routes
$routes->get('items', 'ItemController::index');              // List all items
$routes->get('items/create', 'ItemController::create');      // Show form to create new item
$routes->post('items/store', 'ItemController::store');       // Handle new item submission
$routes->get('items/edit/(:num)', 'ItemController::edit/$1');    // Show form to edit item by ID
$routes->post('items/update/(:num)', 'ItemController::update/$1'); // Handle item update by ID
$routes->get('items/delete/(:num)', 'ItemController::delete/$1'); // Delete item by ID
$routes->get('items/(:num)', 'ItemController::show/$1');          // Show single item details by ID
