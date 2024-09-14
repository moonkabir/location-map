<?php

use App\Http\Controllers\MapController;
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

require __DIR__.'/auth.php';

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/map/view', [MapController::class,'view']);
Route::post('/map/map-data', [MapController::class,'mapData']);
Route::get('/map/map-data/{id}', [MapController::class,'viewDetails']);


Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    // Route::get('/map/config', [MapController::class,'Config']);
    Route::get('/map/admin', [MapController::class,'admin']);
    Route::post('/map/create', [MapController::class,'create']);
    Route::get('/map/edit/{id}', [MapController::class,'edit']);
    Route::post('/map/update', [MapController::class,'update']);
    Route::post('/map/delete/{id}', [MapController::class,'delete']);
    // Route::get('/map/fileEntry', [MapController::class, 'fileEntry']);
    // Route::Post('/map/file', [MapController::class, 'file']);
});