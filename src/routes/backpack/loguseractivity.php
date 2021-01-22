<?php

/*
|--------------------------------------------------------------------------
| Backpack\LogUserActivity Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are
| handled by the Backpack\LogUserActivity package.
|
*/

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace'  => 'Coziboy\LogUserActivityForBackpack\app\Http\Controllers',
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
], function () {
    Route::get('log-user/{id}', 'LogUserActivityController@show')->name('log-user.show');
    Route::get('log-user', 'LogUserActivityController@index')->name('log-user.index');
});
