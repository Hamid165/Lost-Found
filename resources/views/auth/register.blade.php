<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Register - {{ config('app.name', 'Lost & Found') }}</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">

        <div>
            <a href="/">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-24 h-24">
            </a>
        </div>

        <div class="w-full sm:max-w-lg mt-6 px-8 py-10 bg-white shadow-xl overflow-hidden sm:rounded-xl">

            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Buat Akun Baru</h1>
                <p class="mt-2 text-gray-600">Pilih cara termudah untuk bergabung.</p>
            </div>

            <div>
                <a href="{{ route('google.redirect') }}" class="...">
                    Daftar dengan Google
                </a>
            </div>

            {{-- Separator --}}
            <div class="my-6 flex items-center">
                <div class="flex-grow border-t border-gray-300"></div>
                <span class="mx-4 text-sm text-gray-500">ATAU</span>
                <div class="flex-grow border-t border-gray-300"></div>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <div class="mt-1">
                        <input id="name" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm py-3" type="text" name="name" :value="old('name')" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                </div>

                <div class="mt-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                    <div class="mt-1">
                        <input id="email" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm py-3" type="email" name="email" :value="old('email')" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>

                <div class="mt-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                     <div class="mt-1">
                        <input id="password" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm py-3"
                                        type="password"
                                        name="password"
                                        required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                </div>

                <div class="mt-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                    <div class="mt-1">
                        <input id="password_confirmation" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm py-3"
                                        type="password"
                                        name="password_confirmation" required />
                    </div>
                </div>

                <div class="mt-8">
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-800 hover:bg-red-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Daftar
                    </button>
                </div>

                 <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="font-medium text-red-600 hover:text-red-500">
                            Masuk di sini
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
