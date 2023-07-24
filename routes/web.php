<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [
    \App\Http\Controllers\PostController::class, 'index'
])->name('index');

Route::prefix('/auth')->name('auth.')->controller(\App\Http\Controllers\AuthController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'login')->name('login');
    Route::post('/logout', 'logout')->name('logout');
    Route::post('/register', 'register')->name('register');
});

Route::get(
    '/chatrooms', [
        \App\Http\Controllers\ChannelController::class, 'getChannels'
    ])->name('chatrooms');

Route::prefix('/channels')->name('channels.')->controller(\App\Http\Controllers\ChannelController::class)->group(function () {
    Route::get('/{chatRoomId}/messages', 'getMessages')->name('messages');
    Route::post('/{chatRoomId}/messages', 'sendMessage')->name('messages')->middleware('auth');
});

Route::prefix('/posts')->name('post.')->controller(\App\Http\Controllers\PostController::class)->middleware('auth')->group(function () {
    Route::get('/new', 'create')->name('create');
    Route::post('/new', 'store');
    Route::get('/{post}/edit', 'edit')->name('edit');
    Route::post('/{post}/edit', 'update');
    Route::get('/{post}/delete', 'delete')->name('delete');
});

Route::prefix('/friends')->name('friend.')->controller(\App\Http\Controllers\FriendController::class)->middleware('auth')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{person1}/add/{person2}', 'add')->name('add');
    Route::get('/{person1}/remove/{person2}', 'remove')->name('remove');
    Route::get('/{friendship}', 'acceptFriend')->name('accept');
});

Route::prefix('/notification')->name('notification.')->controller(\App\Http\Controllers\NotificationController::class)->middleware('auth')->group(function () {
    Route::get('/{user}/read', 'read')->name('read');
});



