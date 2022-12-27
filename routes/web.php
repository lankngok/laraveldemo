<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\ProvinceController;
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
// dùng route prefix cho gọn
Route::prefix('')->group(function(){
    // nếu url k có gì (/) thì trả về view index, trong HomeController
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    // Sử dụng router resources để đỡ phải định nghĩa 1 đống route
    // Nếu phải Crud trên 2 bảng thì dùng route Resources, còn nếu k thì route resource thường
    // VD:
    // Route::resource('province', ProvinceController::class);
    // Route::resource('people', PeopleController::class);

    Route::resources([
        'province' => ProvinceController::class,
        'people' => PeopleController::class
    ]);
});
