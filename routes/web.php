<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DonateController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsletterController;

// Language switch
Route::get('/lang/{locale}', function (string $locale) {
    if (in_array($locale, ['fr', 'en'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/a-propos', [AboutController::class, 'index'])->name('about');
Route::get('/nos-actions', [ActionController::class, 'index'])->name('actions.index');
Route::get('/nos-actions/{slug}', [ActionController::class, 'show'])->name('actions.show');
Route::get('/evenements', [EventController::class, 'index'])->name('events.index');
Route::get('/evenements/{slug}', [EventController::class, 'show'])->name('events.show');
Route::get('/faire-un-don', [DonateController::class, 'index'])->name('donate');
Route::get('/don-merci', [DonateController::class, 'merci'])->name('donate.merci');
Route::get('/mediatheque', [DocumentController::class, 'index'])->name('documents.index');
Route::get('/mediatheque/telecharger/{id}', [DocumentController::class, 'download'])->name('documents.download');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/newsletter/confirm/{token}', [NewsletterController::class, 'confirm'])->name('newsletter.confirm');
Route::get('/newsletter/unsubscribe/{token}', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');
