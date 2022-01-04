<?php

namespace App\Http\Controllers;

use App\Models\PageView;
use Illuminate\Http\Request;

class PageViewController extends Controller
{
  public function index()
  {
      //
  }

  public function create()
  {
      //
  }

  public function store(Request $request)
  {
    $request->validate([
      'page' => ['required', 'url'],
      'referrer' => ['url'],
    ]);
    
    $url = $request->page;    
    
    $pageView = PageView::create([
      'ip' => $_SERVER['REMOTE_ADDR'],
      'page' => $request->page,
      'scheme' => parse_url($url, PHP_URL_SCHEME),
      'host' => parse_url($url, PHP_URL_HOST),
      'path' => parse_url($url, PHP_URL_PATH),
      'query' => parse_url($url, PHP_URL_QUERY),
      'fragment' => parse_url($url, PHP_URL_FRAGMENT),
      'referrer' => $request->referrer,
      'user_agent' => $_SERVER['HTTP_USER_AGENT'],
    ]);
    
    return response()->json($pageView, 201);
  }

  public function show(PageView $pageView)
  {
      //
  }

  public function edit(PageView $pageView)
  {
      //
  }

  public function update(Request $request, PageView $pageView)
  {
      //
  }

  public function destroy(PageView $pageView)
  {
      //
  }
}
