@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Room Management</h1>
        <a href="{{ route('admin.kamar.create') }}" class="btn btn-primary">Add Room</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Room</th>
                    <th>Price/Month</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kamars as $kamar)
                    <tr>
                        <td>{{ $kamar->id }}</td>
                        <td>{{ $kamar->nomor_kamar }}</td>
                        <td>IDR {{ number_format($kamar->harga, 2) }}</td>
                        <td>
                            <a href="{{ route('admin.kamar.edit', $kamar) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.kamar.destroy', $kamar) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $kamars->links() }}
    </div>
@endsection