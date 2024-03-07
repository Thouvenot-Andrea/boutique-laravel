@extends('layouts.app')
<style>
    @layer utilities {
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    }
</style>
@section('content')

    @include('header')
    <div class="md:h-screen bg-gray-100 pt-20">
        @if(isset($productsWithQuantities))
            <div class="">
                <h1 class="mb-10 text-center text-2xl font-bold">Cart Items</h1>
                <div class=" px-6 md:flex md:space-x-6 xl:px-5 mx-20">
                    <div class="flex flex-col w-full">
                        @foreach($productsWithQuantities as $id => $quantity)
                            @php($product = \App\Models\Product::find($id))
                            <div class="rounded-lg mb-6 bg-white p-6 shadow-md flex flex-col md:flex-row items-center">
                                <a href="{{route('product.show', $product->slug)}}"> <img src="{{ $product->picture }}" alt="product-image" class="w-full rounded-lg sm:w-40"/></a>
                                <div class="ml-4 flex-grow">
                                    <h2 class="text-lg font-bold text-gray-900">{{ $product->name }}</h2>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-xs text-gray-700 w-2/3">{{ $product->description }}</p>

                                    </div>
                                </div>
                                <div class="flex flex-col">
                                    <form class="flex items-center border-gray-100" method="post" action="{{ route('cart.update') }}">
                                        @csrf
                                        <input type="submit" value="-" id="decrement[{{$product->id}}]" class="cursor-pointer rounded-l bg-gray-100 py-1 px-3.5 duration-100 hover:bg-primary hover:text-blue-50"/>
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input id="quantityInput[{{$product->id}}]" name="quantity" class="h-8 w-8 border bg-white text-center text-xs outline-none" type="number" value="{{ $quantity }}" min="1"/>
                                        <input type="submit" value="+" id="increment[{{$product->id}}]" class="cursor-pointer rounded-r bg-gray-100 py-1 px-3 duration-100 hover:bg-primary hover:text-blue-50"/>
                                    </form>
                                    <div class="flex">
                                        <p class="text-sm">{{ number_format($product->TTC_price/100, 2) }}€  x {{ $quantity }} : {{ number_format(($product->TTC_price * $quantity)/100, 2) }} €</p>
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 cursor-pointer duration-150 hover:text-red-500">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>


                            </div>
                        @endforeach
                    </div>

                    <!-- Sub total -->
                    <div class="my-6  rounded-lg border bg-white p-6 shadow-md md:mt-0 md:w-1/3">
                        <div class="mb-2 flex justify-between">
                            <p class="text-gray-700">Subtotal</p>
                            <p class="text-gray-700">{{ number_format($total/100, 2) }}€</p>
                        </div>
                        <hr class="my-4"/>
                        <div class="flex justify-between items-center">
                            <p class="text-lg font-bold">Total</p>
                            <div class="">
                                <p class="mb-1 text-lg font-bold">{{ number_format($total/100, 2) }} EUR</p>
                                <p class="text-sm text-gray-700">including VAT</p>
                            </div>
                        </div>
                        <button class="mt-6 w-full rounded-md bg-primary py-1.5 font-medium text-blue-50 hover:bg-accent">Checkout</button>
                    </div>
                </div>
            </div>
        @else
            <div class="h-screen bg-gray-100 pt-20 flex justify-center">
                <h1 class="mb-10 text-center text-2xl font-bold">Cart is empty</h1>
            </div>
        @endif
    </div>
    @include('footer')
    <script>
        @if(isset($productsWithQuantities))
        @foreach($productsWithQuantities as $id => $quantity)
        document.getElementById('increment[{{$id}}]').addEventListener('click', function () {
            document.getElementById('quantityInput[{{$id}}]').value = parseInt(document.getElementById('quantityInput[{{$id}}]').value) + 1;
        });
        document.getElementById('decrement[{{$id}}]').addEventListener('click', function () {
            if (parseInt(document.getElementById('quantityInput[{{$id}}]').value) > 1) {
                document.getElementById('quantityInput[{{$id}}]').value = parseInt(document.getElementById('quantityInput[{{$id}}]').value) - 1;
            }
        });
        @endforeach
        @endif
    </script>
@endsection
