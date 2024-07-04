<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __("Modification d'un produit") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center">
                    {{ __("Tu as fait une erreur Boss ?") }}
                </div>
            </div>
        </div>
    </div>
    <!--Mettre à jour un produit-->
    <form method="POST" action="{{ route('products.update', $product->id) }}" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @csrf
        @method('PATCH')
        <!-- picture -->
        <div class="flex ml-36 mb-5">
            <x-input-label for="picture" :value="__('Image *')"/>
            <x-text-input id="picture" class="block mt-1 w-80" type="file" name="picture"  accept="image/*" required />
            <x-input-error :messages="$errors->get('picture')" class="mt-2"/>
        </div>

        <!-- name -->
        <div class="flex ml-36 mb-5">
            <x-input-label for="name" :value="__('Name *')"/>
            <x-text-input id="name" class="block mt-1 w-80" type="name" name="name" required :value="$product->name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2"/>
        </div>

        <!-- Description -->
        <div class="flex justify-center mt-4 mb-5">
            <x-input-label for="description" :value="__('Description *')"/>
            <textarea id="description" class="block mt-1 w-3/4" type="description" name="description"
                      required>{{ $product->description}}</textarea>
            <x-input-error :messages="$errors->get('description')" class="mt-2"/>
        </div>
        <div class="flex flex-wrap ml-36 mb-5">
            <!-- weight -->
            <div class="mr-3">
                <x-input-label for="weight" :value="__('Poids (kg) *')"/>
                <x-text-input id="weight" class="block mt-1 w-60" type="weight" name="weight" :value="$product->weight"
                              required/>
                <x-input-error :messages="$errors->get('weight')" class="mt-2"/>
            </div>

            <!-- stock -->
            <div class="mr-3">
                <x-input-label for="stock" :value="__('Stock Quantité *')"/>
                <x-text-input id="stock" class="block mt-1 w-60" type="stock" name="stock" :value="$product->stock"
                              required/>
                <x-input-error :messages="$errors->get('stock')" class="mt-2"/>
            </div>

            <!-- HT_price -->
            <div class="mr-3">
                <x-input-label for="HT_price" :value="__('Prix HT (€) *')"/>
                <x-text-input id="HT_price" class="block mt-1 w-60" type="HT_price" name="HT_price"
                              :value="$product->HT_price" required/>
                <x-input-error :messages="$errors->get('HT-price')" class="mt-2"/>
            </div>

            <!-- VAT -->
            <div class="mr-3">
                <x-input-label for="VAT" :value="__('Taux de TVA (%) *')"/>
                <x-text-input id="VAT" class="block mt-1 w-60" type="VAT" name="VAT" :value="$product->VAT" required/>
                <x-input-error :messages="$errors->get('VAT')" class="mt-2"/>
            </div>
        </div>
        <!-- Categorie -->
        <div class="flex ml-36">
            <x-input-label for="Category" :value="__('Catégorie *')"/>
            <select id="Category" class="block mt-1 w-80" name="category_id" required>
                <option value="">Sélectionnez une catégorie</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->id }} - {{ $category->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('Category')" class="mt-2"/>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3">
                {{ __('Mettre à jour') }}
            </x-primary-button>
        </div>
    </form>
</x-app-layout>

