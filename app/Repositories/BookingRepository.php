<?php

namespace App\Repositories;

use App\Models\SubscribeTransaction;
use App\Repositories\Contracts\BookingRepositoryInterface;
use Illuminate\Support\Facades\Session;

class BookingRepository implements BookingRepositoryInterface{
     public function createBooking(array $data){
        return SubscribeTransaction::create($data);
     }

     public function findByTrxAndPhoneNumber($bookingTrxId, $phoneNumber){
        return SubscribeTransaction::where('booking_trx_id', $bookingTrxId)
            ->where('phone', $phoneNumber)
            ->first();
     }

     public function saveToSession(array $data){
        Session::put('booking_data', $data);
     }

     public function getBookingDataFromSession(){
        return Session('booking_data', []);
     }

     public function updateSessionData(array $data)
     {
        $bookingData = Session('booking_data', []);
        $bookingData = array_merge($bookingData, $data);
        Session(['booking_data' => $bookingData]);
     }

     public function clearSession(){
        Session::forget('booking_data');
     }
}
