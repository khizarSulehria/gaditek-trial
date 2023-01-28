<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use App\Models\User;
use App\Repositories\Interfaces\ParcelRepositoryInterface;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Object_;
use Validator;

class ParcelController extends Controller
{
    //
    private $parcelRepo;

    public  function __construct(ParcelRepositoryInterface $parcelRepo){
        $this->parcelRepo = $parcelRepo;
    }

    public function index(){
        $data = $this->parcelRepo->getAll(auth()->user());
        return response()->json($data,200);
    }


    function get(Parcel $parcel){
        
        $data = $this->parcelRepo->getById($parcel,auth()->user());
        return response()->json($data,$data["status"]);

    }


    public function create(Request $request){

        $validator = Validator::make($request->all(),[
            "pickup_address" => ['required', 'string','max:500'],
            "dropoff_address" => ['required', 'string','max:500'],
        ]);

        if($validator->fails()){
            return response($validator->messages(), 422);
        } else {
            $resp = $this->parcelRepo->create(auth()->user(), $request->only('pickup_address','dropoff_address'));            
            return response()->json($resp,$resp["status"]);
            
        }
    }

    public function pickParcel(Request $request,Parcel $parcel){
        $resp = $this->parcelRepo->pickParcel($parcel,auth()->user());            
        return response()->json($resp,$resp["status"]);
    }

}
