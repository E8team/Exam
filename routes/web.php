<?php

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
Route::get('/exam', function () {
    return view('exam');
});
Route::get('/test', 'IndexController@test');
Route::get('email-verification/error', 'Auth\RegisterController@getVerificationError')->name('email-verification.error');
Route::get('email-verification/check/{token}', 'Auth\RegisterController@getVerification')->name('email-verification.check');


Route::get('/courses' , 'TestController@courses');
Route::post('auth/register', 'Auth\RegisterController@register');

Route::post('submit', 'SubmitRecordController@submit');

Route::get('allStudent', 'Admin\StudentController@allStudent');
//==Route::get('topics', 'Admin\TopicController@topics');
Route::auth();

//注册时等待邮箱验证
Route::get('wait_verify', 'Auth\RegisterController@showWaitVerifyForm')->name('wait_verify');
//重新发送验证邮件
Route::get('resend_verify_email', 'Auth\RegisterController@sendVerifyEmail')->name('resend_verify_email');

Route::get('after_verification', 'Auth\RegisterController@showAfterVerifyForm')->name('after_verification');
Route::get('choose', 'Auth\RegisterController@showChooseCourseForm')->name('choose');
Route::post('choose', 'Auth\RegisterController@selectCourses')->name('choose');