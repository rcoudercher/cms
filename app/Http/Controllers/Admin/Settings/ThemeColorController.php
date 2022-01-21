<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Config;

class ThemeColorController extends Controller
{
    public function index()
    {
        return view('admin.settings.theme-color.index')->with([
            'data' => Config::where('name', 'theme-color')->first(),
        ]);
    }

    public function store(Request $request)
    {
        // validate the uploaded data
        $request->validate([
            'color' => 'string|alpha_num|size:6',
        ]);

        Config::create([
            'name' => 'theme-color',
            'value' => '#' . $request->input('color'),
        ]);

        return redirect()->route('admin.settings.theme-color.index')
        ->with('message', 'Theme color uploaded successfully.');
    }

    public function edit()
    {
        // retrieve config
        $config = Config::where('name', 'theme-color')->firstOrFail();
        
        return view('admin.settings.theme-color.edit')->with([
            'config' => $config,
        ]);
    }
    
    public function update(Request $request)
    {
        // validate the uploaded file
        $request->validate([
            'color' => 'string|alpha_num|size:6',
        ]);
        
        // retrieve config
        $config = Config::where('name', 'theme-color')->firstOrFail();

        // update config
        $config->value = '#' . $request->input('color');
        $config->save();

        // redirect to index
        return redirect()->route('admin.settings.theme-color.index')
        ->with('message', 'Theme color updated successfully.');
    }
    
    public function delete()
    {
        Config::firstWhere('name', 'theme-color')->delete();

        return redirect()->route('admin.settings.theme-color.index')
        ->with('message', 'Theme color deleted successfully.');
    }
}
