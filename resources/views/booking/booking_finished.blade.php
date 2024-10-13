@extends('layouts.app')

@section('title') Booking Finished @endsection
@section('content')
<div id="background" class="absolute w-full h-[345px] top-0 z-0 bg-[#9FDDFF]"></div>
<x-nav/>
<div class="relative flex flex-col items-center w-full max-w-[642px] text-center rounded-3xl p-8 py-[85px] gap-6 bg-white mx-auto mt-[120px]">
    <img src="{{asset('assets/images/icons/Success.svg')}}" class="w-[390px] flex shrink-0" alt="icon">
    <div class="flex flex-col items-center gap-4">
        <h1 class="font-['ClashDisplay-SemiBold'] text-[32px] leading-10 tracking-05">Booking Completed</h1>
        <p class="text-xl leading-8 tracking-[1px] opacity-60">
            We will confirm your payment and update <br>
            the status to your email adress
        </p>
    </div>
    <div class="w-fit flex items-center rounded-2xl py-4 px-8 gap-4 bg-[#D0EEFF]">
        <img src="{{asset('assets/images/icons/cart.svg')}}" class="w-10 h-10 flex shrink-0" alt="icon">
        <p class="font-['ClashDisplay-SemiBold'] text-xl leading-[34px] tracking-05">Your Booking ID:<span class="ml-2 text-[#835DFE]">{{$subscribeTransaction->booking_trx_id}}</span></p>
    </div>
    <a href="{{route('front.check_booking')}}" class="w-fit rounded-full py-3 px-6 bg-[#606DE5] font-semibold leading-19 tracking-05 text-white text-center">View My Subscription</a>
</div>
<x-footer/>
@endsection
