<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(App\User::class, 50)->create();
        $user = new User([
            'name' => 'admin',
            'email' => 'info@anuncioslucena.com',
            'phone' => '123456789',
            'email_verified_at' => now(),
            'password' => Hash::make('admin'),
            'remember_token' => Str::random(10),
            'admin'=> true
        ]);
        $user->save();

    }
}
