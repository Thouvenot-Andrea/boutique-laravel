<x-app-layout>
    @if ($products->count() >0)
        <div class="flex flex-row justify-center">
            @foreach($products as $product)
                <article>
                    <div>
                        <img class="object-cover h-[300px] min-w-[290px] max-w-full]" src="{{$product->picture}}" alt="product picture">
                    </div>
                    <div class="max-w-[390px]">
                        <h1 class="text-center text-blue-700"> {{$product->name}}</h1>
                    </div>
                    <div class="max-w-[390px]">
                        <p class="text-center text-blue-700"> {{$product->description}}</p>
                    </div>
                </article>
        @endforeach
{{--                    @else--}}
{{--                        <p>Aucun produit trouvé pour "{{ $search }}".</p>--}}

    @endif
</x-app-layout>
