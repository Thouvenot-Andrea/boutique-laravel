<x-app-layout>
        @foreach($orders as $order)
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Historique des commandes') }}
            </h2>
        </x-slot>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl flex items-center justify-around">
                        <img src="{{$order->orderLines->first()->picture}}" class="w-10 h-10">
                       <p>Total : {{$order->total}} € </p>
                        <p>Status : {{$order->status}} </p>
                    </div>
                </div>

            </div>
        </div>
    @endforeach
</x-app-layout>

