@extends('layouts.app')

@section('content')
    @include('header')
    <section class="justify-center">
        <h3 class="text-center mb-3"> {{$product->name}}, {{$product->id}}</h3>
        <div class="flex flex-wrap justify-evenly">
            <div>
                <img class=" min-w-[250px] max-w-[250px] mr-5" src="{{$product->picture}}">
            </div>
            <div class="text-center">
                <p class="max-w-[350px]">{{$product->description}}</p>
            </div>
        </div>
        <div class="flex flex-row justify-evenly">
            <div>
                <p class="text-red-600">{{$product->TTC_price}} €</p>
            </div>
            <div>
                <div class="flex items-center">
                    <span class="mr-2">Quantité:</span>
                    <button id="decreaseBtn"
                            class="px-3 py-1 bg-gray-200 text-gray-700 rounded-l focus:outline-none">-
                    </button>
                    <input id="quantityInput" type="text" value="1"
                           class="px-2 py-1 w-16 bg-gray-100 text-center focus:outline-none" readonly>
                    <button id="increaseBtn"
                            class="px-3 py-1 bg-gray-200 text-gray-700 rounded-r focus:outline-none">+
                    </button>
                </div>
            </div>
            <div>
                <button class="btn">Ajouter au panier</button>
            </div>
        </div>
    </section>
@endsection
