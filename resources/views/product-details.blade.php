
@extends('layouts.app')

@section('content')
    @include('header')
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
@endsection
