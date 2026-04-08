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
      <title>Panel - Pengaturan Data | {{ config('app.name', 'Digital Library') }}</title>
      <!-- Title: End -->

      <!-- Laravel Assets: Start -->
      @vite(['resources/css/app.css', 'resources/js/app.js'])
      <!-- Laravel Assets: End -->
    </head>
    <body class="w-full flex flex-col">
      <!-- Header Component: Start -->
      <x-header class="text-black px-5 lg:px-10 mt-5 lg:mt-10"></x-header>
      <!-- Header Component: End -->

      <!-- Panel Section: Start -->
      <section id="panel-section"
        class="w-full h-full lg:h-[90vh] flex flex-row gap-10 items-center p-5 lg:px-10 lg:py-20">
        <!-- Side Menu: Start -->
        <x-panel-sidebar></x-panel-sidebar>
        <!-- Side Menu: End -->

        <!-- Panel Content: Start -->
        <main class="w-full h-full lg:h-auto bg-white overflow-y-scroll rounded-lg drop-shadow-lg flex flex-col p-3 lg:p-5">
          <div class="flex flex-row">
            <h1 class="font-bold text-base lg:text-2xl">
              Pengaturan Data
            </h1>

            <a href="{{ route('books.index') }}"
              class="ms-auto border border-yellow-500 bg-yellow-500 text-white rounded-md lg:rounded-lg hover:bg-white hover:text-yellow-500 duration-200 py-1 lg:py-2 px-2 lg:px-4 font-bold text-xs lg:text-base"
              title="Klik untuk kembali ke halaman sebelumnya">
              Kembali
            </a>
          </div>

          @if ($errors->any())
            <div class="p-3 bg-red-100 border text-red-700 rounded-md text-sm mt-4">
              <ul class="list-disc ps-4">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          @if (session('success'))
            <div class="p-3 bg-green-100 border text-green-700 rounded-md text-sm mt-4">
              {{ session('success') }}
            </div>
          @endif

          <form class="w-full lg:w-1/2 flex flex-col gap-4"
            action="{{ route('profile.update') }}"  
            method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="text-sm lg:text-base w-full flex flex-col gap-1 mt-4">
              <label for="email-field"
                class="text-base">
                Email
              </label>
              <input id="email-field"
                type="email"
                class="w-full outline-none p-3 rounded-lg border placeholder:text-black/30 read-only:bg-gray-200"
                placeholder="Email Anda"
                value="{{ old('email', auth()->user()->email) }}"
                readonly
                required/>
            </div>

            <div class="text-sm lg:text-base w-full flex flex-col gap-1">
              <label for="name-field"
                class="text-base">
                Nama Lengkap
              </label>
              <input id="name-field"
                name="name"
                type="text"
                class="w-full outline-none p-3 rounded-lg border placeholder:text-black/30"
                placeholder="Nama Lengkap Anda"
                value="{{ old('name', auth()->user()->name) }}"
                required/>
            </div>

            <div class="text-sm lg:text-base w-full flex flex-col gap-1">
              <label for="image-field"
                class="text-base"
                required>
                Foto Avatar (Max 2 MB)
              </label>
              <input id="image-field"
                name="image"
                type="file"
                accept="image/*"
                class="w-full outline-none p-3 rounded-lg border placeholder:text-black/30"
                placeholder="Foto Avatar Anda"/>
            </div>

            <button type="submit" 
              class="w-fit border border-primary bg-primary text-white rounded-md lg:rounded-lg hover:bg-white hover:text-primary duration-200 py-1 lg:py-2 px-2 lg:px-4 font-bold text-xs lg:text-base cursor-pointer">
              Ubah Data
            </a>
          </form>
        </main>
        <!-- Panel Content: End -->
      </section>
      <!-- Panel Section: End -->

      <!-- Footer Component: Start -->
      <x-footer></x-footer>
      <!-- Footer Component: End -->
    </body>
</html>