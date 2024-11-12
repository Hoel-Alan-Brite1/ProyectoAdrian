<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 $routes->get('/', 'Home::index');
 $routes->get('auth/login', 'Auth::login');
 $routes->post('auth/login', 'Auth::login');
 $routes->get('auth/logout', 'Auth::logout');
 
 // Rutas con filtro
 $routes->get('admin/dashboard', 'Admin::dashboard', ['filter' => 'auth:administrador']);
 $routes->get('vendedor/dashboard', 'Vendedor::dashboard', ['filter' => 'auth:vendedor']);
 $routes->get('cliente/dashboard', 'Cliente::dashboard', ['filter' => 'auth:cliente']);
 
 $routes->get('newlogin', 'NewLogin::index');
$routes->post('newlogin/process', 'NewLogin::process');
$routes->get('newlogin/logout', 'NewLogin::logout');

 $routes->get('registro', 'Registro::index');
 $routes->post('registro/guardar', 'Registro::guardar');
 
