<?php

$api->group(['middleware'=>['auth', 'isVerified', 'user_selected_courses']], function ($api){
    $api->post('submit', 'SubmitRecordController@submit');
});
