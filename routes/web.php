<?php
//namespace App\Http\Controllers;

use App\Http\Controllers\Admincontrol;
use App\Http\Controllers\EnrollmentCourseRequestController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\InstituteController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Studentcontrol;
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

////////////////////////////////////////////////////////
/////                                                ///
/////             Route for Login                ///
/////                                                ///
////////////////////////////////////////////////////////
Route::post('/login', [\App\Http\Controllers\AccountsLogController::class, 'LoginProcess']);


////////////////////////////////////////////////////////
/////                                                ///
/////             Routes for Students                ///
/////                                                ///
////////////////////////////////////////////////////////
Route::post('/sign-up/student', [Studentcontrol::class, 'storeStudentRecord'])->name('signUpStudent');
Route::post('/student/delete', [Studentcontrol::class, 'deleteStudentRecord'])->name('editStudent');
Route::post('/student/edit', [Studentcontrol::class, 'editStudentRecord'])->name('editStudent');
Route::post('/student/course-enrollment', [Studentcontrol::class, 'storeStudentRecord'])->name('signUpStudent');

////////////////////////////////////////////////////////
/////                                                ///
/////            Routes for Feedbacks                ///
/////                                                ///
////////////////////////////////////////////////////////
Route::post('/feedback/send', [FeedbackController::class, 'sendFeedback'])->name('sendFeedback');
Route::post('/feedback/review', [FeedbackController::class, 'reviewFeedback'])->name('reviewFeedback');

////////////////////////////////////////////////////////
/////                                                ///
/////   Routes for uploading and downloading files   ///
/////                                                ///
////////////////////////////////////////////////////////


Route::post('/institute/upload-file', [FileController::class, 'fileUpload'])->name('fileUpload');
Route::post('/institute/download-file/', [FileController::class, 'fileDownload'])->name('fileDownload');
Route::post('/institute/remove-file/', [FileController::class, 'fileRemove'])->name('fileRemove');


///////////////////////////////////////////////////////
/////                                               ///
/////              Route for Institute              ///
/////                                               ///
///////////////////////////////////////////////////////


Route::post('/InstituteSignUp', [InstituteController::class, 'InstituteSignUp']);

//////
////Courses
//////

Route::get('/ViewAllCourses/{inst_id}', [InstituteController::class, 'ViewAllCoursesWithOffer']);

Route::post('/AddNewCourse', [InstituteController::class, 'AddNewCourse']);

Route::get('/RemoveCourse/{courseId}', [InstituteController::class, 'DeleteCourse']);

Route::post('/EditCourse', [InstituteController::class, 'EditCourse']);

Route::get('/StarredCourse/{courseId}', [InstituteController::class, 'StarredCourse']);

//////
////Offer
//////

Route::get('/ViewAllOffers/{inst_id}', [InstituteController::class, 'ViewAllOffers']);

Route::post('/AddNewOffer', [InstituteController::class, 'AddNewOffer']);

Route::get('/RemoveOffer/{offerId}', [InstituteController::class, 'DeleteOffer']);

Route::post('/EditOffer', [InstituteController::class, 'EditOffer']);

//////
////Files
//////
Route::get('/ViewFiles/{courseId}', [InstituteController::class, 'ViewAllFiles']);

////
/// request
////

Route::post('/course/request/add', [EnrollmentCourseRequestController::class, 'addRequest']);
Route::post('/course/request/accept', [EnrollmentCourseRequestController::class, 'AcceptRequest']);
Route::post('/course/request/dismiss', [EnrollmentCourseRequestController::class, 'DismissRequest']);

///////////////////////////////////////////////////////
/////                                               ///
/////                  Dash Board                   ///
/////                                               ///
///////////////////////////////////////////////////////


Route::post('/AddNewAdmin', [Admincontrol::class, 'AddNewAdmin']);

Route::get('/ViewAllInstitute', [Admincontrol::class, 'ViewAllInstitute']);

Route::get('/DeleteInstitute/{instituteId}', [Admincontrol::class, 'DeleteInstitute']);

Route::get('/ViewAllRequests', [Admincontrol::class, 'ViewAllRequest']);

Route::post('/AcceptRequest/{instituteId}', [Admincontrol::class, 'AcceptRequest']);

Route::post('/DismissRequest/{instituteId}', [Admincontrol::class, 'DeleteInstitute']);

Route::get('/ViewAllStudent', [Admincontrol::class, 'ViewAllStudent']);

Route::get('/DeleteStudent/{studentId}', [Admincontrol::class, 'DeleteStudent']);

//Search
Route::post('/Search', [SearchController::class, 'Search']);
