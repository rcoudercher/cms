<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Events\TagDestroyedEvent;

class TagController extends Controller
{
  public function index()
  {
    return view('admin.tags.index')->with([
      'tags' => Tag::orderByDesc('id')->paginate(20),
    ]);
  }

  public function create()
  {
    return view('admin.tags.create')->with([
      'tag' => new Tag(), // passes an empty model to the view
    ]);
  }

  public function store(StoreTagRequest $request)
  {
    Tag::create($request->validated());
    return redirect()->route('admin.tags.index')
    ->with('message', 'Tag created successfully.');
  }

  public function show(Tag $tag)
  {
    return view('admin.tags.show')->with([
      'tag' => $tag,
      'articles' => $tag->articles,
    ]);
  }

  public function edit(Tag $tag)
  {
    return view('admin.tags.edit')->with([
      'tag' => $tag,
    ]);
  }

  public function update(UpdateTagRequest $request, Tag $tag)
  {
    $tag->update($request->validated()); // update model
    return redirect()->route('admin.tags.show', ['tag' => $tag])
    ->with('message', 'Tag updated successfully.'); // return view with success
  }

  public function destroy(Tag $tag)
  {
    $id = $tag->id;
    
    $tag->delete();
    
    TagDestroyedEvent::dispatch($id);
    
    return redirect()->route('admin.tags.index')
    ->with('message', 'Tag deleted successfully.');
  }
}
