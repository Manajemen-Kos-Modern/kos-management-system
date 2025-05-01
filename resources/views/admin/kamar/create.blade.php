@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Create New Room</h1>
        <form action="{{ route('admin.kamar.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Room Name</label>
                <input type="text" name="nomor_kamar" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Room Type</label>
                <input type="text" name="tipe_kamar" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="number" name="harga" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control" required>
                    <option value="tersedia">Available</option>
                    <option value="tidak">Not Available</option>
                </select>
            </div>
            <div class="form-group">
                <label>User ID</label>
                <input type="number" name="user_id" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Create</button>
        </form>
    </div>
@endsection