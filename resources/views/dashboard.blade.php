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
                <div class="room-cards" id="roomCards" style="scroll-behavior:smooth;">
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
                <script>
                    // Carousel dots scroll logic
                    document.addEventListener('DOMContentLoaded', function () {
                        const dots = document.querySelectorAll('.carousel-dots .dot');
                        const roomCards = document.getElementById('roomCards');
                        const cardWidth = document.querySelector('.room-card')?.offsetWidth || 320;
                        const gap = 24; // adjust if you use gap in CSS
                        const perSlide = 5;

                        dots.forEach(dot => {
                            dot.addEventListener('click', function () {
                                dots.forEach(d => d.classList.remove('active'));
                                this.classList.add('active');
                                const index = parseInt(this.getAttribute('data-index'));
                                const scrollTo = index * (cardWidth + gap) * perSlide;
                                roomCards.scrollTo({ left: scrollTo, behavior: 'smooth' });
                            });
                        });

                        // Optional: update active dot on scroll
                        roomCards.addEventListener('scroll', function () {
                            const scrollLeft = roomCards.scrollLeft;
                            const slide = Math.round(scrollLeft / ((cardWidth + gap) * perSlide));
                            dots.forEach((d, i) => d.classList.toggle('active', i === slide));
                        });
                    });
                </script>
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