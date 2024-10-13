@extends('layouts.app')

@section('title')
@endsection
@section('content')
    <div id="background" class="absolute w-full h-[345px] top-0 z-0 bg-[#9FDDFF]"></div>
    {{-- @dd($subscribePackage->name) --}}
    <x-nav />
    <form action="{{route('front.payment_store')}}" method="POST" enctype="multipart/form-data" id="content"
        class="relative flex w-full max-w-[1280px] gap-6 mx-auto px-10 mt-[96px]">
        @csrf
        <div class="flex flex-col gap-6 w-full max-w-[820px] shrink-0">
            <div id="account" class="flex flex-col w-full rounded-3xl p-8 gap-6 bg-white">
                <div class="flex flex-col gap-2">
                    <p class="font-['ClashDisplay-SemiBold'] text-xl leading-6 tracking-05">Account Details</p>
                    <p class="text-sm leading-16 tracking-03 opacity-60">Confirm and make sure your contact before
                        checkout
                    </p>
                </div>
                <hr class="border-black opacity-10">
                <div class="group flex items-center justify-between">
                    <p class="flex w-[162px] shrink-0 font-['ClashDisplay-SemiBold'] leading-19 tracking-05">Full Name
                    </p>
                    <p class="leading-19 tracking-05">{{ $booking['name'] }}</p>
                </div>
                <div class="group flex items-center justify-between">
                    <p class="flex w-[162px] shrink-0 font-['ClashDisplay-SemiBold'] leading-19 tracking-05">Phone
                        Number
                    </p>
                    <p class="leading-19 tracking-05">{{ $booking['phone'] }}</p>
                </div>
                <div class="group flex items-center justify-between">
                    <p class="flex w-[162px] shrink-0 font-['ClashDisplay-SemiBold'] leading-19 tracking-05">Email</p>
                    <p class="leading-19 tracking-05">{{ $booking['email'] }}</p>
                </div>
            </div>
            <div id="booking-items" class="flex flex-col w-full rounded-3xl p-8 gap-6 bg-white">
                {{-- @dd($subscribePackage->subcribeTransactions) --}}
                    <div class="flex flex-col gap-2">
                        <p class="font-['ClashDisplay-SemiBold'] text-xl leading-6 tracking-05">Booking ID : <span
                                class="text-[#606DE5]">TBD</span>
                        </p>
                    </div>
                    <div class="items flex flex-nowrap gap-4 w-full">
                        <img src="{{ asset('assets/images/icons/cart.svg') }}" class="w-10 h-10 flex shrink-0"
                            alt="icon">
                        <div class="flex flex-col gap-2 w-full">
                            <div class="flex justify-between">
                                <p class="font-['ClashDisplay-SemiBold'] leading-19 tracking-05">
                                    {{ $subscribePackage->name }}</p>
                            </div>
                            <p class="text-sm leading-16 tracking-03 opacity-60">{{ $subscribePackage->duration/31 }} Month - All Benefits Included</p>
                        </div>
                    </div>
                    <div class="group flex items-center justify-between">
                        <p class="flex w-[162px] shrink-0 font-['ClashDisplay-SemiBold'] leading-19 tracking-05">Subtotal
                        </p>
                        <p class="leading-19 tracking-05">Rp {{ number_format($booking['subTotal'], 0, ',', '.') }}</p>
                    </div>
                    <div class="group flex items-center justify-between">
                        <p class="flex w-[162px] shrink-0 font-['ClashDisplay-SemiBold'] leading-19 tracking-05">Total PPN
                        </p>
                        <p class="leading-19 tracking-05">Rp {{ number_format($booking['total_ppn'], 0, ',', '.') }}</p>
                    </div>
                    <div class="group flex items-center justify-between">
                        <p class="flex w-[162px] shrink-0 font-['ClashDisplay-SemiBold'] leading-19 tracking-05">Promo Code
                        </p>
                        <p class="leading-19 tracking-05 text-[#EC0307]">-Rp 0</p>
                    </div>
                    <hr class="border-black border-dashed">
                    <div class=" w-full flex justify-between items-center rounded-2xl py-4 px-8 bg-[#D0EEFF]">
                        <p class="font-['ClashDisplay-SemiBold'] text-xl leading-[34px] tracking-05">Total Payment</p>
                        <p class="font-['ClashDisplay-SemiBold'] text-xl leading-[34px] tracking-05 text-right">Rp{{ number_format($booking['total_amount'], 0, ',', '.') }}
                        </p>
                    </div>
            </div>
            <div class="flex w-full aspect-[820/209]">
                <img src="{{ asset('assets/images/thumbnails/banner.png') }}" class="w-full h-full object-contain"
                    alt="banner">
            </div>
        </div>
        <div class="flex flex-col gap-6 w-full">
            <div class="flex flex-col w-full rounded-3xl p-8 gap-6 bg-white">
                <div class="flex flex-col gap-2">
                    <p class="font-['ClashDisplay-SemiBold'] text-xl leading-6 tracking-05">Transfer to</p>
                    <p class="text-sm leading-16 tracking-03 opacity-60">Select one of the two banks below</p>
                </div>
                <div class="flex items-center gap-4">
                    <img src="{{ asset('assets/images/logos/BCA.svg') }}" class="w-12 flex shrink-0" alt="logo">
                    <div class="flex flex-col gap-2">
                        <p class="font-['ClashDisplay-SemiBold'] leading-19 tracking-05">Fitnesia Corporation</p>
                        <p class="leading-19">129405960495</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <img src="{{ asset('assets/images/logos/MANDIRI.svg') }}" class="w-12 flex shrink-0" alt="logo">
                    <div class="flex flex-col gap-2">
                        <p class="font-['ClashDisplay-SemiBold'] leading-19 tracking-05">Fitnesia Corporation</p>
                        <p class="leading-19">129405960495</p>
                    </div>
                </div>
                <hr class="border-black opacity-10">
                <label id="upload-proof" class="flex flex-col gap-1 font-['Poppins']">
                    <p class="font-semibold text-fitcamp-black">Transfer Proof</p>
                    <div class="relative w-full rounded-xl border border-[#BFBFBF] py-4 px-3 bg-white">
                        <p id="file-name" class="text-sm leading-[22px] tracking-03 text-[#BFBFBF]">Upload transfer proof
                        </p>
                        <input type="file" id="file-input" name="proof" class="absolute top-0 -z-10">
                    </div>
                </label>
                <button type="submit"
                    class="rounded-full py-3 px-6 bg-[#606DE5] font-semibold leading-19 tracking-05 text-white text-center">Confirm</button>
            </div>
        </div>
    </form>
    <x-footer />
@endsection

@push('after-script')
    <script src="{{ asset('js/file-input.js') }}"></script>
@endpush
