<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Role;
use Illuminate\Http\Request;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Events\RoleDestroyedEvent;


class RoleController extends Controller
{
  public function index()
  {
    return view('admin.roles.index')->with([
      'roles' => Role::orderByDesc('id')->paginate(20),
    ]);
  }

  public function create()
  {
    return view('admin.roles.create')->with([
      'role' => new Role(), // passes an empty model to the view
    ]);
  }

  public function store(StoreRoleRequest $request)
  {
    Role::create($request->validated());
    return redirect()->route('admin.roles.index')
    ->with('message', 'Role created successfully.');
  }

  public function show(Role $role)
  {
    return view('admin.roles.show')->with([
      'role' => $role,
    ]);
  }

  public function edit(Role $role)
  {
    return view('admin.roles.edit')->with([
      'role' => $role,
    ]);
  }

  public function update(UpdateRoleRequest $request, Role $role)
  {
    $role->update($request->validated()); // update model
    return redirect()->route('admin.roles.show', ['role' => $role])
    ->with('message', 'Role updated successfully.'); // return view with message
  }

  public function destroy(Role $role)
  {
    $id = $role->id;
    
    $role->delete();
    
    RoleDestroyedEvent::dispatch($id);
    
    return redirect()->route('admin.roles.index')
    ->with('message', 'Role deleted successfully.');
  }
}
