<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\TodoController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\QueryController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\StoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [AuthController::class, 'index'])->name('login');

Route::post('login', [AuthController::class, 'store'])->name('admin.login');

Route::middleware('admin.check')->group(function () {

    Route::controller(AuthController::class)->group(function () {

        Route::get('profile',  'show')->name('profile');
        Route::post('profile-update',  'update')->name('profile.update');
        Route::get('logout',  'destroy')->name('logout');
    });

    Route::controller(HomeController::class)->group(function () {
        Route::get('dashboard',  'index')->name('dashboard');
        Route::get('meta-data',  'metaIndex')->name('meta.index');

        Route::get('our-teams',  'team')->name('team.index');
        Route::get('create-teams',  'createTeam')->name('team.create');
        Route::get('edit-teams/{teamId}',  'editTeam')->name('team.edit');
        Route::post('store-teams',  'storeTeam')->name('team.store');
        Route::delete('team-delete',  'teamDestroy')->name('team.destroy');

        Route::get('our-customers',  'customers')->name('clients.index');
        Route::get('create-customers',  'createCustomers')->name('clients.create');
        Route::get('edit-customers/{customerId}',  'editCustomers')->name('clients.edit');
        Route::post('store-customers',  'storeCustomers')->name('clients.store');
        Route::delete('clients-delete',  'clientsDestroy')->name('clients.destroy');

        Route::post('update-meta-desc',  'updateMetaDescription')->name('update.meta.desc');
    });

    Route::controller(TodoController::class)->group(function () {
        Route::post('todo',  'store')->name('store.todo');
        Route::post('todo-delete',  'destroy')->name('remove.todo');
        Route::post('todo-update',  'update')->name('update.todo');
    });

    Route::resource('categories', CategoryController::class)->only([
        'index', 'store', 'destroy'
    ]);
    Route::resource('subcategories', SubCategoryController::class)->only([
        'index', 'show', 'store',  'destroy'
    ]);

    Route::controller(ReviewController::class)->group(function () {
        Route::get('reviews',  'index')->name('reviews.index');
        Route::get('reviews-create',  'create')->name('reviews.create');
        Route::get('reviews-edit/{reviewId}',  'edit')->name('reviews.edit');
        Route::post('reviews-store',  'store')->name('reviews.store');
        Route::delete('reviews-delete',  'destroy')->name('reviews.destroy');
    });
    Route::controller(ServiceController::class)->group(function () {
        Route::get('services',  'index')->name('services.index');
        Route::get('services-create',  'create')->name('services.create');
        Route::get('services-edi/{serviceId}',  'edit')->name('services.edit');
        Route::post('services-store',  'store')->name('services.store');
        Route::delete('services-delete',  'destroy')->name('services.destroy');
    });
    Route::controller(StoryController::class)->group(function () {
        Route::get('stories',  'index')->name('stories.index');
        Route::get('stories-create',  'create')->name('stories.create');
        Route::get('stories-edit/{storyId}',  'edit')->name('stories.edit');
        Route::post('stories-store',  'store')->name('stories.store');
    });
    Route::controller(PortfolioController::class)->group(function () {
        Route::get('portfolios',  'index')->name('portfolios.index');
        Route::get('portfolios-create',  'create')->name('portfolios.create');
        Route::get('portfolios-edit/{portfolioId}',  'edit')->name('portfolios.edit');
        Route::post('portfolios-store',  'store')->name('portfolios.store');
        Route::delete('portfolios-delete',  'destroy')->name('portfolios.destroy');
    });
    Route::controller(QueryController::class)->group(function () {
        Route::get('queries',  'index')->name('queries.index');
        Route::get('show-queries/{queryId}',  'show')->name('queries.show');

        Route::post('queries-store',  'store')->name('queries.store');
        Route::delete('queries-delete',  'destroy')->name('queries.destroy');
    });
});
