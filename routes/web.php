<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EkspedisiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\VariablePenilaianController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::prefix('backend')->middleware("admin")->group(function () {
    Route::resource("mitra", MitraController::class);
    Route::resource("admin", AdminController::class);
    Route::resource("ekspedisi", EkspedisiController::class);
    Route::resource("variable-penilaian", VariablePenilaianController::class);
    Route::get("edit-profile", [AuthController::class, "editProfile"])->name("editProfile");
    Route::post("updateProfile", [AuthController::class, "updateProfile"])->name("updateProfile");
});

Route::get("/penilaian/{id_ekspedisi}", [HomeController::class, "penilaian"])->name("penilaian")->middleware("auth");
Route::post("/prosesPenilaian", [HomeController::class, "prosesPenilaian"])->name("prosesPenilaian")->middleware("auth");

Route::get("login", [AuthController::class, "login"])->name("login");
Route::post("prosesLogin", [AuthController::class, "prosesLogin"])->name("prosesLogin");

Route::get("/", [HomeController::class, "index"])->name("home");
Route::get("/home", [HomeController::class, "index"]);

Route::get('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->name('logout')->middleware("auth");
