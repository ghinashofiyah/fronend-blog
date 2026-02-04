@extends('layout.App')

@section('title', 'List Blog - Portal Blog')

@section('content')
<div class="p-8 font-sans bg-white min-h-screen">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-8 flex-wrap gap-4">
        <h1 class="text-3xl font-bold text-gray-800">List Blog</h1>

        <a href="{{ route('blog.tambah') }}"
           class="px-8 py-3 bg-[#4988C4] text-white font-semibold rounded-xl
                  shadow-lg shadow-blue-500/40
                  hover:-translate-y-0.5 hover:shadow-xl transition">
            Tambah Blog
        </a>
    </div>

    {{-- TABLE CONTAINER --}}
    <div class="relative bg-white rounded-2xl p-6 shadow-lg border border-gray-200">

        {{-- garis biru atas --}}
        <div class="absolute top-0 left-0 right-0 h-1 bg-[#4988C4] rounded-t-2xl"></div>

        <table class="w-full border-collapse mt-4">
            <thead>
                <tr class="bg-[#4988C4]">
                    <th class="px-4 py-4 text-left text-sm font-semibold text-white">No</th>
                    <th class="px-4 py-4 text-left text-sm font-semibold text-white">Foto</th>
                    <th class="px-4 py-4 text-left text-sm font-semibold text-white">Judul</th>
                    <th class="px-4 py-4 text-left text-sm font-semibold text-white">Penulis</th>
                    <th class="px-4 py-4 text-left text-sm font-semibold text-white">Kategori</th>
                    <th class="px-4 py-4 text-left text-sm font-semibold text-white">Status</th>
                    <th class="px-4 py-4 text-left text-sm font-semibold text-white">Aksi</th>
                </tr>
            </thead>

            <tbody>
            @forelse($blogs as $index => $blog)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="px-4 py-4 text-sm text-gray-700">
                        {{ $index + 1 }}
                    </td>

                    {{-- FOTO --}}
                    <td class="px-4 py-4">
                        @if(!empty($blog->foto))
                            <img src="{{ asset('storage/' . $blog->foto) }}"
                                 alt="{{ $blog->judul }}"
                                 class="w-14 h-14 object-cover rounded-lg shadow">
                        @else
                            <div class="w-14 h-14 bg-[#4988C4] rounded-lg
                                        flex items-center justify-center
                                        text-white text-xl shadow">
                                <i class="fas fa-image"></i>
                            </div>
                        @endif
                    </td>

                    <td class="px-4 py-4 text-sm font-semibold text-gray-800">
                        {{ $blog->judul }}
                    </td>

                    <td class="px-4 py-4 text-sm text-gray-700">
                        {{ $blog->penulis }}
                    </td>

                    <td class="px-4 py-4">
                        <span class="px-3 py-1 rounded-full bg-[#4988C4]
                                     text-white text-xs font-semibold">
                            {{ $blog->kategori }}
                        </span>
                    </td>

                    <td class="px-4 py-4 text-sm text-gray-700 capitalize">
                        {{ $blog->status }}
                    </td>

                    {{-- AKSI --}}
                    <td class="px-4 py-4 relative">
                        <button onclick="toggleDropdown({{ $blog->id }}, event)"
                                class="text-xl font-bold text-gray-500 hover:text-[#4988C4] transition">
                            ⋮
                        </button>

                        <div id="dropdown-{{ $blog->id }}"
                             class="hidden absolute right-0 mt-2 w-36 bg-white
                                    border border-gray-200 rounded-lg
                                    shadow-xl overflow-hidden z-50">

                            <a href="#"
                               class="block px-4 py-3 text-sm text-gray-700
                                      hover:bg-blue-50 hover:text-[#4988C4] transition">
                                Edit
                            </a>

                            <form action="#" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="w-full text-left px-4 py-3 text-sm
                                               text-red-600 hover:bg-red-50 transition">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7"
                        class="text-center py-6 text-gray-500">
                        Belum ada data blog.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function toggleDropdown(id, event) {
        event.stopPropagation();
        const current = document.getElementById('dropdown-' + id);

        document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
            if (el !== current) el.classList.add('hidden');
        });

        current.classList.toggle('hidden');
    }

    window.addEventListener('click', () => {
        document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
            el.classList.add('hidden');
        });
    });
</script>
@endpush
