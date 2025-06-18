<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-white shadow p-4">
        <div class="container mx-auto">
            <a class="text-xl font-bold text-orange-500" href="{{ route('admin.dashboard') }}">Admin Panel</a>
        </div>
    </nav>

    <!-- Wrapper -->
    <div class="flex flex-1">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r min-h-screen">
            <nav class="flex flex-col p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-orange-500">Dashboard</a>
                <a href="{{ route('admin.penyewa.index') }}" class="text-gray-700 hover:text-orange-500">Manajemen Penyewa</a>
                <a href="{{ route('admin.kamar.index') }}" class="text-gray-700 hover:text-orange-500">Manajemen Kamar</a>
                <a href="{{ route('admin.keluhan.index') }}" class="text-gray-700 hover:text-orange-500">Manajemen Keluhan</a>
                <a href="{{ route('admin.kontrak.index') }}" class="text-gray-700 hover:text-orange-500">Manajemen Kontrak</a>
                <a href="{{ route('admin.pembayarans.index') }}" class="text-gray-700 hover:text-orange-500">Manajemen Pembayaran</a>
                <a href="{{ route('admin.pemeliharaan.index') }}" class="text-gray-700 hover:text-orange-500">Manajemen Pemeliharaan</a>
                <a href="{{ route('admin.notifikasi.index') }}" class="text-gray-700 hover:text-orange-500">Manajemen Notifikasi</a>
            </nav>
        </aside>

        <!-- Content Area -->
        <main class="flex-1 p-6">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

</body>
</html>