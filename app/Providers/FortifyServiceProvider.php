<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\LogoutResponse;

class FortifyServiceProvider extends ServiceProvider
{
  /**
  * Register any application services.
  *
  * @return void
  */
  public function register()
  {
    Fortify::ignoreRoutes();
    
    $this->app->instance(LoginResponse::class, new class implements LoginResponse {
      public function toResponse($request)
      {
        return redirect()->route('home')->with('message', 'Vous êtes connecté');
      }
    });
    
    $this->app->instance(LogoutResponse::class, new class implements LogoutResponse {
      public function toResponse($request)
      {
        return redirect()->route('home')->with('message', 'Vous vous êtes bien déconnecté');
      }
    });  
  }

  /**
  * Bootstrap any application services.
  *
  * @return void
  */
  public function boot()
  {
    Fortify::createUsersUsing(CreateNewUser::class);
    Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
    Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
    Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

    RateLimiter::for('login', function (Request $request) {
      return Limit::perMinute(5)->by($request->email.$request->ip());
    });

    RateLimiter::for('two-factor', function (Request $request) {
      return Limit::perMinute(5)->by($request->session()->get('login.id'));
    });

    Fortify::loginView(function () {
      return view('auth.login');
    });

    Fortify::registerView(function () {
      return view('auth.register');
    });

    Fortify::requestPasswordResetLinkView(function () {
      return view('auth.forgot-password');
    });

    Fortify::resetPasswordView(function ($request) {
      return view('auth.reset-password', ['request' => $request]);
    });

    Fortify::verifyEmailView(function () {
      return view('auth.verify-email');
    });
  }
}