<?php
namespace App\Http\Controllers;

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

Route::get('/', function () {
    return view('welcome');
});
Route::view('loginpage', view('login'));
Route::post('islogin', 'Admincontrol@adminloged');


//////////////////////////////////////////////////////
///                                                ///
///   Routes for uploading and downloading files   ///
///                                                ///
/// //////////////////////////////////////////////////


Route::get('/upload-file', [FileController::class, 'uploadForm']);

Route::post('/upload-file', [FileController::class, 'fileUpload'])->name('fileUpload');


Route::get('/download-file/{id}', [FileController::class, 'downloadForm']);

Route::post('/download-file/{id}', [FileController::class, 'fileDownload'])->name('fileDownload');


/////////////////////////////////////////////////////
///                                               ///
///     Route for remove a file from database     ///
///                                               ///
/////////////////////////////////////////////////////


Route::get('/remove-file/{id}', [FileController::class, 'removeForm']);

Route::post('/remove-file/{id}', [FileController::class, 'fileRemove'])->name('fileRemove');
