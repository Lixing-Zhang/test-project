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
                    <div>
                        <x-label for="company_name" value="{{ __('Company Name') }}" />
                        <x-input id="company_name" class="block mt-1 w-full" type="text" name="company_name"
                            :value="old('company_name')" required autofocus autocomplete="company_name" />
                        <x-input-error for="company_name" class="mt-2" />
                    </div>

                    <div class="mt-6">
                        <x-label for="full_name" value="{{ __('Full Name') }}" />
                        <x-input id="full_name" class="block mt-1 w-full" type="text" name="full_name"
                            :value="old('full_name')" required autofocus autocomplete="full_name" />
                        <x-input-error for="full_name" class="mt-2" />
                    </div>

                    <div class="mt-6">
                        <x-label for="domain" value="{{ __('Domain') }}" />
                        <x-input id="domain" class="block mt-1 w-full" type="text" name="domain" :value="old('domain')"
                            required autofocus autocomplete="domain" />
                        <x-input-error for="domain" class="mt-2" />
                    </div>

                    <div class="mt-6">
                        <x-label for="email" value="{{ __('Email') }}" />

                        <x-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')"
                            required autofocus autocomplete="email" />
                        <x-input-error for="email" class="mt-2" />
                    </div>

                    <div class="mt-6">
                        <x-label for="password" value="{{ __('Password') }}" />

                        <x-input id="password" class="block mt-1 w-full" type="password" name="password"
                            :value="old('password')" required autofocus autocomplete="password" />
                        <x-input-error for="password" class="mt-2" />
                    </div>

                    <div class="mt-6">

                        <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />

                        <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                            name="passwordConfirmation" :value="old('password')" required autofocus
                            autocomplete="password" />
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
