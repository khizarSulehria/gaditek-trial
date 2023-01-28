<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    protected $with = [
        'roles'
    ];


    public const USER_ROLE_CUSTOMER = "customer";
    public const USER_ROLE_RIDER = "rider";


    public function parcels(){
        return $this->hasMany(Parcel::class,"user_id");
    }

    public function riderParcels(){
        return $this->hasMany(Parcel::class,"assigned_rider_id");
    }


    public function createApiToken(){
        $token = $this->createToken(config('app.app_token'));
        return $token->plainTextToken;
    }
}
