<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Config;
use Illuminate\Support\Facades\Storage;

class LogoController extends Controller
{
    public function index()
    {
        return view('admin.settings.logo.index')->with([
            'logo' => Config::where('name', 'logo')->first(),
        ]);
    }

    public function store(Request $request)
    {
        // validate the uploaded file
        $request->validate([
            'image' => 'required|file|image|max:10000',
        ]);

        // use OBJECT STORAGE to store the image
        $path = $request->file('image')->store('public');

        Config::create([
            'name' => 'logo',
            'value' => Storage::url($path),
        ]);

        return redirect()->route('admin.settings.logo.index')
        ->with('message', 'Logo uploaded successfully.');
    }

    public function edit()
    {
        return view('admin.settings.logo.edit')->with([
            // 'logo' => Config::where('name', 'logo')->first(),
        ]);
    }
    
    public function update(Request $request)
    {
        // validate the uploaded file
        $request->validate([
            'image' => 'required|file|image|max:10000',
        ]);
        
        // retrieve logo config
        $config = Config::where('name', 'logo')->firstOrFail();

        // delete old logo image
            // get logo image path
            $file = str_replace('/storage', 'public', $config->value);

            // delete the old image from storage
            Storage::delete($file);

        // store the new image
        $path = $request->file('image')->store('public');

        // update config
        $config->value = Storage::url($path);
        $config->save();

        // redirect to logo index
        return redirect()->route('admin.settings.logo.index')
        ->with('message', 'Logo updated successfully.');
    }
    
    public function delete()
    {
        // retrieve logo config
        $config = Config::firstWhere('name', 'logo');

        // get logo image path
        $file = str_replace('/storage', 'public', $config->value);

        // delete the image from storage
        Storage::delete($file);
        
        // delete config
        $config->delete();

        return redirect()->route('admin.settings.logo.index')
        ->with('message', 'Logo deleted successfully.');
    }
}
