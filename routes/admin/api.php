<?php

$api->get('test', 'StudentController@test')->name('test');

//$api->get('users', 'UsersController@lists');
$api->get('users', 'UsersController@getUser');

//$api->get('topics', 'TopicController@lists');
$api->get('topics', 'TopicController@getTopic');

//$api->get('course' , 'CourseController@getAllCourses');
$api->get('course' , 'CourseController@getCourse');

$api->get('submit/{id}' , 'SubmitRecordController@getSubmitRecord');
$api->get('submit' , 'SubmitRecordController@lists');


$api->get('getUser' , 'UsersController@getUser');