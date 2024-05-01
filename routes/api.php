<?php

use App\Http\Controllers\OrdersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Models\Article;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Using Middlewares to Restrict Access
// With the api_token created, we can toggle the authentication middleware in the routes file:
Route::middleware('auth:api')->get('/user', function(Request $request){
    // We can access the current user using the $request->user() method or through the Auth facade
    return $request->user();
});

// This way we don’t have to set the middleware for each of the routes. It doesn’t save a lot of time
// right now, but as the project grows it helps to keep the routes DRY.
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('articles', [ArticleController::class, 'index']); // Find all
    Route::get('articles/{id}', [ArticleController::class, 'show']); // Retrieve
    Route::post('articles', [ArticleController::class, 'store']); // Create new
    Route::put('articles/{id}', [ArticleController::class, 'update']); // Update
    Route::delete('articles/{id}', [ArticleController::class, 'delete']); // Delete

    Route::post('/orders', [OrdersController::class, 'store']);
});

Route::post('register', [RegistrationController::class, 'register']); // Customize own register controller
Route::post('login', [LoginController::class, 'login']); // Login
Route::post('logout', [LoginController::class, 'logout']); // Logout

// Test connect mongodb
Route::get('/mongo/ping', function () {
    $connection = \Illuminate\Support\Facades\DB::connection('mongodb');
    $msg = 'MongoDb is accessible!';
    try {
        $connection->command(['ping' => 1]);
    } catch (Exception $e) {
        $msg = 'MongoDb is not accessible. Error: '.$e->getMessage();
    }
    return ['msg' => $msg];
});

Route::post('/products', [\App\Http\Controllers\NotificationController::class, 'createProduct']);
Route::get('/noti/users/{userId}', [\App\Http\Controllers\NotificationController::class, 'listNotiByUser']);

// KAFKA
Route::get('kafka/producer', function () {
    $service = new \App\Services\KafkaProducer();
    return $service->runProducer();
});

Route::get('kafka/consumer', function () {
    $service = new \App\Services\KafkaConsumer();
    return $service->runConsumer();
});

// RabbitMQ
Route::post('rabbitmq/producer', function (Request $request) {
    $service = new \App\Services\RabbitMQProducer();
    return $service->runProducer($request->all());
});

Route::get('rabbitmq/consumer', function () {
//    $service = new \App\Services\KafkaConsumer();
//    return $service->runConsumer();
});
