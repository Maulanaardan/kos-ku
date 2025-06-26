<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('resources/css/app.css')
        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    </head>
    <body>

        <nav class="bg-white shadow-md fixed top-0 left-0 w-full z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="/" class="text-2xl font-bold text-indigo-600">KosKu</a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex space-x-8">
                    <a href="#home" class="text-gray-700 hover:text-indigo-600 font-medium">Beranda</a>
                    <a href="#rooms" class="text-gray-700 hover:text-indigo-600 font-medium">Kamar</a>
                    <a href="#facilities" class="text-gray-700 hover:text-indigo-600 font-medium">Fasilitas</a>
                    <a href="#contact" class="text-gray-700 hover:text-indigo-600 font-medium">Kontak</a>
                </div>

                <!-- Call to Action -->
                <div class="hidden md:flex">
                    <a href="/login" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">Login</a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-gray-700 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    </button>
                </div>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="md:hidden hidden px-4 pb-4">
                <a href="#home" class="block py-2 text-gray-700 hover:text-indigo-600">Beranda</a>
                <a href="#rooms" class="block py-2 text-gray-700 hover:text-indigo-600">Kamar</a>
                <a href="#facilities" class="block py-2 text-gray-700 hover:text-indigo-600">Fasilitas</a>
                <a href="#contact" class="block py-2 text-gray-700 hover:text-indigo-600">Kontak</a>
                <a href="/login" class="block mt-2 bg-indigo-600 text-white text-center py-2 rounded-lg hover:bg-indigo-700">Login</a>
            </div>
        </nav>

        <div class="min-h-screen w-full bg-cover bg-center relative pt-24" style="background-image: url('/images/kos-background.jpg')">
            <div class="absolute inset-0 bg-black bg-opacity-70"></div>
            <div class="relative z-10 flex items-center justify-center min-h-screen">
                <div class="w-full max-w-[1440px] mx-auto px-0 md:px-12 grid grid-cols-1 md:grid-cols-2 gap-12 items-center text-white">
                    
                    {{-- Kiri: Sambutan --}}
                    <div>
                        <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">Selamat Datang di Kos Nyaman Kita</h1>
                        <p class="text-lg mb-6">Temukan kenyamanan seperti di rumah sendiri. Kos dengan fasilitas lengkap, lokasi strategis, dan harga terjangkau.</p>
                        <a href="/kamar" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl transition duration-300">
                            Lihat Kamar
                        </a>
                    </div>

                    {{-- Kanan: Gambar --}}
                    <div class="flex justify-center md:justify-end px-4 md:px-0">
                        <img src="/images/kamar-example.jpg" alt="Gambar Kamar Kos" class="rounded-2xl shadow-lg max-w-full max-h-[400px]">
                    </div>

                </div>
            </div>
        </div>

        <section id="rooms" class="py-20 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800">Pilihan Kamar</h2>
            <p class="mt-2 text-gray-600">Pilih kamar sesuai kebutuhan dan kenyamanan Anda</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {{-- Card Kamar --}}
            @foreach ($rooms as $room)
            <div class="bg-white rounded-xl shadow-md p-6 flex flex-col justify-between">
                <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $room->name }}</h3>
                <p class="text-gray-600 mb-4">Kapasitas: {{ $room->capacity }} orang</p>
                </div>
                @if ($room->is_available)
                    <a href="{{ route('booking.store') }}"
                    class="mt-auto inline-block bg-indigo-600 hover:bg-indigo-700 text-white text-center py-2 px-4 rounded-lg transition duration-300">
                        Lihat Detail
                    </a>
                @else
                    <span class="mt-auto inline-block bg-gray-400 text-white text-center py-2 px-4 rounded-lg cursor-not-allowed opacity-70">
                        Booked
                    </span>
                @endif
            </div>
            @endforeach
        </section>   

        <section id="facilities" class="py-16 bg-gray-100">
            <div class="max-w-6xl mx-auto px-6 text-center mt-8">
                <h2 class="text-3xl font-bold mb-4 text-gray-800">Fasilitas Kami</h2>
                <p class="text-gray-600 mb-10">Kami menyediakan berbagai fasilitas terbaik untuk kenyamanan Anda. Fasilitas yang didapat tergantung dari jenis kamar yang Anda pilih</p>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-10">
                {{-- Fasilitas --}}
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                    <div class="text-indigo-600 text-4xl mb-3">📶</div>
                    <h3 class="font-semibold text-lg text-gray-800">WiFi Cepat</h3>
                </div>

                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                    <div class="text-indigo-600 text-4xl mb-3">❄️</div>
                    <h3 class="font-semibold text-lg text-gray-800">AC</h3>
                </div>

                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                    <div class="text-indigo-600 text-4xl mb-3">🚿</div>
                    <h3 class="font-semibold text-lg text-gray-800">Kamar Mandi Dalam</h3>
                </div>

                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                    <div class="text-indigo-600 text-4xl mb-3">🔒</div>
                    <h3 class="font-semibold text-lg text-gray-800">Keamanan 24 Jam</h3>
                </div>

                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                    <div class="text-indigo-600 text-4xl mb-3">🔒</div>
                    <h3 class="font-semibold text-lg text-gray-800">Keamanan 24 Jam</h3>
                </div>

                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                    <div class="text-indigo-600 text-4xl mb-3">🅿️</div>
                    <h3 class="font-semibold text-lg text-gray-800">Parkir Luas</h3>
                </div>

                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                    <div class="text-indigo-600 text-4xl mb-3">🍳</div>
                    <h3 class="font-semibold text-lg text-gray-800">Dapur Bersama</h3>
                </div>

                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                    <div class="text-indigo-600 text-4xl mb-3">🧹</div>
                    <h3 class="font-semibold text-lg text-gray-800">Cleaning Service</h3>
                </div>
                </div>
            </div>
        </section>

        <section id="contact" class="py-16 bg-white">
            <div class="max-w-6xl mx-auto px-6">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-4">Hubungi Kami</h2>
                <p class="text-center text-gray-600 mb-10">Punya pertanyaan atau ingin melihat kos? Hubungi kami melalui kontak di bawah ini.</p>

                <div class="grid md:grid-cols-2 gap-10">
                
                {{-- Info Kontak --}}
                <div class="space-y-6">
                    <div>
                    <h3 class="text-lg font-semibold text-gray-700">📍 Alamat</h3>
                    <p class="text-gray-600">Jl. Nyaman No. 123, Bandung, Jawa Barat</p>
                    </div>
                    <div>
                    <h3 class="text-lg font-semibold text-gray-700">📞 Telepon / WhatsApp</h3>
                    <p class="text-gray-600">+62 812-3456-7890</p>
                    </div>
                    <div>
                    <h3 class="text-lg font-semibold text-gray-700">✉️ Email</h3>
                    <p class="text-gray-600">info@kosnyaman.com</p>
                    </div>
                </div>

                {{-- Form Kontak --}}
                <form class="space-y-4">
                    <input type="text" placeholder="Nama" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <input type="email" placeholder="Email" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <textarea rows="4" placeholder="Pesan" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
                    <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition">Kirim Pesan</button>
                </form>
                </div>
                <div class="mt-12 w-full">
                    <iframe class="w-full h-64 rounded-lg shadow" 
                        src="https://www.google.com/maps/embed?pb=..." 
                        style="border:0;" allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>
        </section>

        <footer class="bg-gray-900 text-white py-8">
            <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-3 gap-8">

                <!-- Brand & Deskripsi -->
                <div>
                <h3 class="text-2xl font-bold text-indigo-500 mb-2">KosKu</h3>
                <p class="text-gray-400">Kos nyaman dengan fasilitas lengkap dan lokasi strategis di tengah kota.</p>
                </div>

                <!-- Navigasi -->
                <div>
                <h4 class="text-lg font-semibold mb-3">Navigasi</h4>
                <ul class="space-y-2">
                    <li><a href="#home" class="text-gray-400 hover:text-white">Beranda</a></li>
                    <li><a href="#rooms" class="text-gray-400 hover:text-white">Kamar</a></li>
                    <li><a href="#facilities" class="text-gray-400 hover:text-white">Fasilitas</a></li>
                    <li><a href="#contact" class="text-gray-400 hover:text-white">Kontak</a></li>
                </ul>
                </div>

                <!-- Kontak -->
                <div>
                <h4 class="text-lg font-semibold mb-3">Hubungi Kami</h4>
                <p class="text-gray-400">📞 +62 812-3456-7890</p>
                <p class="text-gray-400">✉️ info@kosnyaman.com</p>
                </div>

            </div>

            <!-- Copyright -->
            <div class="mt-8 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} KosKu. All rights reserved.
            </div>
        </footer>


    </body>
</html>
