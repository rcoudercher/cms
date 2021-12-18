<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
  public function index()
  {
    $visitsYesterday = DB::table('request_logs')
                            ->whereDate('date', Carbon::yesterday())
                            ->get()
                            ->countBy('uri')
                            ->sortDesc();
                                
    return view('admin.analytics.index')->with([
      'visitsYesterday' => $visitsYesterday,
    ]);
  }
  
  public function saveYesterdaysRequestLogsToDatabase()
  {
    $yesterday = Carbon::yesterday();
    $filePath = storage_path("logs/requests-{$yesterday->format('Y-m-d')}.log");
    
    // check if yesterday's requests log file exists
    if (file_exists($filePath)) {
      
      // get the date from the most recent entry in the request_logs table
      $lastEntryDay = Carbon::parse(DB::table('request_logs')->max('date'))->dayOfYear;
            
      // check if database already contains yesterday's data
      if ($lastEntryDay != $yesterday->dayOfYear) {
        
        $lines = file($filePath);
        
        foreach ($lines as $line) {
          
          $lineContent = explode('||', $line);
                  
          DB::table('request_logs')->insert([
            'date' => $lineContent['0'],
            'method' => $lineContent['1'],
            'status' => $lineContent['2'],
            'uri' => $lineContent['3'],
            'url' => $lineContent['4'],
            'fullUrl' => $lineContent['5'],
            'ipAddress' => $lineContent['6'],
            'referer' => $lineContent['7'],
            'userAgent' => trim($lineContent['8']),
            'created_at' => Carbon::now()
          ]);
          
        }
        return back()->with('message', 'request logs successfully saved to database');
      } else {
        return back()->with('error', 'request_logs table already contains data from yesterday');
      }
    } else {
      return back()->with('error', 'file not found');
    }
  }
}
