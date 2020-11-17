<?php

Route::group(['prefix' => 'auth', "namespace" => "Auth"], function () {
    Route::post('login', "LoginController");
    Route::post('signup', "SignUpController");
    Route::get('me', "MeController");
    Route::get('otp', "Otp\OtpController@index");
    Route::post('otp', "Otp\OtpController@store");
    Route::delete('otp', "Otp\OtpController@destroy");
    Route::post('logout', "SignOutController");
});

Route::group(['prefix' => 'snippets', "namespace" => "Snippets"], function () {
    Route::get('', "SnippetController@index");
    Route::post('', "SnippetController@store");
    Route::delete('{snippet}', "SnippetController@destroy");
    Route::get('{snippet}', "SnippetController@show");
    Route::patch('{snippet}', "SnippetController@update");

    Route::patch('{snippet}/steps/{step}', "StepController@update");
    Route::delete('{snippet}/steps/{step}', "StepController@destroy");
    Route::post('{snippet}/steps', "StepController@store");
});

Route::group(['prefix' => 'me', "namespace" => "Me"], function () {
    Route::get('snippets', "SnippetController@index");
});

Route::group(['prefix' => 'users/{user}', "namespace" => "Users"], function () {
    Route::get('', "UserController@show");
    Route::patch('', "UserController@update");
    Route::get('snippets', "SnippetController@index");
});
