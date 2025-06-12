<x-app-layout>
    <div class="dashboard-container">
        <x-sidebar />
        <main class="main-content" style="padding:32px;">
            <h2 style="font-weight:600;font-size:1.3em;margin-bottom:24px;">Informasi Kontrak</h2>
            @if($kontraks->count())
                <div style="overflow-x:auto;">
                    <table style="width:100%;border-collapse:collapse;margin-bottom:24px;">
                        <thead>
                            <tr style="background:#ffe082;">
                                <th style="padding:12px 8px;">Tanggal Mulai</th>
                                <th>Durasi Sewa</th>
                                <th>Tipe Kamar</th>
                                <th>No. Kamar</th>
                                <th>Waktu Pembayaran</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kontraks as $kontrak)
                                            <tr style="text-align:center;border-bottom:1px solid #ddd;">
                                                <td style="padding:10px 8px;">
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
                <div style="display:flex;gap:32px;flex-wrap:wrap;">
                    <div
                        style="flex:1;min-width:320px;border:1.5px solid #ffe082;border-radius:12px;padding:24px 20px;background:#fff;">
                        <b style="font-size:1.1em;">Pembayaran Kos</b>
                        <p style="margin:10px 0 18px 0;">
                            Untuk pembayaran kost setiap bulan, silahkan untuk transfer sejumlah :
                        </p>
                        <div style="font-size:2em;color:#e6b800;font-weight:bold;margin-bottom:10px;">
                            Rp{{ number_format($kontraks[0]->kamar->harga ?? 0, 0, ',', '.') }}
                        </div>
                        <button type="button"
                            onclick="navigator.clipboard.writeText('{{ $kontraks[0]->kamar->harga ?? 0 }}')"
                            style="margin-bottom:18px;padding:6px 18px;border-radius:6px;border:1px solid #ffe082;background:#fffbe6;cursor:pointer;">
                            Salin jumlah
                        </button>
                        <div style="margin-top:10px;">
                            <span>Pembayaran ke Bank berikut :</span>
                            <div style="background:#f4f4f4;padding:14px 10px;border-radius:8px;margin-top:8px;">
                                <img src="{{ asset('images/bca.png') }}" alt="BCA"
                                    style="height:38px;vertical-align:middle;">
                                <div style="margin:8px 0 2px 0;">No.Rek: <b>1234567890</b></div>
                                <div>Atas Nama: <b>Valentina</b></div>
                                <button type="button" onclick="navigator.clipboard.writeText('1234567890')"
                                    style="margin-top:8px;padding:4px 14px;border-radius:6px;border:1px solid #ffe082;background:#fffbe6;cursor:pointer;">
                                    Salin No.Rekening
                                </button>
                            </div>
                        </div>
                    </div>
                    <div style="flex:1;min-width:320px;">
                        <form method="POST" action="#" enctype="multipart/form-data"
                            style="background:#fff;padding:24px 20px;border-radius:12px;">
                            @csrf
                            <label style="font-weight:500;margin-bottom:8px;display:block;">Bukti Transfer</label>
                            <div style="display:flex;align-items:center;gap:12px;margin-bottom:18px;">
                                <label for="bukti_transfer"
                                    style="background:#ffe082;padding:8px 18px;border-radius:8px;cursor:pointer;">
                                    Pilih File
                                </label>
                                <input type="file" id="bukti_transfer" name="bukti_transfer" accept="image/*"
                                    style="display:none;">
                                <span id="file-name" style="color:#888;">Belum ada file dipilih</span>
                            </div>
                            <button type="submit"
                                style="background:#ffe082;padding:10px 38px;border-radius:8px;border:none;font-weight:600;cursor:pointer;">
                                Kirim
                            </button>
                        </form>
                        <script>
                            document.getElementById('bukti_transfer').addEventListener('change', function (e) {
                                document.getElementById('file-name').textContent = e.target.files[0]?.name || 'Belum ada file dipilih';
                            });
                        </script>
                    </div>
                </div>
            @else
                <p>Belum ada kontrak.</p>
            @endif
        </main>
        <x-chatboot />
    </div>
    @vite([
        'resources/css/dashboard.css',
        'resources/js/dashboard.js',
        'resources/css/chatboot.css',
        'resources/js/chatboot.js'
    ])
</x-app-layout>