<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Article;

class PostBlock extends Component
{
  public $article;
  
  /**
  * Create a new component instance.
  *
  * @return void
  */
  public function __construct(Article $article)
  {
    $this->article = $article;
  }

  /**
  * Get the view / contents that represent the component.
  *
  * @return \Illuminate\Contracts\View\View|\Closure|string
  */
  public function render()
  {
    return view('components.post-block');
  }
}
