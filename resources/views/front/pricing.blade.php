@extends('layouts.app')

@section('title')
@endsection

@section('content')
    <x-nav />
    <main id="content"
        class="relative flex w-full max-w-[1312px] min-h-[970px] h-fit mx-auto mt-[120px] rounded-[32px] bg-[#606DE5] overflow-hidden">
        <img src="assets/images/backgrounds/Illustration BG.svg" class="absolute w-full h-full object-cover" alt="background">
        <div class="relative flex flex-col w-full items-center">
            <div class="flex flex-col gap-4 text-center mx-auto mt-12">
                <h2 class="font-['ClashDisplay-SemiBold'] text-5xl leading-[59px] tracking-05">Subscribe Package</h2>
                <p class="leading-19 tracking-03 opacity-60">Find the perfect plan, explore our subscription packages.
                    Discover the Best Package for You!</p>
            </div>
            <div class="flex gap-8 max-w-[1132px] mx-auto mt-20 mb-[124px]">
                @forelse ($subscribePackages as $subscribePackage)
                    <div class="card flex flex-col w-[356px] rounded-3xl p-8 gap-6 bg-white">
                        <div class="flex w-full h-[200px] rounded-3xl overflow-hidden bg-[#606DE5]">
                            <img src="assets/images/thumbnails/Regular-plan.png" class="w-full h-full object-cover"
                                alt="icon">
                        </div>
                        <div class="flex flex-col gap-2">
                            <p class="font-['ClashDisplay-SemiBold'] leading-19 tracking-05">{{$subscribePackage->name}}</p>
                            <p class="text-sm leading-16 tracking-05 opacity-50">Enjoy all subscribe package benefits</p>
                        </div>
                        @foreach ($subscribePackage->subscribeBenefits as $subscribeBenefit)
                        <div class="flex items-center gap-4">
                            <img src="assets/images/icons/tick-circle.svg" class="w-8 h-8 flex shrink-0" alt="icon">
                            <p class="leading-19 tracking-05">{{$subscribeBenefit->name}}</p>
                        </div>
                        @endforeach
                        <div class="flex items-center justify-between mt-auto">
                            <a href="{{route('front.booking', $subscribePackage->id)}}"
                                class="w-fit rounded-full py-3 px-6 bg-[#606DE5] font-semibold leading-19 tracking-05 text-white text-center">Subscribe</a>
                            <p class="text-right font-semibold leading-19 tracking-05">
                                Rp. {{ number_format($subscribePackage->price, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                @empty
                <p>Belum ada package</p>
                @endforelse
            </div>
        </div>
    </main>
    <x-footer/>
@endsection
