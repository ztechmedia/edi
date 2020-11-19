<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'AppController';
$route['404_override'] = 'AppController/pageNotFound';
$route['translate_uri_dashes'] = false;

//admin routes
$route['admin'] = 'AppController';

/* home routes */
//@view
$route['admin/dashboard'] = "HomeController/dashboard";

/* auth routes */
//@view
$route['login'] = 'AuthController/login';
$route['register'] = 'AuthController/register';
//@action
$route['auth/login'] = 'AuthController/authLogin';
$route['auth/register'] = 'AuthController/authRegister';
$route['logout'] = 'AppController/logout';

/* users routes */
//@view
$route['admin/users/(:num)'] = 'UsersController/users/$1';
$route['admin/users-table/(:num)'] = 'UsersController/usersTable/$1';
$route['admin/users/create/(:num)'] = 'UsersController/create/$1';
$route['admin/users/(:num)/edit'] = 'UsersController/edit/$1';
//@action
$route['admin/users/add'] = 'UsersController/add';
$route['admin/users/(:num)/update'] = 'UsersController/update/$1';
$route['admin/users/(:num)/delete'] = 'UsersController/delete/$1';

/* biodata routes */
//@view
$route['admin/biodata'] = 'BiodataController/biodata';
$route['admin/biodata-table'] = 'BiodataController/biodataTable';
$route['admin/biodata/(:num)/edit'] = 'BiodataController/edit/$1';
$route['admin/biodata/(:num)/update'] = 'BiodataController/update/$1';

/* roles routes */
//@view
$route['admin/roles'] = 'RolesController/roles';
$route['admin/roles-table'] = 'RolesController/rolesTable';
$route['admin/roles/(:num)/edit'] = 'RolesController/edit/$1';
//@action
$route['admin/roles/(:num)/update'] = 'RolesController/update/$1';