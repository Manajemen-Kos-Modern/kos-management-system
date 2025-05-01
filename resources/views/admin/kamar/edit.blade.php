@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Edit Room</h1>
        <form action="{{ route('admin.kamar.update', $kamar) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Room Name</label>
                <input type="text" name="nomor_kamar" class="form-control" value="{{ $kamar->nomor_kamar }}" required>
            </div>
            <div class="form-group">
                <label>Room Type</label>
                <input type="text" name="tipe_kamar" class="form-control" value="{{ $kamar->tipe_kamar }}" required>
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="number" name="harga" class="form-control" value="{{ $kamar->harga }}" required>
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control" required>
                    <option value="tersedia" {{ $kamar->status == 'tersedia' ? 'selected' : '' }}>Available</option>
                    <option value="tidak" {{ $kamar->status == 'tidak' ? 'selected' : '' }}>Not Available</option>
                </select>
            </div>
            <div class="form-group">
                <label>User ID</label>
                <input type="number" name="user_id" class="form-control" value="{{ $kamar->user_id }}" required>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
@endsection