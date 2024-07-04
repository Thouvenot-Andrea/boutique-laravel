<nav class="bg-black  z-50">
    <div class="px-4">
        <div class="flex justify-between items-center mx-20">
            <div class="flex">
                <button id="toggleSidebar" class="text-white focus:outline-none focus:text-white">
                    <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
                        <path id="menuIcon" fill-rule="evenodd" clip-rule="evenodd"
                              d="M4 6h16v2H4V6zm0 5h16v2H4v-2zm0 5h16v2H4v-2z"/>
                    </svg>
                </button>
            </div>
            <div class="">
                <a href="{{ route('home') }}" class="text-white text-lg font-semibold ">
                    <img src="{{ asset('images/logo.svg') }}" alt="Bio" class=" w-36 md:w-44 h-auto py-2">
                </a>
            </div>
            <div class="hidden items-center md:flex">
                <form class="relative flex items-center" method="get" action="{{route('search')}}">
                    <input
                        type="text"
                        name="search"
                        placeholder="Find your Tempo"
                        class="w-64 h-8 py-2 px-4 rounded-full border-2 focus:outline-none focus:border-blue-500 transition-all duration-300 transform focus:scale-110"
                    />
                    <button type="submit" class="absolute right-0 mr-3">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-6 h-6 text-gray-400"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"
                            />
                        </svg>
                    </button>
                </form>
            </div>
            <div class="flex space-x-4 border-2 p-2 my-4 items-center">
                <a href="{{ route('profile.edit') }}" class="text-white hover:text-gray-300">
                    @auth
                        <img src="{{ asset('images/user-checked.svg') }}" alt="" class="w-7">
                    @else
                        <img src="{{ asset('images/user.svg') }}" alt="">
                    @endauth
                </a>
                <a href="{{ url('/wishlist') }}" class="text-white hover:text-gray-300">
                    <img src="{{ asset('images/heart.svg') }}" alt="">
                </a>
                <a href="{{ route('cart.index') }}" class="text-white hover:text-gray-300 relative">
                    @php($nbProducts = \App\Http\Controllers\CartController::totalProductsCount())
                    <div>
                        <button type="button"
                                class="relative flex"
                                id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <span class="sr-only">Ouvre ton panier</span>
                            @if(isset($nbProducts) && $nbProducts != 0)
                                <span
                                    class="absolute text-xs text-white -top-2 -right-2 px-2 py-1 bg-red-600 rounded-full">{{ $nbProducts > 99 ? '99+' : $nbProducts }}</span>
                            @endif
                            <img class="" src="{{asset('images/cart.svg')}}" alt="">
                        </button>
                    </div>
                </a>
                @auth
                    <form method="POST" action="{{ route('logout') }}" class="w-7 flex">
                        @csrf
                        <button type="submit"><img src="{{ asset('images/logout.svg') }}" alt=""></button>
                    </form>
                @endauth
            </div>
        </div>
    </div>

</nav>




