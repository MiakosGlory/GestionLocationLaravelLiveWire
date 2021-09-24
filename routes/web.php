<?php

use Illuminate\Support\Facades\Route;
/*use App\Http\Controllers\UserController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TypeArticleController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\TarificationController;
use App\Http\Controllers\PermissionController;*/
use App\Http\Livewire\Utilisateurs;
use App\Http\Livewire\TypeArticleComp;
use App\Http\Livewire\Articles;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route admin
/*Route::group([
    "middleware" => ["auth", "auth.admin"],
    "as" => "admin."
], function(){
    Route::group([
        "prefix" => "habilitations",
        "as" => "habilitation." 
    ], function(){
        Route::get("/ghabil", [Utilisateurs::class])->name('users.index');
    });
});*/


Route::get('/ghabil', Utilisateurs::class)->name('habilitation')->middleware('auth.admin');
//Route::get('/ghabil', [UserController::class, 'index'])->name('habilitation')->middleware('auth.admin');
//Route::get('/gperm', [PermissionController::class, 'index'])->name('permission')->middleware('auth.admin');
//Route::get('/gclte', [ClientController::class, 'index'])->name('clients')->middleware('auth.employe');
//Route::get('/gloca', [LocationController::class, 'index'])->name('locations')->middleware('auth.employe');
//Route::get('/gutil', [UtilisateurController::class, 'index'])->name('utilisateurs')->middleware('auth.admin');
//Route::get('/gutil', [PaiementController::class, 'index'])->name('paiements')->middleware('auth.employe');
Route::get('/garticle', TypeArticleComp::class)->name('type_article')->middleware('auth.superadmin');
Route::get('/article', Articles::class)->name('article')->middleware('auth.superadmin');
//Route::get('/gartic', [ArticleController::class, 'index'])->name('articles')->middleware('auth.superadmin');
//Route::get('/gutil', [TarificationController::class, 'index'])->name('tarifications')->middleware('auth.superadmin');
