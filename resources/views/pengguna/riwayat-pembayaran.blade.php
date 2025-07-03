<x-app-layout>
    <div class="dashboard-container">
        <x-sidebar />
        <main class="main-content">
            <section class="riwayat-section">
                <div class="riwayat-header">
                    <h2>Riwayat Pembayaran</h2>
                </div>
                <div class="riwayat-table-container">
                    <table class="riwayat-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NAMA</th>
                                <th>TANGGAL PEMBAYARAN</th>
                                <th>TOTAL TAGIHAN</th>
                                <th>TOTAL PEMBAYARAN</th>
                                <th>METODE</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pembayarans as $i => $pembayaran)
                                <tr>
                                    <td data-label="No" style="text-align:center;">{{ $i + 1 }}</td>
                                    <td data-label="NAMA">{{ auth()->user()?->nama ?? '-' }}</td>
                                    <td data-label="TANGGAL PEMBAYARAN">
                                        {{ \Carbon\Carbon::parse($pembayaran->created_at)->format('d/m/Y') }}
                                    </td>
                                    <td data-label="TOTAL TAGIHAN">Rp {{ number_format($pembayaran->harga, 0, ',', '.') }}</td>
                                    <td data-label="TOTAL PEMBAYARAN">Rp {{ number_format($pembayaran->harga, 0, ',', '.') }}</td>
                                    <td data-label="METODE" style="text-transform:capitalize;">{{ $pembayaran->metode_pembayaran }}</td>
                                    <td data-label="STATUS">
                                        @if($pembayaran->status == 'dibayar')
                                            <span class="dibayar">Dibayar</span>
                                        @elseif($pembayaran->status == 'menunggu')
                                            <span class="menunggu">Menunggu</span>
                                        @else
                                            <span class="gagal">Gagal</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
        <x-chatboot />
    </div>
    @vite([
        'resources/css/pengguna/riwayat-pembayaran.css',
        'resources/js/pengguna/riwayat-pembayaran.js',
        'resources/css/pengguna/dashboard.css',
        'resources/js/pengguna/dashboard.js',
        'resources/css/pengguna/chatboot.css',
        'resources/js/pengguna/chatboot.js'
    ])
</x-app-layout>