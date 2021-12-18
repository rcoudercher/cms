<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class LogRequest
{
  public function handle(Request $request, Closure $next)
  {  
    return $next($request);
  }
  
  public function terminate($request, $response)
  {
    $method = strtoupper($request->getMethod());
    $status = $response->status(); 
    $uri = $request->getPathInfo();
    $url = $request->url();
    $fullUrl = $request->fullUrl();
    $ipAddress = $request->ip();
    $referer = is_null($request->header('referer')) ? 'undefined' : $request->header('referer');
    $userAgent = $request->header('User-Agent');
    
    
    $message = "{$method}||{$status}||{$uri}||{$url}||{$fullUrl}||{$ipAddress}||{$referer}||{$userAgent}";
    
    Log::channel('requestlog')->info($message);  
  }
}
