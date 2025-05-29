<x-app-layout>
    <div class="dashboard-container">
        <x-sidebar />
        <main class="main-content">
            <x-header />
            <section class="room-detail-section">
                <div class="room-detail-header">
                    <div class="room-detail-images">
                        <img src="{{ asset('images/kost1.png') }}" alt="Kamar {{ $kamar->nomor_kamar }}"
                            class="room-main-image">
                        <div class="room-thumbnails">
                            <img src="{{ asset('images/kost1.png') }}" class="room-thumb" alt="Thumb 1">
                            <img src="{{ asset('images/kost2.png') }}" class="room-thumb" alt="Thumb 2">
                            <img src="{{ asset('images/image1.png') }}" class="room-thumb" alt="Thumb 3">
                        </div>
                    </div>
                    <div class="room-detail-info">
                        <h2>{{ $kamar->nomor_kamar }} - {{ $kamar->tipe_kamar }}</h2>
                        <div class="room-price">Rp {{ number_format($kamar->harga, 0, ',', '.') }} <span>/ Per
                                Bulan</span></div>
                        <form class="booking-form">
                            <label for="tanggal">Tanggal Masuk</label>
                            <input type="date" id="tanggal" name="tanggal">
                            <label for="durasi">Durasi</label>
                            <select id="durasi" name="durasi">
                                <option>1 Bulan</option>
                                <option>3 Bulan</option>
                                <option>6 Bulan</option>
                                <option>12 Bulan</option>
                            </select>
                            <input type="hidden" name="kamar_id" value="{{ $kamar->id }}">
                            <a href="{{ route('pemesanan.form', $kamar->id) }}" class="detail-btn">Booking Now</a>
                        </form>
                        <div class="total-section">
                            <div>Total Pembayaran Pertama</div>
                            <div class="total-amount">Rp {{ number_format($kamar->harga, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
                <div class="room-detail-body">
                    <h3>Spesifikasi {{ $kamar->tipe_kamar }}</h3>
                    <ul class="spec-list">
                        <li><span>&#10003;</span> Tidak termasuk listrik</li>
                    </ul>
                    <h3>Fasilitas Kamar</h3>
                    <ul class="facility-list">
                        @if(strtolower($kamar->tipe_kamar) == 'single')
                            <li><span>&#128716;</span> Single Bed</li>
                            <li><span>&#128705;</span> Kamar Mandi Dalam</li>
                            <li><span>&#128716;</span> Lemari</li>
                            <li><span>&#128716;</span> Meja</li>
                            <li><span>&#9881;</span> Kursi</li>
                            <li><span>&#128250;</span> TV</li>
                        @elseif(strtolower($kamar->tipe_kamar) == 'double')
                            <li><span>&#128716;</span> Double Bed</li>
                            <li><span>&#128705;</span> Kamar Mandi Dalam</li>
                            <li><span>&#128716;</span> Lemari Besar</li>
                            <li><span>&#128716;</span> Meja & Kursi</li>
                            <li><span>&#128250;</span> TV LED</li>
                            <li><span>&#128705;</span> Balkon</li>
                        @else
                            <li>Fasilitas tidak tersedia</li>
                        @endif
                    </ul>
                    <h3>Fasilitas Area Umum</h3>
                    <ul class="facility-list">
                        <li><span>&#127968;</span> Area Parkir</li>
                        <li><span>&#127969;</span> Ruang Duduk</li>
                    </ul>
                    <h3>Public Facilities</h3>
                    <ul class="facility-list">
                        <li><span>&#128703;</span> WiFi</li>
                        <li><span>&#9881;</span> CCTV</li>
                        <li><span>&#127859;</span> Pantry / Dapur</li>
                    </ul>
                    <h3>Deskripsi {{ $kamar->tipe_kamar }}</h3>
                    @if(strtolower($kamar->tipe_kamar) == 'single')
                        <p>Kamar {{ $kamar->nomor_kamar }} adalah kamar single yang nyaman, cocok untuk satu orang, dengan
                            fasilitas lengkap dan harga terjangkau.</p>
                    @elseif(strtolower($kamar->tipe_kamar) == 'double')
                        <p>Kamar {{ $kamar->nomor_kamar }} adalah kamar double yang luas, cocok untuk dua orang, dilengkapi
                            balkon dan lemari besar.</p>
                    @else
                        <p>Kamar {{ $kamar->nomor_kamar }} adalah kamar {{ strtolower($kamar->tipe_kamar) }} dengan
                            fasilitas lengkap, cocok untuk mahasiswa dan pekerja. Lokasi strategis, lingkungan nyaman, dan
                            keamanan 24 jam.</p>
                    @endif
                </div>
                <div class="room-detail-recommend">
    <h3>Tipe Kamar Lainnya</h3>
    <div class="recommend-cards">
        @foreach(
            \App\Models\Kamar::where('id', '!=', $kamar->id)
                ->where('tipe_kamar', $kamar->tipe_kamar)
                ->limit(2)
                ->get() as $lain
        )
            <div class="room-card">
                <img src="{{ asset('images/kost2.png') }}" alt="Kost {{ $lain->nomor_kamar }}">
                <div class="room-info">
                    <h4>{{ $lain->nomor_kamar }} - {{ $lain->tipe_kamar }}</h4>
                    <ul>
                        @if(strtolower($lain->tipe_kamar) == 'single')
                            <li><span>&#128716;</span> Single Bed</li>
                            <li><span>&#128705;</span> Kamar Mandi Dalam</li>
                        @elseif(strtolower($lain->tipe_kamar) == 'double')
                            <li><span>&#128716;</span> Double Bed</li>
                            <li><span>&#128705;</span> Kamar Mandi Dalam</li>
                        @endif
                    </ul>
                    <a href="{{ route('kamar.detail', $lain->id) }}" class="detail-btn">Lihat Detail</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
                <x-chatboot />
            </section>
            <x-footer />
        </main>
    </div>
    @vite([
        'resources/css/detail-kamar.css',
        'resources/js/detail-kamar.js',
        'resources/css/dashboard.css',
        'resources/js/dashboard.js',
        'resources/css/chatboot.css',
        'resources/js/chatboot.js'
    ])
</x-app-layout>