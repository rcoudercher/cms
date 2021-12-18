<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="">Home</a></li>
    
    @if ($levels == 1)
      
      <li class="breadcrumb-item active">{{ $label }}</li>
      
      
      
      
    @elseif ($levels == 2)
      
      <li class="breadcrumb-item">
        <a href="{{ $link }}">{{ $label }}</a>
      </li>
      <li class="breadcrumb-item active">{{ $attributes['label2'] }}</li>
            
      
    @endif
    
    
    
    
    
    
  </ol>
</nav>