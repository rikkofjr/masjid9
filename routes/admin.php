<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\MasjidProfileController;
use App\Http\Controllers\Dashboard\AlamatJamaahController;
use App\Http\Controllers\Dashboard\DataJamaahController;
use App\Http\Controllers\Dashboard\KasController;
use App\Http\Controllers\Dashboard\KasKategoriController;
use App\Http\Controllers\Dashboard\KasPenerimaanController;
use App\Http\Controllers\Dashboard\KasPengeluaranController;
use App\Http\Controllers\Dashboard\ZisController;
use App\Http\Controllers\Dashboard\ZisTypeController;
use App\Http\Controllers\Dashboard\QurbanController;
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
Route::get('/', [DashboardController::class, 'home'])->name('index');
Route::get('/admin-profile', [DashboardController::class, 'coba'])->name('coba'); 

//Admin Role 
Route::group(['middleware' => ['role:Admin']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::put('update-masjid-info', [DashboardController::class, 'updateMasjidProfile'])->name('update.MasjidInfo');
});

//Permission Bendahara
Route::group(['middleware' => ['can:bendahara-create']], function(){
    //kas Route
    Route::resource('kas', KasController::class);
    Route::get('laporan-kas', [KasController::class, 'kasLaporan'])->name('kas.laporan');
    Route::resource('kas-kategori', KasKategoriController::class);
    Route::resource('kas-penerimaan', KasPenerimaanController::class);
    Route::resource('kas-pengeluaran', KasPengeluaranController::class);

    //Zis
    Route::resource('zis-type', ZisTypeController::class);
});

//Can create
Route::group(['middleware' => ['permission:outsource-create']], function(){
    //Jamaah
    Route::resource('alamat-jamaah', AlamatJamaahController::class);
    Route::resource('data-jamaah', DataJamaahController::class);

    //zis
    Route::get('zis-dashboard', [ZisController::class, 'zisDashboard'])->name('zis.dashboard');
    Route::resource('zis', ZisController::class);
    Route::get('rekap-zakat-rekapan/{zis_type}', [ZisController::class, 'rekapHarian'])->name('zis.rekap.harian');

    //qurban
    Route::resource('qurban', QurbanController::class);
    Route::get('qurban-dashboard', [QurbanController::class, 'qurbanDashboard'])->name('qurban.dashboard');

});

//can do soft delete
Route::group(['middleware' => ['permission:outsource-delete|dkm-delete', 'as' => 'softdelete.']], function(){
    Route::delete('softdelete/keluarga/{id}', [DataJamaahController::class, 'SoftDelete'])->name('keluarga');
    Route::delete('softdelete/data-jamaah/{id}', [DataJamaahController::class, 'SoftDeleteByJamah'])->name('jamaah');
    Route::delete('softdelete/zis/{id}', [ZisController::class, 'SoftDeleteById'])->name('softdelete.zis');
    Route::delete('softdelete/qurban/{id}', [QurbanController::class, 'SoftDeleteById'])->name('softdelete.qurban');
});



//Jamaah


Route::group(['prefix' => 'api', 'as' => 'api.'],function(){
    //Kas
    Route::get('/kas', [KasController::class, 'getAllDataKas'])->name('all.kas');

    //Jamaah
    Route::get('/jamaah', [DataJamaahController::class, 'getJamaah'])->name('all.jamaah');
    Route::get('/jamaah-internal', [AlamatJamaahController::class, 'getJamaahInternal'])->name('all.jamaah.internal');
    Route::get('/jamaah-external', [AlamatJamaahController::class, 'getJamaahExternal'])->name('all.jamaah.external');

    //zis
    Route::get('/zis-data-tahun-ini', [ZisController::class, 'getZisDataByThisYear'])->name('zis.data.ByThisYear');
    Route::get('/zis-data-tahunan', [ZisController::class, 'getAllZisDataByYear'])->name('zis.data.ByYear');
    Route::get('/zis-semua-data', [ZisController::class, 'getAllZisData'])->name('zis.data');
    //Qurban
    Route::get('/qurban-kambing-tahun-ini', [QurbanController::class, 'getQurbanKambing'])->name('qurban.kambing.by.this.year');
    Route::get('/qurban-sapi-tahun-ini', [QurbanController::class, 'getQurbanSapi'])->name('qurban.sapi.by.this.year');
    Route::get('/qurban-semua-data', [QurbanController::class, 'getAllQurbanData'])->name('all.qurban.data');

    Route::get('/tes-function', [MasjidProfileController::class, 'tesFunction']);


});

Route::group(['prefix' => 'print'],function(){
    //Print Zakat {Fitrah, Mall, Fidyah}
    Route::get('/zakat-jamaah/{id}', [ZisController::class, 'printZakatJamaah'])->name('print.zakat.jamaah');
    Route::get('/zakat-tahun/{year}', [ZisController::class,'printZakatTahun'])->name('print.zakat.tahun');
    //print qurban
    Route::get('/qurban/{jenis_hewan}', [QurbanController::class, 'printQurbanByThisYear'])->name('print.qurbanRekapJamaah');
    Route::get('/qurban/jamaah/{id}', [QurbanController::class, 'printQurbanJamaah'])->name('print.qurban.jamaah');

    //Print Keluarga atau jamaah
    Route::get('/keluarga/{id}', [AlamatJamaahController::class, 'PrintKeluarga'])->name('print.keluarga');
});