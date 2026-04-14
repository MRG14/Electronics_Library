<aside class="w-3/12 min-w-3/12 bg-white px-5 py-10 rounded-lg drop-shadow-lg hidden lg:flex flex-col items-center">
    <!-- Avatar Image: Start -->
    <div class="w-30 h-30 border-4 border-primary rounded-full overflow-hidden p-2">
        <img class="w-full h-full object-cover rounded-full"
            src="{{ auth()->user()->avatar_path ? asset('storage/' . auth()->user()->avatar_path) : 'https://placehold.co/300x300?text=Electronics+Library' }}"
            alt="Avatar Pengguna" />
    </div>
    <!-- Avatar Image: End -->

    <!-- User Name: Start -->
    <span class="font-bold uppercase text-xl mt-3">
        {{ auth()->user()->name }}
    </span>
    <!-- User Name: End -->

    <!-- Navigation: Start -->
    <ul class="w-full flex flex-col mt-5 gap-2 text-black font-bold text-sm">
        <li class="flex">
            <a href="{{ route('books.index') }}"
                class="{{ request()->path() === 'panel' ? 'text-white bg-primary' : 'hover:bg-gray-500/5 hover:text-primary' }} rounded-md w-full px-2.5 py-2 duration-200"
                title="Klik untuk membuka halaman 'Semua Karya'">
                {{ auth()->user()->role === 'admin' ? 'Semua Karya' : 'Karya Saya' }}
            </a>
        </li>

        <li class="flex">
            <a href="{{ route('borrowings.index') }}"
                class="{{ request()->path() === 'panel/borrowings' ? 'text-white bg-primary' : 'hover:bg-gray-500/5 hover:text-primary' }} rounded-md w-full px-2.5 py-2 duration-200"
                title="Klik untuk membuka halaman 'Peminjaman Buku'">
                {{ auth()->user()->role === 'admin' ? 'Peminjaman Buku' : 'Peminjaman Saya' }}
            </a>
        </li>
        

        @if (auth()->user()->role === 'admin')
            <li class="flex">
                <a href="{{ route('categories.index') }}"
                    class="{{ request()->path() === 'panel/categories' ? 'text-white bg-primary' : 'hover:bg-gray-500/5 hover:text-primary' }} rounded-md w-full px-2.5 py-2 duration-200"
                    title="Klik untuk membuka halaman 'Manajemen Kategori'">
                    Manajemen Kategori
                </a>
            </li>

            <li class="flex">
                <a href="{{ route('users.index') }}"
                    class="{{ request()->path() === 'panel/users' ? 'text-white bg-primary' : 'hover:bg-gray-500/5 hover:text-primary' }} rounded-md w-full px-2.5 py-2 duration-200"
                    title="Klik untuk membuka halaman 'Manajemen Pengguna'">
                    Manajemen Pengguna
                </a>
            </li>
        @endif

        <li class="flex">
            <a href="{{ route('profile.show') }}"
                class="{{ request()->path() === 'panel/profile' ? 'text-white bg-primary' : 'hover:bg-gray-500/5 hover:text-primary' }} rounded-md w-full px-2.5 py-2 duration-200"
                title="Klik untuk membuka halaman 'Pengaturan Data'">
                Pengaturan Data
            </a>
        </li>
        <li class="flex">
            <a href="{{ route('change-password.show') }}"
                class="{{ request()->path() === 'panel/change-password' ? 'text-white bg-primary' : 'hover:bg-gray-500/5 hover:text-primary' }} rounded-md w-full px-2.5 py-2 duration-200"
                title="Klik untuk membuka halaman 'Pengaturan Kata Sandi'">
                Pengaturan Kata Sandi
            </a>
        </li>
        <li class="flex">
            <form action="/logout" method="POST" class="w-full">
                @csrf
                <button type="submit"
                    class="hover:bg-gray-500/5 hover:text-red-500 rounded-md w-full px-2.5 py-2 duration-200 text-start cursor-pointer"
                    title="Klik untuk keluar dari portal pengguna">
                    Keluar
                </button>
            </form>
        </li>
    </ul>
    <!-- Navigation: End -->
</aside>