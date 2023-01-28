<?php

namespace App\Repositories;

use App\Models\Parcel;
use App\Models\Status;
use App\Models\User;

use App\Repositories\Interfaces\RiderRepositoryInterface;
use Illuminate\Support\Str;

class RiderRepository implements RiderRepositoryInterface
{
    public function getAll()
    {       
        $data = Parcel
                ::whereHas("status", function($query){
                    $query->where("title",Status::STATUS_PENDING);
                })
                ->orderBy("id","DESC")->get();
        return  [
            "success" => true,
            "data" => $data,
            "message" => "",
            "status" => 200
        ];

    }


    public function myParcels(User $user){
        $data = $user->riderParcels()->orderBy("id","DESC")->get();;

        return [
            "success" => true,
            "data" => $data,
            "message" => "",
            "status" => 200
        ];

    }
    
    
}