<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('/produk', 'Produk::index');
$routes->get('/produk/detail/(:num)', 'Produk::detail/$1');
$routes->get('/admin', 'Admin::index');
$routes->get('/admin/tambah', 'Admin::tambah');
$routes->post('/admin/simpan', 'Admin::simpan');
$routes->get('/admin/edit/(:num)', 'Admin::edit/$1');
$routes->post('/admin/update/(:num)', 'Admin::update/$1');
$routes->get('/admin/hapus/(:num)', 'Admin::hapus/$1');

$routes->get('keranjang', 'KeranjangController::index');
$routes->get('keranjang/tambah/(:num)', 'KeranjangController::tambah/$1');
$routes->post('keranjang/update', 'KeranjangController::update');
$routes->get('keranjang/hapus/(:num)', 'KeranjangController::hapus/$1');
$routes->get('keranjang/kosongkan', 'KeranjangController::kosongkan');

$routes->get('checkout', 'CheckoutController::index');
$routes->post('checkout/process', 'CheckoutController::process');

$routes->get('pesanan', 'PesananController::index');
$routes->get('pesanan/detail/(:segment)', 'PesananController::detail/$1');
$routes->get('pesanan/invoice/(:segment)', 'PesananController::invoice/$1');

$routes->get('admin/pesanan', 'AdminPesanan::index');

$routes->get(
    'admin/pesanan/detail/(:segment)',
    'AdminPesanan::detail/$1'
);

$routes->post(
    'admin/pesanan/status/(:segment)',
    'AdminPesanan::updateStatus/$1'
);

$routes->post(
    'admin/pesanan/pembayaran/(:segment)',
    'AdminPesanan::updatePembayaran/$1'
);

$routes->get('login', 'Auth::login');
$routes->post('login/check', 'Auth::checkLogin');

$routes->get('register', 'Auth::register');
$routes->post('register/create', 'Auth::create');

$routes->get('logout', 'Auth::logout');

$routes->post(
    'admin/pesanan/pengiriman/(:segment)',
    'AdminPesanan::updatePengiriman/$1'
);

$routes->get('/histori', 'Histori::index');
$routes->get('/histori/detail/(:num)', 'Histori::detail/$1');