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
    <title>Panel | Peminjaman Buku{{ config('app.name', 'E Library') }}</title>
    <!-- Title: End -->

    <!-- Laravel Assets: Start -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Laravel Assets: End -->
</head>

<body class="w-full flex flex-col">
    <!-- Header Components -->
    <x-header class="text-black px-5 lg:px-10 mt-5 lg:mt-10"></x-header>

    <section id="panel-section" 
        class="w-full h-full lg:h-[90vh] flex flex-row gap-10 items-center p-5 lg:px-10 lg:py-20">
        <x-panel-sidebar></x-panel-sidebar>

        <!--Panel utama:start-->
            <main class="w-full h-full bg-white overflow-y-scroll rounded-lg drop-shadow-lg flex flex-col p-3 lg:p-5">
                <div class="flex flex-row">
                    <h1 class="font-bold text-base lg:text-2xl">
                        Review Peminjaman
                    </h1>
                    <a href="{{ route('borrowings.index') }}"
                    class="ms-auto border border-yellow-500 bg-yellow-500 text-white rounded-md lg:rounded-lg hover:bg-white hover:text-yellow-500 duration-200 py-1 lg:py-2 px-2 lg:px-4 font-bold text-xs lg:text-base"
                    title="Kembai ke daftar peminjaman">
                        Kembali
                    </a>
                </div>

                <form class="w-full lg:w-1/2 flex flex-col gap-4 mt-4"
                    method="POST" 
                    action="{{ route('borrowings.approval', $borrowing) }}">
                    @csrf
                    @method('PUT')

                    <!--Peminjam-->
                    <div class="flex flex-col gap-1">
                        <label class="text-base">Nama Peminjam</label>
                        <input type="text" class="w-full outline-none p-3 rounded-lg border bg-gray-100" value="{{ $borrowing->user->name }}" readonly disable>
                    </div>

                    <!--Email Peminjam-->
                    <div class="flex flex-col gap-1">
                        <label class="text-base">Email Peminjam</label>
                        <input type="text" class="w-full outline-none p-3 rounded-lg border bg-gray-100" value="{{ $borrowing->user->email }}" readonly disable>
                    </div>

                    <!--Buku-->
                    <div class="flex flex-col gap-1">
                        <label class="text-base">Judul Buku</label>
                        <input type="text" class="w-full outline-none p-3 rounded-lg border bg-gray-100" value="{{ $borrowing->book->title }}" readonly disable>
                    </div>

                    <!--Kategori-->
                    <div class="flex flex-col gap-1">
                        <label class="text-base">Kategori Buku</label>
                        <input type="text" class="w-full outline-none p-3 rounded-lg border bg-gray-100" value="{{ $borrowing->book->category->title }}" readonly disable>
                    </div>

                    <!--Cover Buku-->
                    <div class="flex flex-col gap-1">
                        <label class="text-base">Cover Buku</label>
                        <img src="{{ asset('storage/'. $borrowing->book->image_path) }}" class="w-32 rounded-md mt-2" alt="Cover Buku">
                    </div>

                    <!--Tanggal Pengajuan-->
                    <div class="flex flex-col gap-1">
                        <label class="text-base">Tanggal Pengajuan</label>
                        <input type="text" class="w-full outline-none p-3 rounded-lg border bg-gray-100" value="{{ $borrowing->created_at->format('d M Y, H:i') }}" readonly disable>
                    </div>

                    <!--Review-->
                    <div class="flex flex-col gap-1">
                        <label for="approval-field" class="text-base">Review Peminjaman</label>
                        <select id="approval-field" name="approval"
                            class="w-full outline-none p-3 rounded-lg border" required>
                            <option disabled selected>Pilih Keputusan</option>
                            <option value="approve">SETUJU — Izinkan peminjaman</option>
                            <option value="reject">TOLAK — Batalkan permintaan</option>
                        </select>
                    </div>

                    <!--Berikan Keputusan-->
                    <button type="submit"
                        class="w-fit border border-primary bg-primary text-white rounded-md lg:rounded-lg hover:bg-white hover:text-primary duration-200 py-1 lg:py-2 px-2 lg:px-4 font-bold text-xs lg:text-base cursor-pointer">
                        Berikan Keputusan
                    </button>   
                </form>
            </main>
        <!--Panel utama:end-->
    </section>

    <!-- Footer Component -->
    <x-footer></x-footer>
</body>

</html>