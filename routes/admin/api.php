<?php

$api->get('test', 'StudentController@test')->name('test');
$api->get('users', 'UsersController@lists');
$api->get('topics', 'TopicController@lists');