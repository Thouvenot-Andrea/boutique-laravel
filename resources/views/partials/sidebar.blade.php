@php($categories = \App\Models\Category::all())
<aside id="sidebar" class="bg-black fixed inset-y-0 left-0 w-64 md:w-80 transition duration-300 ease-in-out transform -translate-x-full z-10 my-20">
    <div class="flex flex-col items-center justify-start h-full my-10">
        <a href="{{ url('/') }}" class="text-white text-3xl font-bold mb-4">Categories</a>
        <ul class="text-white">
            @foreach($categories as $category)
                <li class="mb-4">
                    <a href="{{ url('/category/' . $category->id) }}">{{ $category->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</aside>

