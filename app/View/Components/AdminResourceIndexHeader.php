<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AdminResourceIndexHeader extends Component
{
  public $title;
  public $route;
  public $btnText;
    
  /**
  * Create a new component instance.
  *
  * @return void
  */
  public function __construct($title, $route, $btnText)
  {
    $this->title = $title;
    $this->route = $route;
    $this->btnText = $btnText;
  }

  /**
  * Get the view / contents that represent the component.
  *
  * @return \Illuminate\Contracts\View\View|\Closure|string
  */
  public function render()
  {
    return view('components.admin-resource-index-header');
  }
}
