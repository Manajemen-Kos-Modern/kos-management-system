<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kost Kita - {{ $title }}</title>
    
    <!-- Tailwind CSS -->
    @vite('resources/css/app.css')
    
    <!-- Font yang digunakan (opsional) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        #sidebar {
            transition: all 0.3s ease;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
        }
        .sidebar-collapsed {
            width: 4rem !important;
        }
        .sidebar-collapsed .sidebar-text {
            display: none;
        }
        .content-area {
            transition: margin-left 0.3s ease;
            min-height: 100vh;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
        <!-- Sidebar -->
        <div id="sidebar" class="w-48 bg-yellow-100 shadow-lg flex flex-col z-50">
            <div class="p-4 flex-shrink-0 border-b border-yellow-200">
                <h1 class="text-xl font-bold text-orange-500 sidebar-logo">Kost Kita</h1>
            </div>
            <nav class="flex-1 overflow-y-auto p-2">
                <ul class="space-y-1">
                    <li>
                        <a href="/dashboard-own" class="flex items-center p-2 text-orange-500 hover:bg-yellow-200 rounded-lg">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            <span class="sidebar-text">Dashboard</span>
                        </a>
                    </li>
                    <!-- Manajemen Kamar -->
                    <li>
                        <a href="/manajemen-kamar-own" class="flex items-center p-2 text-orange-500 hover:bg-yellow-200 rounded-lg">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            <span class="sidebar-text">Manajemen Kamar</span>
                        </a>
                    </li>

                    <!-- Manajemen Penyewa -->
                    <li>
                        <a href="/manajemen-penyewa-own" class="flex items-center p-2 text-orange-500 hover:bg-yellow-200 rounded-lg">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <span class="sidebar-text">Manajemen Penyewa</span>
                        </a>
                    </li>

                    <!-- Manajemen Pembayaran -->
                    <li>
                        <a href="/manajemen-pembayaran-own" class="flex items-center p-2 text-orange-500 hover:bg-yellow-200 rounded-lg">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <span class="sidebar-text">Manajemen Pembayaran</span>
                        </a>
                    </li>

                    <!-- Jadwal Pemeliharaan -->
                    <li>
                        <a href="/jadwal-pemeliharaan-own" class="flex items-center p-2 text-orange-500 hover:bg-yellow-200 rounded-lg">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="sidebar-text">Jadwal Pemeliharaan</span>
                        </a>
                    </li>

                    <!-- Notifikasi -->
                    <li>
                        <a href="/notifikasi-own" class="flex items-center p-2 text-orange-500 hover:bg-yellow-200 rounded-lg">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            <span class="sidebar-text">Notifikasi</span>
                        </a>
                    </li>

                    <!-- Keluhan -->
                    <li>
                        <a href="/keluhan-own" class="flex items-center p-2 text-orange-500 hover:bg-yellow-200 rounded-lg">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="sidebar-text">Keluhan</span>
                        </a>
                    </li>

                    <!-- Laporan & Keuangan -->
                    <li>
                        <a href="laporan-keuangan-own" class="flex items-center p-2 text-orange-500 hover:bg-yellow-200 rounded-lg">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span class="sidebar-text">Laporan & Keuangan</span>
                        </a>
                    </li>

                    <!-- Logout -->
                    <li>
                        <a href="/logout" class="flex items-center p-2 text-orange-500 hover:bg-yellow-200 rounded-lg">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            <span class="sidebar-text">Logout</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Content Area -->
    <div id="contentArea" class="content-area ml-48 p-6">
        <!-- Header -->
        <header class="bg-yellow-100 p-4 rounded-lg shadow-md mb-6 flex items-center justify-between">
            <div class="flex items-center">
                <button id="sidebarToggle" class="text-orange-500 hover:bg-yellow-200 p-2 rounded-lg mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <h2 class="text-xl font-semibold text-orange-500">@yield('header', 'Dashboard')</h2>
            </div>
        </header>

        <!-- Main Content -->
        <main class="space-y-6">
            @yield('content')
        </main>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const contentArea = document.getElementById('contentArea');
            const sidebarToggle = document.getElementById('sidebarToggle');

            // Load state
            const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            if(isCollapsed) {
                sidebar.classList.add('sidebar-collapsed');
                contentArea.classList.remove('ml-48');
                contentArea.classList.add('ml-16');
            }

            // Toggle function
            sidebarToggle.addEventListener('click', function() {
                const isCollapsed = sidebar.classList.contains('sidebar-collapsed');
                
                if(isCollapsed) {
                    sidebar.classList.remove('sidebar-collapsed');
                    contentArea.classList.remove('ml-16');
                    contentArea.classList.add('ml-48');
                } else {
                    sidebar.classList.add('sidebar-collapsed');
                    contentArea.classList.remove('ml-48');
                    contentArea.classList.add('ml-16');
                }
                
                localStorage.setItem('sidebarCollapsed', !isCollapsed);
            });
        });
    </script>
</body>
</html>