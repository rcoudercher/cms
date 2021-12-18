<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Comment;

class AuthServiceProvider extends ServiceProvider
{
 /**
  * The policy mappings for the application.
  *
  * @var array
  */
  protected $policies = [
    // 'App\Models\Comment' => 'App\Policies\CommentPolicy',
  ];

 /**
  * Register any authentication / authorization services.
  *
  * @return void
  */
  public function boot()
  {
    $this->registerPolicies();
    
    Gate::define('access-admin', function (User $user) {
      return $user->hasRole('admin');
    });
    
  }
}
