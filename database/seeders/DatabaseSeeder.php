<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
  public function run()
  {
    $this->call(UserSeeder::class);
    $this->call(RoleSeeder::class);
    $this->call(RoleUserSeeder::class);
    $this->call(AuthorSeeder::class);
    $this->call(CategorySeeder::class);
    $this->call(ImageSeeder::class);
    $this->call(ArticleSeeder::class);
    $this->call(TagSeeder::class);
    $this->call(ArticleTagSeeder::class);
    $this->call(ConfigSeeder::class);
    $this->call(PageSeeder::class);
    $this->call(CommentSeeder::class);
    
    // adds an admin user to the database
    $admin = User::create([
      'name' => 'admin',
      'email' => 'admin@admin.com',
      'email_verified_at' => now(),
      'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
      'remember_token' => Str::random(10),
    ]);
    $admin->roles()->attach(1);
  }
}
