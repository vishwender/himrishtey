<?php

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/design-preview', [WelcomeController::class, 'designPreview'])->name('design-preview');
Route::get('about-us', [WelcomeController::class, 'about'])->name('about-us');
Route::get('success-stories', [WelcomeController::class, 'success_stories'])->name('success-stories');
Route::get('contact-us', [WelcomeController::class, 'contact'])->name('contact-us');
Route::post('contact-us', [WelcomeController::class, 'submitContact'])->middleware('throttle:5,1')->name('contact-us.submit');
Route::get('privacy-policy', [WelcomeController::class, 'privacy_policy'])->name('privacy-policy');
Route::get('refund-policy', [WelcomeController::class, 'refund_policy'])->name('refund-policy');
Route::redirect('refun-policy', '/refund-policy')->name('refun-policy');
Route::get('terms-and-conditions', [WelcomeController::class, 'terms_and_conditions'])->name('terms-and-conditions');
Route::get('child-safety-standard', [WelcomeController::class, 'child_safety'])->name('child-safety-standard');
Route::get('pricing', [WelcomeController::class, 'pricing'])->name('pricing');
Route::get('blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('faqs', [WelcomeController::class, 'faqs'])->name('faqs');
