<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laporkan Keluhan</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <div class="form-container">
        <h2>Laporkan Keluhan</h2>

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('keluhan.store') }}" method="POST">
            @csrf

            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" required>

            <label for="no_kamar">No Kamar</label>
            <input type="text" name="no_kamar" id="no_kamar" required>

            <label for="detail">Detail Keluhan</label>
            <textarea name="detail" id="detail" rows="4" required></textarea>

            <button type="submit" class="btn-submit">Kirim Keluhan</button>
        </form>

        <a href="{{ route('keluhan.index') }}" class="back-link">← Kembali ke Riwayat Keluhan</a>
    </div>

</body>

</html>