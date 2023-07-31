<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
// $routes->get('/dashboard', 'Admin::dashboard', ['filter' => 'auth']);


// sistem login
$routes->get('/Auth/index', 'Auth::index');
$routes->get('/Auth/regis', 'Auth::regis');
$routes->post('/Auth/login', 'Auth::login');
$routes->post('/Auth/register', 'Auth::register');
$routes->get('/Auth/logout', 'Auth::logout');

// Forget password
$routes->get('/Auth/forget_pass', 'Auth::forget_pass');
$routes->get('/Auth/reset_pass', 'Auth::reset_pass');
$routes->get('/change_password', 'Auth::change_pass');
$routes->get('/change_passwordUser', 'Auth::change_passuser');
$routes->post('/Auth/changePassword', 'Auth::changePassword');
$routes->post('AUth/sendEmail', 'Auth::sendEmail');
$routes->get('Auth/reset/(:any)', 'Auth::reset/$1');
$routes->post('Auth/forgotPassword', 'Auth::forgotPassword');
$routes->post('Auth/resetPassword', 'Auth::resetPassword');

$routes->get('/Admin/response_layanan', 'Admin::response_layanan');
$routes->get('/Admin/dashboard', 'Admin::dashboard_admin');
$routes->get('/User/dashboard', 'User::dashboard_user');
$routes->get('/Admin/aduan', 'Admin::aduan');
$routes->get('/User/pengajuan', 'User::pengajuan');
$routes->post('/User/simpan', 'User::simpan');
$routes->post('/User/save', 'User::save');
// $routes->get('/Admin/(:segment)/delete_aduan', 'Admin::delete_aduan/$1');
$routes->delete('/Admin/(:num)/delete_aduan', 'Admin::delete_aduan/$1');
$routes->delete('/Admin/(:num)/delete_layanan', 'Admin::delete_layanan/$1');
$routes->get('/User/create_aduan', 'User::create_aduan');
// edit layanan dan aduan
$routes->get('/Admin/(:segment)/edit_aduan', 'Admin::edit_aduan/$1');
$routes->get('/Admin/(:segment)/edit_layanan', 'Admin::edit_layanan/$1');
$routes->post('/Admin/(:segment)/update_aduan', 'Admin::update_aduan/$1');
$routes->post('/Admin/(:segment)/update_layanan', 'Admin::update_layanan/$1');

// User
$routes->get('/User/dashboard', 'User::dashboard_user');
$routes->get('/User/pengajuan', 'User::pengajuan');
$routes->post('/User/simpan', 'User::simpan');
$routes->post('/User/save', 'User::save');

// User edit layanan dan aduan
$routes->get('/User/(:segment)/edit_aduan', 'User::edit_aduanuser/$1');
$routes->get('/User/aduan', 'User::aduanuser');
$routes->get('/User/(:segment)/edit_layanan', 'User::edit_layananuser/$1');
$routes->post('/User/(:segment)/update_aduan', 'User::update_aduanuser/$1');
$routes->post('/User/(:segment)/update_layanan', 'User::update_layananuser/$1');

// status
$routes->get('/User/status_aduan', 'User::status_aduan');
$routes->get('/User/status_layanan', 'User::status_layanan');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
