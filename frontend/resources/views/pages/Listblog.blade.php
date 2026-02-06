@extends('layout.App')

@section('title', 'List Blog - Portal Blog')

@section('content')
<div class="p-8 font-sans bg-white min-h-screen">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-8 flex-wrap gap-4">
        <h1 class="text-3xl font-bold text-gray-800">List Blog</h1>

        <div class="flex items-center gap-3 flex-wrap">

            <!-- SEARCH (MODEL KAPSUL SESUAI GAMBAR) -->
            <div class="relative w-80">
                <span class="absolute left-5 top-1/2 -translate-y-1/2 text-[#4988C4] text-lg">
                    <i class="fas fa-search"></i>
                </span>
                <input
                    type="text"
                    id="searchInput"
                    placeholder="Cari jurnal..."
                    onkeyup="filterBlog()"
                    class="w-full pl-12 pr-5 py-3
                           rounded-full
                           border-2 border-[#4988C4]
                           text-gray-700
                           focus:outline-none
                           focus:ring-2 focus:ring-[#4988C4]/40">
            </div>

            <!-- TAMBAH BLOG -->
            <a href="{{ route('blog.tambah') }}"
               class="px-8 py-3 bg-[#4988C4] text-white font-semibold rounded-xl
                      shadow-lg shadow-blue-500/40
                      hover:-translate-y-0.5 hover:shadow-xl transition">
                Tambah Blog
            </a>

        </div>
    </div>

    <!-- TABLE -->
    <div class="relative bg-white rounded-2xl p-6 shadow-lg border border-gray-200 overflow-visible">
        <div class="absolute top-0 left-0 right-0 h-1 bg-[#4988C4] rounded-t-2xl"></div>

        <table class="w-full border-collapse mt-4 overflow-visible">
            <thead class="bg-[#4988C4] sticky top-0 z-40">
                <tr>
                    <th class="px-4 py-4 text-left text-sm font-semibold text-white">No</th>
                    <th class="px-4 py-4 text-left text-sm font-semibold text-white">Foto</th>
                    <th class="px-4 py-4 text-left text-sm font-semibold text-white">Judul</th>
                    <th class="px-4 py-4 text-left text-sm font-semibold text-white">Penulis</th>
                    <th class="px-4 py-4 text-left text-sm font-semibold text-white">Kategori</th>
                    <th class="px-4 py-4 text-left text-sm font-semibold text-white">Status</th>
                    <th class="px-4 py-4 text-left text-sm font-semibold text-white">Aksi</th>
                </tr>
            </thead>
            <tbody id="tableBody"></tbody>
        </table>

        <!-- PAGINATION -->
        <div class="flex items-center justify-between mt-6 px-2">
            <span id="pageInfo" class="text-gray-500 font-medium"></span>

            <div class="flex gap-3">
                <button onclick="prevPage()"
                        class="px-6 py-2 rounded-xl border border-gray-300 text-gray-500">
                    Prev
                </button>
                <button onclick="nextPage()"
                        class="px-6 py-2 rounded-xl border border-[#4988C4]
                               text-[#4988C4] hover:bg-blue-50 transition">
                    Next
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
/* ================= DATA ================= */
const blogs = [
    { id:1,foto:'https://picsum.photos/80?1',judul:'Belajar Laravel dari Nol',penulis:'Admin',kategori:'Programming',status:'publish'},
    { id:2,foto:'https://picsum.photos/80?2',judul:'Mengenal MVC pada Laravel',penulis:'Admin',kategori:'Framework',status:'draft'},
    { id:3,foto:'https://picsum.photos/80?3',judul:'Tips Desain UI Dashboard Modern',penulis:'Editor',kategori:'UI/UX',status:'publish'},
    { id:4,foto:'https://picsum.photos/80?4',judul:'Cara Menggunakan Tailwind CSS',penulis:'Admin',kategori:'Frontend',status:'publish'},
    { id:5,foto:'https://picsum.photos/80?5',judul:'Optimasi Query Database Laravel',penulis:'Editor',kategori:'Backend',status:'draft'},
    { id:6,foto:'https://picsum.photos/80?6',judul:'Implementasi Login dan Logout',penulis:'Admin',kategori:'Authentication',status:'publish'},
    { id:7,foto:'https://picsum.photos/80?7',judul:'Membuat CRUD Blog dengan Laravel',penulis:'Admin',kategori:'Programming',status:'publish'},
    { id:8,foto:'https://picsum.photos/80?8',judul:'Pagination Manual vs Laravel',penulis:'Editor',kategori:'Framework',status:'draft'},
    { id:9,foto:'https://picsum.photos/80?9',judul:'Struktur Folder Laravel yang Benar',penulis:'Admin',kategori:'Laravel',status:'publish'},
    { id:10,foto:'https://picsum.photos/80?10',judul:'Best Practice Controller Laravel',penulis:'Admin',kategori:'Backend',status:'publish'}
];

let searchKeyword = '';
let currentPage = 1;
const perPage = 10;

/* ================= SEARCH ================= */
function filterBlog() {
    searchKeyword = searchInput.value.toLowerCase();
    currentPage = 1;
    renderTable();
}

/* ================= RENDER ================= */
function renderTable() {
    tableBody.innerHTML = '';

    const filtered = blogs.filter(b =>
        b.judul.toLowerCase().includes(searchKeyword) ||
        b.penulis.toLowerCase().includes(searchKeyword) ||
        b.kategori.toLowerCase().includes(searchKeyword)
    );

    const start = (currentPage - 1) * perPage;
    filtered.slice(start, start + perPage).forEach((blog, i) => {
        tableBody.innerHTML += `
        <tr class="border-b hover:bg-gray-50">
            <td class="px-4 py-4">${start + i + 1}</td>
            <td class="px-4 py-4">
                <img src="${blog.foto}" class="w-14 h-14 rounded-lg object-cover">
            </td>
            <td class="px-4 py-4 font-semibold">${blog.judul}</td>
            <td class="px-4 py-4">${blog.penulis}</td>
            <td class="px-4 py-4">
                <span class="px-3 py-1 rounded-full bg-[#4988C4] text-white text-xs">
                    ${blog.kategori}
                </span>
            </td>
            <td class="px-4 py-4 capitalize">${blog.status}</td>
            <td class="px-4 py-4 text-xl">⋮</td>
        </tr>`;
    });

    pageInfo.innerText = `Hal ${currentPage} / ${Math.ceil(filtered.length / perPage) || 1}`;
}

/* ================= PAGINATION ================= */
function prevPage(){ if(currentPage>1){currentPage--;renderTable();}}
function nextPage(){
    const total = Math.ceil(
        blogs.filter(b=>b.judul.toLowerCase().includes(searchKeyword)).length / perPage
    );
    if(currentPage<total){currentPage++;renderTable();}
}

document.addEventListener('DOMContentLoaded', renderTable);
</script>
@endpush
