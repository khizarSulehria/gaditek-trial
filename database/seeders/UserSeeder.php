<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::factory()->count(5)->create()
           ->each(function ($user) {
            $user->assignRole(User::USER_ROLE_CUSTOMER);
           });
    
        User::factory()->count(3)->create()
           ->each(function ($user) {
            $user->assignRole(User::USER_ROLE_RIDER);
           });   
    
    
    }
}
