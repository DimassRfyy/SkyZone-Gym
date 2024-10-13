<?php

namespace App\Repositories;

use App\Models\City;
use App\Repositories\Contracts\CityRepositoryInterface;

class CityRepository implements CityRepositoryInterface {
    public function getAllCities(){
        return City::latest()->get();
    }
}
