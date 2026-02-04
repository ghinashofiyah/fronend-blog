@extends('layout.App')

@section('title', 'Dashboard - Portal Blog')

@section('content')
<div class="min-h-screen bg-[#fbfbfc] p-5 font-sans max-w-7xl mx-auto">

    <!-- Page Title -->
    <h1 class="text-[28px] font-bold mb-6
               bg-gradient-to-r from-gray-800 to-[#4988C4]
               bg-clip-text text-transparent">
        Dashboard Portal Blog
    </h1>

    <!-- Stats Cards -->
    <div class="flex flex-wrap gap-5 mb-9">
        <!-- Card -->
        <div class="flex-1 min-w-[200px] text-center px-9 py-6 rounded-xl
                    bg-gradient-to-r from-[#4988C4] to-[#4988C4]
                    transition-all duration-300
                    hover:-translate-y-1 hover:shadow-lg">
            <div class="text-sm text-white/95 mb-2 font-medium tracking-wide">
                📰 Jumlah Berita
            </div>
            <div class="text-4xl font-bold text-white">
                {{ $jumlahBerita ?? 131 }}
            </div>
        </div>

        <div class="flex-1 min-w-[200px] text-center px-9 py-6 rounded-xl
                    bg-gradient-to-r from-[#4988C4] to-[#4988C4]
                    transition-all duration-300
                    hover:-translate-y-1 hover:shadow-lg">
            <div class="text-sm text-white/95 mb-2 font-medium tracking-wide">
                ✅ Berita Published
            </div>
            <div class="text-4xl font-bold text-white">
                {{ $beritaPublished ?? 98 }}
            </div>
        </div>

        <div class="flex-1 min-w-[200px] text-center px-9 py-6 rounded-xl
                    bg-gradient-to-r from-[#4988C4] to-[#4988C4]
                    transition-all duration-300
                    hover:-translate-y-1 hover:shadow-lg">
            <div class="text-sm text-white/95 mb-2 font-medium tracking-wide">
                📝 Berita Draft
            </div>
            <div class="text-4xl font-bold text-white">
                {{ $beritaDraft ?? 33 }}
            </div>
        </div>
    </div>

    <!-- Diagram -->
    <div class="relative bg-white rounded-2xl p-8 mb-9
                shadow-[0_4px_20px_rgba(0,0,0,0.08)]
                border-t-4 border-[#4988C4]">
        <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center gap-2">
            <span class="text-2xl">📊</span> Diagram Data Viewers
        </h2>
        <canvas id="myChart" class="max-h-[350px] w-full"></canvas>
    </div>

    <!-- Berita Section -->
    <div class="grid grid-cols-1 lg:grid-cols-[73%_25%] gap-6">

        <!-- Berita Terbaru -->
        <div>
            <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center gap-2">
                <span class="text-2xl">🔥</span> Berita Terbaru
            </h2>

            <div class="relative bg-white rounded-2xl overflow-hidden
                        shadow-[0_4px_20px_rgba(0,0,0,0.08)]
                        border-t-4 border-[#4988C4]">
                <table class="w-full border-collapse text-sm">
                    <thead class="bg-gradient-to-r from-gray-100 to-gray-200 border-b-2">
                        <tr class="text-gray-800 font-semibold">
                            <th class="p-4 text-center w-[5%]">No</th>
                            <th class="p-4 text-left w-[12%]">Gambar</th>
                            <th class="p-4 text-left w-[30%]">Judul</th>
                            <th class="p-4 text-center w-[8%]">Admin</th>
                            <th class="p-4 text-left w-[15%]">Nama</th>
                            <th class="p-4 text-center w-[15%]">Status</th>
                            <th class="p-4 text-center w-[15%]">Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b transition hover:bg-gradient-to-r hover:from-gray-100 hover:to-gray-200">
                            <td class="p-4 text-center font-semibold text-gray-600">1</td>
                            <td class="p-4">
                                <img src="https://via.placeholder.com/80x60"
                                     class="w-[80px] h-[60px] rounded-lg object-cover shadow">
                            </td>
                            <td class="p-4 font-medium text-gray-800 leading-relaxed">
                                Efek Krisis RAM, Toko di Jepang Sampai "Ngebet" Beli PC Lama
                            </td>
                            <td class="p-4 text-center">
                                <img src="https://via.placeholder.com/40"
                                     class="w-10 h-10 rounded-full object-cover border-2 border-[#4988C4] mx-auto">
                            </td>
                            <td class="p-4 font-medium text-gray-600">Admin Satu</td>
                            <td class="p-4 text-center">
                                <span class="px-4 py-1 rounded-full text-xs font-semibold text-white
                                             bg-gradient-to-r from-[#4988C4] to-[#4988C4]">
                                    Published
                                </span>
                            </td>
                            <td class="p-4 text-center text-gray-500 text-xs font-medium">
                                2 jam lalu
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Berita Terpopuler -->
        <div>
            <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center gap-2">
                <span class="text-2xl">⭐</span> Berita Terpopuler
            </h2>

            <div class="bg-white rounded-2xl p-5
                        shadow-[0_4px_20px_rgba(0,0,0,0.08)]">
                <div class="mb-4 p-4 rounded-xl
                            bg-gradient-to-r from-[#4988C4] to-[#4988C4]
                            border-l-4 border-[#4988C4]
                            transition-all hover:translate-x-1 hover:shadow-lg">
                    <div class="text-white font-semibold text-sm mb-2 leading-relaxed">
                        Bahlil Siap Perangi Mafia Migas
                    </div>
                    <div class="flex justify-between items-center gap-2 text-white text-xs flex-wrap">
                        <span class="px-3 py-1 rounded-full bg-[#4988C4] font-semibold">POLITIK</span>
                        <span>👁 15.3k</span>
                        <span>3 hari lalu</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
const ctx = document.getElementById('myChart');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'],
        datasets: [{
            label: 'Viewers',
            data: [879,3595,2569,1995,3678,500,4278],
            borderColor: '#4988C4',
            backgroundColor: 'rgba(73,136,196,0.15)',
            borderWidth: 3,
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { labels: { color: '#2d3748' } }
        }
    }
});
</script>
@endpush
@endsection
