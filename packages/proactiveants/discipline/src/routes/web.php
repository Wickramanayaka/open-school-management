<?php

Route::group(['middleware' => ['web', 'auth']], function(){
    // ajax calls
    Route::get('discipline/student/getinfo','proactiveants\discipline\DisciplineController@getStudent');
    Route::resource('discipline/student','proactiveants\discipline\DisobedienceStudentController');
    Route::group(['middleware' => ['role:Administrator|Principal']], function(){
        

        Route::resource('discipline/category','proactiveants\discipline\DisobedienceCategoryController');
        Route::resource('discipline/disobedience','proactiveants\discipline\DisobedienceController');
        
        Route::get('discipline/report/disobedience','proactiveants\discipline\DisciplineReportController@getDisobedience');
        Route::post('discipline/report/disobedience','proactiveants\discipline\DisciplineReportController@postDisobedience');
        Route::get('discipline/report/student','proactiveants\discipline\DisciplineReportController@getPoint');
        Route::post('discipline/report/student','proactiveants\discipline\DisciplineReportController@postPoint');
    });
});

