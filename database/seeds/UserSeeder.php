<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $user = new User();
         $user->name = 'Pippo';
         $user->email = 'test@test.it';
         $user->password = bcrypt('password');
         $user->save();
    }
}
 