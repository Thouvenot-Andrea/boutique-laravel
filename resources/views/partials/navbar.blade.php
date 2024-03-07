<nav class="bg-black  z-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center">
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
            <div class="flex space-x-4 border-2 p-2 my-4">
                <a href="{{ url('/login') }}" class="text-white hover:text-gray-300">
                    <img src="{{ asset('images/user.svg') }}" alt="">
                </a>
                <a href="{{ url('/wishlist') }}" class="text-white hover:text-gray-300">
                    <img src="{{ asset('images/heart.svg') }}" alt="">
                </a>
                <a href="{{ url('/cart') }}" class="text-white hover:text-gray-300 relative">
                    <div class="relative">
                        <img src="{{ asset('images/cart.svg') }}" alt="">
                        <!-- Badge -->
                        @if(session()->get('cart') && \App\Http\Controllers\CartController::totalProductsCount() != 0)
                        <div class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full py-1 px-2 w-4 h-4 items-center"><p class="absolute top-0 right-1">{{ \App\Http\Controllers\CartController::totalProductsCount() }}</p></div>
                        @endif
                    </div>
                </a>
            </div>
        </div>
    </div>

</nav>




