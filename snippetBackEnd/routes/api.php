<?php

Route::group(['prefix' => 'auth', "namespace" => "Auth"], function () {
    Route::post('login', "LoginController");
    Route::get('me', "MeController");
    Route::post('logout', "SignOutController");
});
