<form method="POST" action="{{ route('register') }}" class="w-1/4">
    @csrf

    <h2 class="text-2xl font-bold mb-10">{{__('Register')}}</h2>
    <!-- Username -->
    <div>
        <x-input-label for="username" :value="__('Username')"/>
        <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('name')" required
                      autofocus autocomplete="name"/>
        <x-input-error :messages="$errors->get('username')" class="mt-2"/>
    </div>

    <!-- Firstname -->
    <div class="mt-4">
        <x-input-label for="firstname" :value="__('Firstname')"/>
        <x-text-input id="firstname" class="block mt-1 w-full" type="text" name="firstname" :value="old('firstname')"
                      required
                      autocomplete="firstname"/>
        <x-input-error :messages="$errors->get('firstname')" class="mt-2"/>
    </div>

    <!-- Lastname -->
    <div class="mt-4">
        <x-input-label for="lastname" :value="__('Lastname')"/>
        <x-text-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname')"
                      required
                      autocomplete="lastname"/>
        <x-input-error :messages="$errors->get('lastname')" class="mt-2"/>
    </div>

    <!-- Phone -->
    <div class="mt-4">
        <x-input-label for="phone" :value="__('Phone')"/>
        <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required
                      autocomplete="phone"/>
        <x-input-error :messages="$errors->get('phone')" class="mt-2"/>
    </div>

    <!-- Email Address -->
    <div class="mt-4">
        <x-input-label for="email" :value="__('Email')"/>
        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                      autocomplete="username"/>
        <x-input-error :messages="$errors->get('email')" class="mt-2"/>
    </div>

    <!-- Password -->
    <div class="mt-4">
        <x-input-label for="password" :value="__('Password')"/>

        <x-text-input id="password" class="block mt-1 w-full"
                      type="password"
                      name="password"
                      required autocomplete="new-password"/>

        <x-input-error :messages="$errors->get('password')" class="mt-2"/>
    </div>

    <!-- Confirm Password -->
    <div class="mt-4">
        <x-input-label for="password_confirmation" :value="__('Confirm Password')"/>

        <x-text-input id="password_confirmation" class="block mt-1 w-full"
                      type="password"
                      name="password_confirmation" required autocomplete="new-password"/>

        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
    </div>

    <div class="flex items-center justify-end mt-4">
        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
           href="{{ route('login') }}">
            {{ __('Already registered?') }}
        </a>

        <x-primary-button class="ms-4">
            {{ __('Register') }}
        </x-primary-button>
    </div>
</form>