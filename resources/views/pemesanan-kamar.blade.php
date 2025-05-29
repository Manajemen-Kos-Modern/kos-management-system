<x-app-layout>
    <div class="dashboard-container">
        <x-sidebar />
        <main class="main-content">
            <section class="room-order-section">
                <h2 class="section-title" style="text-align:center;">Detail Pemesanan Kamar Kost</h2>
                <form method="POST" action="{{ route('pemesanan.store') }}" enctype="multipart/form-data" class="order-form" style="display:flex;flex-wrap:wrap;gap:24px;">
                    @csrf
                    <div style="flex:1;min-width:320px;">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ old('nama', auth()->user()->name ?? '') }}" required>
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" required>
                        <label>Nomor HP</label>
                        <input type="text" name="no_hp" value="{{ old('no_hp') }}" required>
                        <label>Alamat</label>
                        <input type="text" name="alamat" value="{{ old('alamat') }}" required>
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" required>
                            <option value="">Pilih</option>
                            <option value="Man">Man</option>
                            <option value="Women">Women</option>
                        </select>
                        <div class="payment-info" style="margin-top:20px;">
                            <b>Pembayaran Bulan Januari</b>
                            <p>Untuk menyelesaikan proses booking, lakukan pembayaran bulan Januari, silakan untuk transfer sejumlah</p>
                            <div style="font-size:2em;color:#e6b800;font-weight:bold;">Rp{{ number_format($kamar->harga,0,',','.') }}</div>
                            <button type="button" onclick="navigator.clipboard.writeText('{{ $kamar->harga }}')">Salin Jumlah</button>
                            <div style="margin-top:10px;">
                                <b>Pembayaran ke Bank berikut:</b>
                                <div style="background:#f4f4f4;padding:10px;border-radius:8px;">
                                    <img src="{{ asset('images/bca.png') }}" alt="BCA" style="height:24px;vertical-align:middle;">
                                    <span>No.Rek: <b>1234567890</b></span><br>
                                    <span>Atas Nama: <b>Valentina</b></span>
                                    <button type="button" onclick="navigator.clipboard.writeText('1234567890')">Salin No.Rekening</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="flex:1;min-width:320px;">
                        <label>Tanggal Mulai Kost</label>
                        <input type="date" name="tanggal_mulai" required>
                        <label>Durasi Sewa</label>
                        <select name="durasi_sewa" required>
                            <option value="1">1 Bulan</option>
                            <option value="3">3 Bulan</option>
                            <option value="6">6 Bulan</option>
                            <option value="12">1 Tahun</option>
                        </select>
                        <label>Waktu Pembayaran</label>
                        <select name="waktu_pembayaran" required>
                            <option value="Per Bulan">Per Bulan</option>
                            <option value="Lunas">Lunas</option>
                        </select>
                        <label>Tipe Kamar Yang Dipilih</label>
                        <input type="text" name="tipe_kamar" value="{{ $kamar->tipe_kamar }}" readonly>
                        <label>Nomor Kamar Yang Dipilih</label>
                        <input type="text" name="nomor_kamar" value="{{ $kamar->nomor_kamar }}" readonly>
                        <label>Bukti Transfer</label>
                        <input type="file" name="bukti_transfer" accept="image/*" required>
                        <button type="submit" class="detail-btn" style="margin-top:24px;width:100%;">Booking</button>
                    </div>
                </form>
                <x-chatboot />
            </section>
            <x-footer />
        </main>
    </div>
    @vite([
        'resources/css/pemesanan-kamar.css',
        'resources/css/pemesanan-kamar.js',
        'resources/css/dashboard.css',
        'resources/js/dashboard.js',
        'resources/css/chatboot.css',
        'resources/js/chatboot.js'
    ])
</x-app-layout>