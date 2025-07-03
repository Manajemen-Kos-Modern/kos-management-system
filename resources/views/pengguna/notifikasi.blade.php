<x-app-layout>
    <div class="dashboard-container">
        <x-sidebar />
        <main class="main-content">
            <section class="notification-section">
                <h2 class="notification-title">Notification</h2>
                <div class="notification-list">
                    @php
                        $today = \Carbon\Carbon::today();
                        $notifikasiToday = $notifikasi->where('waktu_kirim', '>=', $today);
                        $notifikasiLastWeek = $notifikasi->where('waktu_kirim', '<', $today);
                    @endphp

                    <div class="notification-group">
                        <div class="notification-group-title">Today</div>
                        @forelse($notifikasiToday as $notif)
                            <div class="notification-card">{{ $notif->pesan }}</div>
                        @empty
                            <div class="notification-empty">No notification today.</div>
                        @endforelse
                    </div>

                    <div class="notification-group">
                        <div class="notification-group-title">Last Week</div>
                        @forelse($notifikasiLastWeek as $notif)
                            <div class="notification-card">{{ $notif->pesan }}</div>
                        @empty
                            <div class="notification-empty">No notification last week.</div>
                        @endforelse
                    </div>
                </div>
            </section>
        </main>
        <x-chatboot />
    </div>

    @vite([
        'resources/css/pengguna/notifikasi.css',
        'resources/js/pengguna/notifikasi.js',
        'resources/css/pengguna/dashboard.css',
        'resources/js/pengguna/dashboard.js',
        'resources/css/pengguna/chatboot.css',
        'resources/js/pengguna/chatboot.js'
    ])
</x-app-layout>