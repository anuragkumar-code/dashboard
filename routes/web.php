<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sign-in', [UserController::class, 'showSignIn'])->name('showSignIn');
Route::get('/sign-up', [UserController::class, 'showSignUp'])->name('showSignUp');


Route::post('/signedup', [UserController::class, 'signinUser'])->name('signinUser');
Route::post('/signedin', [UserController::class, 'signedIn'])->name('signinSubmit');


Route::group(['middleware' => ['admin']], function(){
    Route::get('admin/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('admin/form', [UserController::class, 'showForm'])->name('showForm');
    Route::get('admin/table', [UserController::class, 'showTable'])->name('showTable');
    Route::get('admin/element', [UserController::class, 'showElement'])->name('showElement');
    Route::get('admin/button', [UserController::class, 'showButton'])->name('showButton');
    Route::get('admin/typography', [UserController::class, 'showTypography'])->name('showTypography');
    Route::get('admin/widget', [UserController::class, 'showWidget'])->name('showWidget');
    Route::get('admin/chart', [UserController::class, 'showChart'])->name('showChart');

    Route::get('admin/logout', [UserController::class, 'logout'])->name('logout');
});
