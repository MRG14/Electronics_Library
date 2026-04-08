<footer class="bg-[#00304D] p-5 lg:px-10 lg:py-5 flex flex-col text-white">
    <!-- Logo Component: Start -->
    @include('components.logo')
    <!-- Logo Component: End -->

    <!-- 3 Columns: Start -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-10 lg:gap-20 mt-5">
        <!-- Left Column: Start -->
        <div class="flex flex-col lg:col-span-2">
            <p class="text-base lg:text-2xl w-full lg:w-3/4">
                Perpustakaan digital modern yang dirancang untuk memberikan akses instan ke ribuan buku, jurnal dan
                sumber belajar - kapan saja, di mana saja
            </p>

            <div class="flex flex-row items-center mt-3 lg:mt-5 gap-2 lg:gap-4">
                <a href="https://www.youtube.com/@develobe_id" target="_blank"
                    title="Klik untuk melihat Youtube Tutorial membuat Perpus ini" class="group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 lg:w-10 lg:h-10" viewBox="0 0 24 24">
                        <g fill="none" class="stroke-white group-hover:stroke-primary duration-200" stroke-width="1.5">
                            <path
                                d="M12 20.5c1.81 0 3.545-.179 5.153-.507c2.01-.41 3.014-.614 3.93-1.792c.917-1.179.917-2.532.917-5.238v-1.926c0-2.706 0-4.06-.917-5.238c-.916-1.178-1.92-1.383-3.93-1.792A26 26 0 0 0 12 3.5c-1.81 0-3.545.179-5.153.507c-2.01.41-3.014.614-3.93 1.792C2 6.978 2 8.331 2 11.037v1.926c0 2.706 0 4.06.917 5.238c.916 1.178 1.92 1.383 3.93 1.792c1.608.328 3.343.507 5.153.507Z" />
                            <path stroke-linejoin="round"
                                d="M15.962 12.313c-.148.606-.938 1.04-2.517 1.911c-1.718.947-2.577 1.42-3.272 1.237a1.7 1.7 0 0 1-.635-.317C9 14.709 9 13.806 9 12s0-2.709.538-3.144c.182-.147.4-.256.635-.317c.695-.183 1.554.29 3.272 1.237c1.58.87 2.369 1.305 2.517 1.911c.05.206.05.42 0 .626Z" />
                        </g>
                    </svg>
                </a>

                <a href="https://www.instagram.com/chill_ghil/" target="_blank"
                    title="Klik untuk melihat Instagram MRG14" class="group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 lg:w-10 lg:h-10" viewBox="0 0 24 24">
                        <g fill="none" class="stroke-white group-hover:stroke-primary duration-200" stroke-width="1">
                            <path stroke-linejoin="round" stroke-width="1.5"
                                d="M2.5 12c0-4.478 0-6.718 1.391-8.109S7.521 2.5 12 2.5c4.478 0 6.718 0 8.109 1.391S21.5 7.521 21.5 12c0 4.478 0 6.718-1.391 8.109S16.479 21.5 12 21.5c-4.478 0-6.718 0-8.109-1.391S2.5 16.479 2.5 12Z" />
                            <path stroke-width="1.5" d="M16.5 12a4.5 4.5 0 1 1-9 0a4.5 4.5 0 0 1 9 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.508 6.5h-.01" />
                        </g>
                    </svg>
                </a>
            </div>
        </div>
        <!-- Left Column: End -->

        <!-- Middle Column: Start -->
        <div class="flex flex-col text-base lg:text-2xl">
            <span class="font-bold">
                LINKS
            </span>

            <ul class="mt-1 lg:mt-2 flex flex-col">
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
            </ul>
        </div>
        <!-- Middle Column: End -->

        <!-- Right Column: Start -->
        <div class="flex flex-col text-base lg:text-2xl">
            <span class="font-bold">
                CONTACT
            </span>

            <ul class="mt-1 lg:mt-2 flex flex-col">
                <li>
                    <a href="#" class="hover:text-primary duration-200" title="Klik untuk menyalin email">
                        Email
                    </a>
                </li>
                <li>
                    <a href="https://academy.develobe.id?ref=dev-academy-digilib"
                        class="hover:text-primary duration-200" title="Klik untuk melihat Develobe Academy">
                        Visit Us
                    </a>
                </li>
            </ul>
        </div>
        <!-- Right Column: End -->
    </div>
    <!-- 3 Columns: End -->

    <!-- Copyright Information: Start -->
    <span class="w-full text-center mt-10 text-xs lg:text-base">
        &copy; 2026 Powered by <a href="https://github.com/MRG14" target="_blank"
            class="underline hover:text-primary duration-200" title="Github">MRG14</a>
    </span>
    <!-- Copyright Information: End -->
</footer>