@extends('layouts.app')

@section('title') @endsection
@section('content')
<div id="background" class="absolute w-full h-[345px] top-0 z-0 bg-[#9FDDFF]"></div>
<x-nav/>
{{-- @dd($bookingDetails) --}}
<div class="relative flex justify-center w-full max-w-[1280px] gap-6 mx-auto px-10 mt-[96px]">
    <div class="flex flex-col w-full max-w-[665px] shrink-0 rounded-3xl px-[57.5px] py-[46px] gap-6 bg-white">
        <img src="{{asset('assets/images/icons/ticket-lifting.svg')}}" class="w-[350px] mx-auto" alt="icon">
        <h1 class="font-['ClashDisplay-SemiBold'] text-[32px] leading-10 tracking-05 text-center">Transaction Ticket</h1>
        <div class="flex items-center justify-between">
            <p class="font-['ClashDisplay-SemiBold'] leading-19 tracking-05">Booking ID</p>
            <p class="leading-19 tracking-05">{{$bookingDetails->booking_trx_id}}</p>
        </div>
        <div class="flex items-center justify-between">
            <p class="font-['ClashDisplay-SemiBold'] leading-19 tracking-05">Started At</p>
            <p class="leading-19 tracking-05">{{$bookingDetails->started_at->format('M d, Y')}}</p>
        </div>
        <div class="flex items-center justify-between">
            <p class="font-['ClashDisplay-SemiBold'] leading-19 tracking-05">Ended At</p>
            <p class="leading-19 tracking-05">{{$bookingDetails->ended_at->format('M d, Y')}}</p>
        </div>
        <div class="flex items-center justify-between">
            <p class="font-['ClashDisplay-SemiBold'] leading-19 tracking-05">Total Payment</p>
            <p class="leading-19 tracking-05 font-bold">Rp {{ number_format($bookingDetails->total_amount, 0, ',', '.')}} </p>
        </div>
        <div class="flex items-center justify-between">
            <p class="font-['ClashDisplay-SemiBold'] leading-19 tracking-05">Payment Status</p>
            @if ($bookingDetails->is_paid)
            <p class="rounded-full py-3 px-6 bg-[#E56062] w-fit font-semibold leading-19 tracking-05 text-white">Success</p>
            @else
            <p class="rounded-full py-3 px-6 bg-[#E56062] w-fit font-semibold leading-19 tracking-05 text-white">Pending</p>
            @endif
        </div>
    </div>
    <div class="flex flex-col w-full max-w-[356px] h-fit rounded-3xl p-8 gap-6 bg-white">
        <div class="flex w-full h-[200px] rounded-3xl overflow-hidden bg-[#606DE5]">
            <img src="{{Storage::url($bookingDetails->subscribePackage->icon)}}" class="w-full h-full object-cover" alt="icon">
        </div>
        <div class="flex flex-col gap-2">
            <p class="font-['ClashDisplay-SemiBold'] leading-19 tracking-05">{{$bookingDetails->subscribePackage->name}}</p>
            <p class="text-sm leading-16 tracking-05 opacity-50">Starter membership, start your journey</p>
        </div>
        <p class="font-semibold leading-19 tracking-05">
            Rp {{number_format($bookingDetails->subscribePackage->price, 0, ',', '.')}}<span class="font-normal opacity-50">/{{$bookingDetails->subscribePackage->duration/31}} month</span>
        </p>
    </div>
</div>
<x-footer/>
@endsection
