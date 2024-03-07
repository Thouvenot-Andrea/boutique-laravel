@extends('layouts.app')

@section('content')
    @include('header')

    <section class="justify-center">
        <h3 class="text-center mb-3"> {{$product->name}}</h3>
        <div class="flex flex-wrap justify-center ">
            <div>
                <img class=" min-w-[250px] max-w-[250px] mr-15" src="{{$product->picture}}">
            </div>
            <div class="text-center m-8">
                <p class="max-w-[350px]">{{$product->description}}</p>
            </div>
        </div>
        <div >
            <div>
                <p class="text-red-600 text-center ">{{$product->TTC_price}} €</p>
            </div>
            <div class="flex flex-row justify-center ">
                <div class="">
                    <div class="flex items-center my-2">
                        <span class="mr-30">Quantité:</span>
                        <input id="quantityInput" type="number" value="1"
                               class="px-2 py-1 w-16 bg-gray-100 text-center focus:outline-none">
                    </div>
                </div>
                <div class="">
                    <button class="btn ">Ajouter au panier</button>
                </div>
            </div>
        </div>
    </section>

    @include('sidebar')
    <div class="flex flex-col space-y-10 md:space-y-16 ">
        <h2 class="font-bold  text-3xl text-center underline decoration-orange-400">Accessoires</h2>
        <h2 class="text-center uppercase font-bold">Des musiciens ont acheté en même temps ces références, vous en avez
            sûrement besoin</h2>
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
                                {{$recommendation->recommendedProduct->name}}</h1>
                            <h2>{{$recommendation->recommendedProduct->description}}</h2>
                            <h3 class="text-center">{{number_format($recommendation->recommendedProduct->TTC_price/100, 2)}}
                                €</h3>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
    <div class="flex flex-col space-y-100 md:space-y-10 my-10 ">
        <h2 class="font-bold  text-3xl text-center underline decoration-orange-400">Commentaires</h2>
        <div>
            <h3 class="flex flex-wrap space-x-2  justify-center text-2xl">{{ $averageRating }}/5</h3>
            <div class="flex flex-wrap space-x-2  justify-center ">

                @foreach ($comments as $comment)
                    <article>
                        <div class="max-w-[390px]  bg-orange-400 text-center rounded-lg m-5 ">
                            <h3>{{$comment->content}}</h3>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
    @include('footer')
@endsection
