<!-- resources/views/dashboard.blade.php -->
@extends('layout.App')

@section('title', 'Dashboard - Portal Blog')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
<div class="dashboard-container">
    
    <!-- Title -->
    <h1 class="page-title">Dashboard Portal Blog</h1>
    
    <!-- Stats Cards -->
    <div class="stats-cards">
        <div class="stat-card">
            <div class="stat-label">📰 Jumlah Berita</div>
            <div class="stat-value">{{ $jumlahBerita ?? 131 }}</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-label">✅ Berita Published</div>
            <div class="stat-value">{{ $beritaPublished ?? 98 }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">📝 Berita Draft</div>
            <div class="stat-value">{{ $beritaDraft ?? 33 }}</div>
        </div>
    </div>
    
    <!-- Diagram Viewers -->
    <div class="diagram-container">
        <h2 class="section-title">
            <span class="section-icon">📊</span>
            Diagram Data Viewers 
        </h2>
        <canvas id="myChart" class="chart-canvas"></canvas>
    </div>
    
    <!-- Berita Section -->
    <div class="berita-section">
        
        <!-- Berita Terbaru (73%) -->
        <div>
            <h2 class="section-title">
                <span class="section-icon">🔥</span>
                Berita Terbaru
            </h2>
            <div class="berita-box">
                <table class="berita-table">
                    <thead>
                        <tr>
                            <th class="col-no">No</th>
                            <th class="col-image text-left">Gambar</th>
                            <th class="col-title text-left">Judul</th>
                            <th class="col-admin text-center">Admin</th>
                            <th class="col-name text-left">Nama</th>
                            <th class="col-status text-center">Status</th>
                            <th class="col-time text-center">Waktu</th>
                        </tr>
                    </thead>
                    <tbody id="beritaTerbaruList">
                        <tr>
                            <td class="text-center cell-number">1</td>
                            <td class="cell-image">
                                <img src="https://via.placeholder.com/80x60" alt="Berita 1">
                            </td>
                            <td class="cell-title">Efek Krisis RAM, Toko di Jepang Sampai "Ngebet" Beli PC Lama Pelanggan</td>
                            <td class="text-center cell-admin-avatar">
                                <img src="https://via.placeholder.com/40" alt="Admin">
                            </td>
                            <td class="cell-name">Admin Satu</td>
                            <td class="text-center">
                                <span class="status-badge published">Published</span>
                            </td>
                            <td class="text-center cell-time">2 jam lalu</td>
                        </tr>
                        <tr>
                            <td class="text-center cell-number">2</td>
                            <td class="cell-image">
                                <img src="https://via.placeholder.com/80x60" alt="Berita 2">
                            </td>
                            <td class="cell-title">Ribuan Warga Mojokerto Ikuti "Mlaku Bareng Gus Bupati" di Stadion Gajah Mada</td>
                            <td class="text-center cell-admin-avatar">
                                <img src="https://via.placeholder.com/40" alt="Admin">
                            </td>
                            <td class="cell-name">Admin Dua</td>
                            <td class="text-center">
                                <span class="status-badge draft">Draft</span>
                            </td>
                            <td class="text-center cell-time">5 jam lalu</td>
                        </tr>
                        <tr>
                            <td class="text-center cell-number">3</td>
                            <td class="cell-image">
                                <img src="https://via.placeholder.com/80x60" alt="Berita 3">
                            </td>
                            <td class="cell-title">Pihak Tergugat 1 (Bapenda Kab Sukabumi), Tidak Bisa Hadirkan Saksi Fakta Dan Alat Bukti Dalam Lanjutan Sidang Gugatan Bayar Pajak Waris Tanah Natadipura</td>
                            <td class="text-center cell-admin-avatar">
                                <img src="https://via.placeholder.com/40" alt="Admin">
                            </td>
                            <td class="cell-name">Admin Tiga</td>
                            <td class="text-center">
                                <span class="status-badge published">Published</span>
                            </td>
                            <td class="text-center cell-time">1 hari lalu</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Berita Terpopuler (25%) -->
        <div>
            <h2 class="section-title">
                <span class="section-icon">⭐</span>
                Berita Terpopuler
            </h2>
            <div class="berita-box terpopuler">
                <div id="beritaTerpopulerList">
                    <!-- Item 1 -->
                    <div class="popular-item">
                        <div class="popular-item-title">Bahlil Siap Perangi Mafia Migas, Minta Dukungan Ulama</div>
                        <div class="popular-item-meta">
                            <span class="popular-category">POLITIK</span>
                            <span class="popular-views">👁 15.3k</span>
                            <span class="popular-time">3 hari lalu</span>
                        </div>
                    </div>
                    
                    <!-- Item 2 -->
                    <div class="popular-item">
                        <div class="popular-item-title">Indonesia Percepat Pembangunan Infrastruktur Digital Nasional Internet</div>
                        <div class="popular-item-meta">
                            <span class="popular-category">TEKNOLOGI</span>
                            <span class="popular-views">👁 12.8k</span>
                            <span class="popular-time">1 minggu lalu</span>
                        </div>
                    </div>
                    
                    <!-- Item 3 -->
                    <div class="popular-item">
                        <div class="popular-item-title">Erick Thohir Tancap Gas, Industri Olahraga Ditarget Jadi Mesin Ekonomi Baru Nasional</div>
                        <div class="popular-item-meta">
                            <span class="popular-category">OLAHRAGA</span>
                            <span class="popular-views">👁 10.5k</span>
                            <span class="popular-time">2 hari lalu</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    
    const data = {
        labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
        datasets: [{
            label: 'Viewers',
            data: [879, 3595, 2569, 1995, 3678, 500, 4278],
            borderColor: '#667eea',
            backgroundColor: 'rgba(102, 126, 234, 0.1)',
            borderWidth: 3,
            pointRadius: 6,
            pointBackgroundColor: '#667eea',
            pointBorderColor: '#fff',
            pointBorderWidth: 2,
            pointHoverRadius: 8,
            tension: 0.4,
            fill: true
        }]
    };

    const config = {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        color: '#2d3748',
                        font: {
                            size: 13,
                            weight: '600'
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(45, 55, 72, 0.95)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    padding: 12,
                    borderColor: '#4988C4',
                    borderWidth: 1,
                    callbacks: {
                        label: function(context) {
                            return 'Viewers: ' + context.parsed.y.toLocaleString('id-ID');
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 4500,
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString('id-ID');
                        },
                        font: {
                            size: 12
                        },
                        color: '#4a5568'
                    },
                    grid: {
                        color: 'rgba(102, 126, 234, 0.1)',
                        drawBorder: false
                    }
                },
                x: {
                    ticks: {
                        font: {
                            size: 12,
                            weight: '500'
                        },
                        color: '#4a5568'
                    },
                    grid: {
                        display: false
                    }
                }
            }
        }
    };

    const myChart = new Chart(ctx, config);
</script>
@endpush

@endsection