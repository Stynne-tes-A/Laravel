<?php


use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;
use App\Livewire\Chat\Index;
use App\Livewire\Chat\Main;
use App\Livewire\Explore;
use App\Livewire\Home;
use App\Livewire\Post\View\Page;
use App\Livewire\Profile\Home as ProfileHome;
use App\Livewire\Profile\Reels;
use App\Livewire\Profile\Saved;
use App\Livewire\Reels as LivewireReels;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->put('/user/password', [PasswordController::class, 'update'])->name('password.update');


Route::middleware('auth')->group(function () {
    // Edit Profile Routes
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
   // Profile Update Route - using PATCH method
Route::middleware('auth')->patch('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Main App Routes
    Route::get('/', Home::class)->name('Home');
    Route::get('/explore', Explore::class)->name('explore');
    Route::get('/reels', LivewireReels::class)->name('reels');

    // Post Routes
    Route::get('/post/{post}', Page::class)->name('post');

    // Chat Routes
    Route::get('/chat', Index::class)->name('chat');
    Route::get('/chat/{chat}', Main::class)->name('chat.main');

    // User Profile Routes
    Route::get('/profile/{user}', ProfileHome::class)->name('profile.home');
    Route::get('/profile/{user}/reels', Reels::class)->name('profile.reels');
    Route::get('/profile/{user}/saved', Saved::class)->name('profile.saved');
});

// Authentication Routes
require __DIR__.'/auth.php';
