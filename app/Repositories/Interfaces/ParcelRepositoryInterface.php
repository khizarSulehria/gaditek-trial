<?php

namespace App\Repositories\Interfaces;

use App\Models\Parcel;
use App\Models\User;

interface ParcelRepositoryInterface
{
    public function getAll(User $user);

    public function create(User $user,$request);

    public function pickParcel(Parcel $parcel,User $user);

}