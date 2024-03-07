@extends('layouts.app')

@section('content')
    @include('header')
    @include('sidebar')
    <div class="flex flex-col space-y-10 md:space-y-16 ">
        <h2 class="font-bold  text-3xl text-center underline decoration-orange-400">Accessoires</h2>
        <h2 class="text-center uppercase font-bold">Des musiciens ont acheté en même temps ces références, vous en avez sûrement besoin</h2>
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
