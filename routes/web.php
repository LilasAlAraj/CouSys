<?php
//namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

///*
//|--------------------------------------------------------------------------
//| Web Routes
//|--------------------------------------------------------------------------
//|
//| Here is where you can register web routes for your application. These
//| routes are loaded by the RouteServiceProvider within a group which
//| contains the "web" middleware group. Now create something great!
//|
//*/
//
Route::get('/Leen', function () {
    echo 'welcome Leen ';
    $arr = ['a', 'b', 'c'];
    echo $arr[0];
    // return view('Dania');
});

Route::get('/Dania', function () {
    return 'welcome Dania';
});
//

////////////////////////////////////////////////////////
/////                                                ///
/////            Routes for Students                ///
/////                                                ///
////////////////////////////////////////////////////////


//
//
////////////////////////////////////////////////////////
/////                                                ///
/////   Routes for uploading and downloading files   ///
/////                                                ///
////////////////////////////////////////////////////////
//
//
//Route::get('/upload-file', [FileController::class, 'uploadForm']);
//
//Route::post('/upload-file', [FileController::class, 'fileUpload'])->name('fileUpload');
//
//
//Route::get('/download-file/{id}', [FileController::class, 'downloadForm']);
//
//Route::post('/download-file/{id}', [FileController::class, 'fileDownload'])->name('fileDownload');

//
///////////////////////////////////////////////////////
/////                                               ///
/////     Route for remove a file from database     ///
/////                                               ///
///////////////////////////////////////////////////////
//
//
//Route::get('/remove-file/{id}', [FileController::class, 'removeForm']);
//
//Route::post('/remove-file/{id}', [FileController::class, 'fileRemove'])->name('fileRemove');
//
//
///////////////////////////////////////////////////////
/////                                               ///
/////              Route for Institute              ///
/////                                               ///
///////////////////////////////////////////////////////
//Route::get('/institute_page',view('institute_page'));
//
//Route::get('/InstituteLogin', [InstituteController::class, 'InstituteLoginForm']);
//
//Route::post('/InstituteLogin', [InstituteController::class, 'institutelogged']);
//
//Route::get('/InstituteSignUp', [InstituteController::class, 'InstituteSignUpForm']);
//
//Route::post('/InstituteSignUp', [InstituteController::class, 'InstituteSignUp']);
//
////////////////////////////////////////////////////////
/////                                                ///
/////              Routes for course                 ///
/////                                                ///
////////////////////////////////////////////////////////
//
//Route::get('/institute_courses', [InstituteController::class, 'ViewAllCourses']);
//
//Route::get('/AddNewCourse', [InstituteController::class, 'AddNewCourseForm']);
//
//Route::post('/AddNewCourse', [InstituteController::class, 'AddNewCourse']);
//
//Route::post('/RemoveCourse/{courseId}', [InstituteController::class, 'DeleteCourse']);
//
//Route::get('/EditCourse', [InstituteController::class, 'EditCourseForm']);
//
//Route::post('/EditCourse', [InstituteController::class, 'EditCourse']);
//
//Route::post('/StarredCourse/{courseId}', [InstituteController::class, 'StarredCourse']);
//

////////////////////////////////////////////////////////
/////                                                ///
/////              Routes for offer                  ///
/////                                                ///
////////////////////////////////////////////////////////
//
//Route::get('/institute_offers', [InstituteController::class, 'ViewAllOffers']);
//
//Route::get('/AddNewOffer', [InstituteController::class, 'AddNewOfferForm']);
//
//Route::post('/AddNewOffer', [InstituteController::class, 'AddNewOffer']);
//
//Route::post('/RemoveOffer/{offerId}', [InstituteController::class, 'DeleteOffer']);
//
//Route::get('/EditOffer', [InstituteController::class, 'EditOfferForm']);
//
//Route::post('/EditOffer', [InstituteController::class, 'EditOffer']);
//
//////
////Files
//////
//Route::get('/institute_Files/{courseId}', [InstituteController::class, 'ViewAllFiles']);
//
///////////////////////////////////////////////////////
/////                                               ///
/////                  Dash Board                   ///
/////                                               ///
///////////////////////////////////////////////////////
//Route::get('/DashBoard',view('DashBoard'));
//
//Route::get('/AdminLogin', [Admincontrol::class, 'AdminLoginForm']);
//
//Route::post('/AdminLogin', [Admincontrol::class, 'AdminLogged']);
//
//Route::get('/AddNewAdmin', [Admincontrol::class, 'AddNewAdminForm']);
//
//Route::post('/AddNewAdmin', [Admincontrol::class, 'AddNewAdmin']);
//
//Route::get('/ViewAllRequests', [Admincontrol::class, 'ViewAllRequest']);
//
//Route::get('/ViewAllInstitute', [Admincontrol::class, 'ViewAllInstitute']);
//
//Route::post('/DeleteInstitute/{instituteId}', [Admincontrol::class, 'DeleteInstitute']);
//
//Route::post('/AcceptRequest/{instituteId}', [Admincontrol::class, 'AcceptRequest']);
//
//Route::post('/DismissRequest/{instituteId}', [Admincontrol::class, 'DismissRequest']);
//
//
