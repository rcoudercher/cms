<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
  use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

 /**
  * The attributes that are mass assignable.
  *
  * @var string[]
  */
  protected $fillable = [
    'name',
    'email',
    'password',
  ];

  /**
  * The attributes that should be hidden for serialization.
  *
  * @var array
  */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
  * The attributes that should be cast.
  *
  * @var array
  */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];
  
  public function roles()
  {
    return $this->belongsToMany(Role::class)->withTimestamps();
  }
  
  public function comments()
  {
    return $this->hasMany(Comment::class);
  }
    
 /**
  * Check if the user has a specific role
  * @param string $role
  * @return bool
  */
  public function hasRole(string $role)
  {
    return null !== $this->roles()->where('name', $role)->first();
  }
  
 /**
  * Check if the user has any of the given roles
  * @param array $roles
  * @return bool
  */
  public function hasAnyRole(array $roles)
  {
    return null !== $this->roles()->whereIn('name', $roles)->first();
  }
  
}
