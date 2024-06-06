<?php

use App\Http\Controllers\CarritoController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Stripe\StripeController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

// HomeController
Route::redirect('/', '/home');

// JobController
Route::get('/home', [JobController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::post('/reduce-credits', [JobController::class, 'reduceCredits'])->name('reduce.credits');
    Route::get('/mis-ofertas', [JobController::class, 'userJobs'])->name('user.jobs');
    Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
    Route::get('/jobs', [JobController::class, 'create'])->name('jobs.create');
    Route::get('/jobs/{job}', [JobController::class, 'edit'])->name('jobs.edit');
    Route::put('/update/{job}', [JobController::class, 'update'])->name('jobs.update');
    Route::post('/credits', [JobController::class, 'rechargeCredits'])->name('credits.recharge');
    Route::get('/credits', function () {
        return view('jobs.recarga');
    })->name('credits');
    Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');

    // CarritoController
    Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
    Route::post('/carrito/add', [CarritoController::class, 'addToCart'])->name('carrito.add');
    Route::post('/carrito/remove', [CarritoController::class, 'removeFromCart'])->name('carrito.remove');
    Route::post('/carrito/checkout', [CarritoController::class, 'checkout'])->name('carrito.checkout');
    Route::post('/carrito/update', [CarritoController::class, 'update'])->name('carrito.update');

    // ProfileController
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ProductosController
Route::get('/recargar', [ProductoController::class, 'index'])->name('recargar');

// Email verification
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

require __DIR__.'/auth.php';

// Checkout Stripe
Route::post('/checkout', [StripeController::class, 'checkout'])->name('checkout');
Route::get('/success', [StripeController::class, 'success'])->name('success');
Route::get('/cancel', [StripeController::class, 'cancel'])->name('cancel');

// Contact
Route::get('/contact', function () {
    return view('errors.contact');
})->name('contact');

Route::post('/contact', function () {
    return redirect()->route('contact')->with('success', '¡Hemos recibido tu mensaje!');
})->name('contact');
