@extends('layout.App')

@section('title', 'List Blog - Portal Blog')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/listblog.css') }}">
@endpush

@section('content')
<div class="header">
    <h1 class="title">List Blog</h1>
    <a href="{{ route('blog.tambah') }}" class="btn-add">Tambah Blog</a>
</div>

<div class="table-container">
    <table id="blogTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            {{-- Loop data dari Controller --}}
            @forelse($blogs as $index => $blog)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    @if(isset($blog->foto) && $blog->foto)
                        <img src="{{ asset('storage/' . $blog->foto) }}" alt="{{ $blog->judul }}" class="blog-foto">
                    @else
                        <div class="blog-foto-placeholder">
                            <i class="fas fa-image"></i>
                        </div>
                    @endif
                </td>
                <td><strong>{{ $blog->judul }}</strong></td>
                <td>{{ $blog->penulis }}</td>
                <td><span class="badge">{{ $blog->kategori }}</span></td>
                <td>{{ ucfirst($blog->status) }}</td>
                <td>
                    <div class="dropdown">
                        <button class="dropdown-toggle" onclick="toggleDropdown({{ $blog->id }})">⋮</button>
                        <div id="dropdown-{{ $blog->id }}" class="dropdown-menu">
                            <a href="#" class="dropdown-item edit">Edit</a>
                            <form action="#" method="POST" class="delete-form">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="dropdown-item delete">Hapus</button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="empty-state">Belum ada data blog.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script>
    function toggleDropdown(id) {
        event.stopPropagation();
        const current = document.getElementById('dropdown-' + id);
        document.querySelectorAll('.dropdown-menu').forEach(d => {
            if (d !== current) d.classList.remove('show');
        });
        current.classList.toggle('show');
    }

    window.onclick = function() {
        document.querySelectorAll('.dropdown-menu').forEach(d => d.classList.remove('show'));
    }
</script>
@endpush