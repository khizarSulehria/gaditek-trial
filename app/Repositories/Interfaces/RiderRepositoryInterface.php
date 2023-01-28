<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface RiderRepositoryInterface
{
    public function getAll();

    public function myParcels(User $user);




}