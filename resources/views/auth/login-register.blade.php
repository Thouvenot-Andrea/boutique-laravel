<x-app-layout>
    <div class="flex justify-around my-20 items-center">
        @include ('auth.login')
        <div style="border-left: 6px solid black; height: 500px"></div>
        @include ('auth.register')
    </div>
</x-app-layout>
