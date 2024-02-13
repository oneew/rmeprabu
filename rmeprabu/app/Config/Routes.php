<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Users::index', ['filter' => 'noauth']);
$routes->get('logout', 'Users::logout');
$routes->match(['get', 'post'], 'register', 'Users::register', ['filter' => 'noauth']);
$routes->match(['get', 'post'], 'profile', 'Users::profile', ['filter' => 'auth']);
//$routes->get('/Abie/HalamanUtama', 'Abie::HalamanUtama', ['filter' => 'auth']);
$routes->get('/SimrsHome/HomeSimrs', 'SimrsHome::HomeSimrs', ['filter' => 'auth']);
$routes->get('/Users/profile', 'Users::profile', ['filter' => 'auth']);
$routes->get('/rawatinap/inputdetailibs', 'rawatinap::inputdetailibs', ['filter' => 'auth']);
$routes->get('/rawatinap/lihatdetailibs2', 'rawatinap::lihatdetailibs2', ['filter' => 'auth']);
$routes->get('/EdukasiBedah/prabedah', 'EdukasiBedah::prabedah', ['filter' => 'auth']);

$routes->get('/IGD', 'IGD::index', ['filter' => 'auth']);
$routes->get('/UsersAkun/register', 'UsersAkun::register', ['filter' => 'auth']);
$routes->get('/UsersAkun/SettingLokasi', 'UsersAkun::SettingLokasi', ['filter' => 'auth']);
$routes->get('/PendaftaranRanap', 'PendaftaranRanap::index', ['filter' => 'auth']);
$routes->get('/DPMRI', 'DPMRI::index', ['filter' => 'auth']);
$routes->get('/ValidasiDaftarRanap', 'ValidasiDaftarRanap::index', ['filter' => 'auth']);
$routes->get('/ValidasiDaftarRanap/ValidasiPindah', 'ValidasiDaftarRanap::ValidasiPindah', ['filter' => 'auth']);
$routes->get('/PasienRanap/Dact', 'PasienRanap::Dact', ['filter' => 'auth']);
$routes->get('/PelayananRanap/PasienPindah', 'PelayananRanap::PasienPindah', ['filter' => 'auth']);
$routes->get('/PelayananRanap/PasienPulang', 'PelayananRanap::PasienPulang', ['filter' => 'auth']);
$routes->get('/AmprahFarmasiRuanganRanap', 'AmprahFarmasiRuanganRanap::index', ['filter' => 'auth']);
$routes->get('/AmprahFarmasiRuanganRanap/DSP', 'AmprahFarmasiRuanganRanap::DSP', ['filter' => 'auth']);

$routes->get('/AbuyaUci', 'EnJadwal::index', ['filter' => 'auth']);














/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
