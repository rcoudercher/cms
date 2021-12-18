<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Events\PageDestroyedEvent;

class PageController extends Controller
{
  public function index()
  {
    return view('admin.pages.index')->with([
      'pages' => Page::orderByDesc('id')->paginate(20),
    ]);
  }

  public function create()
  {
    return view('admin.pages.create')->with([
      'page' => new Page(), // passes an empty model to the view
    ]);
  }

  public function store(StorePageRequest $request)
  {
    Page::create($request->validated());
    return redirect()->route('admin.pages.index')
    ->with('message', 'Page created successfully.');
  }

  public function show(Page $page)
  {
    return view('admin.pages.show')->with([
      'page' => $page,
    ]);
  }

  public function edit(Page $page)
  {
    return view('admin.pages.edit')->with([
      'page' => $page,
    ]);
  }

  public function update(UpdatePageRequest $request, Page $page)
  {
    $page->update($request->validated()); // update model
    return redirect()->route('admin.pages.show', ['page' => $page])
    ->with('message', 'Page updated successfully.'); // return view with message
  }

  public function destroy(Page $page)
  {
    $id = $page->id;
    
    $page->delete();
    
    PageDestroyedEvent::dispatch($id);
    
    return redirect()->route('admin.pages.index')
    ->with('message', 'Page deleted successfully.');
  }
}
