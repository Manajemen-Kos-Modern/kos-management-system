<x-app-layout>
    <div class="dashboard-container">
        <x-sidebar />
        <main class="main-content">
            @if(session('success'))
                <div class="success-alert">
                    {{ session('success') }}
                </div>
            @endif
            @if($errors->any())
                <div class="error-alert">
                    {{ $errors->first() }}
                </div>
            @endif
            <section class="room-order-section">
                <h2 class="section-title">Detail Pemesanan Kamar Kost</h2>
                <form method="POST" action="{{ route('pemesanan.store') }}" enctype="multipart/form-data"
                    class="order-form" id="bookingForm">
                    @csrf
                    <input type="hidden" name="kamar_id" value="{{ $kamar->id }}">
                    <input type="hidden" name="harga" value="{{ $kamar->harga }}">
                    <div>
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ old('nama', auth()->user()->nama ?? '') }}" required readonly>
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" required readonly>
                        <label>Nomor HP</label>
                        <input type="text" name="no_hp" value="{{ old('no_hp', auth()->user()->no_hp ?? '') }}" required readonly>
                        <label>Jenis Kelamin</label>
                        <select name="gender" required readonly onfocus="this.defaultIndex=this.selectedIndex;" onchange="this.selectedIndex=this.defaultIndex;">
                            <option value="">Pilih</option>
                            <option value="L" {{ (old('gender', auth()->user()->gender ?? '') == 'L') ? 'selected' : '' }}>Laki-Laki</option>
                            <option value="P" {{ (old('gender', auth()->user()->gender ?? '') == 'P') ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        <div class="payment-info">
                            <b>Pembayaran Pertama</b>
                            <p>Untuk menyelesaikan proses booking, lakukan pembayaran sesuai pilihan durasi dan metode pembayaran di bawah ini:</p>
                            <div id="totalPembayaran">
                                Rp{{ number_format($totalHarga ?? $kamar->harga, 0, ',', '.') }}
                            </div>
                            <button type="button" id="salin-jumlah">Salin Jumlah</button>
                            <div>
                                <b>Pembayaran ke Bank berikut:</b>
                                <div class="bank-info">
                                    <img src="{{ asset('images/bca.png') }}" alt="BCA">
                                    <span>No.Rek: <b>1234567890</b></span>
                                    <span>Atas Nama: <b>Valentina</b></span>
                                    <button type="button" id="salin-rekening">Salin No.Rekening</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label>Tanggal Mulai Kost</label>
                        <input type="date" name="tanggal_mulai" value="{{ request('tanggal') }}" required>
                        <label>Durasi Sewa</label>
                        <select name="durasi_sewa" id="durasi_sewa" required>
                            <option value="1" {{ request('durasi') == '1' ? 'selected' : '' }}>1 Bulan</option>
                            <option value="3" {{ request('durasi') == '3' ? 'selected' : '' }}>3 Bulan</option>
                            <option value="6" {{ request('durasi') == '6' ? 'selected' : '' }}>6 Bulan</option>
                            <option value="12" {{ request('durasi') == '12' ? 'selected' : '' }}>1 Tahun</option>
                        </select>
                        <label>Waktu Pembayaran</label>
                        <select name="waktu_pembayaran" id="waktu_pembayaran" required>
                            <option value="Per Bulan" {{ request('waktu_pembayaran') == 'Per Bulan' ? 'selected' : '' }}>Per Bulan</option>
                            <option value="Lunas" {{ request('waktu_pembayaran') == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                        </select>
                        <label>Tipe Kamar Yang Dipilih</label>
                        <input type="text" name="tipe_kamar" value="{{ $kamar->tipe_kamar }}" readonly>
                        <label>Nomor Kamar Yang Dipilih</label>
                        <input type="text" name="nomor_kamar" value="{{ $kamar->nomor_kamar }}" readonly>
                        <label>Bukti Transfer</label>
                        <input type="file" name="bukti_transfer" accept="image/*" required>
                        <button type="submit" class="detail-btn">Booking</button>
                        <div id="successModal">
                            <div class="modal-content">
                                <h3>Booking Berhasil!</h3>
                                <p>Pemesanan kamar Anda telah berhasil.<br>Silakan cek email untuk detail selanjutnya.</p>
                                <button id="closeSuccessModal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </form>
                <x-chatboot />
            </section>
            <x-footer />
        </main>
        <x-chatboot />
    </div>
    <script>window.hargaPerBulan = {{ $kamar->harga }};</script>
    @vite([
        'resources/css/pengguna/pemesanan-kamar.css',
        'resources/js/pengguna/pemesanan-kamar.js',
        'resources/css/pengguna/dashboard.css',
        'resources/js/pengguna/dashboard.js',
        'resources/css/pengguna/chatboot.css',
        'resources/js/pengguna/chatboot.js'
    ])
</x-app-layout>