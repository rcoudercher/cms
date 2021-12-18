<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Auth\Events\PasswordReset;

class AuthController extends Controller
{
  public function register(Request $request)
  {
    // creates the new user
    $newUser = new CreateNewUser();
    $user = $newUser->create($request->only(['name', 'email', 'password', 'password_confirmation']));
    
    // attaches the 'user' role to this new user
    $user->roles()->attach(1);
    
    // dispatch the event to send verification link by email
    event(new Registered($user));
    
    // log this new user in
    if (Auth::attempt($request->only(['email', 'password']))) {
      $request->session()->regenerate();
      return redirect()->route('home')
      ->with('notification', 'Votre compte a bien été créé. Veuillez confirmer votre email avec le lien que nous venons d\'envoyer à votre adresse.');
    }
    
    return redirect()->route('home')
    ->with('notification', 'Une erreur s\'est produite');
  }
  
  public function login(Request $request)
  {
    $credentials = $request->validate([
      'email' => ['required', 'email'],
      'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();
      return redirect()->intended(route('home'))
      ->with('notification', 'Vous êtes connecté');
    }

    return back()->withErrors([
      'email' => 'Identifiants erronés',
    ]);
  }
  
  public function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('home')
    ->with('notification', 'Vous avez bien été déconnecté');
  }
  
  public function verifyEmail(EmailVerificationRequest $request)
  {
    $request->fulfill();
    return redirect()->route('home')
    ->with('notification', 'Votre email a bien été vérifié');
  }
  
  public function resendEmailVerificationLink(Request $request)
  {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('notification', 'Un nouveau lien de vérification vient d\'être envoyé à votre adresse email');
  }
  
  public function forgotPassword(Request $request)
  {
    $request->validate(['email' => 'required|email']);
    $status = Password::sendResetLink($request->only('email'));
    return $status === Password::RESET_LINK_SENT
        ? redirect()->route('home')->with(['notification' => __($status)])
        : back()->withErrors(['email' => __($status)]);
  }
  
  public function resetPassword(Request $request)
  {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('notification', __($status))
                : back()->withErrors(['email' => [__($status)]]);
  }
}
