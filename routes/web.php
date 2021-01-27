<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/login', 'AuthController@login')->name('login');
Route::get('/forgot-password', 'AuthController@forgot')->name('password');
Route::post('/store-forgot', 'AuthController@forgotPasswordPost')->name('forgotStore');
Route::get('/reset-password/{id}', 'AuthController@reset')->name('reset');
Route::post('/store-reset', 'AuthController@resetPassword')->name('resetPassword');
Route::post('/loginpost', 'AuthController@loginpost');
Route::post('/logingurupost', 'AuthController@logingurupost');
Route::get('/presensi', 'AbsensiController@rfid');
Route::get('/login-guru', 'AuthController@loginGuru');
Route::post('/tambahabsenrfid', 'AbsensiController@storeRFID');

Route::get('/cetakpembayaran/{id}', 'AccPembayaranController@cetak');
Route::group(['middleware' => 'auth'], function () {
    // User
    Route::get('/user', 'DashboardController@user');
    // user
    Route::get('/user/{id}/edit', 'UserController@edit');
    Route::put('/user/{id}/update', 'UserController@update');
    Route::get('/user/siswa/{id}/edit', 'UserController@editusersiswa');
    // Dashboard
    Route::get('/', 'DashboardController@dashboard');
    // logout
    Route::get('/logout', 'AuthController@logout');

    // tidak boleh siswa & kepala sekolah
    Route::group(['middleware' => 'checkNotRole:2|3'], function () {
        Route::get('/siswa/{id}/kelas', 'SiswaController@getSiswa');
        // tidak boleh guru
        Route::group(['middleware' => 'checkNotRole:7'], function () {
            // Siswa;
            Route::get('/siswa', 'SiswaController@index');
            Route::post('/siswa', 'SiswaController@store');
            Route::get('/siswa/{id}/edit', 'SiswaController@edit');
            Route::get('/siswa/{id}/bayar', 'SiswaController@getPembayaran');
            Route::put('/siswa/{id}/update', 'SiswaController@update');
            Route::get('/siswa/{id}/pass', 'SiswaController@pass');
            

            // Guru;
            Route::get('/guru', 'GuruController@index');
            Route::post('/guru', 'GuruController@store');
            Route::get('/guru/{id}/edit', 'GuruController@edit');
            Route::put('/guru/{id}/update', 'GuruController@update');
            Route::get('/guru/{id}/pass', 'GuruController@pass');
        
            // Kelas;
            Route::get('/kelas', 'KelasController@index');
            Route::post('/kelas', 'KelasController@store');
            Route::get('/kelas/{id}/edit', 'KelasController@edit');
            Route::put('/kelas/{id}/update', 'KelasController@update');

        });

        // hanya boleh admin & staf pembayaran
        Route::group(['middleware' => 'checkRole:4|1'], function () {
            // spp
            Route::get('/spp', 'AngkatanController@index');
            Route::post('/spp', 'AngkatanController@store');
            Route::get('/spp/{id}/edit', 'AngkatanController@edit');
            Route::put('/spp/{id}/update', 'AngkatanController@update');

            // tipe
            Route::get('/tipepembayaran', 'TipePembayaranController@index');
            Route::post('/tipepembayaran', 'TipePembayaranController@store');
            Route::get('/tipepembayaran/{id}/edit', 'TipePembayaranController@edit');
            Route::put('/tipepembayaran/{id}/update', 'TipePembayaranController@update');
        });


        // hanya boleh admin & staf pembelajaran & guru
        Route::group(['middleware' => 'checkRole:4|5|7'], function () {
                // Mata Pelajaran;
            Route::get('/matapelajaran', 'MataPelajaranController@index');
            Route::post('/matapelajaran', 'MataPelajaranController@store');
            Route::get('/matapelajaran/{id}/edit', 'MataPelajaranController@edit');
            Route::put('/matapelajaran/{id}/update', 'MataPelajaranController@update');
        });
        
        // hanya boleh admin 
        Route::group(['middleware' => 'checkRole:4'], function () {
            // admin
            Route::get('/admin', 'AdminController@index');
            Route::post('/admin', 'AdminController@store');
            Route::get('/admin/{id}/edit', 'AdminController@edit');
            Route::put('/admin/{id}/update', 'AdminController@update');

            // logo
            Route::get('/logo', 'LogoController@index');
            Route::put('/logo/update', 'LogoController@update');
        });
    });
    // hanya boleh admin & staf pembayaran
    Route::group(['middleware' => 'checkRole:4|1'], function () {
        // tagihan
        Route::get('/daftartagihan', 'TagihanController@index');
        Route::post('/daftartagihan', 'TagihanController@store');
        Route::get('/detail_tagihan/{kelas_id}/{id}', 'TagihanController@detail');
        Route::get('/tagihanemail/{kelas_id}/{id}', 'TagihanController@email');

        // pembayaran Admin
        Route::get('/accpembayaran', 'AccPembayaranController@index');
        Route::get('/accpembayarantambahan', 'AccPembayaranController@tambahan');
        Route::get('/accpembayaranwajib', 'AccPembayaranController@wajib');
        Route::put('/accpembayaran/{id}/{tipe}/{tipebyr}', 'AccPembayaranController@update');
        Route::get('/detailpembayaran', 'AccPembayaranController@detail');
    });

    // hanya boleh admin & staf pembelajaran 
    Route::group(['middleware' => 'checkRole:4|5'], function () {
        // Jadwal;
        Route::get('/jadwal', 'JadwalController@index');
        Route::post('/jadwal', 'JadwalController@store');
        Route::get('/jadwal/{id}/edit', 'JadwalController@edit');
        Route::put('/jadwal/{id}/update', 'JadwalController@update');

        
        
        // rppdansilabus
        Route::get('/rppdansilabus', 'SilabusDanRppController@index');
        Route::post('/rppdansilabus', 'SilabusDanRppController@store');
        Route::get('/rppdansilabus/{id}/edit', 'SilabusDanRppController@edit');
        Route::put('/rppdansilabus/{id}/update', 'SilabusDanRppController@update');
    });
    
    // hanya boleh admin & staf absen & guru 
    Route::group(['middleware' => 'checkRole:4|6|7'], function () {
        // absensi
        Route::get('/agendasiswa', 'AbsensiController@agenda');
        Route::get('/absensisiswa', 'AbsensiController@siswa');
        Route::get('/absendetail/{id}/siswa', 'AbsensiController@detailSiswa');
        Route::get('/absendetail/{id}/detail/siswa', 'AbsensiController@detail');
        Route::put('/absensi/update', 'AbsensiController@update');
        Route::post('/absensi/add', 'AbsensiController@storeDetail');
        Route::post('/tambahabsenm', 'AbsensiController@storeManual'); 
    });

    // hanya boleh admin & staf absen 
    Route::group(['middleware' => 'checkRole:4|6'], function () {
        // absensi
        Route::get('/presensiall', 'AbsensiController@presensiall');
        Route::get('/absensiguru', 'AbsensiController@guru');
        Route::get('/absensistaf', 'AbsensiController@staf');
        Route::get('/absensirfid', 'AbsensiController@rfid');
        Route::get('/settingrfid', 'LogoController@setrfid');
       Route::put('/settingrfid/update', 'LogoController@setrfidupdate');
        Route::get('/absendetail/{id}/guru', 'AbsensiController@detailGuru');
        Route::get('/absendetail/{id}/staf', 'AbsensiController@detailStaf');
    });
    // tidak boleh staf pembayaran 
    Route::group(['middleware' => 'checkNotRole:1'], function () {
        Route::get('/presensime', 'AbsensiController@user');
    });

    //laporan pembayaran
    // hanya boleh kepala sekolah & staf pembayaran & admin 
    Route::group(['middleware' => 'checkRole:3|1|4'], function () {
        Route::get('/laporanpembayaran', 'LaporanController@pembayaran');
        Route::post('/cetaklaporanpembayaran', 'LaporanController@cetakpembayaran');
        Route::get('/laporanpembayaranangkatan', 'LaporanController@pembayaranangkatan');
        Route::post('/cetaklaporanpembayaranangkatan', 'LaporanController@cetakpembayaranangkatan');
    });
    //laporan pembelajaran
    // hanya boleh kepala sekolah & staf pembelajaran & admin & guru 
    Route::group(['middleware' => 'checkRole:3|5|4|7'], function () {
        Route::get('/laporanpenilaian', 'LaporanController@penilaian');
        Route::post('/cetaklaporanpenilaian', 'LaporanController@cetakpenilaian');
        Route::get('/laporanrds', 'LaporanController@rppdansilabus');
        Route::post('/cetaklaporanrds', 'LaporanController@cetakrppdansilabus');
        Route::get('/laporanjadwal', 'LaporanController@jadwal');
        Route::post('/cetaklaporanjadwal', 'LaporanController@cetakjadwal');
    });
    
    //laporan presensi
    // hanya boleh kepala sekolah & staf absen & admin & guru 
    Route::group(['middleware' => 'checkRole:3|6|4|7'], function () {
        Route::get('/laporanabsensiswa', 'LaporanController@absenSiswa');
        Route::post('/cetaklaporanabsensiswa', 'LaporanController@cetakAbsSiswa');
    });
    // hanya boleh kepala sekolah & staf absen & admin 
    Route::group(['middleware' => 'checkRole:3|6|4'], function () {
        
        Route::get('/laporanabsenguru', 'LaporanController@absenGuru');
        Route::get('/laporanpresensi', 'LaporanController@presensi');
        Route::post('/cetaklaporanabsenguru', 'LaporanController@cetakAbsGuru');
        Route::get('/laporanabsenstaf', 'LaporanController@absenStaf');
        Route::post('/cetaklaporanabsenstaf', 'LaporanController@cetakAbsStaf');
        // Route::post('/cetaklaporanbulan', 'LaporanController@cetakbulan');
        // Route::post('/pembayaran', 'PembayaranController@store');
    });
});
// hanya boleh admin & staf pembelajaran & guru & siswa
Route::group(['middleware' => 'checkRole:4|5|7|2'], function () {
        // nilai
    Route::get('/nilaiharian', 'NilaiController@harian');
    Route::get('/nilairaport', 'NilaiController@raport');
    Route::get('/nilaiujian', 'NilaiController@ujian');
    Route::get('/nilaiuts', 'NilaiController@uts');
    Route::get('/nilaiuas', 'NilaiController@uas');
    Route::post('/nilai', 'NilaiController@store');
    Route::get('/nilai/{id}/edit', 'NilaiController@edit');
    Route::put('/nilai/{id}/update', 'NilaiController@update');
});
Route::group(['middleware' => ['auth','checkRole:2']], function () {
    // pembayaran
    Route::get('/historypembayaran', 'PembayaranController@index');
    Route::get('/tagihanbiaya', 'PembayaranController@tagihan');
    Route::get('/cetakpembayaran', 'PembayaranController@cetaksemua');
    Route::get('/pembayaran/{id}/edit', 'PembayaranController@edit');
    Route::post('/pembayaran', 'PembayaranController@store');
    Route::post('/pembayaran/{id}/update', 'PembayaranController@update');
});







