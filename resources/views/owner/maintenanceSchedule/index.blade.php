@extends('layouts.index')

@section('header', 'Jadwal Pemeliharaan')

@section('content')
    <!-- Flash Message with Auto-dismiss and close button -->
    @if (session('success') || session('error'))
        <div id="notification" class="{{ session('success') ? 'bg-green-100 border-l-4 border-green-500 text-green-700' : 'bg-red-100 border-l-4 border-red-500 text-red-700' }} p-4 mb-6 rounded relative" role="alert">
            <span>{{ session('success') ?? session('error') }}</span>
            <button type="button" class="absolute top-0 right-0 mt-3 mr-3" onclick="closeNotification()">
                <svg class="h-4 w-4 text-gray-500 hover:text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

    <!-- Tombol Tambah Pemeliharaan -->
    <div class="mb-4">
        <a href="{{ route('jadwalPemeliharaan.create') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded inline-flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Tambah Pemeliharaan
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-yellow-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-orange-500 uppercase tracking-wider">Jadwal</th>
                    @foreach ($days as $day)
                        <th class="px-6 py-3 text-left text-xs font-medium text-orange-500 uppercase tracking-wider">{{ $day }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($times as $time)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap bg-gray-100">
                            {{ $time }} - {{ Carbon\Carbon::parse($time)->add(59, 'minute')->format('H:i') }}
                        </td>
                        @foreach ($days as $day)
                            <td class="px-6 py-4 whitespace-nowrap border">
                                @if (isset($schedules[$day][$time]))
                                    @foreach ($schedules[$day][$time] as $pemeliharaan)
                                        <a href="{{ route('jadwalPemeliharaan.show', $pemeliharaan->id) }}" class="block mb-2">
                                            <div class="bg-yellow-100 p-3 rounded-md hover:bg-yellow-200 transition-colors cursor-pointer border border-yellow-300">
                                                <div class="font-medium text-yellow-800">
                                                    Kamar: {{ $pemeliharaan->kamar->nama_kamar ?? 'Kamar #'.$pemeliharaan->kamar_id }}
                                                </div>
                                                <div class="text-xs text-gray-600 mt-1">
                                                    <span class="inline-block px-2 py-1 {{ $pemeliharaan->status == 'sedang-proses' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }} rounded-full text-xs">
                                                        {{ $pemeliharaan->status == 'sedang-proses' ? 'Sedang Proses' : 'Selesai' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function closeNotification() {
            document.getElementById('notification').style.display = 'none';
        }
        
        // Auto-dismiss notification after 5 seconds
        setTimeout(function() {
            var notification = document.getElementById('notification');
            if (notification) {
                notification.style.display = 'none';
            }
        }, 5000);
    </script>
@endsection