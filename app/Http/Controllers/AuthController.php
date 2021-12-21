<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Auth\Events\PasswordReset;
use App\Events\PasswordResetEvent;
use App\Events\UserRegisteredEvent;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Mail\VerifyEmailMail;
use App\Mail\PasswordResetLinkMail;
use App\Models\User;
use Carbon\Carbon;



class AuthController extends Controller
{
  public function register(Request $request)
  {
    // creates the new user
    $newUser = new CreateNewUser();
    $user = $newUser->create($request->only(['name', 'email', 'password', 'password_confirmation']));
    
    // attaches the 'user' role to this new user
    $user->roles()->attach(2);
    
    // dispatch the event to send verification link by email
    event(new UserRegisteredEvent($user));
    
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
    $user = Auth::user();
        
    if ($user instanceof MustVerifyEmail && ! $user->hasVerifiedEmail()) {
      Mail::to($user->email)
            ->queue(new VerifyEmailMail($user));
    }
    
    return back()->with('notification', 'Un nouveau lien de vérification vient d\'être envoyé à votre adresse email');
  }
  
  public function forgotPassword(Request $request)
  {
    // makes sure the given email exists in the users table
    $request->validate(['email' => 'required|email|exists:users']);
    
    // retrieve the user requesting a password reset
    $user = User::where('email', $request->email)->firstOrFail();
    
    // creates a token
    $token = Str::random(60);
        
    // insert token and email in database
    DB::table('password_resets')->insert([
      'email' => $request->email,
      'token' => $token,
      'created_at' => Carbon::now()
    ]);
    
    //Generate, the password reset link. The token generated is embedded in the link
    // $link = config('app.url') . '/reset-password/' . $token . '?email=' . urlencode($user->email);
    
    
    if ($this->sendPasswordResetEmail($user, $token)) {
      return redirect()->back()->with('notification', 'Nous vous avons envoyé un email pour changer votre mot de passe');
    } else {
      return redirect()->back()->with('notification', 'Une erreur s\'est produite');
    }
    
    // $status = Password::sendResetLink($request->only('email'));
    // 
    // return $status === Password::RESET_LINK_SENT
    //     ? redirect()->route('home')->with(['notification' => __($status)])
    //     : back()->withErrors(['email' => __($status)]);
  }
  
  private function sendPasswordResetEmail($user, $token)
  {
    // generate the password reset link with the token embedded into it
    $link = config('app.url') . 'reset-password/' . $token . '?email=' . urlencode($user->email);

    try {
      Mail::to($user->email)->queue(new PasswordResetLinkMail($user, $link));
      return true;
    } catch (\Exception $e) {
      return false;
    }
  }
    
  // public function resetPassword(Request $request)
  // {
  //   $request->validate([
  //       'token' => 'required',
  //       'email' => 'required|email',
  //       'password' => 'required|min:8|confirmed',
  //   ]);
  // 
  //   $status = Password::reset(
  //       $request->only('email', 'password', 'password_confirmation', 'token'),
  //       function ($user, $password) {
  //           $user->forceFill([
  //               'password' => Hash::make($password)
  //           ])->setRememberToken(Str::random(60));
  // 
  //           $user->save();
  // 
  //           event(new PasswordReset($user));
  //       }
  //   );
  // 
  //   return $status === Password::PASSWORD_RESET
  //               ? redirect()->route('login')->with('notification', __($status))
  //               : back()->withErrors(['email' => [__($status)]]);
  // }
  
  public function resetPassword(Request $request)
  {
    // validate form inputs
    $request->validate([
      'email' => 'required|email|exists:users',
      'password' => 'required|min:8|confirmed',
      'token' => 'required',
    ]);
    
    // look for given email/token in database
    $tokenData = DB::table('password_resets')
                      ->where('email', $request->email)
                      ->where('token', $request->token)
                      ->first();
    
    // if nothing found, redirect with error message
    if (!$tokenData) {
      back()->with(['notification' => 'Email et/ou Token incorrects']);
    }
    
    // save the new password
    $user = User::where('email', $request->email)->firstOrFail();
    $user->password = Hash::make($request->password);
    $user->save();
    
    
    // dispatch the event
    event(new PasswordResetEvent($user));
        
    // delete the token
    DB::table('password_resets')->where('email', $user->email)->delete();
    
    return redirect()->route('home')->with('notification', 'Votre mot de passe a été mis à jour correctement');
    
  }
  
}
