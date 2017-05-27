<?php
Route::get('home', 'IndexController@home');

//Route::get('student' , 'StudentController@getStudent');
Route::get('student' , 'StudentController@getAllStudent');