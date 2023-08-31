<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\AdministratorSchema;

// php artisan make:model Administrator -cm
// php artisan make:model Ads -cm
// php artisan make:model Attachment -cm
// php artisan make:model Chat -cm
// php artisan make:model Comment -cm
// php artisan make:model CountriesStatesCities -cm
// php artisan make:model ForgotPasswordSchema -cm
// php artisan make:model MessageAttachment -cm
// php artisan make:model MessageAttachmentSchema -cm
// php artisan make:model Message -cm
// php artisan make:model Notification -cm
// php artisan make:model Post -cm
// php artisan make:model Reason -cm
// php artisan make:model Report -cm
// php artisan make:model UserAccountPrefrence -cm
// php artisan make:model User -cm

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('auth')->group(function () {
    Route::post('employee/login', [AuthController::class, 'login']);
    // Define other authentication routes if needed.
});

Route::group(['middleware' => 'auth:administrator_schemas'], function () {

    Route::get("admin", [AuthController::class, "login"]);
});

Route::post('login', [AuthController::class, 'login']);

Route::group(
    ['middleware' => 'auth:sanctum'],
    function () {
    }
);
