<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
Route::get('dashboard', [AuthController::class, 'dashboard']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::group(['prefix'=> 'admin'], function(){
        Route::controller(AdminController::class)->group(function(){
            Route::get('/dashboard', 'index')->name('admin.home');
            // start website routes
            Route::get('/change-website/{id}', 'changeWebsite')->name('change-website');
            Route::get('/get-website', 'getWebsite')->name('get-website');
            Route::get('/add-website', 'addWebsite')->name('add-website');
            Route::post('/store-website', 'storeWebsite')->name('store-website');
            Route::get('/edit-website/{id}', 'editWebsite')->name('edit-website');
            Route::post('/update-website', 'updateWebsite')->name('update-website');
            Route::delete('/delete-website/{id}', 'deleteWebsite')->name('delete-website');
            // end website routes
            // start category routes
            Route::get('/get-category', 'getCategory')->name('get-category');
            Route::get('/add-category', 'addCategory')->name('add-category');
            Route::post('/store-category', 'storeCategory')->name('store-category');
            Route::get('/edit-category/{id}', 'editCategory')->name('edit-category');
            Route::post('/update-category', 'updateCategory')->name('update-category');
            Route::delete('/delete-category/{id}', 'deleteCategory')->name('delete-category');
            Route::get('/web-data/{id}', 'webData')->name('web-data');
            // end category routes
            // start plans routes
            Route::get('/get-plan', 'getPlan')->name('get-plan');
            Route::get('/add-plan', 'addPlan')->name('add-plan');
            Route::post('/store-plan', 'storePlan')->name('store-plan');
            Route::get('/edit-plan/{id}', 'editPlan')->name('edit-plan');
            Route::post('/update-plan', 'updatePlan')->name('update-plan');
            Route::delete('/delete-plan/{id}', 'deletePlan')->name('delete-plan');
            // end plans routes

            // start subscriptions routes
            Route::get('/get-subscription', 'getSubscription')->name('get-subscription');
            Route::get('/add-subscription', 'addSubscription')->name('add-subscription');
            Route::post('/store-subscription', 'storeSubscription')->name('store-subscription');
            Route::get('/edit-subscription/{id}', 'editSubscription')->name('edit-subscription');
            Route::post('/update-subscription', 'updateSubscription')->name('update-subscription');
            Route::delete('/delete-subscription/{id}', 'deleteSubscription')->name('delete-subscription');
            // end subscriptions routes
            // start plan details routes
            Route::get('/get-plan-detail', 'getPlanDetail')->name('get-plan-detail');
            Route::get('/add-plan-detail', 'addPlanDetail')->name('add-plan-detail');
            Route::post('/store-plan-detail', 'storePlanDetail')->name('store-plan-detail');
            Route::get('/edit-plan-detail/{id}', 'editPlanDetail')->name('edit-plan-detail');
            Route::post('/update-plan-detail', 'updatePlanDetail')->name('update-plan-detail');
            Route::delete('/delete-plan-detail/{id}', 'deletePlanDetail')->name('delete-plan-detail');
            Route::post('/add-specification', 'addSpecification')->name('add-specification');
            Route::post('/update-specification', 'updateSpecification')->name('update-specification');
            Route::get('/remove-specification/{id}', 'removeSpecification')->name('remove-specification');
            Route::post('/update-price', 'updatePrice')->name('update-price');
            Route::post('/add-price', 'addPrice')->name('add-price');
            Route::get('/remove-price/{id}', 'removePrice')->name('remove-price');
            // end plan details routes
            // start company routes
            Route::get('/get-company', 'getCompany')->name('get-company');
            Route::get('/add-company', 'addCompany')->name('add-company');
            Route::post('/store-company', 'storeCompany')->name('store-company');
            Route::get('/edit-company/{id}', 'editCompany')->name('edit-company');
            Route::post('/update-company', 'updateCompany')->name('update-company');
            Route::delete('/delete-company/{id}', 'deleteCompany')->name('delete-company');
            // end company routes
            // start Staff routes
            Route::get('/get-staff', 'getStaff')->name('get-staff');
            Route::get('/add-staff', 'addStaff')->name('add-staff');
            Route::post('/store-staff', 'storeStaff')->name('store-staff');
            Route::get('/edit-staff/{id}', 'editStaff')->name('edit-staff');
            Route::post('/update-staff', 'updateStaff')->name('update-staff');
            Route::delete('/delete-staff/{id}', 'deleteStaff')->name('delete-staff');
            // end Staff routes
            // start bookings routes
            Route::get('/get-booking', 'getBooking')->name('get-booking');
            Route::get('/add-booking', 'addBooking')->name('add-booking');
            Route::post('/store-booking', 'storeBooking')->name('store-booking');
            Route::get('/edit-booking/{id}', 'editBooking')->name('edit-booking');
            Route::post('/update-booking', 'updateBooking')->name('update-booking');
            Route::delete('/delete-booking/{id}', 'deleteBooking')->name('delete-booking');
            Route::get('/company-staff/{id}', 'companyStaff')->name('company-staff');
            Route::post('/get-service', 'getService')->name('get-service');
            Route::post('/get-price', 'getPrice')->name('get-price');
            Route::post('/get-website-timing', 'getWebsiteTiming')->name('get-website-timing');
            Route::get('/get-customer-details/{nbr}', 'getCustomerDetails')->name('get-customer-details');
            Route::get('/generate-report/{id}', 'generateReport')->name('generate-report');
            // end bookings routes

            // start user routes
            Route::get('/get-user', 'getUser')->name('get-user');
            // Route::get('/add-category', 'addCategory')->name('add-category');
            // Route::post('/store-category', 'storeCategory')->name('store-category');
            // Route::get('/edit-category/{id}', 'editCategory')->name('edit-category');
            // Route::post('/update-category', 'updateCategory')->name('update-category');
            // Route::delete('/delete-category/{id}', 'deleteCategory')->name('delete-category');
            // end User routes
        });
    });
});
Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('home');
    // Route::controller(HomeController::class)->group(function(){
    //     Route::get('/my-account', 'myAccount')->name('my-account');
    // });
});