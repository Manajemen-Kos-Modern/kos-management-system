<x-app-layout>
    <div class="dashboard-container">
        <x-sidebar />
        <main class="main-content">
            <x-header />
            <section class="room-list-section">
                @php
                    $hour = now()->format('H');
                    if ($hour >= 5 && $hour < 12) {
                        $greeting = 'Selamat pagi';
                    } elseif ($hour >= 12 && $hour < 15) {
                        $greeting = 'Selamat siang';
                    } elseif ($hour >= 15 && $hour < 18) {
                        $greeting = 'Selamat sore';
                    } else {
                        $greeting = 'Selamat malam';
                    }
                    $totalKamar = \App\Models\Kamar::count();
                    $dotCount = ceil($totalKamar / 5); // 5 kamar per slide
                @endphp
                <p class="greeting">{{ $greeting }}.</p>
                <div class="room-cards" id="roomCards">
                    @foreach (\App\Models\Kamar::all() as $kost)
                        <div class="room-card">
                            <img src="{{ asset('images/kost' . ($kost->id ?? 1) . '.png') }}"
                                alt="Kost {{ $kost->nomor_kamar ?? 'Type' }}">
                            <div class="room-info">
                                <h3>{{ $kost->nomor_kamar ?? 'ManKost' }} - {{ $kost->tipe_kamar ?? 'Type' }}</h3>
                                <ul>
                                    <li><span>&#128716;</span> Single Bed</li>
                                    <li><span>&#128705;</span> Kamar Mandi Dalam</li>
                                    <li><span>&#128716;</span> Furniture</li>
                                    <li><span>&#127777;</span> AC</li>
                                    <li><span>&#128250;</span> TV</li>
                                    <li><span>&#9881;</span> Utilities</li>
                                </ul>
                                @if($kost->status == 'terisi')
                                    <span style="color:red;font-weight:bold;display:block;margin-bottom:8px;">Terisi</span>
                                    <button class="detail-btn" disabled
                                        style="background:#eee;color:#aaa;cursor:not-allowed;">Booking Tidak Tersedia</button>
                                @else
                                    <a href="{{ route('kamar.detail', $kost->id) }}" class="detail-btn">Lihat Detail</a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="carousel-dots" id="carouselDots">
                    @for ($i = 0; $i < $dotCount; $i++)
                        <span class="dot{{ $i == 0 ? ' active' : '' }}" data-index="{{ $i }}"></span>
                    @endfor
                </div>
            </section>
            <x-footer />
        </main>
        <x-chatboot />
    </div>
    @vite([
        'resources/css/pengguna/dashboard.css',
        'resources/js/pengguna/dashboard.js',
        'resources/css/pengguna/chatboot.css',
        'resources/js/pengguna/chatboot.js',
    ])
</x-app-layout>