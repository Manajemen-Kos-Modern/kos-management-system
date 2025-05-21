<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Riwayat Keluhan</title>
    @vite('resources/css/keluhan.css')
</head>

<body>

    <div class="form-container">
        <h2>Riwayat Keluhan</h2>

        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>No Kamar</th>
                    <th>Detail</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($keluhans as $keluhan)
                    <tr>
                        <td>{{ $keluhan->nama }}</td>
                        <td>{{ $keluhan->no_kamar }}</td>
                        <td>{{ $keluhan->detail }}</td>
                        <td>{{ $keluhan->created_at->format('d-m-Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('keluhan.create') }}" class="back-link">← Laporkan Keluhan Baru</a>
    </div>

</body>

</html>