@section('title', 'Create a new account')

    <div>
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <a href="{{ route('home') }}">
                <x-logo class="w-auto h-16 mx-auto text-indigo-600" />
            </a>

            <h2 class="mt-6 text-3xl font-extrabold text-center text-gray-900 leading-9">
                Create a new account
            </h2>

            <p class="mt-2 text-sm text-center text-gray-600 leading-5 max-w">
                Or
                <a href="{{ route('login') }}"
                    class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                    sign in to your account
                </a>
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="px-4 py-8 bg-white shadow sm:rounded-lg sm:px-10">
                <form wire:submit.prevent="register">
                    <div class="mt-6">
                        <x-label for="name" value="{{ __('Full Name') }}" />
                        <x-input id="name" class="block mt-1 w-full" type="text" wire:model="name" required autofocus
                            autocomplete="name" />
                        <x-input-error for="name" class="mt-2" />
                    </div>

                    <div class="mt-6">
                        <x-label for="email" value="{{ __('Email') }}" />

                        <x-input id="email" class="block mt-1 w-full" type="text" wire:model="email" required autofocus
                            autocomplete="email" />
                        <x-input-error for="email" class="mt-2" />
                    </div>

                    <div class="mt-6">
                        <x-label for="password" value="{{ __('Password') }}" />

                        <x-input id="password" class="block mt-1 w-full" type="password" wire:model="password" required
                            autofocus autocomplete="password" />
                        <x-input-error for="password" class="mt-2" />
                    </div>

                    <div class="mt-6">

                        <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />

                        <x-input id="password_confirmation" class="block mt-1 w-full" wire:model="passwordConfirmation"
                            type="password" required autofocus autocomplete="password" />
                        <x-input-error for="password" class="mt-2" />

                    </div>

                    <div class="mt-6">
                        <span class="block w-full rounded-md shadow-sm">
                            <x-button class="w-full bg-indigo-600 hover:bg-indigo-500 flex justify-center">Register
                            </x-button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
