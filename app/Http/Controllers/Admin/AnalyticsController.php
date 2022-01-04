<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\PageView;

class AnalyticsController extends Controller
{
  public function index()
  {
    $dt = Carbon::today()->subDay(29);    
    $pageViewsLast30Days = [];
    $dates = [];
    
    for ($i=0; $i < 30; $i++) {
      $pageViewsLast30Days[] = PageView::whereDate('created_at', $dt)->count();
      $dates[] = $dt->format('d-m-Y');
      $dt->addDay();
    }
    
    return view('admin.analytics.index')->with([
      'pageViews' => PageView::orderByDesc('created_at')->paginate(100),
      'pageViewsLast30Days' => json_encode($pageViewsLast30Days),
      'dates' => json_encode($dates),
    ]);
  }
}
