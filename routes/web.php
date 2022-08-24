<?php

use App\Models\Book;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookIssueController;

// Home Page with All Books
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::post('/search', [HomeController::class, 'search'])->name('home.search');

Route::middleware('guest')->group(function () {
    // Show Register Page
    Route::get('/users/register', [UserController::class, 'register'])->name('users.register');

    // Show Login Page
    Route::get('/users/login', [UserController::class, 'login'])->name('users.login');

    // Save New User into Database
    Route::post('/users/register', [UserController::class, 'store'])->name('users.store');

    // Login User with Credentials
    Route::post('/users/login', [UserController::class, 'authenticate'])->name('users.authenticate');

    // Issue Book to User
});

Route::middleware('auth')->group(function () {
    // Logout user
    Route::post('/users/logout/{id}', [UserController::class, 'logout'])->name('users.logout');

    // User Dashboard
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('users.dashboard');

    // Request to Issue a Book
    Route::post('/issue/{book_id}', [BookIssueController::class, 'request_book'])->name('book_issues.request_book');

    // Return Book Back
    Route::put('/issue/{issue_id}', [BookIssueController::class, 'return_book'])->name('book_issues.return_book');
});

Route::middleware('admin')->group(function () {
    // Admin Home Page
    Route::get('/admin', [BookController::class, 'index'])->name('books.index');

    // Admin Dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Add New Book
    Route::get('/admin/books/create', [BookController::class, 'create'])->name('books.create');

    // Save Book into Database
    Route::post('admin/books/store', [BookController::class, 'store'])->name('books.store');

    // Edit Book
    Route::get('admin/books/edit/{id}', [BookController::class, 'edit'])->name('books.edit');

    // Update Book
    Route::put('admin/books/update/{id}', [BookController::class, 'update'])->name('books.update');

    // Delete Book
    Route::delete('admin/book/delete/{id}', [BookController::class, 'delete'])->name('books.delete');

    // Get All Book Issue Request
    Route::get('/admin/issues', [BookIssueController::class, 'issue_requests'])->name('book_issues.issue_requests');

    // Approve Request to Issue Book
    Route::post('admin/issue/book/{issue_id}', [BookIssueController::class, 'issue_book'])->name(('book_issues.issue_book'));

    // Category Resources
    Route::resource('admin/categories', CategoryController::class);
});


Route::get('/dummy', function () {
    return view('dummy', [
        'books' => Book::all()
    ]);
});
