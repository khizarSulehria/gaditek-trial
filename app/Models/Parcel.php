<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcel extends Model
{
    use HasFactory;

    protected $guarded = [ "id"];

    protected $with = ["user","status","assignedRider"]; 

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function status(){
        return $this->hasOne(Status::class,"id","status");
    }

    public function assignedRider(){
        return $this->belongsTo(User::class);
    }

}
