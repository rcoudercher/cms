<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Events\CategoryDestroyedEvent;

class CategoryController extends Controller
{
  public function index()
  {
    return view('admin.categories.index')->with([
      'categories' => Category::orderByDesc('id')->paginate(20),
    ]);
  }

  public function create()
  {
    return view('admin.categories.create')->with([
      'category' => new Category(), // passes an empty model to the view
    ]);
  }

  public function store(StoreCategoryRequest $request)
  {
    Category::create($request->validated());
    return redirect()->route('admin.categories.index')
    ->with('message', 'Category created successfully.');
  }

  public function show(Category $category)
  {
    return view('admin.categories.show')->with([
      'category' => $category,
    ]);
  }

  public function edit(Category $category)
  {
    return view('admin.categories.edit')->with([
      'category' => $category,
    ]);
  }

  public function update(UpdateCategoryRequest $request, Category $category)
  {
    $category->update($request->validated()); // update model
    return redirect()->route('admin.categories.show', ['category' => $category])
    ->with('message', 'Category updated successfully.'); // return view with message
  }

  public function destroy(Category $category)
  {
    $id = $category->id;
    
    $category->delete();
    
    CategoryDestroyedEvent::dispatch($id);
    
    return redirect()->route('admin.categories.index')
    ->with('message', 'Category deleted successfully.');
  }
}
