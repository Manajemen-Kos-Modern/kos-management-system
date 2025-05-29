<x-app-layout>
    <div class="dashboard-container">
        <x-sidebar />
        <main class="main-content">
            <section class="keluhan-section">
                <h2 class="keluhan-title">Laporkan Keluhan</h2>
                <div class="keluhan-action">
                    <a href="{{ route('keluhan.form') }}" class="keluhan-btn-report">+ Report a Complaint</a>
                </div>
                <div class="keluhan-history-title">Complaint history</div>
                <div class="keluhan-table-wrapper">
                    <table class="keluhan-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>No Kamar</th>
                                <th>Detail Keluhan</th>
                                <th>Tanggal Lapor</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($keluhan as $k => $item)
                                <tr>
                                    <td>{{ $k+1 }}</td>
                                    <td>{{ $item->user->name ?? '-' }}</td>
                                    <td>{{ $item->kamar->nomor_kamar ?? '-' }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('m/d/Y') }}</td>
                                    <td>
                                        <a href="{{ route('keluhan.detail', $item->id) }}" class="keluhan-btn-detail">Detail</a>
                                        @if($item->status == 'done')
                                            <span class="keluhan-btn-done">Done</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align:center;color:#bbb;">Belum ada keluhan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            <x-chatboot/>
            </section>
        </main>
    </div>
    @vite(['resources/css/keluhan.css',
                        'resources/js/keluhan.js',
                        'resources/css/dashboard.css',
                        'resources/js/dashboard.js',
                        'resources/css/chatboot.css',
                        'resources/js/chatboot.js'
                        
                        ])
</x-app-layout>