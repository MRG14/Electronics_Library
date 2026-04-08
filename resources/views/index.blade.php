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
      <title>{{ config('app.name', 'Digital Library') }}</title>
      <!-- Title: End -->

      <!-- Laravel Assets: Start -->
      @vite(['resources/css/app.css', 'resources/js/app.js'])
      <!-- Laravel Assets: End -->
    </head>
    <body class="w-full flex flex-col">
      <!-- Header Component: Start -->
      <x-header class="absolute top-5 lg:top-10 left-0 px-5 lg:px-10 text-white" isLightColor="true"></x-header>
      <!-- Header Component: End -->

      <!-- Hero Section: Start -->
      <section id="hero-section"
        class="relative flex items-center justify-center w-full h-screen">
        <div class="w-full h-full absolute top-0 left-0">
          <img src="https://images.unsplash.com/photo-1521587760476-6c12a4b040da?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
            class="w-full h-full"/>
          <div class="top-0 left-0 bg-black/50 w-full h-full absolute"></div>
        </div>

        <div class="w-5/6 lg:w-1/2 flex flex-col gap-5 text-white z-10 items-center text-center">
          <h1 class="font-bold text-2xl lg:text-4xl">
            READ ANYWHERE. ANYTIME
          </h1>
          <p class="text-xs lg:text-xl">
            Perpustakaan digital modern yang dirancang untuk memberikan akses instan ke ribuan buku, jurnal dan sumber belajar - kapan saja, di mana saja
          </p>
          <a href="{{ route('register') }}"
            class="font-bold px-4 py-2 text-xs lg:text-xl text-white bg-primary rounded-lg hover:bg-white hover:text-primary duration-200"
            title="Klik untuk melakukan pendaftaran">
            DAFTAR SEKARANG
          </a>
        </div>
      </section>
      <!-- Hero Section: End -->

      <!-- Book Section: Start -->
      <section id="book-section"
        class="w-full flex flex-col p-5 lg:py-15 lg:px-10">
        <div class="flex flex-row items-center">
          <h2 class="font-bold text-2xl lg:text-4xl">
            Buku Terpopuler
          </h2>
          <a href="{{ route('frontpage.books') }}"
            title="Klik untuk melihat lebih banyak buku"
            class="hidden lg:inline hover:text-primary duration-200 ms-auto text-xl">
            Lihat lainnya
          </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-10 mt-4">
          @foreach ($books as $book)
            <x-book-item :book="$book"></x-book-item>
          @endforeach
        </div>

        <a href="{{ route('frontpage.books') }}"
          title="Klik untuk melihat lebih banyak buku"
          class="inline lg:hidden hover:text-primary duration-200 mt-5 mx-auto text-base">
          Lihat lainnya
        </a>
      </section>
      <!-- Book Section: End -->

      <!-- Footer Component: Start -->
      <x-footer></x-footer>
      <!-- Footer Component: End -->
    </body>
</html>