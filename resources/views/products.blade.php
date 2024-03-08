<x-app-layout>
    <h2 class="font-bold  text-4xl text-center underline decoration-orange-400 mt-10">CATELOGUE</h2>
    <div >
        <!-- Bouton de filtrage -->
        <div class="col-span-1">
            <button class="text-2xl m-10" onclick="toggleFilterForm()">Filtrer</button>
        </div>

        <!-- Filtre (initiallement caché) -->
        <div id="filter-form-container"  >
            <form action="{{ url('/products') }}" method="get" >
                <!-- Vos champs de filtrage ici -->
                <div class="mb-5">
                <label for="min_price">Prix minimum :</label>
                <input type="text" name="min_price" id="min_price" value="{{ request('min_price') }}">
                </div>
                <div class="mb-5">
                <label for="max_price">Prix maximum :</label>
                <input type="text" name="max_price" id="max_price" value="{{ request('max_price') }}">
                </div>
                <div  class="mb-5">
                <!-- Ajoutez ces champs pour le filtrage par note -->
                <label for="min_rating">Note minimale :</label>
                <input type="number" name="min_rating" id="min_rating" step="0.1" value="{{ request('min_rating') }}" min="0" max="5">
                </div>
                <button class=" text-center ml-20 rounded border-2 border-orange-500 hover:bg-orange-500 " type="submit">Filtrer</button>
            </form>
        </div>

        <!-- Produits -->
        <div class="flex flex-wrap gap-40 justify-center">
            @foreach($products as $product)
                <article class="flex flex-col w-[400px]">
                    <div>
                        <a href="{{route('product.show', $product->slug)}}">
                            <img class="object-cover h-[300px] min-w-[290px] max-w-full" src="{{$product->picture}}">
                        </a>
                    </div>
                    <div class="max-w-[390px]">
                        <a href="{{ route('product.show', $product->slug) }}">
                            <h1 class="text-center text-blue-700">Titre: {{$product->name}}</h1>
                        </a>
                        <h3 class="text-center">  {{$product->TTC_price}} €</h3>
                        <h3 class="text-center">{{$product->averageRating}} / 5</h3>
                        <div class="{{ $product->stock > 0 ? 'in-stock' : 'out-of-stock' }}">
                            <p class="text-center">{{ $product->stock > 0 ? 'En stock' : 'Pas de stock' }}</p>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
    {{$products->links()}}

</x-app-layout>
<script>
    function toggleFilterForm() {
        var filterFormContainer = document.getElementById('filter-form-container');
        if (filterFormContainer.style.display === 'none') {
            filterFormContainer.style.display = 'block';
        } else {
            filterFormContainer.style.display = 'none';
        }
    }
</script>
