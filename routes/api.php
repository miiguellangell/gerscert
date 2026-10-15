<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//  Route::middleware('auth:api')->get('/user', function (Request $request) {
//      return $request->user();
// });

// Emisión de certificados desde WordPress (Tutor LMS → Reportes → Estudiante).
Route::post('/wp/certificados', [\App\Http\Controllers\Api\WpCertificateController::class, 'store'])
    ->middleware('wp.token');
