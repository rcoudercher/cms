<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;
use Illuminate\Support\Facades\Storage;
use App\Events\ImageDestroyedEvent;

class ImageController extends Controller
{
  public function index()
  {
    return view('admin.images.index')->with([
      'images' => Image::orderByDesc('id')->paginate(20),
    ]);
  }

  public function create()
  {
    return view('admin.images.create')->with([
      'image' => new Image(),// passes an empty model to the view
    ]);
  }

  public function store(StoreImageRequest $request)
  {    
    // use OBJECT STORAGE to store the image
    $path = $request->file('image')->store('public');
        
    // save that image in the database
    Image::create([
      'path' => $path,
      'url' => Storage::url($path),
      'credit' => $request->input('credit'),
      'original_name' => $request->file('image')->getClientOriginalName(),
      'extension' => $request->file('image')->extension(),
    ]);

    return redirect()->route('admin.images.index')
    ->with('message', 'Image created successfully.');
  }

  public function show(Image $image)
  {
    return view('admin.images.show')->with([
      'image' => $image,
    ]);
  }

  public function edit(Image $image)
  {
    return view('admin.images.edit')->with([
      'image' => $image,
    ]);
  }

  public function update(UpdateImageRequest $request, Image $image)
  {
    $image->update($request->validated()); // update model

    // return view
    return redirect()->route('admin.images.show', ['image' => $image])
    ->with('message', 'Image updated successfully.');
  }

  public function destroy(Image $image)
  {
    $id = $image->id;
    
    Storage::delete($image->path); // delete file from object storage
    $image->delete(); // delete file from database
    
    ImageDestroyedEvent::dispatch($id);
    
    return redirect()->route('admin.images.index')
    ->with('message', 'Image deleted successfully.');
  }
}
