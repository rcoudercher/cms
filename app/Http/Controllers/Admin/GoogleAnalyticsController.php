<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Config;

class GoogleAnalyticsController extends Controller
{
    public function index()
    {
        return view('admin.settings.google-analytics.index')->with([
            'data' => Config::where('name', 'ga-tracking-code')->first(),
        ]);
    }

    public function store(Request $request)
    {
        // validate the uploaded data
        $request->validate([
            'ga-tracking-code' => 'string|max:999',
        ]);

        Config::create([
            'name' => 'ga-tracking-code',
            'value' => $request->input('ga-tracking-code'),
        ]);

        return redirect()->route('admin.settings.ga.index')
        ->with('message', 'Google Analytics tracking code uploaded successfully.');
    }

    public function edit()
    {
        // retrieve config
        $config = Config::where('name', 'ga-tracking-code')->firstOrFail();
        
        return view('admin.settings.google-analytics.edit')->with([
            'config' => $config,
        ]);
    }
    
    public function update(Request $request)
    {
        // validate the uploaded file
        $request->validate([
            'ga-tracking-code' => 'string|max:999',
        ]);
        
        // retrieve config
        $config = Config::where('name', 'ga-tracking-code')->firstOrFail();

        // update config
        $config->value = $request->input('ga-tracking-code');
        $config->save();

        // redirect to index
        return redirect()->route('admin.settings.ga.index')
        ->with('message', 'Google Analytics tracking code updated successfully.');
    }
    
    public function delete()
    {
        Config::firstWhere('name', 'ga-tracking-code')->delete();

        // $config = Config::firstWhere('name', 'ga-tracking-code');
        // $config->delete();

        return redirect()->route('admin.settings.ga.index')
        ->with('message', 'Google Analytics tracking code deleted successfully.');
    }
}
