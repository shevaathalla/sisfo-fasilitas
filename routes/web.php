<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoanLaboratoriumController;
use App\Http\Controllers\LoanToolController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {   
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    Route::resource('/tool',"ToolController" );
    Route::resource('/laboratorium',"LaboratoriumController" );
    
    Route::resource('/student', "StudentController");
    Route::prefix('/loan')->group(function () {
        Route::get('/tool', [LoanToolController::class, 'index'])->name('loan.tool.index');
        Route::post('/tool', [LoanToolController::class, 'store'])->name('loan.tool.store');
        Route::put('/tool/{loan}', [LoanToolController::class, 'update'])->name('loan.tool.update');
        Route::delete('/tool/{loan}', [LoanToolController::class, 'destroy'])->name('loan.tool.destroy');
        Route::post('/tool/{loan}', [LoanToolController::class, 'confirm'])->name('loan.tool.confirm');
        
    
        Route::get('/laboratorium', [LoanLaboratoriumController::class, 'index'])->name('loan.laboratorium.index');
        Route::post('/laboratorium', [LoanLaboratoriumController::class, 'store'])->name('loan.laboratorium.store');
        Route::put('/laboratorium/{loan}', [LoanLaboratoriumController::class, 'update'])->name('loan.laboratorium.update');
        Route::delete('/laboratorium/{loan}', [LoanLaboratoriumController::class, 'destroy'])->name('loan.laboratorium.destroy');
        Route::post('/laboratorium/{loan}', [LoanLaboratoriumController::class, 'confirm'])->name('loan.laboratorium.confirm');
    });
    
    
    Route::get('/about', function () {
        return view('about');
    })->name('about');
});
