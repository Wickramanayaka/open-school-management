<?php

Route::group(['middleware' => ['web', 'auth']], function(){
    // ajax calls
    Route::post('sms/report/message','proactiveants\sms\SMSReportController@message');


    Route::get('sms/','proactiveants\sms\SMSController@index');
    Route::get('sms/template','proactiveants\sms\SMSTemplateController@index');
    Route::post('sms/template/store','proactiveants\sms\SMSTemplateController@store');
    Route::post('sms/store','proactiveants\sms\SMSController@store');
    Route::get('sms/result','proactiveants\sms\SMSController@result');
    Route::get('sms/report','proactiveants\sms\SMSReportController@index');

});

