<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KKiapayWebhookController;

Route::post('/webhooks/kkiapay', [KKiapayWebhookController::class, 'handle'])->name('webhooks.kkiapay');
