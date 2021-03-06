<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Article extends Model
{
  use HasFactory;
  
  protected $fillable = [
    'key',
    'author_id', 
    'category_id',
    'image_id',
    'title', 
    'description', 
    'content', 
    'slug', 
    'published_at',
    'scheduled_at',
  ];
  
  // get the author that owns the article
  public function author()
  {
    return $this->belongsTo(Author::class);
  }
  
  // get the category that owns the article
  public function category()
  {
    return $this->belongsTo(Category::class);
  }
  
  // get the main image associated with the article
  public function image()
  {
    return $this->belongsTo(Image::class);
  }
  
  // get the tags of the article
  public function tags()
  {
    return $this->belongsToMany(Tag::class)->withTimestamps();
  }
  
  public function comments()
  {
    return $this->hasMany(Comment::class);
  }
  
  public function scopePublic($query)
  {
    return $query->whereNotNull('published_at');
  }
  
  public function isPublic()
  {
    return is_null($this->published_at) ? false : true;
  }

  public function isScheduled()
  {
    return is_null($this->scheduled_at) ? false : true;
  }
  
  public function postedAtDifference()
  {
    return Carbon::parse($this->published_at)->locale('fr')->diffForHumans();
  }
  
  public function postedAtInGoodFrench()
  {
    $dt = Carbon::parse($this->published_at);
    return $dt->day . ' ' . $dt->locale('fr')->monthName . ' ' . $dt->year;
  }

  public function scheduledAtDifference()
  {
    return Carbon::parse($this->scheduled_at)->locale('en')->diffForHumans();
  }
}
