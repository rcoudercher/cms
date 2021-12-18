<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Actions\Fortify\UpdateUserPassword;


class ProfileController extends Controller
{  
  public function updateInfo(Request $request)
  {
    // retrieves the authenticated user
    $user = Auth::user();
    
    // check if the email was changed
    $emailChanged = false;
    if ($request->input('email') !== $user->email) {
      $emailChanged = true;
    }
        
    // updates this user's name and/or email using Fortify's UpdateUserProfileInformation action
    $UpdateUserProfileInformation = new UpdateUserProfileInformation();
    $UpdateUserProfileInformation->update($user, $request->only(['name', 'email']));
    
    // redirect with relevant message
    if ($emailChanged) {
      return redirect()->route('profile.index')
      ->with('notification', 'Veuillez vérifier votre nouvelle adresse email avec le lien que nous venons de vous envoyer.');
    } else {
      return redirect()->route('profile.index')
      ->with('notification', 'Profil mis à jour correctement');
    }
  }
  
  public function updatePassword(Request $request)
  {
    $UpdateUserPassword = new UpdateUserPassword();
    $UpdateUserPassword->update(Auth::user(), $request->all());
    return redirect()->route('profile.index')
    ->with('notification', 'Mot de passe modifié correctement');
  }
  
  public function destroy()
  {
    Auth::user()->delete();
    return redirect()->route('home')
    ->with('notification', 'Votre compte a bien été supprimé');
  }
  
  public function commentsIndex()
  {
    return view('front.profile.comments')->with([      
      'comments' => Auth::user()->comments()->orderByDesc('updated_at')->paginate(20),
    ]);
  }
}
