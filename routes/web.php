<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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
/*
Route::get('/', function () {
    return view('dashboard');
})->middleware('auth');
*/
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {return view('dashboard');});
    Route::resource('samples', \App\Http\Controllers\SampleController::class);
    Route::resource('users', \App\Http\Controllers\UsersController::class);
    Route::get('/utilities/softwares', [\App\Http\Controllers\UtilitiesController::class, 'softwares'])->name('utilities.softwares');
    Route::get('/utilities/userdocuments', [\App\Http\Controllers\UtilitiesController::class, 'userdocuments'])->name('utilities.userdocuments');
    Route::get('/getsafefile/{pathname}/{filename}', [\App\Http\Controllers\UploadImageController::class, 'getFileFromStore'])
        ->where('filename','(.*)')->name('getsafefile');
    Route::resource('substrate_batches', \App\Http\Controllers\SubstrateBatchController::class);
    Route::resource('sources', \App\Http\Controllers\SourceController::class);
    Route::resource('cvrs', \App\Http\Controllers\CvrController::class);
    Route::resource('cvr_steps', \App\Http\Controllers\CvrStepController::class);
    Route::resource('substrates', \App\Http\Controllers\SubstrateController::class);
    Route::resource('equipments', \App\Http\Controllers\EquipmentController::class);
    Route::resource('maintenances', \App\Http\Controllers\MaintenanceController::class);
    Route::resource('gas_flows', \App\Http\Controllers\GasflowController::class);
    return view('dashboard');
});


