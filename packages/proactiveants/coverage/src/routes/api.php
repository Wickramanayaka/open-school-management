<?php

use Illuminate\Http\Request;

Route::get('api/coverage/class_room', 'proactiveants\coverage\CoverageController@classRoom');
Route::get('api/coverage/checkin', 'proactiveants\coverage\CoverageController@checking');
Route::post('api/coverage/feedback', 'proactiveants\coverage\FeedbackController@store');
// Device regisration at just after installation
Route::post('api/coverage/device', 'proactiveants\coverage\DeviceController@store');

Route::group(['middleware'=> 'auth:api'], function(){
    // All authenticated routes go here.
    Route::get('api/coverage/check', 'proactiveants\coverage\CoverageController@check');
    Route::post('api/coverage/class_room/subject', 'proactiveants\coverage\CoverageController@subject');
    Route::post('api/coverage/subject/chapter', 'proactiveants\coverage\CoverageController@chapter');
    Route::post('api/coverage/class_room/student', 'proactiveants\coverage\CoverageController@student');
    Route::post('api/coverage/class_room/register', 'proactiveants\coverage\CoverageController@register');
    Route::post('api/coverage/period/begin', 'proactiveants\coverage\CoverageController@periodBegin');
    Route::post('api/coverage/period/complete', 'proactiveants\coverage\CoverageController@periodComplete');
    Route::post('api/coverage/period/incomplete', 'proactiveants\coverage\CoverageController@periodIncomplete');
    Route::post('api/coverage/class_room/info', 'proactiveants\coverage\CoverageController@info');
    Route::post('api/coverage/grade', 'proactiveants\coverage\CoverageController@grade');
    Route::post('api/coverage/grade_class_room', 'proactiveants\coverage\CoverageController@gradeClassRoom');
    Route::post('api/coverage/grade_subject', 'proactiveants\coverage\CoverageController@gradeSubject');
    Route::post('api/coverage/warning_on', 'proactiveants\coverage\CoverageController@warningOn');
    Route::post('api/coverage/warning_off', 'proactiveants\coverage\CoverageController@warningOff');
    Route::post('api/coverage/warning_check', 'proactiveants\coverage\CoverageController@warningCheck');
});