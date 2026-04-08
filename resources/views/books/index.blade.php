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
      <title>Buku | {{ config('app.name', 'Digital Library') }}</title>
      <!-- Title: End -->

      <!-- Laravel Assets: Start -->
      @vite(['resources/css/app.css', 'resources/js/app.js'])
      <!-- Laravel Assets: End -->
    </head>
    <body class="w-full flex flex-col">
      <!-- Header Component: Start -->
      <x-header class="text-black px-5 lg:px-10 mt-5 lg:mt-10"></x-header>
      <!-- Header Component: End -->

      <!-- Search Filter: Start -->
      <form method="GET"
        action="{{ route('frontpage.books') }}"
        class="flex flex-row items-center gap-5 mt-5 lg:mt-10 ms-5 lg:ms-10">
        <div class="w-2/3 lg:w-75 flex flex-row rounded-lg border p-2 gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m17 17l4 4m-2-10a8 8 0 1 0-16 0a8 8 0 0 0 16 0"/></svg>

          <input type="search"
            name="keyword"
            placeholder="Search book here..."
            class="w-full text-base font-light outline-none"
            value="{{ request('keyword') }}"/>
        </div>

        <select name="category_id"
          class="w-fit outline-none p-2 rounded-lg border">
          <option value="">All Categories</option>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
              {{ $category->title }}
            </option>
          @endforeach
        </select>

        <button type="submit"
          class="border border-primary bg-primary text-white rounded-lg hover:bg-white hover:text-primary duration-200 py-2 px-4 cursor-pointer">
          Cari
        </button>
      </form>
      <!-- Search Filter: End -->

      <!-- Book Section: Start -->
      <section id="book-section"
        class="w-full flex flex-col pt-5 pb-15 px-5 lg:px-10">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-10">
          @forelse ($books as $book)
            <x-book-item :book="$book"></x-book-item>
          @empty
            <div class="text-center py-4 col-span-4">
              Tidak ada data buku
            </div>
          @endforelse
        </div>

        @if ($books->hasPages())
          <div class="mt-4 flex justify-center">
            {{ $books->links() }}
          </div>
        @endif
      </section>
      <!-- Book Section: End -->

      <!-- Footer Component: Start -->
      <x-footer></x-footer>
      <!-- Footer Component: End -->
    </body>
</html>