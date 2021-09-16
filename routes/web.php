<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GatewayController;
use \App\Services\Gateway;

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

Route::permanentRedirect('/', 'users/register');

Route::any('/{microservice_name}/{microservice_querystring?}', GatewayController::class)->where('microservice_name', Gateway::getRegExpFromMicroservicesPrefixes())->where('microservice_querystring', '.*');
