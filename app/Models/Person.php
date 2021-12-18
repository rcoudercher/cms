<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
  use HasFactory;
  
  protected $fillable = [
    'name',
    'slug',
    'date_of_birth',
    'place_of_birth',
    'date_of_death',
    'place_of_death',
    'description',
    'content'
  ];
  
}