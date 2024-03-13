<x-app-layout>
    <div class="flex justify-around my-20 items-center">
        @include ('auth.login')
        <div style="border-left: 6px solid black; height: 500px"></div>
        @include ('auth.register')
    </div>
    <div class="flex justify-center">
        <img src="{{asset('images/ads/ad-skull.png')}}" alt="skullAd" class="w-full hidden md:flex">
        <img src="{{asset('images/ads/mobile/ad-skull.png')}}" alt="skullAd" class="w-full block md:hidden">
    </div>
</x-app-layout>
