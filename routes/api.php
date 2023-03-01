<?php

use App\Http\Controllers\homeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\signupController;
use App\Http\Controllers\pro;
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
Route::post('signup', [signupController::class, 'sign']);
Route::post('login', [signupController::class, 'logInUser']);
Route::post('course_registration', [homeController::class, 'register_course']);
Route::get('get_course_register_user/{email}', [homeController::class, 'getCourseRegisteredUser']);
Route::get('get_banners', [homeController::class, 'getBanners']);
Route::get('get_languages', [homeController::class, 'getLanguages']);
Route::get('get_courses', [homeController::class, 'getCourses']);
Route::get('get_fee_structure', [homeController::class, 'getFeeStructure']);
Route::get('get_course_outline/{course_id}', [homeController::class, 'getCourseOutline']);
Route::post('signupup', [homeController::class, 'signupup']);
Route::get('get_language_category/{language_id}', [homeController::class, 'getLanguageCategory']);
Route::get('get_language_heading/{language_id}/{lang_category_id}', [homeController::class, 'getLanguageHeading']);
Route::get('get_language_detail/{sub_head_id}', [homeController::class, 'getLanguageDetails']);
Route::get('get_interview_questions/{language_id}/{lang_category_id}', [homeController::class, 'getInterviewHeading']);
Route::get('get_interview_details/{sub_head_id}', [homeController::class, 'getInterviewDetail']);
Route::get('fyp', [homeController::class, 'FYPP']);
Route::get('why_choose_us', [homeController::class, 'whychoose']);
Route::get('get_course_outline_outline', [homeController::class, 'getCourseOutlineline']);
Route::get('enroll_Dropdown', [homeController::class, 'enrolldrop']);
Route::get('Project_UI', [Pro::class, 'projects']);
Route::get('drop', [Pro::class, 'drop']);
