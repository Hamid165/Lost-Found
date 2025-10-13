<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login - {{ config('app.name', 'Lost & Found') }}</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex items-center justify-center bg-gray-100 p-4">

        <div class="w-full max-w-4xl flex bg-white rounded-xl shadow-2xl overflow-hidden">

            <div class="hidden md:block w-1/2">
                <img src="{{ asset('images/telu.png') }}" alt="Login Image" class="w-full h-full object-cover">
            </div>

            <div class="w-full md:w-1/2 p-8 sm:p-12 flex flex-col justify-center">

                <div class="text-center mb-8">
                    <a href="/">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-16 h-16 mx-auto mb-4">
                    </a>
                    <h1 class="text-3xl font-bold text-gray-800">Sign In</h1>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                        <div class="mt-1">
                            <input id="email" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm py-2.5" type="email" name="email" :value="old('email')" required autofocus />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                    </div>

                    <div class="mt-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                         <div class="mt-1">
                            <input id="password" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm py-2.5"
                                            type="password"
                                            name="password"
                                            required autocomplete="current-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-500" name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                {{ __('Forgot password?') }}
                            </a>
                        @endif
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Sign In
                        </button>
                    </div>

                    {{-- Separator --}}
                    <div class="my-6 flex items-center">
                        <div class="flex-grow border-t border-gray-300"></div>
                        <span class="mx-4 text-sm text-gray-500">Or continue with</span>
                        <div class="flex-grow border-t border-gray-300"></div>
                    </div>

                    {{-- Google Sign In --}}
                    <div>
                        <a href="{{ route('google.redirect') }}" class="...">
                            Daftar dengan Google
                        </a>
                    </div>

                     <div class="mt-8 text-center">
                        <p class="text-sm text-gray-600">
                            Don't have an account?
                            <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-500">
                                Sign up
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
