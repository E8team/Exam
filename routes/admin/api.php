<?php

$api->get('test', 'StudentController@test')->name('test');

$api->get('users', 'UsersController@lists');
$api->get('users/{id}', 'UsersController@getUser');

$api->get('topics', 'TopicController@lists');
$api->get('topics/{id}', 'TopicController@getTopic');

$api->get('course' , 'CourseController@lists');
$api->get('course/{id}' , 'CourseController@getCourse');

$api->get('submit/{id}' , 'SubmitRecordController@getSubmitRecord');
$api->get('submit' , 'SubmitRecordController@lists');


