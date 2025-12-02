<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// pengendara
$routes->get('/', 'Frontend::index');
$routes->get('data-pengendara/(:any)', 'Frontend::dataPengendara/$1');
$routes->get('tambah-email/(:any)', 'Frontend::tambahEmail/$1');
$routes->post('tambah-email/(:any)', 'Frontend::addEmail/$1');
// $routes->post('/cari/(:any)', 'Frontend::search/$1');
// $routes->get('/cari/tambah-email/(:any)', 'Frontend::viewEmail/$1');
// $routes->post('/cari/tambah-email/(:any)', 'Frontend::tambahEmail/$1');

$routes->get('/login', 'Home::index');
$routes->post('/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');
$routes->get('/unauthorized', 'Auth::unauthorized');
$routes->get('/error-verifikasi', 'Auth::errorVerifikasiAkun');
$routes->get('/verifikasi-akun/(:any)', 'Auth::verifikasiAkun/$1');
$routes->get('/lupa-password', 'Home::lupaPassword');
$routes->get('/reset-password', 'Home::resetPassword');
$routes->post('/lupa-password/kirim-email', 'Auth::kirimEmailLupaPassword');
$routes->post('/lupa-password/reset-password', 'Auth::resetPassword');

// superadmin
$routes->group("superadmin", function ($routes) {
    $routes->get('', 'SuperAdmin::index');
    $routes->get('jenis-pelanggaran', 'SuperAdmin::dataJenis');
    $routes->get('tambah-jenis/(:any)', 'SuperAdmin::tambahJenis/$1');
    $routes->post('tambah-jenis', 'SuperAdmin::addJenis');
    $routes->get('edit-jenis/(:any)', 'SuperAdmin::editViewJenis/$1');
    $routes->post('edit-jenis/(:any)', 'SuperAdmin::updateJenis/$1');
    $routes->get('hapus-jenis/(:any)', 'SuperAdmin::deleteJenis/$1');

    $routes->get('kategori-pelanggaran', 'SuperAdmin::dataKategori');
    $routes->post('tambah-kategori', 'SuperAdmin::addKategori');
    $routes->get('edit-kategori/(:any)', 'SuperAdmin::editViewKategori/$1');
    $routes->post('edit-kategori/(:any)', 'SuperAdmin::updateKategori/$1');
    $routes->get('hapus-kategori/(:any)', 'SuperAdmin::deleteKategori/$1');

    // $routes->get('tambah-jenis/(:any)', 'SuperAdmin::tambahJenis/$1');
    // $routes->post('tambah-jenis', 'SuperAdmin::addJenis');

    $routes->get('data-pengendara', 'SuperAdmin::dataPengendara');
    $routes->post('tambah-pengendara', 'SuperAdmin::addPengendara');
    $routes->get('edit-pengendara/(:any)', 'SuperAdmin::editViewPengendara/$1');
    $routes->post('edit-pengendara/(:any)', 'SuperAdmin::updatePengendara/$1');
    $routes->get('hapus-pengendara/(:any)', 'SuperAdmin::deletePengendara/$1');

    // Kelola Akun
    $routes->get('kelola-akun', 'SuperAdmin::kelolaAkun');
    $routes->post('register', 'Auth::register');
    $routes->get('hapus-akun/(:any)', 'Auth::deleteAkun/$1');
    $routes->get('ganti-password', 'SuperAdmin::gantiPassword');
    $routes->post('ganti-password', 'Auth::gantiPassword');

    $routes->get('data-point/(:any)', 'SuperAdmin::dataPoint/$1');
    $routes->post('data-point', 'SuperAdmin::addPoint');
    $routes->get('hapus-point/(:any)', 'SuperAdmin::deletePoint/$1');
    $routes->get('detail-point/(:any)', 'SuperAdmin::detailPoint/$1');
    $routes->post('detail-point', 'SuperAdmin::addDetail');
    $routes->get('edit-detail/(:any)', 'SuperAdmin::editDetail/$1');
    $routes->post('edit-detail', 'SuperAdmin::updateDetail');
    // $routes->get('tampil-detail/(:any)', 'SuperAdmin::tampilDetail/$1');

    // Kelola Notifikasi
    $routes->get('kelola-notif', 'SuperAdmin::viewNotif');
    $routes->post('tambah-notif', 'SuperAdmin::addNotif');
    $routes->get('aktif-notif/(:any)', 'SuperAdmin::aktifNotif/$1');
    $routes->get('nonaktif-notif/(:any)', 'SuperAdmin::nonaktifNotif/$1');

    $routes->get('laporan', 'SuperAdmin::viewLaporan');
    $routes->get('laporan/hasil', 'SuperAdmin::laporan');
});

// Admin
$routes->group("admin", function ($routes) {
    $routes->get('', 'Admin::index');
    $routes->get('jenis-pelanggaran', 'Admin::dataJenis');

    $routes->get('kategori-pelanggaran', 'Admin::dataKategori');

    $routes->get('data-pengendara', 'Admin::dataPengendara');
    $routes->post('tambah-pengendara', 'Admin::addPengendara');
    $routes->post('import-pengendara', 'Admin::importDataPengendara');
    $routes->get('edit-pengendara/(:any)', 'Admin::editViewPengendara/$1');
    $routes->post('edit-pengendara/(:any)', 'Admin::updatePengendara/$1');
    $routes->get('hapus-pengendara/(:any)', 'Admin::deletePengendara/$1');

    $routes->get('data-point/(:any)', 'Admin::dataPoint/$1');
    $routes->post('data-point', 'Admin::addPoint');
    $routes->get('hapus-point/(:any)', 'Admin::deletePoint/$1');
    $routes->get('detail-point/(:any)', 'Admin::detailPoint/$1');
    $routes->get('tampil-detail/(:any)', 'Admin::tampilDetail/$1');
    $routes->post('detail-point', 'Admin::addDetail');
    $routes->get('edit-detail/(:any)', 'Admin::editDetail/$1');
    $routes->post('edit-detail', 'Admin::updateDetail');

    $routes->get('ganti-password', 'Admin::gantiPassword');
    $routes->post('ganti-password', 'Auth::gantiPassword');

    $routes->get('laporan', 'Admin::viewLaporan');
    $routes->get('laporan/hasil', 'Admin::laporan');
});
