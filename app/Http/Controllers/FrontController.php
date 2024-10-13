<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Gym;
use App\Services\FrontService;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    protected $frontService;

    public function __construct(FrontService $frontService) {
        $this->frontService = $frontService;
    }

    public function index() {
        $data = $this->frontService->getFrontPageData();
        // dd($data);
        return view('front.index', $data);
    }

    public function pricing() {
        $data = $this->frontService->getSubscriptiosnData();
        // dd($data);
        return view('front.pricing', $data);
    }

    public function details (Gym $gym) {
        // dd($gym);
        return view('front.details', compact('gym'));
    }

    public function city (City $city) {
        // dd($city);
        return view('front.city', compact('city'));
    }
}
