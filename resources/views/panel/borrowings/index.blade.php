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
    <title>Panel | Peminjaman Buku {{ config('app.name', 'E Library') }}</title>
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

        <main class="w-full h-full bg-white overfow-y-scroll rounded-lg drop-shadow-lg flex flex-col p-3 lg:p-5">
            <div class="flex flex-row items-center">
                <h1 class="font-bold text-base lg:text-2xl">
                    {{ auth()->user()->role === 'admin' ? 'Semua Peminjaman' : 'Peminjaman Saya' }}
                </h1>
            </div>

            @if (session('success'))
                <div class="p-3 bg-green-100 border text-green-700 rounded-md text-sm mt-4">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="p-3 bg-green-100 border text-red-700 rounded-md text-sm mt-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="overflow-x-auto mt-3 lg:mt-5">
                <table class="min-w-max w-full border border-gray-200 rounded-lg text-left text-xs lg:text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-3 py-2 w-48">Aksi</th>
                            <th class="px-3 py-2 w-48">Buku</th>
                            @if (auth()->user()->role === 'admin')    
                                <th class="px-3 py-2 w-40">Peminjam</th>
                            @endif
                            <th class="px-3 py-2 w-32">Status</th>
                            <th class="px-3 py-2 w-36">Tgl. Pengajuan</th>
                            <th class="px-3 py-2 w-36">Tgl. Dipinjam</th>
                            <th class="px-3 py-2 w-36">Batas Kembali</th>
                            <th class="px-3 py-2 w-36">Tgl. Dikembalikan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($borrowings as $borrowing)
                            <tr class="border-t border-gray-200 hover:bg-gray-50">
                                <!--Actions Buttons-->
                                <td class="px-3 py-2">
                                    <div class="flex flex-row gap-1 flex-wrap">
                                        @if (auth()->user()->role === 'admin')
                                            @if ($borrowing->status === 'pending')
                                                <a href="{{ route('borrowings.show.approval', $borrowing) }}"
                                                    class="border border-yellow-500 bg-yellow-500 text-white rounded hover:bg-white hover:text-yellow-500 duration-200 py-1 px-2 font-bold text-xs"
                                                    title="Review Peminjaman ini">
                                                Review
                                                </a>
                                            @elseif ($borrowing->status === 'approved')
                                                <!--Jika user sudah ajukan pengembalian, tampilkan tombol langsung-->
                                                @if ($borrowing->return_requested)
                                                    {{-- <form method="POST" action="{{ route('borrowings.return', $borrowing) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit"
                                                            class="border border-green-600 bg-green-600 text-white rounded hover:bg-white hover:text-green-600 duration-200 py-1 px-2 font-bold text-xs"
                                                            title="Konfirmasi pengembalian buku"
                                                            onclick="return confirm('Konfirmasi Buku sudah diterima kembali')">
                                                            Terima Kembali
                                                        </button>
                                                    </form> --}}
                                                    <a href="{{ route('borrowings.show.return', $borrowing) }}"
                                                        class="border border-blue-500 bg-blue-500 text-white rounded hover:bg-white hover:text-blue-500 duration-200 py-1 px-2 font-bold text-xs"
                                                        title="Konfirmasi pengembalian buku">
                                                    Terima Kembali
                                                    </a>
                                                @else
                                                    <span class="text-gray-400 text-xs">
                                                        User Belum mengembalikan
                                                    </span>
                                                @endif
                                            @else
                                                <span class="text-gray-400 text-xs">-</span>
                                            @endif
                                        @else
                                            @if ($borrowing->status === 'pending')
                                                <span class="text-gray-400 text-xs">Menunggu Admin</span>
                                            @elseif ($borrowing->status === 'approved')
                                                <span class="text-gray-400 text-xs">Peminjaman diterima</span>
                                            @elseif ($borrowing->status === 'rejected')
                                                <span class="text-gray-400 text-xs">Permintaan Ditolak</span>
                                            @elseif ($borrowing->status === 'returned')
                                                <span class="text-gray-400 text-xs">Telah dikembalikan</span>
                                            @endif
                                        @endif
                                        
                                        @if ($borrowing->status === 'returned')
                                            <form action="{{ route('borrowings.delete', $borrowing->id) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin untuk menghapus data ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="border border-red-500 bg-red-500 text-white rounded-md hover:bg-white hover:text-red-500 duration-200 py-1 px-2 cursor-pointer">
                                                    Hapus Data
                                                </button>
                                            </form>
                                        @elseif ($borrowing->status === 'pending')
                                            <form action="{{ route('borrowings.delete', $borrowing->id) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin untuk menghapus data ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="border border-red-500 bg-red-500 text-white rounded-md hover:bg-white hover:text-red-500 duration-200 py-1 px-2 cursor-pointer">
                                                    Hapus Data
                                                </button>
                                            </form>
                                        @elseif ($borrowing->status === 'rejected')
                                            <form action="{{ route('borrowings.delete', $borrowing->id) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin untuk menghapus data ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="border border-red-500 bg-red-500 text-white rounded-md hover:bg-white hover:text-red-500 duration-200 py-1 px-2 cursor-pointer">
                                                    Hapus Data
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>

                                <!-- Book Title -->
                                <td class="px-3 py-2 font-medium">
                                    {{ $borrowing->book->title }}
                                </td>

                                <!--Borrower Admin Only -->
                                @if (auth()->user()->role === 'admin')
                                    <td class="px-3 py-2">
                                        {{ $borrowing->user->name }}
                                    </td>
                                @endif

                                <!--Status Badge-->
                                <td class="px-3 py-2">
                                    @if ($borrowing->status === 'pending')
                                        <span class="bg-yellow-100 text-yellow-700 text-xs font-semibold px-2 py-1 rounded-full">
                                            Menunggu
                                        </span>
                                    @elseif ($borrowing->status === 'approved')
                                        <div class="flex flex-col gap-1">
                                            <span class="bg-blue-100 text-blue-700 text-xs font-semibold px-2 py-1 rounded-full w-fit">
                                                Dipinjam
                                            </span>
                                            @if ($borrowing->return_requested)
                                                <span class="bg-orange-100 text-orange-700 text-xs font-semibold px-2 py-1 rounded-full w-fit">
                                                    Minta Dikembalikan
                                                </span>
                                            @endif
                                        </div>
                                    @elseif ($borrowing->status === 'rejected')
                                        <span
                                            class="bg-red-100 text-red-700 text-xs font-semibold px-2 py-1 rounded-full">
                                            Ditolak
                                        </span>
                                    @elseif ($borrowing->status === 'returned')
                                        <span
                                            class="bg-green-100 text-green-700 text-xs font-semibold px-2 py-1 rounded-full">
                                            Dikembalikan
                                        </span>
                                    @endif
                                </td>

                                <!--Date Columns-->
                                <td class="px-3 py-2 text-gray-600">
                                    {{ $borrowing->created_at }}
                                </td>
                                <td class="px-3 py-2 text-gray-600">
                                    {{ $borrowing->borrowed_at ? $borrowing->borrowed_at->format('d M Y') : '' }}
                                </td>
                                <td class="px-3 py-2 text-gray-600">
                                    {{ $borrowing->due_date ? $borrowing->due_date->format('d M Y') : '' }}
                                </td>
                                <td class="px-3 py-2 text-gray-600">
                                    {{ $borrowing->returned_at ? $borrowing->returned_at->format('d M Y') : '' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ auth()->user()->role === 'admin' ? 8 : 7 }}"
                                    class="px-3 py-10 text-center text-gray-400">
                                    Belum ada data peminjaman.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $borrowings->links() }}
            </div>
        </main>
    </section>

    <!-- Footer Component -->
    <x-footer></x-footer>
</body>

</html>