<x-app-layout>
    <div class="dashboard-container">
        <x-sidebar />
        <main class="main-content">
            <x-header />
            <section class="room-list-section">
                <p class="greeting">Selamat pagi.</p>
                <div class="room-cards">
                    @foreach (\App\Models\Kamar::all() as $kost)
                        <div class="room-card">
                            <img src="{{ asset('images/kost' . ($kost->id ?? 1) . '.png') }}" alt="Kost {{ $kost->nomor_kamar ?? 'Type' }}">
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
                                <a href="{{ route('kamar.detail', $kost->id) }}" class="detail-btn">Lihat Detail</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="carousel-dots">
                    <span class="dot active"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                </div>
            </section>
            <x-chatboot />
            <x-footer />
        </main>
    </div>
    @vite([
        'resources/css/dashboard.css',
        'resources/js/dashboard.js',
        'resources/css/chatboot.css',
        'resources/js/chatboot.js'
    ])
</x-app-layout>