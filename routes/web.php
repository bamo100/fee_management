<?php

declare(strict_types=1);

use App\Http\Controllers\FilePondController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FeeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\AcademicSessionController;
use App\Http\Controllers\StudentController;

Route::get('/', fn() => view('index', [
    'photo_url' => App\Models\User::query()->first()?->media->last()->original_url ?? 'default_image_url',
]));

Route::view(uri: '/contact', view: 'contact')->name('contact');

Route::get('/dashboard', fn() => view('dashboard'))->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function (): void {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//fee controller
Route::resource('fees', FeeController::class)->only([
    'index', 'destroy', 'show', 'create', 'edit',
]);

Route::middleware([HandlePrecognitiveRequests::class])->group(function () {
    Route::post('fees', [FeeController::class, 'store'])->name('fees.store');
    Route::put('fees/{fee}', [FeeController::class, 'update'])->name('fees.update');
});

//student controller
Route::resource('students', StudentController::class)->only([
    'index',
]);

Route::post('upload', FileUploadController::class)->name('upload-file');

Route::prefix('file-pond')->group(function (): void {
    Route::post('/', [FilePondController::class, 'process'])->name('file-pond-process');
    Route::delete('/', [FilePondController::class, 'revert'])->name('file-pond-revert');
});

require __DIR__ . '/auth.php';
