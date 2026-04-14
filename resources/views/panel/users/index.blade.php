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
    <title>Panel - Manajemen Pengguna | {{ config('app.name', 'E Library') }}</title>
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
    <section id="panel-section" class="w-full h-full lg:h-[90vh] flex flex-row gap-10 items-center p-5 lg:px-10 lg:py-20">
        <!-- Side Menu: Start -->
        <x-panel-sidebar></x-panel-sidebar>
        <!-- Side Menu: End -->

        <!-- Panel Content: Start -->
        <main class="w-full h-full bg-white overflow-y-scroll rounded-lg drop-shadow-lg flex flex-col p-3 lg:p-5">
            <div class="flex flex-row">
                <h1 class="font-bold text-base lg:text-2xl">
                    Manajemen Pengguna
                </h1>
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
                            <th class="px-3 py-2 w-60">Action</th>
                            <th class="px-3 py-2 w-40">Nama</th>
                            <th class="px-3 py-2 w-40">Email</th>
                            <th class="px-3 py-2">Status</th>
                            <th class="px-3 py-2 w-50">Created At</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($users as $user)
                            <tr class="hover:bg-gray-50 duration-150">
                                <td class="px-3 py-2 flex flex-row gap-2">
                                    @if ($user->status)

                                        <form action="{{ route('users.block', $user->id) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin untuk melakukan blokir pada user ini?');">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                class="border border-red-500 bg-red-500 text-white rounded-md hover:bg-white hover:text-red-500 duration-200 py-1 px-2 cursor-pointer">
                                                Block User
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('users.unblock', $user->id) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin untuk mengaktifkan kembali user ini?');">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                class="border border-green-500 bg-green-500 text-white rounded-md hover:bg-white hover:text-green-500 duration-200 py-1 px-2 cursor-pointer">
                                                Unblock User
                                            </button>
                                        </form>
                                    @endif
                                </td>
                                <td class="px-3 py-2">
                                    {{ $user->name }}
                                </td>
                                <td class="px-3 py-2">
                                    {{ $user->email }}
                                </td>
                                <td class="px-3 py-2">
                                    <span @class([
                                        'px-2 py-1 rounded text-xs font-semibold uppercase',
                                        'bg-green-100 text-green-700' => $user->status == 1,
                                        'bg-red-100 text-red-700' => $user->status == 0,
                                    ])>
                                        {{ $user->status ? 'ACTIVE' : 'INACTIVE' }}
                                    </span>
                                </td>
                                <td class="px-3 py-2">
                                    {{ $user->created_at->format('d M Y - H:i') }} WIB
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-gray-500 py-4">
                                    Tidak ada data user
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
        <!-- Panel Content: End -->
    </section>
    <!-- Panel Section: End -->

    <!-- Footer Component: Start -->
    <x-footer></x-footer>
    <!-- Footer Component: End -->
</body>

</html>
