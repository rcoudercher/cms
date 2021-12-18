<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Storage;

class Image extends Model
{
  use HasFactory;
  
  protected $fillable = [
    'path', 
    'url',
    'credit', 
    'original_name', 
    'extension',
  ];
}
