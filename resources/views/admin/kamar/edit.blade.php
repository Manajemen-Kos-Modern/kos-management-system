<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Kamar</title>
    <!-- (CSS tetap seperti yang kamu buat sebelumnya) -->
</head>
<body>
    <div class="container">
        <h2>Edit Kamar</h2>
        <form action="{{ route('admin.kamar.update', $kamar->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <label for="nomor_kamar">Nomor Kamar</label>
            <input type="text" name="nomor_kamar" id="nomor_kamar" value="{{ $kamar->nomor_kamar }}" required>

            <label for="tipe_kamar">Tipe Kamar</label>
            <input type="text" name="tipe_kamar" id="tipe_kamar" value="{{ $kamar->tipe_kamar }}" required>

            <label for="harga">Harga</label>
            <input type="number" name="harga" id="harga" value="{{ $kamar->harga }}" required>

            <label for="status">Status</label>
            <select name="status" id="status" required>
                <option value="belum_terisi" {{ $kamar->status == 'belum_terisi' ? 'selected' : '' }}>Belum Terisi</option>
                <option value="terisi" {{ $kamar->status == 'terisi' ? 'selected' : '' }}>Terisi</option>
            </select>

            <button type="submit">Update</button>
        </form>
        <a href="{{ route('admin.kamar.index') }}">← Kembali ke daftar</a>
    </div>
</body>
</html>
