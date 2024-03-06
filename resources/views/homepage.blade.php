
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
                            <div class="mx-3">
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
@endsection

