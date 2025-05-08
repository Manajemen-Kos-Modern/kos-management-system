<div class="mb-3">
    <label class="form-label">Nama</label>
    <input type="text" name="nama" class="form-control" value="{{ old('nama', $kos->nama ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">No HP</label>
    <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $kos->no_hp ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Jenis Kelamin</label>
    <select name="jenis_kelamin" class="form-select" required>
        <option value="">-- Pilih --</option>
        <option value="Laki-laki"
            {{ old('jenis_kelamin', $kos->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
        <option value="Perempuan"
            {{ old('jenis_kelamin', $kos->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Kode Kamar</label>
    <input type="text" name="kode_kamar" class="form-control" value="{{ old('kode_kamar', $kos->kode_kamar ?? '') }}"
        required>
</div>

<div class="mb-3">
    <label class="form-label">Harga</label>
    <input type="number" name="harga" class="form-control" value="{{ old('harga', $kos->harga ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Tanggal Mulai</label>
    <input type="date" name="tanggal_mulai" class="form-control"
        value="{{ old('tanggal_mulai', $kos->tanggal_mulai ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Tanggal Selesai</label>
    <input type="date" name="tanggal_selesai" class="form-control"
        value="{{ old('tanggal_selesai', $kos->tanggal_selesai ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Status</label>
    <select name="status" class="form-select" required>
        <option value="Masuk" {{ old('status', $kos->status ?? '') == 'Masuk' ? 'selected' : '' }}>Masuk</option>
        <option value="Keluar" {{ old('status', $kos->status ?? '') == 'Keluar' ? 'selected' : '' }}>Keluar</option>
    </select>
</div>
