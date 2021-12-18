<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Support\Facades\Password;
use App\Events\UserDestroyedEvent;

class UserController extends Controller
{
  public function index()
  {
    return view('admin.users.index')->with([
      'users' => User::orderByDesc('id')->paginate(20),
    ]);
  }

  public function create()
  {
    return view('admin.users.create')->with([
      'user' => new User(), // passes an empty model to the view
      'roles' => Role::all(),
    ]);
  }

  public function store(Request $request)
  {
    $newUser = new CreateNewUser();
    $user = $newUser->create($request->only(['name', 'email', 'password', 'password_confirmation']));
    $user->roles()->sync($request->roles);
    Password::sendResetLink($request->only(['email']));
    return redirect(route('admin.users.index'))
    ->with('message', 'User created successfully.');
  }

  public function show(User $user)
  {
    return view('admin.users.show', ['user' => $user]);
  }

  public function edit(User $user)
  {
    return view('admin.users.edit')->with([
      'user' => $user,
      'roles' => Role::all(),
    ]);
  }

  public function update(Request $request, User $user)
  {
    $UpdateUserProfileInformation = new UpdateUserProfileInformation();
    $UpdateUserProfileInformation->update($user, $request->all());
    
    $user->roles()->sync($request->roles);
    
    return redirect(route('admin.users.show', ['user' => $user]))
    ->with('message', 'User updated successfully.'); // return view with message
  }

  public function destroy(User $user)
  {
    $user->delete();
    
    UserDestroyedEvent::dispatch($user);
    
    return redirect(route('admin.users.index'))
    ->with('message', 'User deleted successfully.');
  }
}
