<thead>
    <tr>
        <th>No</th>
        <th>Nomor Kamar</th>
        <th>Tipe Kamar</th>
        <th>Harga</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
</thead>
<tbody>
    @forelse ($kamars as $index => $kamar)
    <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $kamar->nomor_kamar }}</td>
        <td>{{ $kamar->tipe_kamar }}</td>
        <td>Rp {{ number_format($kamar->harga, 0, ',', '.') }}</td>
        <td>{{ ucfirst(str_replace('_', ' ', $kamar->status)) }}</td>
        <td>
            <a href="{{ route('admin.kamar.edit', $kamar->id) }}" class="btn">Edit</a>
            <form action="{{ route('admin.kamar.destroy', $kamar->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn" style="background-color:#ffb3ba;" onclick="return confirm('Yakin ingin hapus kamar ini?')">Hapus</button>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="6">Belum ada data kamar.</td>
    </tr>
    @endforelse
</tbody>
