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
      <title>Panel - Semua Kategori | {{ config('app.name', 'Digital Library') }}</title>
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
        <main class="w-full h-full bg-white overflow-y-scroll rounded-lg drop-shadow-lg flex flex-col p-3 lg:p-5">
          <div class="flex flex-row">
            <h1 class="font-bold text-base lg:text-2xl">
              Semua Kategori
            </h1>

            <a href="{{ route('categories.show.create') }}"
              class="ms-auto border border-primary bg-primary text-white rounded-md lg:rounded-lg hover:bg-white hover:text-primary duration-200 py-1 lg:py-2 px-2 lg:px-4 font-bold text-xs lg:text-base"
              title="Klik untuk menambah kategori">
              Tambah Data
            </a>
          </div>

          @if (session('success'))
            <div class="p-3 bg-green-100 border text-green-700 rounded-md text-sm mt-4">
              {{ session('success') }}
            </div>
          @endif

          <div class="overflow-x-auto mt-3 lg:mt-5">
            <table class="min-w-max w-full h-full border border-gray-200 rounded-lg text-left text-xs lg:text-sm">
              <thead class="bg-gray-100">
                <tr>
                  <th class="px-3 py-2 w-40">Action</th>
                  <th class="px-3 py-2 w-40">Title</th>
                  <th class="px-3 py-2 w-40">Created At</th>
                </tr>
              </thead>

              <tbody>
                @forelse ($categories as $category)
                <tr class="hover:bg-gray-50 duration-150">
                  <td class="px-3 py-2 flex flex-row gap-2">
                    <a href="{{ route('categories.show.update', $category) }}" 
                      class="border border-primary bg-primary text-white rounded-md hover:bg-white hover:text-primary duration-200 py-1 px-2">
                      Edit Data
                    </a>

                    <form action="{{ route('categories.delete', $category->id) }}" 
                      method="POST" 
                      onsubmit="return confirm('Apakah Anda yakin untuk menghapus data ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                          class="border border-red-500 bg-red-500 text-white rounded-md hover:bg-white hover:text-red-500 duration-200 py-1 px-2 cursor-pointer">
                          Hapus Data
                        </button>
                    </form>
                  </td>
                  <td class="px-3 py-2">
                    {{ $category->title }}
                  </td>
                  <td class="px-3 py-2">
                    {{ $category->created_at->format('d M Y - H:i') }} WIB
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="8" class="text-center text-gray-500 py-4">
                    Tidak ada data kategori
                  </td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          @if ($categories->hasPages())
            <div class="mt-4 flex justify-center">
              {{ $categories->links() }}
            </div>
          @endif
        </main>
        <!-- Panel Content: End -->
      </section>
      <!-- Panel Section: End -->

      <!-- Footer Component: Start -->
      <x-footer></x-footer>
      <!-- Footer Component: End -->
    </body>
</html>