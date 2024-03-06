@extends('layouts.app')

@section('content')
    @include('header')

    <div class="md:flex">
        @include('sidebar')

        <div class="md:w-3/4 mx-auto p-8">
            <!-- Main Content -->
        </div>
    </div>
@endsection
