@props(['isLightColor' => false])

<nav {{ $attributes->merge(['class' => 'w-full flex flex-row items-center z-10']) }}>
    <!-- Logo Component: Start -->
    @include('components.logo')
    <!-- Logo Component: End -->

    <!-- Navigation Menu (Desktop): Start -->
    <ul class="hidden lg:flex flex-row ms-auto gap-10 items-center text-xl font-medium">
        <li>
            <a href="{{ route('frontpage.home') }}" class="hover:text-primary duration-200"
                title="Klik untuk membuka halaman 'Beranda'">
                Beranda
            </a>
        </li>
        <li>
            <a href="{{ route('frontpage.books') }}" class="hover:text-primary duration-200"
                title="Klik untuk membuka halaman 'Buku'">
                Buku
            </a>
        </li>
        <li>
            <a href="{{ route('frontpage.categories') }}" class="hover:text-primary duration-200"
                title="Klik untuk membuka halaman 'Kategori'">
                Kategori
            </a>
        </li>
        <li>
            @if (auth()->user())
                <a href="{{ route('books.index') }}" class="font-bold text-xl hover:text-primary duration-200"
                    title="Klik untuk masuk ke portal pengguna">
                    Hello, {{ auth()->user()->name }}
                </a>

            @elseif (request()->path() === 'login')
                <a href="{{ route('register') }}"
                    class="border border-primary bg-primary text-white rounded-lg hover:bg-white hover:text-primary duration-200 py-2 px-4"
                    title="Klik untuk membuat akun baru">
                    Daftar Akun
                </a>
            @else
                <a href="{{ route('login') }}"
                    class="border border-primary bg-primary text-white rounded-lg hover:bg-white hover:text-primary duration-200 py-2 px-4"
                    title="Klik untuk masuk ke portal pengguna">
                    Masuk
                </a>
            @endif
        </li>
    </ul>
    <!-- Navigation Menu (Desktop): End -->

    <!-- Navigation Icon (Mobile): Start -->
    <button class="inline lg:hidden ms-auto group w-10 h-10 p-1" onclick="showMenu(true)">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full" viewBox="0 0 24 24">
            <path fill="none" {{ $attributes->merge(['class' => $isLightColor ? 'stroke-white group-hover:stroke-primary duration-200' : 'stroke-black group-hover:stroke-primary duration-200']) }} stroke-linecap="round"
                stroke-linejoin="round" stroke-width="1.5" d="M4 5h16M4 12h16M4 19h16" />
        </svg>
    </button>
    <!-- Navigation Icon (Mobile): End -->
</nav>

<!-- Mobile Navigation Layout: Start -->
<div id="mobile-nav-layout" class="hidden w-full h-full fixed top-0 left-0 bg-white z-50 p-5">
    <div class="flex flex-col">
        <div class="flex flex-row items-center">
            @if (auth()->user())
                <a href="{{ route('books.index') }}" class="hover:text-primary duration-200 font-bold text-xl"
                    title="Klik untuk masuk ke portal pengguna">
                    Hello, {{ auth()->user()->name }}
                </a>
            @endif

            <button class="ms-auto w-10 h-10 p-1" onclick="showMenu(false)">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full" viewBox="0 0 24 24">
                    <path class="fill-red-500"
                        d="m6.4 18.308l-.708-.708l5.6-5.6l-5.6-5.6l.708-.708l5.6 5.6l5.6-5.6l.708.708l-5.6 5.6l5.6 5.6l-.708.708l-5.6-5.6z" />
                </svg>
            </button>
        </div>

        @if (request()->is('panel*'))
            <ul class="mt-5 flex flex-col gap-5 text-base text-black font-medium">
                <li>
                    <a href="{{ route('frontpage.home') }}" class="hover:text-primary duration-200"
                        title="Klik untuk membuka halaman 'Beranda'">
                        Kembali ke Beranda
                    </a>
                </li>
                <li>
                    <a href="{{ route('books.index') }}" class="hover:text-primary duration-200"
                        title="Klik untuk membuka halaman 'Semua Karya'">
                        Semua Karya
                    </a>
                </li>

                <li>
                    <a href="{{ route('borrowings.index') }}" class="hover:text-primary duration-200"
                        title="Klik untuk membuka halaman 'Peminjaman Buku'">
                        {{ auth()->user()->role === 'admin' ? 'Peminjaman Buku' : 'Peminjaman Saya' }}
                    </a>
                </li>

                @if (auth()->user()->role === 'admin')
                    <li class="flex">
                        <a href="{{ route('categories.index') }}" class="hover:text-primary duration-200"
                            title="Klik untuk membuka halaman 'Manajemen Kategori'">
                            Manajemen Kategori
                        </a>
                    </li>

                    <li class="flex">
                        <a href="{{ route('users.index') }}" class="hover:text-primary duration-200"
                            title="Klik untuk membuka halaman 'Manajemen Pengguna'">
                            Manajemen Pengguna
                        </a>
                    </li>
                @endif

                <li>
                    <a href="{{ route('profile.show') }}" class="hover:text-primary duration-200"
                        title="Klik untuk membuka halaman 'Pengaturan Data'">
                        Pengaturan Data
                    </a>
                </li>
                <li>
                    <a href="{{ route('change-password.show') }}" class="hover:text-primary duration-200"
                        title="Klik untuk membuka halaman 'Pengaturan Kata Sandi'">
                        Pengaturan Kata Sandi
                    </a>
                </li>
                <li>
                    <form action="/logout" method="POST" class="w-full">
                        @csrf
                        <button type="submit"
                            class="bg-red-500 text-white rounded-lg hover:bg-white hover:text-red-500 duration-200 py-2 px-4 cursor-pointer"
                            title="Klik untuk keluar dari portal pengguna">
                            Keluar
                        </button>
                    </form>
                </li>
            </ul>

        @else
                <ul @class([
                    'flex flex-col gap-5 text-base text-black font-medium',
                    'mt-5' => auth()->user(),
                ])>
              <li>
                        <a href="{{ route('frontpage.home') }}" class="hover:text-primary duration-200"
                            title="Klik untuk membuka halaman 'Beranda'">
                            Beranda
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('frontpage.books') }}" class="hover:text-primary duration-200"
                            title="Klik untuk membuka halaman 'Buku'">
                            Buku
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('frontpage.categories') }}" class="hover:text-primary duration-200"
                            title="Klik untuk membuka halaman 'Kategori'">
                            Kategori
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('login') }}"
                            class="bg-primary text-white rounded-lg hover:bg-white hover:text-primary duration-200 py-2 px-4"
                            title="Klik untuk masuk ke portal pengguna">
                            Masuk
                        </a>
                    </li>
                </ul>
        @endif
    </div>
</div>
<!-- Mobile Navigation Layout: End -->