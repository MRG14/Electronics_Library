<!DOCTYPE html>
<html>

<head>
    <!-- Meta Tag - Encoding Character Information: Start -->
    <meta charset="utf-8">
    <!-- Meta Tag - Encoding Character Information: Start -->

    <!-- Meta Tag - Support Responsive Layout: Start -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Meta Tag - Support Responsive Layout: End -->

    <!-- Title: Start -->
    <title>Lupa Kata Sandi | {{ config('app.name', 'E Library') }}</title>
    <!-- Title: End -->

    <!-- Laravel Assets: Start -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Laravel Assets: End -->
</head>

<body class="w-full flex flex-col">

    <!-- Forgot Password Section: Start -->
    <section id="forgot-password-section" class="relative flex items-center justify-center w-full h-screen">
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
            action="/forgot-password">
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

            @if (session('status'))
                <div class="p-3 bg-green-100 text-green-800 text-sm rounded mb-3">
                    {{ session('status') }}
                </div>
            @endif

            <div class="text-sm lg:text-base w-full flex flex-col gap-1 lg:mt-5">
                <label for="email-field" class="text-base">
                    Email
                </label>
                <input id="email-field" name="email" type="email"
                    class="w-full outline-none p-3 rounded-lg border placeholder:text-black/30" placeholder="Email Anda"
                    required />
            </div>

            <button type="submit"
                class="text-sm lg:text-base w-full font-bold uppercase border border-primary bg-primary text-white rounded-lg hover:bg-white hover:text-primary duration-200 py-2 cursor-pointer">
                Verifikasi Email
            </button>

            <div class="flex flex-row gap-2 text-sm">
                <a href="{{ route('login') }}" title="Klik untuk masuk ke portal pengguna"
                    class="text-black hover:text-primary duration-200">
                    Masuk
                </a>
                <span>
                    |
                </span>
                <a href="{{ route('register') }}" title="Klik untuk membuat akun baru"
                    class="text-black hover:text-primary duration-200">
                    Daftar Akun
                </a>
            </div>
        </form>
        <!-- Form: End -->
    </section>
    <!-- Forgot Password Section: End -->
</body>

</html>