<x-app-layout>

    <section class="justify-center">
        <h3 class="text-center mb-3 text-5xl mt-10"> {{$product->name}}</h3>

        <div class="flex flex-wrap justify-center m-10">

            <div class="flex flex-wrap justify-evenly">

                <div>
                    <img class=" min-w-[250px] max-w-[250px] mr-15" src="{{$product->picture}}" alt="product picture">
                </div>
                <div class="text-center m-8">
                    <p class="max-w-[350px]">{{$product->description}}</p>
                </div>
            </div>

            <form class="flex flex-row justify-evenly" method="post" action="{{ route('cart.add') }}">
                @csrf
                <div>
                    <p class="text-red-600">{{number_format($product->TTC_price, 2)}} €</p>
                </div>
                <div class="flex items-center">
                    <span class="mr-2">Quantité:</span>
                    <input name="product_id" type="hidden" value="{{$product->id}}" class="hidden">
                    <label for="quantityInput"></label>
                    <input id="quantityInput" name="quantity" type="number" value="1"
                                                              class="px-2 py-1 w-16 bg-gray-100 text-center focus:outline-none">
                </div>
                <div class="flex items-center">
                    <input type="submit" class="btn" value="Ajouter au panier">
                </div>
            </form>

            <form action="{{ route('wishlist.store') }}" method="post">
                @csrf
                <input type="hidden" name="product_id" value="{{$product->id}}">
{{--                Heart svg--}}
                <button type="submit" class="btn">
                <img src="{{asset('images/heart.svg')}}" alt="heart">
                </button>
            </form>

        </div>


    </section>
    @if($recommendations)
    <div class="flex flex-col space-y-10 md:space-y-16 ">
        <h2 class="font-bold  text-3xl text-center underline decoration-orange-400">Accessoires</h2>
        <h2 class="text-center uppercase font-bold">Des musiciens ont acheté en même temps ces références, vous en
            avez
            sûrement besoin</h2>
        <div class="flex flex-col space-y-10 md:space-y-16 ">
            <div class="flex flex-wrap space-x-2 justify-center my-10">
                @foreach ($recommendations as $recommendation)
                    <article>
                        <div>
                            <img class="object-cover h-[300px] min-w-[290px] max-w-full]"
                                 src="{{$recommendation->recommendedProduct->picture}}" alt="recommended picture">
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
    @endif
    @if($comments && $averageRating)
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
    @endif
</x-app-layout>

