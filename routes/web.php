<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Define route for testing call procedure [START]
Route::get('/pages', [PagesController::class, 'getUsers']);
Route::get('/pages/{name}', [PagesController::class, 'getUsers']);
// Define route for testing call procedure [END]

require __DIR__.'/auth.php';
