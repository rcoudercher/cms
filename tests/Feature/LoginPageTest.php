<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LoginPageTest extends TestCase
{
  public function test_user_can_login_using_the_login_form()
  {
    $user = User::factory()->create();
    
    $response = $this->post(route('login'), [
      'email' => $user->email,
      'password' => 'password',
    ]);
    
    $this->assertAuthenticated();
    $response->assertRedirect(route('home'));
  }
  
  public function test_non_admin_user_can_not_access_admin()
  {
    $user = User::factory()->create();
    
    $this->post('/login', [
      'email' => $user->email,
      'password' => 'password',
    ]);
    
    $response = $this->get('/admin');
    $response->assertRedirect('/');
  }
  
  public function test_admin_user_can_access_an_admin_page()
  {
    $user = User::factory()->create();
    $user->roles()->attach(1);
    
    $this->post('/login', [
      'email' => $user->email,
      'password' => 'password',
    ]);
    
    $response = $this->get('/admin');
    $response->assertSeeText('Admin home');
  }
}
