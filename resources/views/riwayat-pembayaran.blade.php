<x-app-layout>
    <div class="dashboard-container">
        <x-sidebar />
        <main class="main-content">
            <section class="riwayat-section">
                <div class="riwayat-header"
                    style="background: #FFF9DB; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
                    <h2 style="color: #E59866; text-align: center; font-weight: bold; font-size: 2rem; margin: 0;">
                        Riwayat Pembayaran
                    </h2>
                </div>
                <div class="riwayat-table-container">
                    <table class="riwayat-table" style="width:100%; border-collapse:collapse; background:#fff;">
                        <thead>
                            <tr style="border-bottom:2px solid #E59866;">
                                <th style="padding:8px;">No</th>
                                <th style="padding:8px;">NAMA</th>
                                <th style="padding:8px;">TANGGAL PEMBAYARAN</th>
                                <th style="padding:8px;">TOTAL TAGIHAN</th>
                                <th style="padding:8px;">TOTAL PEMBAYARAN</th>
                                <th style="padding:8px;">METODE</th>
                                <th style="padding:8px;">STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pembayarans as $i => $pembayaran)
                                <tr style="border-bottom:2px solid #222;">
                                    <td style="padding:8px; text-align:center;">{{ $i + 1 }}</td>
                                    <td style="padding:8px;">{{ auth()->user()?->nama ?? '-' }}</td>
                                    <td style="padding:8px;">
                                        {{ \Carbon\Carbon::parse($pembayaran->created_at)->format('d/m/Y') }}
                                    </td>
                                    <td style="padding:8px;">Rp {{ number_format($pembayaran->harga, 0, ',', '.') }}</td>
                                    <td style="padding:8px;">Rp {{ number_format($pembayaran->harga, 0, ',', '.') }}</td>
                                    <td style="padding:8px; text-transform:capitalize;">{{ $pembayaran->metode_pembayaran }}
                                    </td>
                                    <td style="padding:8px;">
                                        @if($pembayaran->status == 'dibayar')
                                            <span style="color:green; font-weight:bold;">Dibayar</span>
                                        @elseif($pembayaran->status == 'menunggu')
                                            <span style="color:orange; font-weight:bold;">Menunggu</span>
                                        @else
                                            <span style="color:red; font-weight:bold;">Gagal</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
    @vite([
        'resources/css/riwayat-pembayaran.css',
        'resources/css/dashboard.css',
        'resources/js/dashboard.js'
    ])
</x-app-layout>