<?php

use Illuminate\Support\Facades\Route;

// Admin controllers
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\LogoController;

// Front controllers
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\CommentController as Comment_Controller;
use App\Http\Controllers\Front\ProfileController;
use App\Http\Controllers\AuthController;


Route::get('/', [FrontController::class, 'homepage'])->name('home');


// ADMIN routes ----------------------------------------

Route::prefix('admin')
    ->middleware(['auth', 'admin', 'verified'])
    ->name('admin.')
    ->group(function () {
      
  Route::view('/', 'admin.home')->name('home');
  
  Route::resources([
    'authors' => AuthorController::class,
    'articles' => ArticleController::class,
    'categories' => CategoryController::class,
    'comments' => CommentController::class,
    'configs' => ConfigController::class,
    'images' => ImageController::class,
    'pages' => PageController::class,
    'roles' => RoleController::class,
    'tags' => TagController::class,
    'users' => UserController::class,
  ]);

  // Settings routes
  Route::prefix('settings')->name('settings.')->group(function () {
    Route::get('/', [SettingsController::class, 'index'])->name('index');


    Route::prefix('logo')->name('logo.')->group(function () {
      Route::get('/', [LogoController::class, 'index'])->name('index');
      Route::post('/', [LogoController::class, 'store'])->name('store');
      Route::get('edit', [LogoController::class, 'edit'])->name('edit');
      Route::patch('/', [LogoController::class, 'update'])->name('update');
      Route::delete('/', [LogoController::class, 'delete'])->name('delete');
    });

    
  });
    
  // Other comment routes
  Route::prefix('comments')->name('comments.')->group(function () {
    Route::get('soft-deleted/{id}', [CommentController::class, 'showSoftDeleted'])->name('soft-deleted.show');
    Route::delete('force-delete/{id}', [CommentController::class, 'forceDelete'])->name('force-delete');
    Route::patch('{comment}/approve', [CommentController::class, 'approve'])->name('approve');
    Route::patch('{comment}/reject', [CommentController::class, 'reject'])->name('reject');
  });
  
  // Other article routes
  Route::prefix('articles')->name('articles.')->group(function () {
    Route::patch('{article}/publish', [ArticleController::class, 'publish'])->name('publish');
    Route::patch('{article}/hide', [ArticleController::class, 'hide'])->name('hide');
  });
  
});

// AUTH routes ----------------------------------------

Route::view('inscription', 'auth.register')->name('register');
Route::post('inscription', [AuthController::class, 'register']);
Route::view('connexion', 'auth.login')->name('login');
Route::post('connexion', [AuthController::class, 'login']);
Route::post('deconnexion', [AuthController::class, 'logout'])
    ->middleware(['auth'])
    ->name('logout');

// Password reset
Route::name('password.')
    ->middleware(['guest'])
    ->group(function () {
  Route::view('mot-de-passe-oublie', 'auth.forgot-password')->name('request');
  Route::post('mot-de-passe-oublie', [AuthController::class, 'forgotPassword'])->name('email');
  Route::view('/reset-password/{token}', 'auth.reset-password')->name('reset');
  Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('update');
});

// Email verification
Route::name('verification.')
    ->middleware(['auth'])
    ->group(function () {
      
      // displays a notice to unverified users trying to access restricted areas
      Route::view('/email/verify', 'auth.verify-email')
          ->name('notice');

      // handles requests generated when the user clicks the email verification link in the email
      Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])
          ->middleware(['signed', 'throttle:6,1'])
          ->name('verify');

      // resends a verification link
      Route::post('/email/verification-notification', [AuthController::class, 'resendEmailVerificationLink'])
          ->middleware(['throttle:6,1'])
          ->name('send');
});

// FRONT ROUTES ----------------------------------------

// User profile
Route::prefix('compte')
    ->middleware(['auth'])
    ->name('profile.')
    ->group(function () {
      
  Route::view('/', 'front.profile.index')->name('index');
  
  // update user's info
  Route::view('/modifier', 'front.profile.edit')->name('info.edit');
  Route::put('/modifier', [ProfileController::class, 'updateInfo'])->name('info.update');
  
  // delete account
  Route::view('/supprimer-mon-compte', 'front.profile.delete')->name('delete');
  Route::delete('/supprimer-mon-compte', [ProfileController::class, 'destroy']);
  
  // update user's password
  Route::name('password.')->group(function () {
    Route::view('modifier-mot-de-passe', 'front.profile.edit-password')->name('edit');
    Route::put('modifier-mot-de-passe', [ProfileController::class, 'updatePassword'])->name('update');
  });
  
  // show user's comments
  Route::get('commentaires', [ProfileController::class, 'commentsIndex'])->name('comments');
  
});

  // static pages

Route::get('/a-propos', [FrontController::class, 'about'])->name('about');
Route::get('/contact', [FrontController::class, 'contact'])->name('contact');
Route::get('/mentions-legales', [FrontController::class, 'legal'])->name('legal');
Route::get('/confidentialite', [FrontController::class, 'privacy'])->name('privacy');
Route::get('/charte-commentaires', [FrontController::class, 'commentRules'])->name('comment-rules');
Route::get('/faire-un-don', [FrontController::class, 'donation'])->name('donation');
Route::get('/contribuer', [FrontController::class, 'contribute'])->name('contribute');


Route::get('/dernieres-nouvelles', [FrontController::class, 'latestNews'])->name('latestNews');

  // other
Route::get('blog/{article:slug}', [FrontController::class, 'article'])->name('article.show');
Route::get('tag/{tag:slug}', [FrontController::class, 'tag'])->name('tag.show');
Route::get('categorie/{category:slug}', [FrontController::class, 'category'])->name('category.show');
Route::get('auteur/{author:slug}', [FrontController::class, 'author'])->name('author.show');

// Front comments routes
Route::prefix('c')
    ->name('comment.')
    ->group(function () {
      
  Route::post('article/{article:key}', [Comment_Controller::class, 'store'])->name('store');
  
  Route::get('{comment:key}/modifier', [Comment_Controller::class, 'edit'])
      ->middleware('can:update,comment')
      ->name('edit');
  
  Route::patch('{comment:key}', [Comment_Controller::class, 'update'])
      ->middleware('can:update,comment')
      ->name('update');
  
  Route::delete('{comment:key}', [Comment_Controller::class, 'destroy'])
      ->middleware('can:delete,comment')
      ->name('delete');
  
});


