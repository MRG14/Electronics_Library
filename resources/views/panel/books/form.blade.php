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
    <title>Panel - {{ $book ? 'Ubah Karya' : 'Tambah Karya' }} | {{ config('app.name', 'Digital Library') }}</title>
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
                    {{ $book ? 'Ubah Karya' : 'Tambah Karya' }}
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

            <form class="w-full lg:w-1/2 flex flex-col gap-4" method="POST" enctype="multipart/form-data" action="{{ $book ? route('books.update', $book->id) : route('books.create') }}">
                @csrf

                @if ($book)
                    @method('PUT')
                @endif

                <div class="text-sm lg:text-base w-full flex flex-col gap-1 mt-4">
                    <label for="title-field" class="text-base">
                        Judul Karya
                    </label>
                    <input id="title-field" name="title" type="text" value="{{ old('title', $book->title ?? '') }}"
                        class="w-full outline-none p-3 rounded-lg border placeholder:text-black/30"
                        placeholder="Judul Karya Anda" required />
                </div>

                <div class="text-sm lg:text-base w-full flex flex-col gap-1">
                    <label for="description-field" class="text-base">
                        Deskripsi Karya
                    </label>
                    <textarea id="description-field"
                        class="w-full outline-none p-3 rounded-lg border placeholder:text-black/30" name="description"
                        rows="5" placeholder="Deskripsi Karya Anda"
                        required>{{ old('description', $book->description ?? '') }}</textarea>
                </div>

                <div class="text-sm lg:text-base w-full flex flex-col gap-1">
                    <label for="category-field" class="text-base">
                        Kategori Karya
                    </label>
                    <select id="category-field" name="category_id"
                        class="w-full outline-none p-3 rounded-lg border placeholder:text-black/30" required>
                        <option disabled selected>Pilih Kategori</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $book->category_id ?? '') == $category->id)>
                                {{ $category->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="text-sm lg:text-base w-full flex flex-col gap-1">
                    <label for="image-field" class="text-base" required>
                        Foto Karya (Max 2 MB)
                    </label>
                    <input id="image-field" name="image" type="file" accept="image/*"
                        class="w-full outline-none p-3 rounded-lg border placeholder:text-black/30"
                        placeholder="Foto Karya Anda" @if(!$book) required @endif />

                    @if ($book && $book->image_path)
                        <img src="{{ asset('storage/' . $book->image_path) }}" class="w-32 rounded-md mt-2" />
                    @endif
                </div>

                <div class="text-sm lg:text-base w-full flex flex-col gap-1">
                    <label for="file-field" class="text-base">
                        File PDF (Max 10 MB)
                    </label>
                    <input id="file-field" name="file" type="file" accept="application/pdf"
                        class="w-full outline-none p-3 rounded-lg border placeholder:text-black/30"
                        placeholder="File PDF Karya Anda" @if(!$book) required @endif />

                    @if ($book && $book->file_path)
                        <a href="{{ asset('storage/' . $book->file_path) }}" target="_blank"
                            class="text-primary underline mt-2 block">
                            Lihat File PDF
                        </a>
                    @endif
                </div>

                <button type="submit"
                    class="w-fit border border-primary bg-primary text-white rounded-md lg:rounded-lg hover:bg-white hover:text-primary duration-200 py-1 lg:py-2 px-2 lg:px-4 font-bold text-xs lg:text-base cursor-pointer">
                    {{ $book ? 'Update Karya' : 'Kirim Karya' }}
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