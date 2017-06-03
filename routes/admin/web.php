<?php

Route::get('/', 'IndexController@home');

//Route::get('student' , 'StudentController@getStudent');
//Route::get('student' , 'StudentController@getAllStudent');
//Route::get('student' , 'StudentController@getSubmitRelated');
Route::get('student' , 'StudentController@getCourseStudent');

//Route::get('topic' , 'TopicController@getTopicIdsByCourse');
Route::get('topic' , 'TopicController@getTopicSubmit');

Route::get('login' , 'LoginController@login');