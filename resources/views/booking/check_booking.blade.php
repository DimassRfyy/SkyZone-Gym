@extends('layouts.app')

@section('title') Check Subscription Fitcamp @endsection
@section('content')
<div id="background" class="absolute w-full h-[345px] top-0 z-0 bg-[#9FDDFF]"></div>
<x-nav/>
<form action="{{route('front.check_booking_details')}}" method="POST" class="relative flex flex-col items-center w-full max-w-[642px] text-center rounded-3xl p-8 py-[70px] gap-8 bg-white mx-auto mt-[120px]">
    @csrf
    <img src="{{asset('assets/images/icons/Booking ID.svg')}}" class="w-[400px] flex shrink-0" alt="icon">
    <div class="flex flex-col items-center gap-4">
        <h1 class="font-['ClashDisplay-SemiBold'] text-[32px] leading-10 tracking-05">View Subscription</h1>
    </div>
    <label class="flex flex-col gap-1 font-['Poppins'] w-full items-start">
        <p class="font-semibold text-fitcamp-black">Booking ID</p>
        <input type="text" name="booking_trx_id" id="" class="outline-none flex w-full rounded-xl px-3 py-4 border border-[#BFBFBF] bg-white font-['Poppins'] text-sm leading-[22px] tracking-03 placeholder:text-[#BFBFBF] transition-all duration-300 group-focus-within:border-black" placeholder="Input your Booking ID from transaction">
    </label>
    <label class="flex flex-col gap-1 font-['Poppins'] w-full items-start">
        <p class="font-semibold text-fitcamp-black">Phone Number</p>
        <input type="tel" name="phone" id="" class="outline-none flex w-full rounded-xl px-3 py-4 border border-[#BFBFBF] bg-white font-['Poppins'] text-sm leading-[22px] tracking-03 placeholder:text-[#BFBFBF] transition-all duration-300 group-focus-within:border-black" placeholder="Input your phone number based on transaction">
    </label>
    <button type="submit" class="w-fit rounded-full py-3 px-6 bg-[#606DE5] font-semibold leading-19 tracking-05 text-white text-center">View My Subscription</button>
</form>
<x-footer/>
@endsection
