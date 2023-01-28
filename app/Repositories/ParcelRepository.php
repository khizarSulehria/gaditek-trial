<?php

namespace App\Repositories;

use App\Models\Parcel;
use App\Models\Status;
use App\Models\User;
use App\Repositories\Interfaces\ParcelRepositoryInterface;
use Illuminate\Support\Str;

class ParcelRepository implements ParcelRepositoryInterface
{
    public function getAll(User $user)
    {       
        $succes = true;
        $message = "";
        $data = null;
        $status = 200;

        $data =  $user->parcels()->orderBy("id","DESC")->get();
        return  [
            "success" => $succes,
            "data" => $data,
            "message" => $message,
            "status" => $status
        ];

    }


    function getById(Parcel $parcel,User $user){
        $data = Parcel::where("user_id",$user->id)
                        ->where("id",$parcel->id)
                        ->first();

       if($data){
        return  [
            "success" => true,
            "data" => $data,
            "message" => "",
            "status" => 200
        ];
       }                 
       return [
        "success" => false,
        "data" => null,
        "message" => "",
        "status" => 404
       ];

    }
    

    function create(User $user,$request){
        $succes = false;
        $message = "";
        $data = null;
        $status = 400;

        try{
            $data = $user->parcels()->create([
                "tracking_id" => Str::uuid(),
                'pickup_address' => $request['pickup_address'],
                'drop_off_address' => $request['dropoff_address'],
                "status" => Status::getStatusId(Status::STATUS_PENDING)
            ]);
            if($data){
                $data->load("status");
                $succes = true;
                $status = 200;
            }
            return  [
                "success" => $succes,
                "data" => $data,
                "message" => $message,
                "status" => $status
            ];
        }catch(\Exception $ex){
            return  [
                "success" => $succes,
                "data" => $data,
                "message" => $ex->getMessage(),
                "status" => 500
            ];
        }
    }
    




    public function pickParcel(Parcel $parcel,User $user){
        $succes = false;
        $message = "";
        $data = null;
        $status = 400;

        try{
            if(!$parcel->assignedRider){
                if($parcel->update([
                    "assigned_rider_id" => $user->id,
                    "status" => Status::getStatusId(Status::STATUS_PICKED_BY_RIDER)
                ])){
                    $success = true;
                    $data = $parcel->refresh();
                    $status = 200;
                }
                $message = config("messages.bad_request");

            }else{
                $message = config("messages.rider_already_picked");
            }

            return  [
                "success" => $succes,
                "data" => $data,
                "message" => $message,
                "status" => $status
            ];
        }catch(\Exception $ex){
            return  [
                "success" => $succes,
                "data" => $data,
                "message" => $ex->getMessage(),
                "status" => 500
            ];
        }

    }
}