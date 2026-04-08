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
    <title>Panel - Detail Karya | {{ config('app.name', 'Digital Library') }}</title>
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
                    Detail Karya
                </h1>

                <a href="{{ route('books.index') }}"
                    class="ms-auto border border-yellow-500 bg-yellow-500 text-white rounded-md lg:rounded-lg hover:bg-white hover:text-yellow-500 duration-200 py-1 lg:py-2 px-2 lg:px-4 font-bold text-xs lg:text-base"
                    title="Klik untuk kembali ke halaman sebelumnya">
                    Kembali
                </a>
            </div>

            <form class="w-full lg:w-1/2 flex flex-col gap-4" method="POST" action="{{ route('books.approval', $book) }}">
                @csrf
                @method('PUT')

                <div class="text-sm lg:text-base w-full flex flex-col gap-1 mt-4">
                    <label for="title-field" class="text-base">
                        Judul Karya
                    </label>
                    <input id="title-field" type="text"
                        class="w-full outline-none p-3 rounded-lg border placeholder:text-black/30 read-only:bg-gray-200"
                        placeholder="Judul Karya Anda" value="{{ $book->title }}" readonly disabled />
                </div>

                <div class="text-sm lg:text-base w-full flex flex-col gap-1">
                    <label for="slug-field" class="text-base">
                        URL Karya
                    </label>
                    <input id="slug-field" type="text"
                        class="w-full outline-none p-3 rounded-lg border placeholder:text-black/30 read-only:bg-gray-200"
                        placeholder="URL Karya Anda" value="{{ $book->slug }}" readonly disabled />
                </div>

                <div class="text-sm lg:text-base w-full flex flex-col gap-1">
                    <label for="description-field" class="text-base">
                        Deskripsi Karya
                    </label>
                    <textarea id="description-field"
                        class="w-full outline-none p-3 rounded-lg border placeholder:text-black/30 read-only:bg-gray-200"
                        rows="5" placeholder="Deskripsi Karya Anda" readonly
                        disabled>{{ $book->description }}</textarea>
                </div>

                <div class="text-sm lg:text-base w-full flex flex-col gap-1">
                    <label for="category-field" class="text-base">
                        Kategori Karya
                    </label>
                    <select id="category-field"
                        class="w-full outline-none p-3 rounded-lg border placeholder:text-black/30 read-only:bg-gray-200"
                        readonly disabled>
                        <option disabled selected>Pilih Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $book->category_id ?? '') == $category->id)>
                                {{ $category->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="text-sm lg:text-base w-full flex flex-col gap-1">
                    <label for="image-field" class="text-base">
                        Foto Karya (Max 2 MB)
                    </label>
                    @if ($book && $book->image_path)
                        <img src="{{ asset('storage/' . $book->image_path) }}" class="w-32 rounded-md mt-2" />
                    @endif
                </div>

                <div class="text-sm lg:text-base w-full flex flex-col gap-1">
                    <label for="file-field" class="text-base">
                        File PDF (Max 10 MB)
                    </label>
                    @if ($book && $book->file_path)
                        <a href="{{ asset('storage/' . $book->file_path) }}" target="_blank"
                            class="text-primary underline mt-2 block">
                            Lihat File PDF
                        </a>
                    @endif
                </div>

                <div class="text-sm lg:text-base w-full flex flex-col gap-1">
                    <label for="approval-field" class="text-base">
                        Review Karya
                    </label>
                    <select id="approval-field" name="approval"
                        class="w-full outline-none p-3 rounded-lg border placeholder:text-black/30" required>
                        <option disabled selected>Pilih Approval</option>
                        <option value="approve">SETUJU</option>
                        <option value="reject">TOLAK</option>
                    </select>
                </div>

                <button type="submit"
                    class="w-fit border border-primary bg-primary text-white rounded-md lg:rounded-lg hover:bg-white hover:text-primary duration-200 py-1 lg:py-2 px-2 lg:px-4 font-bold text-xs lg:text-base cursor-pointer">
                    Berikan Review
                </button>
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