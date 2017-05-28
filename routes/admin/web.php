<?php

Route::get('/', 'IndexController@home');

//Route::get('student' , 'StudentController@getStudent');
//Route::get('student' , 'StudentController@getAllStudent');
Route::get('student' , 'StudentController@getSubmitRelated');

Route::get('topic' , 'TopicController@getTopicIdsByCourse');