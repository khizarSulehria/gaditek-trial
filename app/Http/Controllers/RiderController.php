<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use App\Repositories\Interfaces\RiderRepositoryInterface;
use Illuminate\Http\Request;

class RiderController extends Controller
{
    //

    private $riderRepo;

    public  function __construct(RiderRepositoryInterface $riderRepo){
        $this->riderRepo = $riderRepo;
    }

    public function get(){
        $data = $this->riderRepo->getAll();
        return response()->json($data,200);
    }

    public function myParcels(){
        $data = $this->riderRepo->myParcels(auth()->user());
        return response()->json($data,200);
    }

}
