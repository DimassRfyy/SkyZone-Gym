<?php
namespace App\Services;

use App\Models\SubscribeTransaction;
use App\Repositories\Contracts\BookingRepositoryInterface;
use App\Repositories\Contracts\SubscribePackageRepositoryInterface;
use Illuminate\Support\Facades\DB;

class BookingService {
    protected $subscribePackageRepository;
    protected $bookingRepository;

    public function __construct(SubscribePackageRepositoryInterface $subscribePackageRepository, BookingRepositoryInterface $bookingRepository) {
        $this->subscribePackageRepository = $subscribePackageRepository;
        $this->bookingRepository = $bookingRepository;
    }

    public function getBookingDetails (array $validated) {
        return $this->bookingRepository->findByTrxAndPhoneNumber($validated['booking_trx_id'], $validated['phone']);
    }

    protected function calculateBookingData($subscribePackage, $validatedData){
        $duration = $subscribePackage->duration;
        $startedAt = now();
        $endedAt = now()->addDays($duration);

        $ppn = 0.11;
        $price = $subscribePackage->price;

        $subTotal = $price;
        $totalPpn = $subTotal * $ppn;
        $totalAmount = $subTotal + $totalPpn;

        return [
            'subscribe_package_id' => $subscribePackage->id,
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'duration' => $duration,
            'started_at' => $startedAt,
            'ended_at' => $endedAt,
            'subTotal' => $subTotal,
            'total_ppn' => $totalPpn,
            'total_amount' => $totalAmount,
        ];
    }

    public function storeBookingToSession ($subscribePackage, $validatedData){
        $bookingData = $this->calculateBookingData($subscribePackage, $validatedData);
        $this->bookingRepository->saveToSession($bookingData);
    }

    public function payment(){
        $booking = $this->bookingRepository->getBookingDataFromSession();
        $subscribePackage = $this->subscribePackageRepository->find($booking['subscribe_package_id']);

        return compact('booking', 'subscribePackage');
    }

    public function paymentStore(array $validated){
        $bookingData = $this->bookingRepository->getBookingDataFromSession();
        $bookingTransactionId = null;

        DB::transaction(function () use ($validated, &$bookingTransactionId, $bookingData) {
            if(isset($validated['proof'])){
                $proofpath = $validated['proof']->store('proof', 'public');
                $validated['proof'] = $proofpath;
            }

            $validated['name'] = $bookingData['name'];
            $validated['phone'] = $bookingData['phone'];
            $validated['email'] = $bookingData['email'];
            $validated['duration'] = $bookingData['duration'];
            $validated['total_amount'] = $bookingData['total_amount'];
            $validated['started_at'] = $bookingData['started_at'];
            $validated['ended_at'] = $bookingData['ended_at'];
            $validated['subscribe_package_id'] = $bookingData['subscribe_package_id'];
            $validated['is_paid'] = false;

            $validated['booking_trx_id'] = SubscribeTransaction::generateUniqueTrxId();

            $newBooking = $this->bookingRepository->createBooking($validated);

            $bookingTransactionId = $newBooking->id;
        });

        return $bookingTransactionId;
    }
}
