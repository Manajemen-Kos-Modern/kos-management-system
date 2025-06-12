<x-app-layout>
    <div class="dashboard-container">
        <x-sidebar />
        <main class="main-content">
            <section class="keluhan-section">
                <h2 class="keluhan-title">Detail Keluhan</h2>
                <div class="keluhan-detail-card">
                    <div class="keluhan-detail-row">
                        <span class="keluhan-label">Nama Lengkap</span>
                        <span class="keluhan-colon">:</span>
                        <span class="keluhan-value">{{ $keluhan->user->nama ?? '-' }}</span>
                    </div>
                    <div class="keluhan-detail-row">
                        <span class="keluhan-label">Tipe Kamar</span>
                        <span class="keluhan-colon">:</span>
                        <span class="keluhan-value">{{ $keluhan->kamar->tipe_kamar ?? '-' }}</span>
                    </div>
                    <div class="keluhan-detail-row">
                        <span class="keluhan-label">Nomor Kamar</span>
                        <span class="keluhan-colon">:</span>
                        <span class="keluhan-value">{{ $keluhan->kamar->nomor_kamar ?? '-' }}</span>
                    </div>
                    <div class="keluhan-detail-row">
                        <span class="keluhan-label">Tanggal Lapor</span>
                        <span class="keluhan-colon">:</span>
                        <span
                            class="keluhan-value">{{ \Carbon\Carbon::parse($keluhan->created_at)->format('d/m/Y') }}</span>
                    </div>
                    <div class="keluhan-detail-row">
                        <span class="keluhan-label">Jenis Keluhan</span>
                        <span class="keluhan-colon">:</span>
                        <span class="keluhan-value">{{ $keluhan->jenis_keluhan ?? '-' }}</span>
                    </div>
                    <div class="keluhan-detail-row">
                        <span class="keluhan-label">Keterangan</span>
                        <span class="keluhan-colon">:</span>
                        <span class="keluhan-value">{{ $keluhan->keterangan }}</span>
                    </div>
                    <div class="keluhan-detail-row">
                        <span class="keluhan-label">Status</span>
                        <span class="keluhan-colon">:</span>
                        <span class="keluhan-value">{{ ucfirst($keluhan->status) }}</span>
                    </div>
                </div>
                <div class="keluhan-form-actions" style="margin-top:24px;">
                    <a href="{{ route('keluhan.index') }}" class="keluhan-btn-back">Back</a>
                </div>
            </section>
        </main>
    </div>
    @vite([
        'resources/css/detail-keluhan.css',
        'resources/js/detail-keluhan.js',
        'resources/css/dashboard.css',
        'resources/js/dashboard.js'
    ])
</x-app-layout>