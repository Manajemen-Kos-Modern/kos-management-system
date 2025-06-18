<div class="space-y-4">
    <div>
        <label class="block text-gray-700">Nama</label>
        <input type="text" name="nama"
               value="{{ old('nama', $penyewa->nama ?? '') }}"
               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-orange-400"
               required>
    </div>

    <div>
        <label class="block text-gray-700">No HP</label>
        <input type="text" name="no_hp"
               value="{{ old('no_hp', $penyewa->no_hp ?? '') }}"
               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-orange-400"
               required>
    </div>

    <div>
        <label class="block text-gray-700">Jenis Kelamin</label>
        <select name="gender"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-orange-400"
                required>
            <option value="">-- Pilih --</option>
            <option value="L" {{ old('gender', $penyewa->gender ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
            <option value="P" {{ old('gender', $penyewa->gender ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
        </select>
    </div>

    <div>
        <label class="block text-gray-700">Kode Kamar</label>
        <input type="text" name="kode_kamar"
               value="{{ old('kode_kamar', $penyewa->kode_kamar ?? '') }}"
               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-orange-400"
               required>
    </div>

    <div>
        <label class="block text-gray-700">Harga</label>
        <input type="number" name="harga"
               value="{{ old('harga', $penyewa->harga ?? '') }}"
               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-orange-400"
               required>
    </div>

    <div>
        <label class="block text-gray-700">Tanggal Mulai</label>
        <input type="date" name="tanggal_mulai"
               value="{{ old('tanggal_mulai', $penyewa->tanggal_mulai ?? '') }}"
               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-orange-400"
               required>
    </div>

    <div>
        <label class="block text-gray-700">Tanggal Selesai</label>
        <input type="date" name="tanggal_selesai"
               value="{{ old('tanggal_selesai', $penyewa->tanggal_selesai ?? '') }}"
               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-orange-400">
    </div>

    <div>
        <label class="block text-gray-700">Status</label>
        <select name="status"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-orange-400"
                required>
            <option value="Masuk" {{ old('status', $penyewa->status ?? '') == 'Masuk' ? 'selected' : '' }}>Masuk</option>
            <option value="Keluar" {{ old('status', $penyewa->status ?? '') == 'Keluar' ? 'selected' : '' }}>Keluar</option>
        </select>
    </div>
</div>
