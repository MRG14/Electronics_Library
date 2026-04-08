@props(['book'])
<a href="{{ route('frontpage.book.details', $book->slug) }}" title="Klik untuk melihat detail buku" class="group">
    <div class="w-full flex flex-col rounded-lg border overflow-hidden">
        <!-- Book Image: Start -->
        <div class="w-full h-56 overflow-hidden">
            <img src="{{ asset('storage/' . $book->image_path) }}"
                class="w-full h-full object-cover group-hover:scale-110 duration-200" alt="Cover buku" />
        </div>
        <!-- Book Image: End -->

        <!-- Book Contents: Start -->
        <div class="flex flex-col p-3 gap-1">
            <!-- Title: Start -->
            <span class="font-bold text-base lg:text-2xl group-hover:text-primary duration-200">
                {{ $book->title }}
            </span>
            <!-- Title: End -->

            <!-- Date Information: Start -->
            <div class="flex flex-row items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 lg:w-6 lg:h-6" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M8 13.885q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.539t-.54.23m4 0q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.539t-.54.23m4 0q-.31 0-.54-.23t-.23-.54t.23-.539t.54-.23t.54.23t.23.54t-.23.539t-.54.23M5.616 21q-.691 0-1.153-.462T4 19.385V6.615q0-.69.463-1.152T5.616 5h1.769V2.77h1.077V5h7.154V2.77h1V5h1.769q.69 0 1.153.463T20 6.616v12.769q0 .69-.462 1.153T18.384 21zm0-1h12.769q.23 0 .423-.192t.192-.424v-8.768H5v8.769q0 .23.192.423t.423.192M5 9.615h14v-3q0-.23-.192-.423T18.384 6H5.616q-.231 0-.424.192T5 6.616zm0 0V6z" />
                </svg>
                <span class="text-xs lg:text-sm">
                    {{ $book->approved_at->format('d M Y') }}
                </span>
            </div>
            <!-- Date Information: End -->

            <!-- Author: Start -->
            <div class="flex flex-row items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 lg:w-6 lg:h-6" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M10.8 19.916q1.106-1.949 2.789-2.682Q15.27 16.5 16.5 16.5q.517 0 .98.071q.464.071.912.202q.658-.854 1.133-2.098T20 12q0-3.35-2.325-5.675T12 4T6.325 6.325T4 12q0 1.298.384 2.448q.383 1.15 1.035 2.102q.948-.558 1.904-.804t2.004-.246q.627 0 1.22.099q.594.099.972.209q-.286.184-.52.373q-.233.188-.472.427q-.185-.05-.532-.08q-.347-.028-.668-.028q-.858 0-1.703.214q-.845.213-1.57.64q.935 1.05 2.162 1.693q1.228.643 2.584.868M12.003 21q-1.866 0-3.51-.708q-1.643-.709-2.859-1.924t-1.925-2.856T3 12.003t.709-3.51Q4.417 6.85 5.63 5.634t2.857-1.925T11.997 3t3.51.709q1.643.708 2.859 1.922t1.925 2.857t.709 3.509t-.708 3.51t-1.924 2.859t-2.856 1.925t-3.509.709M9.5 13q-1.258 0-2.129-.871T6.5 10t.871-2.129T9.5 7t2.129.871T12.5 10t-.871 2.129T9.5 13m0-1q.817 0 1.409-.591q.591-.592.591-1.409t-.591-1.409Q10.317 8 9.5 8t-1.409.591Q7.5 9.183 7.5 10t.591 1.409Q8.683 12 9.5 12m7 2.385q-1.001 0-1.693-.692T14.116 12t.691-1.693t1.693-.691t1.693.691t.691 1.693t-.691 1.693t-1.693.692M12 12" />
                </svg>
                <span class="text-xs lg:text-sm">
                    {{ $book->user->name }}
                </span>
            </div>
            <!-- Author: End -->
        </div>
        <!-- Book Contents: End -->
    </div>
</a>