<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\Customer\ListController;
use App\Http\Controllers\Customer\TransaksiController;
// use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\UserController;
use App\Models\Voucher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::view("/login", "login");
Route::post("/login", [UserController::class, "login"]);
Route::get("/logout", [UserController::class, "logout"]);

Route::prefix("/master")->middleware("loggedin")->group(function() {
    Route::prefix("/barang")->group(function() {
        Route::get('/',[BarangController::class, "index"]);
        Route::get('tambah',
            [BarangController::class, "formTambah"]);
        Route::get('{id}',
            [BarangController::class, "formUbah"])
            ->whereAlphaNumeric("id");

        // Open Manipulate/Append Data
        Route::post('tambah',
            [BarangController::class, "tambahData"]);
        Route::patch('{id}',
            [BarangController::class, "ubahData"])
            ->whereAlphaNumeric("id");
        Route::delete('{id}',
            [BarangController::class, "hapusData"])
            ->whereAlphaNumeric("id");
        // Close Manipulate/Append Data
    });

    Route::prefix("/transaksi")->group(function() {
        Route::get("/", [TransaksiController::class, "index"]);
        Route::get("tambah", [TransaksiController::class,
            "formTambah"]);

        // Bagian Manipulasi data!
        Route::post("tambah", [TransaksiController::class,
            "tambahData"]);
    });

    Route::prefix("/voucher")->group(function() {
        Route::get('/',[VoucherController::class, "list"]);
        Route::get('/tambah',[VoucherController::class, "formTambah"]);
        Route::get('/{id}',[VoucherController::class, "formUpdate"])
            ->whereNumber("id");
        Route::get('/{id}/delete',[VoucherController::class, "formHapus"])
            ->whereNumber("id");

        // Proses Data
        Route::post('/tambah', [VoucherController::class, "tambahData"]);
        Route::patch('/{id}', [VoucherController::class, "updateData"])
            ->whereNumber("id");
        Route::delete('/{id}', [VoucherController::class, "hapusData"])
            ->whereNumber("id");
    });

    Route::prefix("/user")->group(function() {
        Route::get('/',[UserController::class, "list"]);
        Route::get('/tambah',[UserController::class, "formTambah"]);
        Route::get('/{id}',[UserController::class, "formUpdate"])
            ->whereNumber("id");

        // Proses Data
        Route::post('/tambah', [UserController::class, "tambahData"]);
        Route::patch('/{id}', [UserController::class, "ubahData"])
            ->whereNumber("id");
        Route::delete('/{id}', [UserController::class, "hapusData"])
            ->whereNumber("id");
    });
});

Route::get("/transaksi", [TransaksiController::class, "doTransaksi"]);
Route::get("/cust-list", [ListController::class, "list"]);
