<?php

namespace App\Repositories\Contracts;

interface GymRepositoryInterface {
    public function getPopularGyms($limit);
    public function getAllNewGyms();
    public function find($id);
    public function getPrice($gymId);
}
