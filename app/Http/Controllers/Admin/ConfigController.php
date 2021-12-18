<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;
use App\Http\Requests\StoreConfigRequest;
use App\Http\Requests\UpdateConfigRequest;
use App\Events\ConfigDestroyedEvent;

class ConfigController extends Controller
{
  public function index()
  {
    return view('admin.configs.index')->with([
      'configs' => Config::orderByDesc('id')->paginate(20),
    ]);
  }

  public function create()
  {
    return view('admin.configs.create')->with([
      'config' => new Config(), // passes an empty model to the view
    ]);
  }

  public function store(StoreConfigRequest $request)
  {
    Config::create($request->validated());
    return redirect()->route('admin.configs.index')
    ->with('message', 'Config created successfully.');
  }

  public function show(Config $config)
  {
    return view('admin.configs.show')->with([
      'config' => $config,
    ]);
  }

  public function edit(Config $config)
  {
    return view('admin.configs.edit')->with([
      'config' => $config,
    ]);
  }

  public function update(UpdateConfigRequest $request, Config $config)
  {
    $config->update($request->validated()); // update model
    return redirect()->route('admin.configs.show', ['config' => $config])
    ->with('message', 'Config updated successfully.'); // return view with message
  }

  public function destroy(Config $config)
  {
    $id = $config->id;
    
    $config->delete();
    
    ConfigDestroyedEvent::dispatch($id);
    
    return redirect()->route('admin.configs.index')
    ->with('message', 'Config deleted successfully.');
  }
}
