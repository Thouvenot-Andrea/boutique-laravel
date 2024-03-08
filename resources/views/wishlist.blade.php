{{-- Wishlist view with lines of products (variable $products containing all products in wishlist is sent)--}}
<x-app-layout>
    @if($products->count() > 0)
        @auth
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Wishlist') }}
            </h2>
        </x-slot>
        @endauth
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($products as $product)
                    <div class="flex flex-col space-y-10 md:space-y-16 ">
                        <div class="flex flex-wrap space-x-2 justify-center my-10">
                            <article>
                                <div>
                                    <img class="object-cover h-[300px] min-w-[290px] max-w-full]"
                                         src="{{$product->picture}}">
                                </div>
                                <div class="max-w-[390px]">
                                    <h1 class="text-center text-blue-700">
                                        {{$product->name}}</h1>
                                    <h2>{{$product->description}}</h2>
                                    <h3 class="text-center">{{number_format($product->TTC_price/100, 2)}}
                                        €</h3>
                                </div>
                            </article>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="flex flex-col space-y-10 md:space-y-16 ">
                    <div class="flex flex-wrap space-x-2 justify-center my-10">
                        <article>
                            <div>
                                <h1 class="text-center text-blue-700">
                                    Votre liste de souhaits est vide</h1>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
    @endif
</x-app-layout>
