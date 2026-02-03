@extends('layout.App')

@section('title', 'Dashboard - Portal Blog')

@section('content')
<div class="dashboard-container">

    <h1 class="dashboard-title">Dashboard Portal Blog</h1>

    <!-- Stats -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-label">📰 Jumlah Berita</div>
            <div class="stat-value">{{ $summary_stats['total_news'] }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">✅ Berita Published</div>
            <div class="stat-value">{{ $summary_stats['published'] }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">📝 Berita Draft</div>
            <div class="stat-value">{{ $summary_stats['draft'] }}</div>
        </div>
    </div>

    <!-- Chart -->
    <div class="card-box">
        <div class="card-accent"></div>
        <h2 class="section-title">📊 Diagram Data Viewers</h2>
        <canvas id="myChart" class="chart-canvas"></canvas>
    </div>

    <!-- Content Grid -->
    <div class="content-grid">

        <!-- Berita Terbaru -->
        <div>
            <h2 class="section-title">📰 Berita Terbaru</h2>
            <div class="card-box">
                <div class="card-accent"></div>
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Judul</th>
                            <th>Admin</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($latest_news as $i => $news)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td><img src="{{ $news['thumbnail'] }}" class="table-img"></td>
                            <td>{{ Str::limit($news['title'], 50) }}</td>
                            <td><img src="{{ $news['author']['avatar'] }}" class="admin-avatar"></td>
                            <td>{{ $news['author']['name'] }}</td>
                            <td>
                                <span class="badge {{ $news['status'] === 'published' ? 'badge-published' : 'badge-draft' }}">
                                    {{ ucfirst($news['status']) }}
                                </span>
                            </td>
                            <td>{{ $news['human_time'] }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="empty-row">Data tidak ditemukan</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Berita Terpopuler -->
        <div>
            <h2 class="section-title">⭐ Berita Terpopuler</h2>
            <div class="card-box space-y-4">
                <div class="card-accent"></div>
                @foreach($popular_news as $pop)
                <div class="popular-item">
                    <div class="pop-title">{{ Str::limit($pop['title'], 60) }}</div>
                    <div class="pop-meta">
                        <span class="pop-tag">{{ $pop['category'] }}</span>
                        <span>👁 {{ $pop['stats']['views_formatted'] }}</span>
                        <span>{{ $pop['date'] }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
const ctx = document.getElementById('myChart').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: @json($analytics['labels']),
        datasets: [{
            label: 'Viewers',
            data: @json($analytics['values']),
            borderColor: '#6366f1',
            backgroundColor: 'rgba(99,102,241,.15)',
            borderWidth: 3,
            tension: .4,
            fill: true
        }]
    }
});
</script>
@endsection
