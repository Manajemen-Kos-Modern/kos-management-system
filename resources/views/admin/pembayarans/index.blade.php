<table>
    <thead>
        <tr>
            <th>User</th>
            <th>Kontrak</th>
            <th>Harga</th>
            <th>Metode</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pembayarans as $pembayaran)
            <tr>
                <td>{{ $pembayaran->user->name }}</td>
                <td>{{ $pembayaran->kontrak->id }}</td>
                <td>Rp{{ number_format($pembayaran->harga, 0, ',', '.') }}</td>
                <td>{{ ucfirst($pembayaran->metode_pembayaran) }}</td>
                <td>{{ ucfirst($pembayaran->status) }}</td>
                <td>
                    @if ($pembayaran->status === 'pending')
                        <form action="{{ route('pembayarans.konfirmasi', $pembayaran->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit">Konfirmasi</button>
                        </form>
                        <form action="{{ route('pembayarans.tolak', $pembayaran->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit">Tolak</button>
                        </form>
                    @else
                        -
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
