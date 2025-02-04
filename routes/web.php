<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\ModificationController;
use App\Http\Controllers\InvitationController;


use App\Models\Person;
use Illuminate\Support\Facades\DB;
require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// require __DIR__.'/auth.php';


Route::middleware(['auth'])->group(function () {
    Route::get('/people', [PersonController::class, 'index'])->name('people.index');
    Route::get('/people/create', [PersonController::class, 'create'])->name('people.create');
    Route::post('/people', [PersonController::class, 'store'])->name('people.store');
    Route::get('/people/{id}', [PersonController::class, 'show'])->name('people.show');
});






Route::get('/test-degree', function () {
    DB::enableQueryLog();
    $timestart = microtime(true);

    $person = Person::findOrFail(84);
    $degree = $person->getDegreeWith(1265);

    $timeElapsed = microtime(true) - $timestart;
    $queries = DB::getQueryLog();

    return response()->json([
        "degree" => $degree,
        "time" => $timeElapsed,
        "nb_queries" => count($queries)
    ]);
});


Route::middleware(['auth'])->group(function () {
    Route::post('/modifications/propose', [ModificationController::class, 'propose'])->name('modifications.propose');
    Route::post('/modifications/vote/{id}/{vote}', [ModificationController::class, 'vote'])->name('modifications.vote');
});



Route::middleware(['auth'])->group(function () {
    Route::post('/invite', [InvitationController::class, 'invite'])->name('invite');
    Route::get('/accept-invite/{id}', [InvitationController::class, 'accept'])->name('invite.accept');
    Route::get('/reject-invite/{id}', [InvitationController::class, 'reject'])->name('invite.reject');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/invitations', [InvitationController::class, 'index'])->name('invitations.index');
});
