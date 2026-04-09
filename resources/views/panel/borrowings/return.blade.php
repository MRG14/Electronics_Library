<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel | Konfirmasi Pengembalian | {{ config('app.name', 'Digital Library') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="w-full flex flex-col">
    <x-header class="text-black px-5 lg:px-10 mt-5 lg:mt-10"></x-header>

    <section id="panel-section"
        class="w-full h-full lg:h-[90vh] flex flex-row gap-10 items-center p-5 lg:px-10 lg:py-20">
        <x-panel-sidebar></x-panel-sidebar>

        <main class="w-full h-full bg-white overflow-y-scroll rounded-lg drop-shadow-lg flex flex-col p-3 lg:p-5">
            <div class="flex flex-row">
                <h1 class="font-bold text-base lg:text-2xl">
                    Konfirmasi Pengembalian Buku
                </h1>
                <a href="{{ route('borrowings.index') }}"
                    class="ms-auto border border-yellow-500 bg-yellow-500 text-white rounded-md lg:rounded-lg hover:bg-white hover:text-yellow-500 duration-200 py-1 lg:py-2 px-2 lg:px-4 font-bold text-xs lg:text-base"
                    title="Kembali ke daftar peminjaman">
                    Kembali
                </a>
            </div>

            <div class="w-full lg:w-1/2 flex flex-col gap-4 mt-4">

                <!-- Info Peminjam -->
                <div class="flex flex-col gap-1">
                    <label class="text-base">Nama Peminjam</label>
                    <input type="text"
                        class="w-full outline-none p-3 rounded-lg border bg-gray-100"
                        value="{{ $borrowing->user->name }}"
                        readonly disabled />
                </div>

                <!-- Buku -->
                <div class="flex flex-col gap-1">
                    <label class="text-base">Judul Buku</label>
                    <input type="text"
                        class="w-full outline-none p-3 rounded-lg border bg-gray-100"
                        value="{{ $borrowing->book->title }}"
                        readonly disabled />
                </div>

                <!-- Cover Buku -->
                <div class="flex flex-col gap-1">
                    <label class="text-base">Cover Buku</label>
                    <img src="{{ asset('storage/' . $borrowing->book->image_path) }}"
                        class="w-32 rounded-md mt-2" alt="Cover buku" />
                </div>

                <!-- Tanggal Dipinjam -->
                <div class="flex flex-col gap-1">
                    <label class="text-base">Tanggal Dipinjam</label>
                    <input type="text"
                        class="w-full outline-none p-3 rounded-lg border bg-gray-100"
                        value="{{ $borrowing->borrowed_at->format('d M Y, H:i') }}"
                        readonly disabled />
                </div>

                <!-- Batas Pengembalian -->
                <div class="flex flex-col gap-1">
                    <label class="text-base">Batas Pengembalian</label>
                    <input type="text"
                        class="w-full outline-none p-3 rounded-lg border {{ now()->greaterThan($borrowing->due_date) ? 'bg-red-50 text-red-700 border-red-300' : 'bg-gray-100' }}"
                        value="{{ $borrowing->due_date->format('d M Y, H:i') }}{{ now()->greaterThan($borrowing->due_date) ? ' — TERLAMBAT' : '' }}"
                        readonly disabled />
                </div>

                <!-- Tombol Konfirmasi -->
                <form method="POST" action="{{ route('borrowings.return', $borrowing) }}">
                    @csrf
                    @method('PUT')
                    <button type="submit"
                        class="w-fit border border-primary bg-primary text-white rounded-md lg:rounded-lg hover:bg-white hover:text-primary duration-200 py-1 lg:py-2 px-2 lg:px-4 font-bold text-xs lg:text-base cursor-pointer"
                        onclick="return confirm('Konfirmasi bahwa buku ini telah dikembalikan?')">
                        Konfirmasi Buku Sudah Kembali
                    </button>
                </form>
            </div>
        </main>
    </section>

    <x-footer></x-footer>
</body>

</html>