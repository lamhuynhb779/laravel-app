<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\TestJobsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\PostsController;

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

// Test job route [START]
Route::get('/testjob', [TestJobsController::class, 'index']);
Route::get('/testjob/user', [TestJobsController::class, 'logUser']);
Route::get('/testjob/beanstalkd', [TestJobsController::class, 'beanstalkd']);
// Test job route [END]

// Events Listeners [START]
Route::get('/orders/{id}', [OrdersController::class, 'ship']);
Route::post('/orders', [OrdersController::class, 'store']);
// Events Listeners [END]

// Intervention Image: processing image [START]
Route::get('/upload-image', [UploadController::class, 'getUploadForm']);
Route::post('/upload-image', [UploadController::class, 'postUploadForm']);
// Intervention Image: processing image [END]

// Transformer [START]
Route::get('/post', [PostsController::class, 'getPost']);
// Transformer [END]

Route::get('/get-voucher', [\App\Http\Controllers\VoucherController::class, 'getVoucher']);
Route::get('/reset-voucher', [\App\Http\Controllers\VoucherController::class, 'reset']);

Route::get('/redis-pubsub', function () {
    $redis = new Redis();
    $redis->connect('redis', '6379');
    $redis->select(12);
    $redis->setex('test', 5, 'ok');
    return 'OK';
});

// SubstituteBindings route sử dụng Eloquent model bindings, sẽ tự động thay thế paramete thành Eloquent model.
Route::group(['prefix' => '/test-model-bindings'], function () {
    Route::get('/pass', function () {

        $user = \App\Models\User::query()->where('id', 1)->first();
        return redirect()->route('pass_user', ['user' => $user]);
    });

    Route::get('/pass/{user}', function (\App\Models\User $user) {
        return $user->email;
    })->name('pass_user');
});

Route::get('/connection', function () {
    $all = \Illuminate\Support\Facades\DB::table('vouchers')->get();
//    \Illuminate\Support\Facades\DB::disconnect('mysql');
//    return $all;
    dump($all);
    sleep(5);
});

require __DIR__.'/auth.php';
