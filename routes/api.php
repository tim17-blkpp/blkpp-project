<?php

use App\Http\Controllers\Admin\DashboardController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// sinau api

// Route::post('/get-statistik', [DashboardController::class, 'getStatistik']);
// Route::get('/get-statistik', function() {
//     return response()->json([
//         'response_code' => 403,
//         'message' => 'Forbidden access'
//     ])->setStatusCode(403);
//     // atau return redirect()->back() aja
// });

// Route::middleware('auth:sanctum')->get('/get-statistik', [DashboardController::class, 'getStatistik']);
Route::middleware('auth:sanctum', 'checkRole:Super Admin,Admin')->group(function () {
    Route::get('/get-statistik', [DashboardController::class, 'getStatistik']);
});

Route::get('/data-pelatihan', [DashboardController::class, 'getDataPelatihan']);

Route::get('/data-chart-usia', [DashboardController::class, 'getDataUmur']);
Route::get('/data-chart-pendidikan', [DashboardController::class, 'getDataPendidikan']);
Route::get('/data-chart-anggaran', [DashboardController::class, 'getDataAnggaran']);
Route::get('/data-chart-kompetensi', [DashboardController::class, 'getDataKompetensi']);

Route::get('/data-statistik', [DashboardController::class, 'getStatistik']);
