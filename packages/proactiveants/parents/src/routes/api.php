<?php

Route::group(['middleware'=> 'api_parents'], function(){
    // APIController
    Route::get('api/parents','proactiveants\parents\ParentsAppAPIController@check');
    Route::post('api/parents/verifyPhoneNumber','proactiveants\parents\ParentsAppAPIController@verifyPhoneNumber');
    Route::post('api/parents/verifySMSCode','proactiveants\parents\ParentsAppAPIController@verifySMSCode');
    Route::post('api/parents/verifyToken','proactiveants\parents\ParentsAppAPIController@verifyToken');
});
Route::group(['middleware'=> 'api_parents_auth'], function(){
    Route::post('api/parents/verifyPayment','proactiveants\parents\ParentsAppAPIController@verifyPayment');
    Route::post('api/parents/renew','proactiveants\parents\ParentsAppAPIController@renew');
    // StudentAPIController
    Route::post('api/parents/getStudent','proactiveants\parents\ParentsAppStudentAPIController@getStudent');
    Route::post('api/parents/getExam','proactiveants\parents\ParentsAppStudentAPIController@getExam');
    Route::post('api/parents/getExamResult','proactiveants\parents\ParentsAppStudentAPIController@getExamResult');
    Route::post('api/parents/getSchoolPayment','proactiveants\parents\ParentsAppStudentAPIController@getSchoolPayment');
    Route::post('api/parents/getSubject','proactiveants\parents\ParentsAppStudentAPIController@getSubject');
    Route::post('api/parents/getVideo','proactiveants\parents\ParentsAppStudentAPIController@getVideo');
    // ParentAPIController
    Route::post('api/parents/updateParents','proactiveants\parents\ParentsAppParentsAPIController@updateParents');
    Route::post('api/parents/getParents','proactiveants\parents\ParentsAppParentsAPIController@getParents');
});