<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;

class AuthorController extends Controller
{
  public function index()
  {
    return view('admin.authors.index')->with([
      'authors' => Author::orderByDesc('id')->paginate(20),
    ]);
  }

  public function create()
  {
    return view('admin.authors.create')->with([
      'author' => new Author(), // passes an empty model to the view
    ]);
  }

  public function store(StoreAuthorRequest $request)
  {
    Author::create($request->validated());
    return redirect()->route('admin.authors.index')
    ->with('message', 'Author created successfully.');
  }

  public function show(Author $author)
  {
    return view('admin.authors.show')->with([
      'author' => $author,
      'articles' => $author->articles,
    ]);
  }

  public function edit(Author $author)
  {
    return view('admin.authors.edit')->with([
      'author' => $author,
    ]);
  }

  public function update(UpdateAuthorRequest $request, Author $author)
  {
    $author->update($request->validated()); // update model
    return redirect()->route('admin.authors.show', ['author' => $author])
    ->with('message', 'Author updated successfully.'); // return view with message
  }

  public function destroy(Author $author)
  {
    $author->delete();
    return redirect()->route('admin.authors.index')
    ->with('message', 'Author deleted successfully.');
  }
}
