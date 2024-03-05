<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>
<body>
<h1 class="text-3xl font-bold underline"></h1>
<main>
    {{--        <div class="flex flex-col space-y-10 md:space-y-16 ">--}}
    <div class="flex flex-row space-x-2 justify-center">
        @foreach($products as $product )
            <article>
                <div>
                    <img class="object-cover h-[300px] min-w-[290px] max-w-full]" src="{{$product->picture}}">
                </div>
                <div class="max-w-[390px]">
                    <h1 class="text-center text-blue-700">Titre: {{$product->name}}</h1>
                    <h3 class="text-center">  {{$product->TTC_price}} €</h3>
                    @foreach($comments as $comment)
                        <h3>{{$comment->rating}}</h3>
                    @endforeach
                </div>
            </article>
        @endforeach
        {
        {{--            {{$products->links()}}--}}

    </div>

</main>


</body>
</html>
