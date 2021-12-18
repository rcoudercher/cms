<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Events\PersonDestroyedEvent;

class PersonController extends Controller
{
  public function index()
  {
    return view('admin.people.index')->with([
      'people' => Person::orderByDesc('id')->paginate(20),
    ]);
  }

  public function create()
  {
    return view('admin.people.create')->with([
      'person' => new Person(), // passes an empty model to the view
    ]);
  }

  public function store(Request $request)
  {
    $data = [
      'name' => $request->input('name'),
      'slug' => Str::slug($request->input('name'), '-'),
      'date_of_birth' => $request->input('date_of_birth'),
      'place_of_birth' => $request->input('place_of_birth'),
      'date_of_death' => $request->input('date_of_death'),
      'place_of_death' => $request->input('place_of_death'),
      'description' => $request->input('description'),
      'content' => $request->input('content')
    ];
    
    $rules = [
      'name' => 'required|max:255',
      'slug' => 'required|unique:people',
      'date_of_birth' => 'required|date',
      'place_of_birth' => 'required|max:200',
      'date_of_death' => 'nullable|date',
      'place_of_death' => 'nullable|string|max:200',
      'description' => 'required|string|max:2000',
      'content' => 'required|string|max:20000'
    ];
    
    $validated = Validator::make($data, $rules)->validate();

    Person::create($validated);

    return redirect()->route('admin.people.index')
    ->with('message', 'Person created successfully.');
  }

  public function show(Person $person)
  {
    return view('admin.people.show')->with([
      'person' => $person,
    ]);
  }

  public function edit(Person $person)
  {  
    return view('admin.people.edit')->with([
      'person' => $person
    ]);
  }

  public function update(Request $request, Person $person)
  {
    $data = [
      'name' => $request->input('name'),
      'slug' => Str::slug($request->input('name'), '-'),
      'date_of_birth' => $request->input('date_of_birth'),
      'place_of_birth' => $request->input('place_of_birth'),
      'date_of_death' => $request->input('date_of_death'),
      'place_of_death' => $request->input('place_of_death'),
      'description' => $request->input('description'),
      'content' => $request->input('content')
    ];
    
    $rules = [
      'name' => 'required|max:255',
      'slug' => ['required', Rule::unique('people')->ignore($person)],
      'date_of_birth' => 'required|date',
      'place_of_birth' => 'required|max:200',
      'date_of_death' => 'nullable|date',
      'place_of_death' => 'nullable|string|max:200',
      'description' => 'required|string|max:2000',
      'content' => 'required|string|max:20000'
    ];
    
    $validated = Validator::make($data, $rules)->validate();
    
    // update model
    $person->update($validated);

    // return view
    return redirect()->route('admin.people.show', ['person' => $person])
    ->with('message', 'Person updated successfully.');
  }

  public function destroy(Person $person)
  {
    $id = $person->id;
    
    $person->delete();
    
    PersonDestroyedEvent::dispatch($id);
    
    return redirect()->route('admin.people.index')
    ->with('message', 'Person deleted successfully.');
  }
}
