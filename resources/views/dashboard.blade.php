<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __("Création d'un nouveau produit") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center">
                    {{ __("Bonjour Boss !") }}
                </div>
            </div>
        </div>
    </div>

    <div class="container justify-center mb-5" > {{--Affichage du bandeau succès--}}
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
    </div>

<!--Créer un nouveau produit-->
    @include('vendor.form') {{--    formulaire de création--}}

</x-app-layout>
