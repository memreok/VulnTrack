<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VulnerabilityController;
use App\Models\Vulnerability;
use App\Http\Controllers\CommentController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    // İstatistikleri çekiyoruz
    $totalVulnerabilities = Vulnerability::count();
    $openVulnerabilities = Vulnerability::where('status', 'Açık')->count();
    $closedVulnerabilities = Vulnerability::where('status', 'Kapatıldı')->count();


    return view('dashboard', [
        'totalVulnerabilities' => $totalVulnerabilities,
        'openVulnerabilities' => $openVulnerabilities,
        'closedVulnerabilities' => $closedVulnerabilities,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/vulnerabilities/{vulnerability}/comments', [CommentController::class, 'store'])->name('comments.store');

    Route::resource('vulnerabilities', VulnerabilityController::class)->except(['destroy']);
});

require __DIR__.'/auth.php';
