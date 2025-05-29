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
                <x-chatboot />
            </section>
        </main>
    </div>
    @vite(['resources/css/notifikasi.css',
                         'resources/js/notifikasi.js',
                         'resources/css/dashboard.css',
                         'resources/js/dashboard.js',
                         'resources/css/chatboot.css',
                         'resources/js/chatboot.js'])
</x-app-layout>