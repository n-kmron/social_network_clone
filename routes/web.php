<?php

use Illuminate\Support\Facades\Route;

//NAVIGATE ROUTES

Route::get('/', function () {
    return view('homepage');
});

Route::get(
    '/chatrooms',
    [
        \App\Http\Controllers\ChannelController::class, 'getChannels'
    ]
);

Route::get('/login', function () {
    return view('login');
});

//AUTH ROUTES

Route::post(
    '/login',
    [
        \App\Http\Controllers\LoginController::class, 'login'
    ]
);

Route::post(
    '/logout',
    [
        \App\Http\Controllers\LoginController::class, 'logout'
    ]
);

Route::post(
    '/register',
    [
        \App\Http\Controllers\LoginController::class, 'register'
    ]
);


//FEATURES
Route::post(
    '/login/editName',
    [
        \App\Http\Controllers\ManageAccountCtrl::class, 'editdisplayname'
    ]
);


//API
Route::get(
    '/channels/{chatRoomId}/messages',
    [
        \App\Http\Controllers\ChannelController::class, 'getMessages'
    ]
);

Route::post(
    '/channels/{chatRoomId}/messages',
    [
        \App\Http\Controllers\ChannelController::class, 'putMessage'
    ]
);

