<x-app-layout>
    <div class="dashboard-container">
        <x-sidebar />
        <main class="main-content">
            <section class="keluhan-section">
                <h2 class="keluhan-title">Form Keluhan</h2>
                <form method="POST" action="{{ route('keluhan.store') }}" class="keluhan-form">
                    @csrf
                    <div class="keluhan-form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ old('nama', $user->nama ?? '') }}" readonly>
                    </div>
                    <div class="keluhan-form-group">
                        <label>Tipe Kamar Yang Dipilih</label>
                        <input type="text" name="tipe_kamar" value="{{ old('tipe_kamar', $kamar->tipe_kamar ?? '') }}"
                            readonly>
                    </div>
                    <div class="keluhan-form-group">
                        <label>Nomor Kamar Yang Dipilih</label>
                        <input type="text" name="nomor_kamar"
                            value="{{ old('nomor_kamar', $kamar->nomor_kamar ?? '') }}" readonly>
                        <input type="hidden" name="kamar_id" value="{{ $kamar->id ?? '' }}">
                    </div>
                    <div class="keluhan-form-group">
                        <label>Tanggal Laporan</label>
                        <input type="text" name="tanggal_lapor" value="{{ \Carbon\Carbon::now()->format('m/d/Y') }}"
                            readonly>
                    </div>
                    <div class="keluhan-form-group">
                        <label>Jenis Keluhan</label>
                        <select name="jenis_keluhan" required>
                            <option value="">Select</option>
                            <option value="Facility" {{ old('jenis_keluhan') == 'Facility' ? 'selected' : '' }}>Facility
                            </option>
                            <option value="Service" {{ old('jenis_keluhan') == 'Service' ? 'selected' : '' }}>Service
                            </option>
                            <option value="Other" {{ old('jenis_keluhan') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    <div class="keluhan-form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" rows="3" required>{{ old('keterangan') }}</textarea>
                    </div>
                    <div class="keluhan-form-actions">
                        <a href="{{ route('keluhan.index') }}" class="keluhan-btn-back">Back</a>
                        <button type="submit" class="keluhan-btn-submit">Submit a Complaint</button>
                    </div>
                </form>
            </section>
        </main>
    </div>
    @vite([
        'resources/css/form-keluhan.css',
        'resources/js/form-keluhan.js',
        'resources/css/dashboard.css',
        'resources/js/dashboard.js'
    ])
</x-app-layout>