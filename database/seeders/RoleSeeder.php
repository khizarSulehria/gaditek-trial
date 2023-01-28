<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
                ['name' => User::USER_ROLE_CUSTOMER],
                ['name' => User::USER_ROLE_RIDER]
        ];
        foreach($data as $role){
            if(!Role::where("name",$role['name'])->exists())
                $role = Role::create($role);
        }


    }
}
