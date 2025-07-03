<x-app-layout>
    <div class="dashboard-container">
        <x-sidebar />
        <main class="main-content">
            @if(session('success'))
                <div
                    style="background:#d4edda;color:#155724;padding:12px 20px;margin-bottom:20px;border-radius:6px;border:1px solid #c3e6cb;">
                    {{ session('success') }}
                </div>
            @endif
            @if($errors->any())
                <div
                    style="background:#f8d7da;color:#721c24;padding:12px 20px;margin-bottom:20px;border-radius:6px;border:1px solid #f5c6cb;">
                    {{ $errors->first() }}
                </div>
            @endif
            <section class="room-order-section">
                <h2 class="section-title" style="text-align:center;">Detail Pemesanan Kamar Kost</h2>
                <form method="POST" action="{{ route('pemesanan.store') }}" enctype="multipart/form-data"
                    class="order-form" style="display:flex;flex-wrap:wrap;gap:24px;" id="bookingForm">
                    @csrf
                    <input type="hidden" name="kamar_id" value="{{ $kamar->id }}">
                    <input type="hidden" name="harga" value="{{ $kamar->harga }}">
                    <div style="flex:1;min-width:320px;">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ old('nama', auth()->user()->nama ?? '') }}" required
                            readonly>
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}"
                            required readonly>
                        <label>Nomor HP</label>
                        <input type="text" name="no_hp" value="{{ old('no_hp', auth()->user()->no_hp ?? '') }}" required
                            readonly>
                        <label>Jenis Kelamin</label>
                        <select name="gender" required readonly onfocus="this.defaultIndex=this.selectedIndex;"
                            onchange="this.selectedIndex=this.defaultIndex;">
                            <option value="">Pilih</option>
                            <option value="L" {{ (old('gender', auth()->user()->gender ?? '') == 'L') ? 'selected' : '' }}>Laki-Laki</option>
                            <option value="P" {{ (old('gender', auth()->user()->gender ?? '') == 'P') ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        <div class="payment-info" style="margin-top:20px;">
                            <b>Pembayaran Pertama</b>
                            <p>Untuk menyelesaikan proses booking, lakukan pembayaran sesuai pilihan durasi dan metode
                                pembayaran di bawah ini:</p>
                            <div id="totalPembayaran" style="font-size:2em;color:#e6b800;font-weight:bold;">
                                Rp{{ number_format($totalHarga ?? $kamar->harga, 0, ',', '.') }}
                            </div>
                            <button type="button"
                                onclick="navigator.clipboard.writeText(document.getElementById('totalPembayaran').innerText.replace(/[^\d]/g, ''))">Salin
                                Jumlah</button>
                            <div style="margin-top:10px;">
                                <b>Pembayaran ke Bank berikut:</b>
                                <div style="background:#f4f4f4;padding:10px;border-radius:8px;">
                                    <img src="{{ asset('images/bca.png') }}" alt="BCA"
                                        style="height:50px;vertical-align:middle;">
                                    <span>No.Rek: <b>1234567890</b></span><br>
                                    <span>Atas Nama: <b>Valentina</b></span>
                                    <button type="button" onclick="navigator.clipboard.writeText('1234567890')">Salin
                                        No.Rekening</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="flex:1;min-width:320px;">
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
                            <option value="Per Bulan" {{ request('waktu_pembayaran') == 'Per Bulan' ? 'selected' : '' }}>
                                Per Bulan</option>
                            <option value="Lunas" {{ request('waktu_pembayaran') == 'Lunas' ? 'selected' : '' }}>Lunas
                            </option>
                        </select>
                        <label>Tipe Kamar Yang Dipilih</label>
                        <input type="text" name="tipe_kamar" value="{{ $kamar->tipe_kamar }}" readonly>
                        <label>Nomor Kamar Yang Dipilih</label>
                        <input type="text" name="nomor_kamar" value="{{ $kamar->nomor_kamar }}" readonly>
                        <label>Bukti Transfer</label>
                        <input type="file" name="bukti_transfer" accept="image/*" required>
                        <button type="submit" class="detail-btn" style="margin-top:24px;width:100%;">Booking</button>
                        <div id="successModal"
                            style="display:none;position:fixed;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,0.4);z-index:9999;align-items:center;justify-content:center;">
                            <div
                                style="background:#fff;padding:32px 24px;border-radius:12px;max-width:320px;text-align:center;box-shadow:0 2px 16px #0002;">
                                <h3 style="color:#27ae60;margin-bottom:16px;">Booking Berhasil!</h3>
                                <p>Pemesanan kamar Anda telah berhasil.<br>Silakan cek email untuk detail selanjutnya.
                                </p>
                                <button onclick="document.getElementById('successModal').style.display='none'"
                                    style="margin-top:18px;padding:8px 24px;background:#27ae60;color:#fff;border:none;border-radius:6px;cursor:pointer;">Tutup</button>
                            </div>
                        </div>
                        <script>
                            // Akumulasi harga otomatis sesuai pilihan dari halaman detail kamar
                            document.addEventListener('DOMContentLoaded', function () {
                                const hargaPerBulan = {{ $kamar->harga }};
                                const durasiSelect = document.getElementById('durasi_sewa');
                                const waktuPembayaranSelect = document.getElementById('waktu_pembayaran');
                                const totalPembayaran = document.getElementById('totalPembayaran');

                                // Set nilai awal dari query string jika ada
                                function setInitialValue() {
                                    const urlParams = new URLSearchParams(window.location.search);
                                    const durasi = urlParams.get('durasi');
                                    const waktu = urlParams.get('tipe_pembayaran');
                                    if (durasi && durasiSelect) durasiSelect.value = durasi;
                                    if (waktu && waktuPembayaranSelect) waktuPembayaranSelect.value = (waktu === 'lunas' ? 'Lunas' : 'Per Bulan');
                                }

                                function updateTotal() {
                                    const durasi = parseInt(durasiSelect.value);
                                    const waktu = waktuPembayaranSelect.value;
                                    let total = 0;

                                    if (waktu === 'Lunas') {
                                        total = hargaPerBulan * durasi;
                                    } else {
                                        total = hargaPerBulan;
                                    }
                                    totalPembayaran.textContent = 'Rp' + total.toLocaleString('id-ID');
                                }

                                setInitialValue();
                                durasiSelect.addEventListener('change', updateTotal);
                                waktuPembayaranSelect.addEventListener('change', updateTotal);
                                updateTotal();
                            });
                        </script>
                    </div>
                </form>
                <x-chatboot />
            </section>
            <x-footer />
        </main>
        <x-chatboot />
    </div>
    
    @vite([
        'resources/css/pengguna/pemesanan-kamar.css',
        'resources/css/pengguna/pemesanan-kamar.js',
        'resources/css/pengguna/dashboard.css',
        'resources/js/pengguna/dashboard.js',
        'resources/css/pengguna/chatboot.css',
        'resources/js/pengguna/chatboot.js'
    ])
</x-app-layout>