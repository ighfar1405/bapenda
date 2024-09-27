<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\ListOpdController;

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

Route::get('/', 'HomeController@index')->name('landing');
Route::get('/grafik', 'IndexController@index')->name('landing-hero');
Route::get('/cek-skrd', 'CekSKRDController@index')->name('cek-skrd');

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return "All cache cleared";
});
Auth::routes();

Route::prefix('report')->group(function () {
    Route::get('example', 'ReportController@example');
    Route::get('cetak_skrd', 'ReportController@cetak_skrd');
    Route::get('cetak_tbp', 'ReportController@cetak_tbp');
    Route::get('wr_kecamatan', 'ReportController@wr_per_kecamatan');
    Route::get('wr_insidentil', 'ReportController@wr_insidentil');
    Route::get('pembayaran_retribusi_kecamatan', 'ReportController@pembayaran_retribusi_kecamatan');
    Route::get('piutang_pertahun', 'ReportController@piutang_pertahun');
    Route::get('realisasi_pembayaran', 'ReportController@realisasi_pembayaran');
    Route::get('piutang_perkelurahan', 'ReportController@piutang_perkelurahan');
    Route::get('piutang_perobjek_perkelurahan', 'ReportController@piutang_perobjek_perkelurahan');
    Route::get('piutang_perwr_perkelurahan', 'ReportController@piutang_perwr_perkelurahan');
    Route::get('pembayaran_bulanan_perkelurahan', 'ReportController@pembayaran_bulanan_perkelurahan');
    Route::get('laporan_objek_retribusi', 'ReportController@laporan_objek_retribusi');
    Route::get('laporan_nominal_jenis_pembayaran', 'ReportController@laporan_nominal_jenis_pembayaran');
    Route::get('lahan_pertanian/pdf', 'ReportController@lahan_pertanian_pdf')->name('report.pertanian.pdf');
    Route::get('lahan_pertanian/xls', 'ReportController@lahan_pertanian_xls')->name('report.pertanian.xls');
});

Route::middleware('auth')->group(function () {
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

    Route::prefix('ajax')->namespace('Ajax')->group(function () {
        Route::get('kelurahan/{kecamatanId}', 'KelurahanController@show')->name('ajax.kelurahan.data');
        Route::get('tarif-retribusi/{id}', 'TarifRetribusiController@show')->name('ajax.tarifretribusi.data');
        Route::put('tarif-retribusi/{id}', 'TarifRetribusiController@update')->name('ajax.tarifretribusi.update');

        Route::get('pemakai', 'PemakaiController@index')->name('ajax.pemakai.index');
        //untuk get pemakai di tbp
        Route::get('pemakai1', 'PemakaiController@index1')->name('ajax.pemakai.index1');
        Route::get('pemakai/data', 'PemakaiController@getData')->name('ajax.pemakai.data');
        Route::get('pemakai/skrd/{pemakaiId}', 'PemakaiController@show')->name('ajax.pemakai.show');
        Route::put('object-retribusi/{id}', 'ObjectRetribusiController@update')->name('ajax.objectretribusi.update');

        Route::get('skrd', 'SkrdController@index')->name('skrd.data');
        Route::put('skrd/{id}', 'SkrdController@update')->name('ajax.skrd.update');

        Route::get('get-object-retribusi/{kode?}', 'ObjectRetribusiController@getAll')->name('ajax.object_retribusi.all');
    });

    Route::prefix('admin')->group(function () {
        /** general pages */
        Route::get('/', 'AdminController@index')->name('admin.dashboard.index');

        /** Opd */
        Route::get('opd', 'User\OpdController@index')->name('opd.index');
        Route::get('opd/create', 'User\OpdController@create')->name('opd.create');
        Route::post('opd/create', 'User\OpdController@store')->name('opd.store');
        Route::get('opd/edit/{id}', 'User\OpdController@edit')->name('opd.edit');
        Route::put('opd/edit/{id}', 'User\OpdController@update')->name('opd.update');
        Route::delete('opd/delete/{id}', 'User\OpdController@destroy')->name('opd.destroy');

        /** Petugas */
        Route::get('petugas', 'User\PetugasController@index')->name('petugas.index');
        Route::get('petugas/create', 'User\PetugasController@create')->name('petugas.create');
        Route::post('petugas/create', 'User\PetugasController@store')->name('petugas.store');
        Route::get('petugas/edit/{id}', 'User\PetugasController@edit')->name('petugas.edit');
        Route::put('petugas/edit/{id}', 'User\PetugasController@update')->name('petugas.update');
        Route::delete('petugas/delete/{id}', 'User\PetugasController@destroy')->name('petugas.destroy');

        /** Pemakai */
        Route::get('pemakai', 'User\PemakaiController@index')->name('pemakai.index');
        Route::get('pemakai/create', 'User\PemakaiController@create')->name('pemakai.create');
        Route::post('pemakai/create', 'User\PemakaiController@store')->name('pemakai.store');
        Route::get('pemakai/edit/{id}', 'User\PemakaiController@edit')->name('pemakai.edit');
        Route::put('pemakai/edit/{id}', 'User\PemakaiController@update')->name('pemakai.update');
        Route::delete('pemakai/delete/{id}', 'User\PemakaiController@destroy')->name('pemakai.destroy');

        Route::group(['middleware' => ['can:admin']], function () {
            Route::get('users', 'User\UserController@index')->name('users.index');
            Route::get('users/create', 'User\UserController@create')->name('users.create');
            Route::post('users/create', 'User\UserController@store')->name('users.store');
            Route::get('users/edit/{id}', 'User\UserController@edit')->name('users.edit');
            Route::put('users/edit/{id}', 'User\UserController@update')->name('users.update');
            Route::delete('users/delete/{id}', 'User\UserController@destroy')->name('users.destroy');
        });

        /** Kecamatan */
        Route::get('kecamatan', 'Master\KecamatanController@index')->name('kecamatan.index');
        Route::get('kecamatan/create', 'Master\KecamatanController@create')->name('kecamatan.create');
        Route::post('kecamatan/create', 'Master\KecamatanController@store')->name('kecamatan.store');
        Route::get('kecamatan/edit/{id}', 'Master\KecamatanController@edit')->name('kecamatan.edit');
        Route::put('kecamatan/edit/{id}', 'Master\KecamatanController@update')->name('kecamatan.update');
        Route::delete('kecamatan/delete/{id}', 'Master\KecamatanController@destroy')->name('kecamatan.destroy');

        /** Kelurahan */
        Route::get('kelurahan/{kecamatan_id}', 'Master\KelurahanController@show')->name('kelurahan.show');
        Route::get('kelurahan/create/{kecamatan_id}', 'Master\KelurahanController@create')->name('kelurahan.create');
        Route::post('kelurahan/create', 'Master\KelurahanController@store')->name('kelurahan.store');
        Route::get('kelurahan/edit/{id}', 'Master\KelurahanController@edit')->name('kelurahan.edit');
        Route::put('kelurahan/edit/{id}', 'Master\KelurahanController@update')->name('kelurahan.update');
        Route::delete('kelurahan/delete/{id}', 'Master\KelurahanController@destroy')->name('kelurahan.destroy');

        /** Klasifikasi Pemakaian */
        Route::get('klasifikasi', 'Master\KlasifikasiPemakaianController@index')->name('klasifikasi.index');
        Route::get('klasifikasi/create', 'Master\KlasifikasiPemakaianController@create')->name('klasifikasi.create');
        Route::post('klasifikasi/create', 'Master\KlasifikasiPemakaianController@store')->name('klasifikasi.store');
        Route::get('klasifikasi/edit/{id}', 'Master\KlasifikasiPemakaianController@edit')->name('klasifikasi.edit');
        Route::post('klasifikasi/edit/{id}', 'Master\KlasifikasiPemakaianController@update')->name('klasifikasi.update');
        Route::delete('klasifikasi/{id}', 'Master\KlasifikasiPemakaianController@destroy')->name('klasifikasi.destroy');

        /** Akun */
        Route::get('akun', 'Statis\AkunController@index')->name('akun.index');
        Route::get('akun/create', 'Statis\AkunController@create')->name('akun.create');
        Route::post('akun/create', 'Statis\AkunController@store')->name('akun.store');
        Route::get('akun/edit/{id}', 'Statis\AkunController@edit')->name('akun.edit');
        Route::put('akun/edit/{id}', 'Statis\AkunController@update')->name('akun.update');
        Route::delete('akun/{id}', 'Statis\AkunController@destroy')->name('akun.destroy');

        /** Rekening Bank */
        Route::get('rekening', 'Statis\RekeningBankController@index')->name('rekening.index');
        Route::get('rekening/create', 'Statis\RekeningBankController@create')->name('rekening.create');
        Route::post('rekening/create', 'Statis\RekeningBankController@store')->name('rekening.store');
        Route::get('rekening/edit/{id}', 'Statis\RekeningBankController@edit')->name('rekening.edit');
        Route::put('rekening/edit/{id}', 'Statis\RekeningBankController@update')->name('rekening.update');
        Route::delete('rekening/{id}', 'Statis\RekeningBankController@destroy')->name('rekening.destroy');

        /** Jenis Pembayaran */
        Route::get('jenispembayaran', 'Transaction\JenisPembayaranController@index')->name('jenispembayaran.index');
        Route::get('jenispembayaran/create', 'Transaction\JenisPembayaranController@create')->name('jenispembayaran.create');
        Route::post('jenispembayaran/create', 'Transaction\JenisPembayaranController@store')->name('jenispembayaran.store');
        Route::get('jenispembayaran/edit/{id}', 'Transaction\JenisPembayaranController@edit')->name('jenispembayaran.edit');
        Route::post('jenispembayaran/edit/{id}', 'Transaction\JenisPembayaranController@update')->name('jenispembayaran.update');
        Route::delete('jenispembayaran/{id}', 'Transaction\JenisPembayaranController@destroy')->name('jenispembayaran.destroy');

        // tarif retribusi
        Route::get('tarif-retribusi', 'Master\TarifRetribusiController@index')->name('tarifretribusi.index');
        Route::get('tarif-retribusi/create', 'Master\TarifRetribusiController@create')->name('tarifretribusi.create');
        Route::post('tarif-retribusi/create', 'Master\TarifRetribusiController@store')->name('tarifretribusi.store');
        Route::get('tarif-retribusi/edit/{id}', 'Master\TarifRetribusiController@edit')->name('tarifretribusi.edit');
        Route::put('tarif-retribusi/edit/{id}', 'Master\TarifRetribusiController@update')->name('tarifretribusi.update');
        Route::delete('tarif-retribusi/{id}', 'Master\TarifRetribusiController@destroy')->name('tarifretribusi.destroy');

        // objek retribusi
        Route::get('object-retribusi', 'Master\ObjectRetribusiController@index')->name('objectretribusi.index');
        Route::get('object-retribusi/create', 'Master\ObjectRetribusiController@create')->name('objectretribusi.create');
        Route::post('object-retribusi/create', 'Master\ObjectRetribusiController@store')->name('objectretribusi.store');
        Route::get('object-retribusi/edit/{id}', 'Master\ObjectRetribusiController@edit')->name('objectretribusi.edit');
        Route::put('object-retribusi/edit/{id}', 'Master\ObjectRetribusiController@update')->name('objectretribusi.update');
        Route::delete('object-retribusi/{id}', 'Master\ObjectRetribusiController@destroy')->name('objectretribusi.destroy');

        // penomoran
        Route::get('penomoran', 'Statis\PenomoranController@index')->name('penomoran.index');
        Route::get('penomoran/create', 'Statis\PenomoranController@create')->name('penomoran.create');
        Route::post('penomoran/create', 'Statis\PenomoranController@store')->name('penomoran.store');
        Route::get('penomoran/edit/{id}', 'Statis\PenomoranController@edit')->name('penomoran.edit');
        Route::put('penomoran/edit/{id}', 'Statis\PenomoranController@update')->name('penomoran.update');
        Route::delete('penomoran/{id}', 'Statis\PenomoranController@destroy')->name('penomoran.destroy');

        // Skrd
        Route::get('skrd', 'Transaction\SkrdController@index')->name('skrd.index');
        Route::get('skrd/create', 'Transaction\SkrdController@create')->name('skrd.create');
        Route::post('skrd/create', 'Transaction\SkrdController@store')->name('skrd.store');
        Route::get('skrd/edit/{id}', 'Transaction\SkrdController@edit')->name('skrd.edit');
        Route::put('skrd/edit/{id}', 'Transaction\SkrdController@update')->name('skrd.update');
        Route::delete('skrd/{id}', 'Transaction\SkrdController@destroy')->name('skrd.destroy');
        Route::get('skrd/print/{id}', 'Transaction\SkrdController@print')->name('skrd.print');

        // salin skrd
        Route::get('salin-skrd', 'Transaction\SalinSkrdController@index')->name('salinskrd.index');
        Route::post('salin-skrd', 'Transaction\SalinSkrdController@store')->name('salinskrd.store');

        // TBP SKRD
        Route::get('tbp', 'Transaction\TbpController@index')->name('tbp.index');
        Route::get('tbp/create', 'Transaction\TbpController@create')->name('tbp.create');
        Route::post('tbp/create', 'Transaction\TbpController@store')->name('tbp.store');
        Route::get('tbp/edit/{id}', 'Transaction\TbpController@edit')->name('tbp.edit');
        Route::put('tbp/edit/{id}', 'Transaction\TbpController@update')->name('tbp.update');
        Route::delete('tbp/delete/{id}', 'Transaction\TbpController@destroy')->name('tbp.destroy');
        Route::get('tbp/print/{id}', 'Transaction\TbpController@print')->name('tbp.print');

        // TBP Insidentil
        Route::get('tbp/insidentil/create', 'Transaction\TbpInsidentilController@create')->name('tbp.create_insidentil');
        Route::post('tbp/insidentil/create', 'Transaction\TbpInsidentilController@store')->name('tbp.store_insidentil');
        Route::get('tbp/insidentil/edit/{id}', 'Transaction\TbpInsidentilController@edit')->name('tbp.edit_insidentil');
        Route::put('tbp/insidentil/edit/{id}', 'Transaction\TbpInsidentilController@update')->name('tbp.update_insidentil');
        Route::delete('tbp/insidentil/delete/{id}', 'Transaction\TbpInsidentilController@destroy')->name('tbp.destroy_insidentil');
        Route::get('tbp/insidentil/print/{id}', 'Transaction\TbpInsidentilController@print')->name('tbp.print_insidentil');

        // lahan pertanian
        Route::get('pertanian', 'Transaction\PertanianController@index')->name('pertanian.index');
        Route::get('pertanian/create', 'Transaction\PertanianController@create')->name('pertanian.create');
        Route::post('pertanian/create', 'Transaction\PertanianController@store')->name('pertanian.store');
        Route::get('pertanian/edit/{id}', 'Transaction\PertanianController@edit')->name('pertanian.edit');
        Route::put('pertanian/edit/{id}', 'Transaction\PertanianController@update')->name('pertanian.update');
        Route::get('pertanian/pay/{id}', 'Transaction\PertanianController@pay')->name('pertanian.bayar');
        Route::post('pertanian/pay/action', 'Transaction\PertanianController@payAction')
            ->name('pertanian.bayar.act');
        Route::delete('pertanian/{id}', 'Transaction\PertanianController@destroy')->name('pertanian.destroy');

        // List OPD
        // Route::get('list_opd', 'ListOpdController@index')->name('list_opd.index');
        // Route::get('list_opd/create', 'ListOpdController@create')->name('list_opd.create');
        // Route::post('list_opd/create', 'ListOpdController@store')->name('list_opd.store');
        // Route::get('list_opd/edit/{id}', 'ListOpdController@edit')->name('list_opd.edit');
        // Route::put('list_opd/edit/{id}', 'ListOpdController@update')->name('list_opd.update');
        // Route::delete('list_opd/delete/{id}', 'ListOpdController@destroy')->name('list_opd.destroy');

        Route::get('list_opd', [ListOpdController::class, 'index'])->name('list_opd.index');
        Route::get('list_opd/create', [ListOpdController::class, 'create'])->name('list_opd.create');
        Route::post('list_opd', [ListOpdController::class, 'store'])->name('list_opd.store');
        Route::get('list_opd/edit/{id}', [ListOpdController::class, 'edit'])->name('list_opd.edit');
        Route::put('list_opd/edit/{id}', [ListOpdController::class, 'update'])->name('list_opd.update');
        Route::delete('list_opd/delete/{id}', [ListOpdController::class, 'destroy'])->name('list_opd.destroy');

        // Monitoring piutang
        Route::prefix('monitoring-piutang')->name('monitoringpiutang.')->group(function () {
            Route::get('/', 'Transaction\MonitoringPiutangController@index')->name('index');
            Route::get('/notif', 'Transaction\MonitoringPiutangController@sendNotification')->name('notif');
        });

        // Report
        Route::get('report', 'Statis\ReportController@index')->name('report.index');
        Route::post('report/harian-objek-retribusi', 'Reports\ReportHarianObjekRetribusiController@print')->name('report.harian_objek_retribusi');
        Route::post('report/harian-nominal-jenis-pembayaran', 'Statis\ReportController@harian_nominal_jenis_pembayaran')->name('report.harian_nominal_jenis_pembayaran');

        Route::post('report/wr-kecamatan', 'Reports\ReportWrKecamatanController@print')->name('report.wr_kecamatan');
        Route::post('report/wr-kecamatan-pdf', 'Reports\ReportWrKecamatanController@printFromAjax')->name('report.wr_kecamatan.pdf');

        Route::get('report/wr-insidentil', 'Statis\ReportController@wr_insidentil')->name('report.wr_insidentil');
        Route::post('report/pembayaran-retribusi-kecamatan', 'Reports\ReportPembayaranKecamatanController@print')->name('report.pembayaran_retribusi_kecamatan');
        Route::get('report/piutang-pertahun/pdf', 'Statis\ReportController@piutang_pertahun_pdf')->name('report.piutang_pertahun.pdf');
        Route::get('report/piutang-pertahun/xls', 'Statis\ReportController@piutang_pertahun_xls')->name('report.piutang_pertahun.xls');
        Route::get('report/realisasi-pembayaran', 'Statis\ReportController@realisasi_pembayaran')->name('report.realisasi_pembayaran');
        Route::get('report/piutang-perkelurahan', 'Statis\ReportController@piutang_perkelurahan')->name('report.piutang_perkelurahan');
        Route::get('report/piutang-perobjek-perkelurahan', 'Statis\ReportController@piutang_perobjek_perkelurahan')->name('report.piutang_perobjek_perkelurahan');
        Route::get('report/piutang-perwr-perkelurahan', 'Statis\ReportController@piutang_perwr_perkelurahan')->name('report.piutang_perwr_perkelurahan');

        // Tahun
        Route::get('tahun', 'Statis\TahunController@index')->name('tahun.index');
        Route::get('tahun/create', 'Statis\TahunController@create')->name('tahun.create');
        Route::post('tahun/create', 'Statis\TahunController@store')->name('tahun.store');
        Route::get('tahun/edit/{id}', 'Statis\TahunController@edit')->name('tahun.edit');
        Route::put('tahun/edit/{id}', 'Statis\TahunController@update')->name('tahun.update');

        // role & permissions
        Route::get('hak-akses', 'RoleController@index')->name('role.index');
        Route::get('hak-akses/permission/{id}', 'RoleController@permission')->name('role.form_permission');
        Route::put('hak-akses/permission/{id}', 'RoleController@syncPermissions')->name('role.sync_permission');

        // pemindahan pemakaian
        Route::prefix('pemindahan-pemakaian')->group(function () {
            Route::get('/', 'Transaction\PemindahanPemakaianController@index')->name('pemindahan_pemakaian.index');
            Route::get('create', 'Transaction\PemindahanPemakaianController@create')->name('pemindahan_pemakaian.create');
            Route::post('create', 'Transaction\PemindahanPemakaianController@store')->name('pemindahan_pemakaian.store');
            Route::get('edit/{id}', 'Transaction\PemindahanPemakaianController@edit')->name('pemindahan_pemakaian.edit');
            Route::put('edit/{id}', 'Transaction\PemindahanPemakaianController@update')->name('pemindahan_pemakaian.update');
            Route::delete('delete/{id}', 'Transaction\PemindahanPemakaianController@destroy')->name('pemindahan_pemakaian.destroy');
        });

        Route::get('pertanian/print/{id}', 'Transaction\PertanianController@print')->name('pertanian.print');
   
        Route::resource('jasa_umum', 'Admin\JasaUmum\JasaUmumController');
          
        Route::resource('tanaman', 'Admin\Tanaman\TanamanController');
    });
});
