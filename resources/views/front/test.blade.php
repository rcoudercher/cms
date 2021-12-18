@extends('layouts.front')

@section('title', 'test')

@section('content')
  
  @php
    $var = "PHP variable";
  @endphp
  
  
  
  
  {{-- <div class="msgbox-message-container"> --}}
    <h1>Responsive Message Box</h1>
    <h3>Using Native Javascript class</h3>
    <p><button id="msgboxPersistent" class="msgbox-message-button" type="button">Show persistent</button></p>
    <p><button id="msgboxShowMessage" class="msgbox-message-button" type="button">Show non-persistent</button></p>
    <p><button id="msgboxHiddenClose" class="msgbox-message-button" type="button">Hidden close button</button></p>
  {{-- </div> --}}
  <div id="msgbox-area" class="msgbox-area"></div>
  
  
  <div class="">
    {{ $var }}
  </div>

  <p>testing</p>
  
  
  <script type="text/javascript">
    var op = <?PHP echo (!empty($var) ? json_encode($var) : '""'); ?>;
    console.log(op);
  </script>

  
@endsection