<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    
    <!-- Tambahkan Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Tambahkan Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-100 text-gray-800">

    <div class="max-w-7xl mx-auto p-6 space-y-6">

        <h1 class="text-3xl font-bold mb-4">Welcome to Admin Dashboard</h1>

        <!-- Ringkasan -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <x-dashboard-card title="Total Kamar" :value="$totalKamar" />
            <x-dashboard-card title="Kamar Terisi" :value="$kamarTerisi" />
            <x-dashboard-card title="Kamar Kosong" :value="$kamarKosong" />
            <x-dashboard-card title="Total Pendapatan" :value="'Rp ' . number_format($totalPendapatan, 0, ',', '.')" />
        </div>

        <!-- Grafik -->
        <div class="bg-white p-4 rounded-lg shadow-md">
            <canvas id="grafikPendapatan" height="100"></canvas>
        </div>

    </div>

    <script>
        const ctx = document.getElementById('grafikPendapatan').getContext('2d');
        const data = {
            labels: [...Array(12)].map((_, i) => `Bulan ${i + 1}`),
            datasets: [{
                label: 'Pendapatan',
                data: @json(array_values($pendapatanTahunan->toArray())),
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };
        new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                scales: { y: { beginAtZero: true } }
            }
        });
    </script>

</body>

</html>
