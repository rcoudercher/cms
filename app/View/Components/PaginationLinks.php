<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PaginationLinks extends Component
{
  public $collection;
  public $origin;
  
  /**
  * Create a new component instance.
  *
  * @return void
  */
  public function __construct($collection, $origin)
  {
    $this->collection = $collection;
    $this->origin = $origin;
  }

  /**
  * Get the view / contents that represent the component.
  *
  * @return \Illuminate\Contracts\View\View|\Closure|string
  */
  public function render()
  {
  return view('components.pagination-links');
  }
}
