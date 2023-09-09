<?php

use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\admin\BlogController as AdminBlogController;
use App\Http\Controllers\admin\FaqController as AdminFaqController;
use App\Http\Controllers\admin\PageController as AdminPageController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/about-us', [HomeController::class, 'about'])->name('about');
Route::get('/services', [ServicesController::class, 'index'])->name('services');
Route::get('/services/details/{id}', [ServicesController::class, 'details'])->name('services.details');
Route::get('/faq', [FaqController::class, 'index'])->name('faq');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/details/{id}', [BlogController::class, 'details'])->name('blog.details');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/blog/comment', [BlogController::class, 'comment'])->name('comment');

Route::group(['prefix' => 'admin'], function () {

    Route::group(['middleware' => 'admin.guest'], function () {
        // here we will define guest routes
        Route::get('login', [AdminLoginController::class, 'index'])->name('admin.login');
        Route::post('login', [AdminLoginController::class, 'authenticate'])->name('admin.auth');
    });


    Route::group(['middleware' => 'admin.auth'], function () {
        // here we will define password protected routes
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');


        // Service Routes
        Route::get('/services', [ServiceController::class, 'index'])->name('serviceList');

        Route::get('/services/create', [ServiceController::class, 'create'])->name('store');
        Route::post('/services/create', [ServiceController::class, 'store'])->name('store');

        Route::get('/services/edit/{id}', [ServiceController::class, 'edit'])->name('service.edit');
        Route::post('/services/edit/{id}', [ServiceController::class, 'update'])->name('service.update');

        Route::delete('/services/delete/{id}', [ServiceController::class, 'delete'])->name('service.delete');


        // Blog Section
        Route::get('/blog', [AdminBlogController::class, 'index'])->name('blog.list');

        Route::get('/blog/create', [AdminBlogController::class, 'create'])->name('blog.create');
        Route::post('/blog/create', [AdminBlogController::class, 'store'])->name('blog.create');

        Route::get('/blog/edit/{id}', [AdminBlogController::class, 'edit'])->name('blog.edit');
        Route::post('/blog/edit/{id}', [AdminBlogController::class, 'update'])->name('blog.update');

        Route::delete('/blog/delete/{id}', [AdminBlogController::class, 'delete'])->name('blog.delete');


        // Faq Section
        Route::get('/faq', [AdminFaqController::class, 'index'])->name('faq.list');

        Route::get('/faq/create', [AdminFaqController::class, 'create'])->name('faq.create');
        Route::post('/faq/create', [AdminFaqController::class, 'store'])->name('faq.create');

        Route::get('/faq/edit/{id}', [AdminFaqController::class, 'edit'])->name('faq.edit');
        Route::post('/faq/edit/{id}', [AdminFaqController::class, 'update'])->name('faq.update');

        Route::delete('/faq/delete/{id}', [AdminFaqController::class, 'delete'])->name('faq.delete');


        // pages section
        Route::get('/pages', [AdminPageController::class, 'index'])->name('pages.list');

        Route::get('/pages/create', [AdminPageController::class, 'create'])->name('pages.create');
        Route::post('/pages/create', [AdminPageController::class, 'store'])->name('pages.create');

        Route::get('/pages/edit/{id}', [AdminPageController::class, 'edit'])->name('pages.edit');
        Route::post('/pages/edit/{id}', [AdminPageController::class, 'update'])->name('pages.update');

        Route::delete('/pages/delete/{id}', [AdminPageController::class, 'delete'])->name('pages.delete');

        // setting route
        Route::get('/setting', [SettingController::class, 'index'])->name('setting');
        Route::post('/setting', [SettingController::class, 'store'])->name('setting.store');
    });
});
