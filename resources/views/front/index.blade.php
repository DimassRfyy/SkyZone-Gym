@extends('layouts.app')

@section('title')
    Fitcamp Community
@endsection

@section('content')
    <header class="relative flex flex-col w-full h-[1044px] overflow-hidden -mb-[140px]">
        <img src="{{ asset('assets/images/backgrounds/Header Illustration.svg') }}"
            class="absolute w-full h-full object-cover" alt="backgrounds">
        <x-nav />
        <div id="hero-text" class="relative flex flex-col items-center mx-auto mt-[96px]">
            <div class="flex items-center w-fit rounded-[38px] p-2 pr-6 gap-3 bg-fitcamp-black">
                <img src="{{ asset('assets/images/photos/triple-photo.png') }}" class="flex shrink-0 w-[88px] h-10"
                    alt="photos">
                <p class="leading-19 text-white">Over <span class="font-semibold">100K+</span> Member Joined</p>
            </div>
            <h1 class="font-['ClashDisplay-Bold'] text-[78px] text-white mt-4">Prioritize Your Health</h1>
            <p class="leading-19 text-white">Transform Your Life by Investing in Your Wellness</p>
            <form action="#" class="flex items-center w-[487px] rounded-[53px] p-2 pl-6 gap-6 bg-white mt-[38px]">
                <input type="text" name="" id=""
                    class="appearance-none outline-none !bg-white w-full leading-19 font-semibold placeholder:text-[#3F3F3F80]"
                    placeholder="Search gym location, city nearby...">
                <button type="submit"
                    class="rounded-[48px] py-4 px-6 bg-fitcamp-black font-semibold leading-19 text-white">Search</button>
            </form>
        </div>
    </header>
    <section id="features" class="relative w-full max-w-[1280px] h-[280px] mx-auto px-10">
        <div
            class="flex items-center justify-center w-full rounded-3xl p-10 gap-16 bg-white shadow-[8px_12px_28px_0_#0000000D]">
            <div class="flex flex-col items-center w-[282px] gap-4 text-center">
                <img src="{{ asset('assets/images/icons/Located.svg') }}" class="w-[72px] h-[72px] flex shrink-0"
                    alt="icon">
                <h3 class="font-['ClashDisplay-SemiBold'] text-xl leading-6 tracking-05">Find Nearby Location</h3>
                <p class="tracking-03">Find the nearby gym that <br>
                    near your location to transform your <br>
                    healthy journey.</p>
            </div>
            <div class="flex flex-col items-center w-[282px] gap-4 text-center">
                <img src="{{ asset('assets/images/icons/coupon-dollar.svg') }}" class="w-[72px] h-[72px] flex shrink-0"
                    alt="icon">
                <h3 class="font-['ClashDisplay-SemiBold'] text-xl leading-6 tracking-05">Become Membership</h3>
                <p class="tracking-03">Access to all fitcamp gym <br>
                    and become part of our exclusive <br>
                    healty community. </p>
            </div>
            <div class="flex flex-col items-center w-[282px] gap-4 text-center">
                <img src="{{ asset('assets/images/icons/Muscle.svg') }}" class="w-[72px] h-[72px] flex shrink-0"
                    alt="icon">
                <h3 class="font-['ClashDisplay-SemiBold'] text-xl leading-6 tracking-05">Maintain the Body</h3>
                <p class="tracking-03">Ensure long-term wellness <br>
                    with effective healty body <br>
                    maintenance strategies</p>
            </div>
        </div>
    </section>
    <section id="location" class="flex flex-col w-full max-w-[1280px] gap-8 mx-auto px-10 mt-[120px]">
        <div class="flex items-center justify-between">
            <div class="flex flex-col gap-4">
                <h2 class="font-['ClashDisplay-SemiBold'] text-5xl leading-[59px] tracking-05">Gym Location</h2>
                <p class="leading-19 tracking-03 opacity-60">Find the nearby gym that near your location to transform your
                    healthy journey</p>
            </div>
        </div>
        <div class="flex items-center gap-4 flex-wrap">
            @forelse ($cities as $city)
                <a href="{{ route('front.city', $city->slug) }}">
                    <div class="flex items-center rounded-full p-3 pr-6 gap-3 bg-white">
                        <div class="w-10 h-10 flex shrink-0 rounded-full overflow-hidden">
                            <img src="{{ Storage::url($city->photo) }}" class="w-full h-full object-cover" alt="icon">
                        </div>
                        <span class="leading-19 tracking-03">{{ $city->name }}</span>
                    </div>
                </a>
            @empty
                <p>Belum ada data terbaru</p>
            @endforelse
        </div>
    </section>
    <section id="latest" class="flex flex-col w-full max-w-[1280px] gap-8 mx-auto px-10 mt-[120px]">
        <div class="flex items-center justify-between">
            <div class="flex flex-col gap-4">
                <h2 class="font-['ClashDisplay-SemiBold'] text-5xl leading-[59px] tracking-05">Latest Added</h2>
                <p class="leading-19 tracking-03 opacity-60">New gyms added from around the city with variety facilities
                    available</p>
            </div>
            <a href="#" class="w-fit rounded-full py-4 px-6 bg-fitcamp-black text-white">
                See All
            </a>
        </div>
        <div class="grid grid-cols-3 gap-6">
            @forelse ($newGyms as $gym)
                <a href="{{ route('front.details', $gym->slug) }}" class="card">
                    <div class="flex flex-col rounded-3xl p-8 gap-6 bg-white">
                        <div class="title flex flex-col gap-2">
                            <h3 class="font-['ClashDisplay-SemiBold'] leading-19 tracking-05">{{ $gym->name }}
                            </h3>
                            <div class="flex items-center gap-1">
                                <img src="{{ asset('assets/images/icons/location.svg') }}" class="flex shrink-0"
                                    alt="icon">
                                <p class="text-sm leading-19 tracking-03 opacity-50">{{ $gym->city->name }}</p>
                            </div>
                        </div>
                        <div class="thumbnail flex rounded-3xl h-[200px] bg-[#06425E] overflow-hidden">
                            <img src="{{ Storage::url($gym->thumbnail) }}" class="w-full h-full object-cover"
                                alt="thumbnail">
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="font-['ClashDisplay-SemiBold']">Facilities</p>
                            <button class="font-semibold text-xs leading-14 tracking-05 text-fitcamp-royal-blue">View
                                all</button>
                        </div>
                        <div class="grid grid-cols-3 justify-between gap-3">
                            @forelse ($gym->gymFacilities->take(3) as $gymFacility)
                                <div class="flex flex-col gap-3 items-center text-center">
                                    <img src="{{ Storage::url($gymFacility->facility->thumbnail) }}" class="w-10 h-10"
                                        alt="icon">
                                    <div class="flex flex-col gap-1">
                                        <p class="font-semibold text-sm leading-16 tracking-05">
                                            {{ $gymFacility->facility->name }}</p>
                                        <p class="opacity-50 text-sm leading-16 tracking-05">
                                            {{ $gymFacility->facility->about }}</p>
                                    </div>
                                </div>
                            @empty
                                <p>Belum ada data facilities</p>
                            @endforelse
                        </div>
                        <hr class="border-black/10">
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('assets/images/icons/Daily Time.svg') }}" class="w-10 h-10" alt="icon">
                            <div class="flex flex-col gap-2">
                                <p class="font-['ClashDisplay-SemiBold'] text-sm leading-17 tracking-05">Opening Work</p>
                                <p class="text-xs leading-14 tracking-05 opacity-50">
                                    {{ $gym->open_time_at->format('h:i A') }} -
                                    {{ $gym->closed_time_at->format('h:i P') }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
            @endforelse
        </div>
    </section>
    <section id="testi" class="flex flex-col gap-8 mt-[120px]">
        <div class="flex items-center justify-between w-full max-w-[1280px] mx-auto px-10 ">
            <div class="flex flex-col gap-4">
                <h2 class="font-['ClashDisplay-SemiBold'] text-5xl leading-[59px] tracking-05">Joined 10.000+ User <br>with
                    Happy Story</h2>
            </div>
            <a href="#" class="w-fit rounded-full py-4 px-6 bg-fitcamp-black text-white">
                See All
            </a>
        </div>
        <div class="swiper w-full">
            <div class="swiper-wrapper">
                @foreach ($newGyms as $gym)
                    @foreach ($gym->gymTestimonials as $gymTestimonial)
                        <div class="swiper-slide w-full">
                            <div
                                class="flex flex-col items-center w-full max-w-[1069px] rounded-[32px] py-[56px] px-[72px] gap-12 mx-auto bg-white">
                                <p class="text-[32px] tracking-05 text-center">
                                    {{ $gymTestimonial->message }}
                                </p>
                                <div class="flex items-center gap-3 w-fit">
                                    <div class="w-16 h-16 rounded-full overflow-hidden">
                                        <img src="{{ Storage::url($gymTestimonial->photo) }}"
                                            class="w-full h-full object-cover" alt="photos">
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <p class="font-['ClashDisplay-SemiBold'] text-2xl leading-[29.52px] tracking-05">
                                            {{ $gymTestimonial->name }}</p>
                                        <p class="text-xl leading-6 tracking-05 opacity-50">
                                            {{ $gymTestimonial->occupation }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
            <div class="swiper-pagination !relative flex items-center justify-center gap-4 mt-[50px] h-[70px]"></div>
        </div>
    </section>
    <section id="benefits" class="flex flex-col w-full max-w-[1280px] gap-8 mx-auto px-10 mt-[120px]">
        <div class="flex items-center justify-between">
            <div class="flex flex-col gap-4 text-center mx-auto">
                <h2 class="font-['ClashDisplay-SemiBold'] text-5xl leading-[59px] tracking-05">Unlock All the Membership
                    Benefits</h2>
                <p class="leading-19 tracking-03 opacity-60">Experience full access to premium features, services, and
                    facilities</p>
            </div>
        </div>
        <div class="w-[1060px] mx-auto grid grid-cols-3 gap-20 mt-20">
            <div class="flex flex-col items-center text-center gap-4">
                <img src="{{ asset('assets/images/icons/Flexible Time.svg') }}" class="w-[120px] h-[120px]"
                    alt="icon">
                <h3 class="font-['ClashDisplay-SemiBold'] text-xl leading-6 tracking-05">Flexible Time</h3>
                <p class="tracking-03">Your schedule, your workout. <br>
                    flexibility that fits your life, <br>
                    no time limits</p>
            </div>
            <div class="flex flex-col items-center text-center gap-4">
                <img src="{{ asset('assets/images/icons/Work From Anywhere.svg') }}" class="w-[120px] h-[120px]"
                    alt="icon">
                <h3 class="font-['ClashDisplay-SemiBold'] text-xl leading-6 tracking-05">Workout From Anywhere</h3>
                <p class="tracking-03">Stay fit wherever you are. <br>
                    All locations, one membership, <br>
                    workout is just a click away</p>
            </div>
            <div class="flex flex-col items-center text-center gap-4">
                <img src="{{ asset('assets/images/icons/Expert Trainer.svg') }}" class="w-[120px] h-[120px]"
                    alt="icon">
                <h3 class="font-['ClashDisplay-SemiBold'] text-xl leading-6 tracking-05">Expert Trainer</h3>
                <p class="tracking-03">Unlock your potential with <br>
                    professional coaching, without <br>
                    any additional charge</p>
            </div>
            <div class="flex flex-col items-center text-center gap-4">
                <img src="{{ asset('assets/images/icons/Schedule.svg') }}" class="w-[120px] h-[120px]" alt="icon">
                <h3 class="font-['ClashDisplay-SemiBold'] text-xl leading-6 tracking-05">Well Planned Schedule</h3>
                <p class="tracking-03">Optimize monthly membership <br>
                    scheduling for consistent progress <br>
                    and results</p>
            </div>
            <div class="flex flex-col items-center text-center gap-4">
                <img src="{{ asset('assets/images/icons/Event.svg') }}" class="w-[120px] h-[120px]" alt="icon">
                <h3 class="font-['ClashDisplay-SemiBold'] text-xl leading-6 tracking-05">Fitness Event</h3>
                <p class="tracking-03">Enjoy fitness event benefit, <br>
                    joined membership get variety <br>
                    free class on every month</p>
            </div>
            <div class="flex flex-col items-center text-center gap-4">
                <img src="{{ asset('assets/images/icons/Enjoy.svg') }}" class="w-[120px] h-[120px]" alt="icon">
                <h3 class="font-['ClashDisplay-SemiBold'] text-xl leading-6 tracking-05">Enjoy All Facilitiese</h3>
                <p class="tracking-03">Experience fitness at It’s finest <br>
                    with our premium facilities. <br>
                    Train with the best</p>
            </div>
        </div>
    </section>
    <x-footer/>
@endsection

@push('after-style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endpush

@push('after-script')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/index.js') }}"></script>
@endpush
