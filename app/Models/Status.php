<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $hidden = [
        "created_at",
        "updated_at",
        "is_active"
    ];

    public const STATUS_ACTIVE = "active";
    public const STATUS_PENDING = "pending";
    public const STATUS_PICKED_BY_RIDER = "picked by rider";
    public const STATUS_CANCELLED = "cancelled";



    public static function getStatusId($statusTitle){
        if($status = self::where("title",$statusTitle)->first('id')){
            return $status->id;
        }
        return null;
    }
}
