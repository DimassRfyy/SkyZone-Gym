<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\StoreCheckBookingRequest;
use App\Http\Requests\StorePaymentRequest;
use App\Models\SubscribePackage;
use App\Models\SubscribeTransaction;
use App\Services\BookingService;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService) {
        $this->bookingService = $bookingService;
    }

    public function checkBooking (){
        return view('booking.check_booking');
    }
    public function checkBookingDetails (StoreCheckBookingRequest $request){
        $validated = $request->validated();

        $bookingDetails = $this->bookingService->getBookingDetails($validated);

        if($bookingDetails){
            return view('booking.check_booking_details', compact('bookingDetails'));
        }

        return redirect()->route('booking.check_booking')->withErrors(['error' => 'Transaction not found.']);
    }
    public function payment (){
        $data = $this->bookingService->payment();

        return view('booking.payment', $data);
    }
    public function paymentStore (StorePaymentRequest $request){
        $validated = $request->validated();
        $bookingTransactionId = $this->bookingService->paymentStore($validated);

        if($bookingTransactionId){
            return redirect()->route('front.booking_finished', $bookingTransactionId);
        }

        return redirect()->route('front.index')->withErrors(['error' => 'Payment Failed. Please try again.']);
    }
    public function booking (SubscribePackage $subscribePackage){
        $tax = 0.11;
        $totalTaxAmount = $tax * $subscribePackage->price;
        $grandTotalAmount = $subscribePackage->price + $totalTaxAmount;

        return view('booking.checkout', compact('subscribePackage', 'totalTaxAmount', 'grandTotalAmount'));
    }
    public function bookingStore (SubscribePackage $subscribePackage, StoreBookingRequest $request){
        $validated = $request->validated();

        try{
            $this->bookingService->storeBookingToSession($subscribePackage, $validated);
        }catch (\Exception $e){
            return redirect()->back()->withErrors('error', 'Failed to store booking, Please try again.');
        }

        return redirect()->route('front.payment');
    }
    public function bookingFinished (SubscribeTransaction $subscribeTransaction){
        return view('booking.booking_finished', compact('subscribeTransaction'));
    }
}
