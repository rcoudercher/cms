<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    use HasFactory;
    
    protected $fillable = [
      'ip',
      'page',
      'scheme',
      'host',
      'path',
      'query',
      'fragment',
      'referrer', 
      'user_agent',
    ];
}
