<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AboutUsController,ProfileController,HomeController,EventController};

Route::group(['prefix' => '/'], function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/show/{id}', [HomeController::class, 'show'])->name('eventimage.show');
});
/* Resource Module */
Route::resources([
    'about-us' => AboutUsController::class,
    'events'=>EventController::class,
]);

Route::group(['prefix' => 'events'], function () {
    Route::get('/images/{id}', [EventController::class, 'eventImages'])->name('events.images');

});