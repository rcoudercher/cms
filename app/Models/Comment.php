<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Comment extends Model
{
  use HasFactory, SoftDeletes;
  
  protected $fillable = ['key', 'user_id', 'article_id', 'content', 'status'];
  
  public function author()
  {
    return $this->belongsTo(User::class, 'user_id');
  }
  
  public function article()
  {
    return $this->belongsTo(Article::class);
  }
  
  public function createdAtDifference()
  {
    return Carbon::parse($this->created_at)->locale('fr')->diffForHumans();
  }
  
  public function wasModified()
  {
    return $this->created_at != $this->updated_at ? true : false;
  }
  
  // Local scopes
  public function scopePending($query)
  {
    return $query->where('status', 'pending');
  }
  
  public function scopeApproved($query)
  {
    return $query->where('status', 'approved');
  }
  
  public function scopeRejected($query)
  {
    return $query->where('status', 'rejected');
  }
  
  public function scopeDeleted($query)
  {
    return $query->where('status', 'deleted');
  }  
}
