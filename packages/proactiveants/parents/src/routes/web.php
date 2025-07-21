<?php
// Alternative sms code verification via browser
Route::get('/parents/verify','proactiveants\parents\ParentsAppUserController@verify');
Route::get('/parents/genie/success','proactiveants\parents\ParentsAppPaymentController@successGenie');
Route::get('/parents/genie/error','proactiveants\parents\ParentsAppPaymentController@errorGenie');
Route::get('/parents/genie/complete','proactiveants\parents\ParentsAppPaymentController@completeGenie');
Route::get('/parents/genie/incomplete','proactiveants\parents\ParentsAppPaymentController@incompleteGenie');


Route::group(['middleware' => ['web', 'auth']], function(){
    Route::group(['middleware' => ['role:Administrator|Principal']], function(){
        Route::get('/parents','proactiveants\parents\ParentsAppUserController@index')->name('parents.index');
        Route::get('/parents/toggle/{id}','proactiveants\parents\ParentsAppUserController@toggle')->name('parents.toggle');
        Route::get('/parents/{id}/view','proactiveants\parents\ParentsAppUserController@show')->name('parents.view');
        Route::get('/parents/{id}/payment','proactiveants\parents\ParentsAppUserController@payment')->name('parents.payment');
        Route::get('/parents/payment/{pid}/cancel','proactiveants\parents\ParentsAppPaymentController@cancel')->name('parents.payment.cancel');
        Route::post('/parents/payment/store','proactiveants\parents\ParentsAppPaymentController@store')->name('parents.payment.store');
        // Ajax calls
        Route::get('/parents/{pid}/createPayment','proactiveants\parents\ParentsAppPaymentController@create')->name('parents.payment.create');
        // New
        Route::get('/parents/create','proactiveants\parents\ParentsAppUserController@create')->name('parents.create');
        Route::post('/parents/create','proactiveants\parents\ParentsAppUserController@store')->name('parents.store');
        Route::get('/parents/destroy/{id}','proactiveants\parents\ParentsAppUserController@destroy')->name('parents.destroy');
    });
});

