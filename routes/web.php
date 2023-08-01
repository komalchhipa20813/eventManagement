<?php

use App\Http\Controllers\{ProfileController,HomeController};
use App\Http\Controllers\Admin\{EventController,UserController,EventGalleryController,AboutUsController};
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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


//     
    
require __DIR__.'/frontWeb.php';

Route::middleware('auth')->group(function () {

	Route::get('/dashboard', function () {
    		return view('dashboard');
	})->middleware(['auth', 'verified'])->name('dashboard');

    Route::get('Event/photo-upload', [EventController::class, 'uploadPhotoIndex'])->name('photoupload');
    Route::post('Event/photo-upload-store', [EventController::class, 'uploadPhotoStore'])->name('photouploadStore');

	/* Resource Module */
    Route::resources([
        'event' => EventController::class,
        'user' => UserController::class,
        'event-gallery'=>EventGalleryController::class,
    ]);

    /* Event */
    Route::group(['prefix' => 'event'], function () {
        Route::post('/listing', [EventController::class, 'listing']);
        Route::post('/event-check', [EventController::class, 'event_check']);
        Route::post('/delete-all', [EventController::class, 'deleteAll']);
        // Route::get('/photo-upload', [EventController::class, 'uploadPhotoIndex'])->name('photoupload');
    
    });

    /* Event Gallery */
    Route::group(['prefix' => 'event-gallery'], function () {
        Route::post('/delete-image', [EventGalleryController::class, 'deleteImage']);
        Route::post('/event-images', [EventGalleryController::class, 'event_images'])->name('eventimages');
    
    });

    /* user */
    Route::group(['prefix' => 'user'], function () {
        Route::post('/listing', [UserController::class, 'listing']);
        Route::post('/user-check', [UserController::class, 'user_check']);
        Route::post('/delete-all', [UserController::class, 'deleteAll']);
    
    });


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
