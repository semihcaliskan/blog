<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Controller;
use RakibDevs\Weather\Weather;

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


Route::get('/weather', [App\Http\Controllers\WeatherController::class, 'index'])->name('weather');

/**
 * Basit bir blog sistemi istiyoruz
 * İçinde blog yazıları (Post) bulunacak
 * Bu yazılar bir kullanıcıya (User) ait olacak
 * Bu yazılar bir kategoriye (Category) bağlı olacak
 * Bu yazılar birçok etikete (Tag) sahip olabilecek
 *
 * Ana sayfada en sonuncudan en eskiye, sayfa başı 5 tane gözükecek şekilde listeleme olacak
 * Bir kullanıcının adına basılarak, o kullanıcın yazılarının listelemesi olacak
 * Kategoriye göre listeleme olacak
 * Etikete göre listeleme olacak
 * Aktif bir kullanıcı varsa;
 * Kullanıcı yeni bir yazı ekleyebilecek
 * Kendi yazılarını düzenleyebilecek ve silebilecek
 */

Auth::routes();

Route::resource('categories', CategoryController::class);

Route::resource('posts', PostController::class);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/mail', [App\Http\Controllers\MailController::class, 'index']);

Route::get('/categories/{category}/follow', [App\Http\Controllers\CategoryController::class, 'follow'])->name('categories.follow');

Route::get('/categories/{category}/unfollow', [App\Http\Controllers\CategoryController::class, 'unfollow'])->name('categories.unfollow');
