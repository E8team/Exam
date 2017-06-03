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
Route::get('/', 'IndexController@index');

Route::get('/score', function (){
    return view('score');
});

Route::get('/test', 'IndexController@test');


Route::get('/courses', 'TestController@courses');

Route::get('allStudent', 'Admin\StudentController@allStudent');


Route::group(['middleware' => 'auth'], function () {
    // 注册时等待邮箱验证
    Route::get('wait_verify', 'Auth\RegisterController@showWaitVerifyForm')->name('wait_verify');
    // 重新发送验证邮件
    Route::get('resend_verify_email', 'Auth\RegisterController@sendVerifyEmail')->name('resend_verify_email');
    // 邮箱验证的token错误
    Route::get('email-verification/error', 'Auth\RegisterController@getVerificationError')->name('email-verification.error');
    // 检验邮箱验证token
    Route::get('email-verification/check/{token}', 'Auth\RegisterController@getVerification')->name('email-verification.check');
    // 退出登录
    $this->get('logout', 'Auth\LoginController@logout')->name('logout');
    // 邮箱验证通过
    Route::group(['middleware' => 'isVerified'], function () {
        Route::group(['middleware' => 'user_selected_courses'], function () {
            Route::group(['middleware' => 'isMockEnded'], function () {
                Route::get('/menu/{courseId}', 'IndexController@menu')->name('menu');
                Route::get('/create_mock/course/{courseId}', 'MockController@createMock')->name('create_mock');
                Route::get('/mock/{mockRecordId}', 'MockController@showMockView')->name('mock');
                Route::get('/end_mock/{mockRecordId}', 'MockController@endMock')->name('end_mock');
            });
        });
        Route::get('after_verification', 'Auth\RegisterController@showAfterVerifyForm')->name('after_verification');
        Route::get('choose', 'CoursesController@showChooseCourseForm')->name('choose');
        Route::post('choose', 'CoursesController@selectCourses');
    });
});


Route::group(['middleware' => 'guest'], function () {
    // Registration Routes...
    $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    $this->post('register', 'Auth\RegisterController@register');
    // Password Reset Routes...
    $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    $this->post('password/reset', 'Auth\ResetPasswordController@reset');
    // Authentication Routes...
    $this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
    $this->post('login', 'Auth\LoginController@login');
});