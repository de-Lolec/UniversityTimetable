<?php

use App\Http\Controllers\Timetable\User\UserProfileController;
use App\Http\Controllers\Timetable\Admin\TimetableController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('Timetable');
//});

Route::get('', [App\Http\Controllers\Timetable\admin\TimetableController::class, 'indexMainPage'])->name('index.timetable');

Route::get('sort/', [App\Http\Controllers\Timetable\admin\TimetableController::class, 'TimeIndex'])->name('sort');
//Route::get('/user/{id}/{name}', function ($id, $name) {
//    return 'ID: ' . $id . 'Name: ' . $name;
//});

//Route::get(
//    '/user/profile',
//    [UserProfileController::class, 'index']
//)->name('profile');


Route::get('/user/{id}/{name}', [App\Http\Controllers\Timetable\User\UserProfileController::class, 'index'])->name('profile');

Route::controller(UserProfileController::class)->group(function () {
    Route::get('/user/{id}/{name}', 'index')->name('profile');
    Route::get('/user/{id}/{name}/edit', 'edit')->name('profile.edit');
    Route::post('/user/{id}/{name}/store', 'store')->name('profile.store');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('events', [EventController::class, 'index']);

$groupData = [
    'namespace' => 'App\Http\Controllers',
    'prefix' => '/admin/',
];


Route::group($groupData, function () {
    $methods = ['index', 'edit', 'update', 'create', 'store', 'destroy'];
    Route::resource('prepods', 'Timetable\Admin\PrepodsController')
        ->only($methods)
        ->names('prepods');
});

Route::group($groupData, function () {
    $methods = ['index', 'edit', 'update', 'create', 'store', 'destroy'];
    Route::resource('groups', 'Timetable\Admin\GroupsController')
        ->only($methods)
        ->names('groups');
});

$groupData = [
    'namespace' => 'App\Http\Controllers',
    'prefix' => '/admin/{group_id}/',
];

Route::group($groupData, function () {
    $methods = ['index', 'indexMainPage', 'edit', 'update', 'create', 'store', 'destroy'];
    Route::resource('timetable', 'Timetable\Admin\TimetableController')
        ->only($methods)
        ->names('timetable');
});

Route::group($groupData, function () {
    $methods = ['index', 'edit', 'update', 'create', 'store', 'destroy'];
    Route::resource('predmet', 'Timetable\Admin\PredmetController')
        ->only($methods)
        ->names('predmet');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
