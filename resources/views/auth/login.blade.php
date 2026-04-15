<!DOCTYPE html>
<html>

<head>
    <!-- Meta Tag - Encoding Character Information -->
    <meta charset="utf-8">

    <!-- Meta Tag - Support Responsive Layout -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title -->
    <title>Masuk | {{ config('app.name', 'E Library') }}</title>

    <!-- Laravel Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="w-full flex flex-col">
    <!-- Header Component: Start -->
    {{-- <x-header class="absolute top-5 lg:top-10 left-0 px-5 lg:px-10 text-white" isLightColor="true"></x-header> --}}

    <!-- Login Section: Start -->
    <section id="login-section" class="relative flex items-center justify-center w-full h-screen">
        <!-- Background: Start -->
        <div class="w-full h-full absolute top-0 left-0">
            <img src="https://images.unsplash.com/photo-1521587760476-6c12a4b040da?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                class="w-full h-full" />
            <div class="top-0 left-0 bg-black/50 w-full h-full absolute"></div>
        </div>
        <!-- Background: End -->

        <!-- Form: Start -->
        <form method="POST"
            class="w-11/12 lg:w-4/12 bg-white px-5 py-10 lg:px-5 lg:py-20 flex flex-col items-center justify-center gap-5 z-1 rounded-3xl"
            action="/login">
            @csrf

            <h1 class="font-bold text-xl">
                E LIBRARY
            </h1>

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="text-sm lg:text-base w-full flex flex-col gap-1 lg:mt-5">
                <label for="email-field" class="text-base">
                    Email
                </label>
                <input id="email-field" name="email" type="email"
                    class="w-full outline-none p-3 rounded-lg border placeholder:text-black/30"
                    placeholder="Email Anda" />
            </div>

            <div class="text-sm lg:text-base w-full flex flex-col gap-1">
                <label for="password-field" class="text-base">
                    Kata Sandi
                </label>
                <input id="password-field" name="password" type="password"
                    class="w-full outline-none p-3 rounded-lg border placeholder:text-black/30"
                    placeholder="Kata Sandi Anda" />
            </div>

            <button type="submit"
                class="text-sm lg:text-base w-full font-bold uppercase border border-primary bg-primary text-white rounded-lg hover:bg-white hover:text-primary duration-200 py-2 cursor-pointer">
                Masuk
            </button>

            <div class="relative w-full flex items-center justify-center my-1">
                <div class="border-t w-full border-gray-200"></div>
                <span class="bg-white px-3 text-xs text-gray-400 absolute uppercase">Atau</span>
            </div>

            <div class="w-full">
                <a href="{{ route('auth.google') }}"
                    class="w-full flex items-center justify-center gap-3 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 duration-200 transition-all group">
                    <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" 
                        alt="Google Logo" class="w-5 h-5">
                    <span class="text-sm font-semibold text-gray-700 group-hover:text-primary">Masuk dengan Google</span>
                </a>
            </div>

            <div class="flex flex-row gap-2 text-sm">
                <a href="{{ route('register') }}" title="Klik untuk membuat akun baru"
                    class="text-black hover:text-primary duration-200">
                    Daftar Akun
                </a>
                <span>
                    |
                </span>
                <a href="{{ route('password.request') }}" title="Klik untuk mengubah kata sandi Anda"
                    class="text-black hover:text-primary duration-200">
                    Lupa Kata Sandi?
                </a>
            </div>
        </form>
        <!-- Form: End -->
    </section>
    <!-- Login Section: End -->
</body>

</html>