<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckUserStatus;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Support\Facades\Storage;

Route::get('/', [PageController::class, 'index'])->name('frontpage.home');
Route::get('/categories', [PageController::class, 'showCategories'])->name('frontpage.categories');
Route::get('/books', [PageController::class, 'showBooks'])->name('frontpage.books');
Route::get('/books/{book:slug}', [PageController::class, 'showBookDetails'])->name('frontpage.book.details');

Route::middleware('auth')->get('/books/view/{book}', function(Book $book) {
    $file = Storage::disk('public')->path($book->file_path);

    if (!file_exists($file)) {
        abort(404);
    }

    return response()->stream(function () use ($file) {
        readfile($file);
    }, 200, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; filename="'.basename($file).'"',
        'Accept-Ranges' => 'bytes'
    ]);
})->name('frontpage.book.view');

Route::middleware(RedirectIfAuthenticated::class)->group(function() {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'handleLogin']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'handleRegister']);

    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'handleForgotPassword'])->name('password.email');

    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'handleResetPassword'])->name('password.update');

    Route::get('/auth-google-redirect', [AuthController::class, 'google_redirect'])->name('auth.google');
    Route::get('/auth-google-callback', [AuthController::class, 'google_callback']);
});

Route::middleware(['auth', CheckUserStatus::class])->group(function () {
    
    //peminjman untuk use mengajukan request
    Route::post('/borrowing', [BorrowingController::class, 'store'])->name('borrowings.store');

    //Peminjaman halaman daftar (admin: semua, user:hanya miliknya sendiri)
    Route::get('/panel/borrowing', [BorrowingController::class, 'index'])->name('borrowings.index');

    //Peminjaman review approval admin:only
    Route::get('/panel/borrowing/{borrowing}/appoval', [BorrowingController::class, 'showApproval'])->name('borrowings.show.approval');
    Route::put('/panel/borrowing/{borrowing}/appoval', [BorrowingController::class, 'handleApproval'])->name('borrowings.approval');

    //Peminjaman konfirmasi - pengembalian
    Route::get('/panel/borrowing/{borrowing}/return', [BorrowingController::class, 'showReturn'])->name('borrowings.show.return');
    Route::put('/panel/borrowing/{borrowing}/return', [BorrowingController::class, 'handleReturn'])->name('borrowings.return');

    //request return
    Route::put('/borrowing/{borrowing}/request-return', [BorrowingController::class, 'requestReturn'])->name('borrowings.request.return');

    //delete peminjaman
    Route::delete('/panel/borrowing/{borrowing}/delete', [BorrowingController::class, 'handleDelete'])->name('borrowings.delete');


    Route::get('/panel', [BookController::class, 'index'])->name('books.index');

    Route::get('/panel/book/create', [BookController::class, 'showCreateForm'])->name('books.show.create');
    Route::post('/panel/book', [BookController::class, 'handleCreate'])->name('books.create');
    
    Route::get('/panel/book/{book}/edit', [BookController::class, 'showUpdateForm'])->name('books.show.update');
    Route::put('/panel/book/{book}', [BookController::class, 'handleUpdate'])->name('books.update');
    
    Route::delete('/panel/book/{book}/delete', [BookController::class, 'handleDelete'])->name('books.delete');

    Route::get('/panel/book/{book}/approval', [BookController::class, 'showApproval'])->name('books.show.approval');
    Route::put('/panel/book/{book}/approval', [BookController::class, 'handleApproval'])->name('books.approval');
    

    Route::get('/panel/categories', [CategoryController::class, 'index'])->name('categories.index');

    Route::get('/panel/category/create', [CategoryController::class, 'showCreateForm'])->name('categories.show.create');
    Route::post('/panel/category', [CategoryController::class, 'handleCreate'])->name('categories.create');
    
    Route::get('/panel/category/{category}/edit', [CategoryController::class, 'showUpdateForm'])->name('categories.show.update');
    Route::put('/panel/category/{category}', [CategoryController::class, 'handleUpdate'])->name('categories.update');
    
    Route::delete('/panel/category/{category}/delete', [CategoryController::class, 'handleDelete'])->name('categories.delete');


    Route::get('/panel/users', [UserController::class, 'index'])->name('users.index');
    Route::put('/users/{user}/block', [UserController::class, 'handleBlock'])->name('users.block');
    Route::put('/users/{user}/unblock', [UserController::class, 'handleUnblock'])->name('users.unblock');


    Route::get('/panel/profile', [UserController::class, 'showProfileForm'])->name('profile.show');
    Route::put('/panel/profile', [UserController::class, 'handleUpdateProfile'])->name('profile.update');


    Route::get('/panel/change-password', [UserController::class, 'showChangePasswordForm'])->name('change-password.show');
    Route::put('/panel/change-password', [UserController::class, 'handleChangePassword'])->name('change-password.update');

    
    Route::post('/logout', [AuthController::class, 'handleLogout'])->name('logout');
});