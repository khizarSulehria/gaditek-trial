<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
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
            ['title' => Status::STATUS_ACTIVE],
            ['title' => Status::STATUS_PENDING],
            ['title' => Status::STATUS_PICKED_BY_RIDER],
            ['title' => Status::STATUS_CANCELLED]
    ];
    foreach($data as $role){
        if(!Status::where("title",$role['title'])->exists())
            $status = Status::create($role);
     }
    }
}
