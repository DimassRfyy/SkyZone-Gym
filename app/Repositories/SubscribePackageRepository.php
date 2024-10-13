<?php

namespace App\Repositories;

use App\Models\SubscribePackage;
use App\Repositories\Contracts\SubscribePackageRepositoryInterface;

class SubscribePackageRepository implements SubscribePackageRepositoryInterface {
    public function getAllSubscribePackages(){
        return SubscribePackage::orderBy('id', 'asc')->get();
    }

    public function find($id){
        return SubscribePackage::find($id);
    }

    public function getPrice($subscribePackageId){
        $subscribePackage = SubscribePackage::find($subscribePackageId);
        return $subscribePackage ? $subscribePackage->price : 0;
    }
}
