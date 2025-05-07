<!-- resources/views/dashboard/index.blade.php -->
@extends('layouts.index')

@section('header', 'Dashboard')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <!-- Statistik Utama -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-blue-50 p-4 rounded-lg shadow">
            <h4 class="text-sm text-blue-800 font-medium">Total Kamar</h4>
            <p class="text-2xl font-bold text-blue-600">20</p>
        </div>
        
        <div class="bg-green-50 p-4 rounded-lg shadow">
            <h4 class="text-sm text-green-800 font-medium">Kamar Terisi</h4>
            <p class="text-2xl font-bold text-green-600">15</p>
        </div>
        
        <div class="bg-yellow-50 p-4 rounded-lg shadow">
            <h4 class="text-sm text-yellow-800 font-medium">Kamar Kosong</h4>
            <p class="text-2xl font-bold text-yellow-600">5</p>
        </div>
        
        <div class="bg-purple-50 p-4 rounded-lg shadow">
            <h4 class="text-sm text-purple-800 font-medium">Total Pendapatan</h4>
            <p class="text-2xl font-bold text-purple-600">Rp 12.500.000</p>
        </div>
    </div>

    <!-- Konten Bawah -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Notifikasi -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow p-4 h-full">
                <h4 class="font-medium text-gray-700 mb-3">Notifikasi</h4>
                <div class="space-y-3">
                    <div class="p-3 bg-yellow-50 rounded-lg">
                        <div class="flex items-start">
                            <div class="flex-1">
                                <h4 class="text-sm font-medium text-yellow-800">Complaint</h4>
                                <p class="text-sm text-gray-600 mt-1">From Heidi Turner: have paid the rental fee</p>
                                <span class="text-xs text-gray-400 mt-1 block">2 jam yang lalu</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-3 bg-red-50 rounded-lg">
                        <div class="flex items-start">
                            <div class="flex-1">
                                <h4 class="text-sm font-medium text-red-800">Late Payment</h4>
                                <p class="text-sm text-gray-600 mt-1">Heidi Turner late paying rent</p>
                                <span class="text-xs text-gray-400 mt-1 block">5 jam yang lalu</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik Pendapatan -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow p-4 h-full">
                <h4 class="font-medium text-gray-700 mb-3">Grafik Pendapatan Tahunan</h4>
                <div class="h-64">
                    <canvas id="incomeChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Grafik
    const ctx = document.getElementById('incomeChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Pendapatan (Juta Rupiah)',
                data: [12, 15, 13, 17, 20, 18, 22, 24, 20, 25, 23, 28],
                borderColor: '#6366f1',
                tension: 0.4,
                fill: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value + ' jt';
                        }
                    }
                }
            }
        }
    });
</script>
@endsection