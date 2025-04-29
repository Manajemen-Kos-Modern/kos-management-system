<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kamar</title>
</head>
<body>
    <h1>Tambah Data Kamar</h1>

    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    <form action="{{ route('admin.kamar.store') }}" method="POST">
        @csrf
        <label>Nomor Kamar:</label>
        <input type="text" name="nomor_kamar" required><br><br>

        <label>Tipe Kamar:</label>
        <input type="text" name="tipe_kamar" required><br><br>

        <label>Harga:</label>
        <input type="number" name="harga" required><br><br>

        <label>Status:</label>
        <select name="status" required>
            <option value="belum_terisi">Belum Terisi</option>
            <option value="terisi">Terisi</option>
        </select><br><br>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
