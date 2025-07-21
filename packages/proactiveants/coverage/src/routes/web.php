<?php

Route::get('coverage','proativeants\coverage\CoverageController@index');
// Route::get('coverage',function(){
//     echo "Hello, this is paclage.";
// });

Route::group(['middleware' => ['web', 'auth']], function(){
    Route::group(['middleware' => ['role:Administrator|Principal']], function(){
        Route::get('chapter/{id}/create','proactiveants\coverage\ChapterController@create');
        Route::resource('chapter','proactiveants\coverage\ChapterController');
        Route::get('pincode','proactiveants\coverage\PinCodeController@index')->name('coverage.pincode.index');
        Route::get('pincode/{id}/edit','proactiveants\coverage\PinCodeController@edit')->name('coverage.pincode.edit');
        Route::post('pincode/update','proactiveants\coverage\PinCodeController@update')->name('coverage.pincode.update');
        Route::get('management','proactiveants\coverage\ManagementController@index')->name('coverage.management.index');
        Route::get('management/class_room','proactiveants\coverage\ManagementController@classRoom');
        Route::get('management/{id}','proactiveants\coverage\ManagementController@view');
        Route::get('management/{id}/chart','proactiveants\coverage\ManagementController@chart');
        Route::get('management/{id}/attendance','proactiveants\coverage\ManagementController@attendance');
        Route::get('management/{id}/period','proactiveants\coverage\ManagementController@period');
        Route::resource('device','DeviceController');
        Route::get('coverage/report/teach','proactiveants\coverage\CoverageReportController@teach');
        Route::get('coverage/report/attendance','proactiveants\coverage\CoverageReportController@attendance');
        Route::get('coverage/report/feedback','proactiveants\coverage\CoverageReportController@feedback');
        Route::post('coverage/report/teach','proactiveants\coverage\CoverageReportController@postTeach');
        Route::post('coverage/report/attendance','proactiveants\coverage\CoverageReportController@postAttendance');
        Route::post('coverage/report/feedback','proactiveants\coverage\CoverageReportController@postFeedback');
    });
});

