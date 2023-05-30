<?php
use App\Http\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PenulisController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\AnggotaController;
use App\Models\Buku;
use App\Models\Penulis;
use App\Models\Penerbit;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\Anggota;

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

Route::get('/', function () {
    return view ('home',[
        "title" => "Home",
        "active" => 'home'
    ]);
    
    Route::get('/pengguna.login');
})->name('login');

Route::get('/about', function () {
    return view(' about', [
        "title" => "About",
        "active" => 'about',
        "name" => "Ravi Hebat",
        "email" => "rafi_ihzadi@gmail.com",
        "image" => "wuifu.jpg"
    ]);
}); 

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);


Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index']);

//Buku
Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
Route::resource('buku', BukuController::class);
Route::get('/pdf-buku', [BukuController::class, 'pdf']);
Route::get('/create-buku', [BukuController::class, 'create']);
Route::post('/store-buku', [BukuController::class, 'store'])->name('buku.store');
Route::get('/export-buku', [BukuController::class, 'exportExcel']);
Route::get('/upload-buku', [BukuController::class, 'upload']);


//Penulis
Route::get('/penulis', [PenulisController::class, 'index'])->name('penulis.index');
Route::resource('penulis', PenulisController::class);
Route::get('/pdf-penulis', [PenulisController::class, 'pdf']);
Route::get('/create-penulis', [PenulisController::class, 'create']);
Route::post('/store-penulis', [PenulisController::class, 'store'])->name('penulis.store');
Route::get('/export-penulis', [PenulisController::class, 'exportExcel']);



//Penerbit
Route::get('/penerbit', [PenerbitController::class, 'index'])->name('penerbit.index');
Route::resource('penerbit', PenerbitController::class);
Route::get('/pdf-penerbit', [PenerbitController::class, 'pdf']);
Route::get('/create-penerbit', [PenerbitController::class, 'create']);
Route::post('/store-penerbit', [PenerbitController::class, 'store'])->name('penerbit.store');
Route::get('/export-penerbit', [PenerbitController::class, 'exportExcel']);
Route::get('/grafik-penerbit', [PenerbitController::class, 'grafik']);




//Kategori
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
Route::resource('kategori', KategoriController::class);
Route::get('/pdf-kategori', [KategoriController::class, 'pdf']);
Route::get('/create-kategori', [KategoriController::class, 'create']);
Route::post('/store-kategori', [KategoriController::class, 'store'])->name('kategori.store');
Route::get('/export-kategori', [KategoriController::class, 'exportExcel']);



//Peminjaman
Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
Route::resource('peminjaman', PeminjamanController::class);
Route::get('/pdf-peminjaman', [PeminjamanController::class, 'pdf']);
Route::get('/create-peminjaman', [PeminjamanController::class, 'create']);
Route::post('/store-peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
Route::get('/export-peminjaman', [PeminjamanController::class, 'exportExcel']);
Route::post('/save-date', 'PeminjmanController@saveDate');



//Anggota
Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota.index');
Route::resource('anggota', AnggotaController::class);
Route::get('/pdf-anggota', [AnggotaController::class, 'pdf']);
Route::get('/create-anggota', [AnggotaController::class, 'create']);
Route::post('/store-anggota', [AnggotaController::class, 'store'])->name('anggota.store');
Route::get('/export-anggota', [AnggotaController::class, 'exportExcel']);

//Dashboard
Route::get('/chart-data', [DashboardController::class, 'getChartPenerbit'])->name('chart-data');



