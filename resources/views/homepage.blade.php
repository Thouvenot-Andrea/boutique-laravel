
@extends('layouts.app')


@section('content')
    @include('header')


    <div class="md:flex">
        @include('sidebar')

        <div class="md:w-3/4 mx-auto p-8">
            <h1 class="text-3xl text-center font-bold mb-10">
                Bienvenue chez Tempo !
            </h1>
            <div class="categories">
                <div class="text-3xl text-center mb-10">
                    <h2>Catégories</h2>
                </div>
                <div class="flex flex-wrap justify-center">
                    @foreach($categories as $category)
                        <div>
                            <div class="mx-3 w-44">
                                <img src='{{$category->image}}'>
                            </div>
                            <div class="text-center mt-5 mb-5">
                                <h3>{{ $category->name }}</h3>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col space-y-10 md:space-y-16">
        <div class="flex flex-wrap space-x-2 justify-center">
            @foreach($products as $product)
                <article>
                    <div>
                        <a href="{{route('product', $product->id)}}"> <img
                                class="object-cover h-[300px] min-w-[290px] max-w-full]"
                                src="{{$product->picture}}"></a>
                    </div>
                    <div class="max-w-[390px]">

                        <a href="{{ url('/products/' . $product->id) }}"><h1 class="text-center text-blue-700">Titre: {{$product->name}}</h1></a>
                        <h3 class="text-center">  {{$product->TTC_price}} €</h3>

                        <h1 class="text-center text-blue-700">Titre: {{$product->name}}</h1>
                        <h3 class="text-center">  {{number_format($product->TTC_price/100, 2)}} €</h3>

                        <h3 class="text-center">{{$product->averageRating}} / 5</h3>
                    </div>
                </article>

            @endforeach
        </div>
    </div>
    @include('footer')
@endsection


