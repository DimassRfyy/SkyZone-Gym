<?php

namespace App\Repositories\Contracts;

interface BookingRepositoryInterface
{
    public function createBooking(array $data);
    public function findByTrxAndPhoneNumber($bookingTrxId, $phoneNumber);
    public function saveToSession(array $data);
    public function updateSessionData(array $data);
    public function getBookingDataFromSession();
    public function clearSession();
}
