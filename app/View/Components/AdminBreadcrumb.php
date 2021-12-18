<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AdminBreadcrumb extends Component
{
  public $levels;
  public $label;
  public $link;
  
 /**
  * Create a new component instance.
  *
  * @return void
  */
  public function __construct(int $levels, string $label, string $link)
  {
    $this->levels = $levels;
    $this->label = $label;
    $this->link = $link;
  }

 /**
  * Get the view / contents that represent the component.
  *
  * @return \Illuminate\Contracts\View\View|\Closure|string
  */
  public function render()
  {
    return view('components.admin-breadcrumb');
  }
}
