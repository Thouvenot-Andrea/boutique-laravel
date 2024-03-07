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
                    <input id="quantityInput" type="number" value="1"
                           class="px-2 py-1 w-16 bg-gray-100 text-center focus:outline-none">
                </div>
            </div>
            <div>
                <button class="btn">Ajouter au panier</button>
            </div>
        </div>
    </section>

    @include('sidebar')
    <div class="flex flex-col space-y-10 md:space-y-16 ">
        <h2 class="font-bold  text-3xl text-center">Accessoires</h2>
        <div class="flex flex-col space-y-10 md:space-y-16 ">
            <div class="flex flex-wrap space-x-2 justify-center">
                @foreach ($recommendations as $recommendation)
                    <article>
                        <div>
                            <img class="object-cover h-[300px] min-w-[290px] max-w-full]"
                                 src="{{$recommendation->recommendedProduct->picture}}">
                        </div>
                        <div class="max-w-[390px]">
                            <h1 class="text-center text-blue-700">
                                Titre: {{$recommendation->recommendedProduct->name}}</h1>
                            <h2>{{$recommendation->recommendedProduct->description}}</h2>
                            <h3 class="text-center">{{number_format($recommendation->recommendedProduct->TTC_price/100, 2)}}
                                €</h3>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    @include('footer')
@endsection
