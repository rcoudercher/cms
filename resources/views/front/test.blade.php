@extends('layouts.front')

@section('title', 'test')

@section('content')
  
  @php
    $user = "PHP variable";
    $id = Auth::user()->name;
    // $this->user()->getKey()
  @endphp
  
  
  
  
  <div class="">
    {{ $url }}
  </div>

  <p>testing</p>
  
  

  
@endsection