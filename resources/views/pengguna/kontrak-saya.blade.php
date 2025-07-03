<x-app-layout>
    <div class="dashboard-container">
        <x-sidebar />
        <main class="main-content" style="padding:32px;">
            <h2 style="font-weight:600;font-size:1.3em;margin-bottom:24px;">Informasi Kontrak</h2>
            @if($kontraks->count())
                <div class="kontrak-table-container">
                    <table class="kontrak-table">
                        <thead>
                            <tr>
                                <th>Tanggal Mulai</th>
                                <th>Durasi Sewa</th>
                                <th>Tipe Kamar</th>
                                <th>No. Kamar</th>
                                <th>Waktu Pembayaran</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kontraks as $kontrak)
                                <tr>
                                    <td>
                                        {{ \Carbon\Carbon::parse($kontrak->tanggal_mulai)->format('d/m/Y') }}
                                    </td>
                                    <td>
                                        {{ $kontrak->durasi_sewa == 12 ? '1 Tahun' : $kontrak->durasi_sewa . ' Bulan' }}
                                    </td>
                                    <td>{{ $kontrak->kamar->tipe_kamar ?? '-' }}</td>
                                    <td>{{ $kontrak->kamar->nomor_kamar ?? '-' }}</td>
                                    <td>
                                        {{ $kontrak->pembayaran && $kontrak->pembayaran->created_at
                                            ? \Carbon\Carbon::parse($kontrak->pembayaran->created_at)->format('d/m/Y H:i')
                                            : '-' }}
                                    </td>
                                    <td>
                                        Rp {{ number_format($kontrak->pembayaran->harga ?? 0, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="kontrak-flex">
                    <div class="kontrak-pembayaran">
                        <b>Pembayaran Kos</b>
                        <p style="margin:10px 0 18px 0;">
                            Untuk pembayaran kost setiap bulan, silahkan untuk transfer sejumlah :
                        </p>
                        <div class="kontrak-harga">
                            Rp{{ number_format($kontraks[0]->kamar->harga ?? 0, 0, ',', '.') }}
                        </div>
                        <button type="button"
                            id="salin-jumlah"
                            class="kontrak-btn"
                            data-jumlah="{{ $kontraks[0]->kamar->harga ?? 0 }}">
                            Salin jumlah
                        </button>
                        <div style="margin-top:10px;">
                            <span>Pembayaran ke Bank berikut :</span>
                            <div class="kontrak-bank-info">
                                <img src="{{ asset('images/bca.png') }}" alt="BCA">
                                <div style="margin:8px 0 2px 0;">No.Rek: <b>1234567890</b></div>
                                <div>Atas Nama: <b>Valentina</b></div>
                                <button type="button"
                                    id="salin-rekening"
                                    class="kontrak-btn"
                                    data-norek="1234567890">
                                    Salin No.Rekening
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="kontrak-form-container">
                        <form method="POST" action="#" enctype="multipart/form-data" class="kontrak-form">
                            @csrf
                            <label>Bukti Transfer</label>
                            <div class="kontrak-form-file">
                                <label for="bukti_transfer" class="kontrak-form-file-label">
                                    Pilih File
                                </label>
                                <input type="file" id="bukti_transfer" name="bukti_transfer" accept="image/*">
                                <span id="file-name" class="kontrak-form-file-name">Belum ada file dipilih</span>
                            </div>
                            <button type="submit" class="kontrak-form-btn">
                                Kirim
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <p>Belum ada kontrak.</p>
            @endif
        </main>
        <x-chatboot />
    </div>
    @vite([
        'resources/css/pengguna/dashboard.css',
        'resources/js/pengguna/dashboard.js',
        'resources/css/pengguna/chatboot.css',
        'resources/js/pengguna/chatboot.js',
        'resources/css/pengguna/kontrak-saya.css',
        'resources/js/pengguna/kontrak-saya.js'
    ])
</x-app-layout>