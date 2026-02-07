@extends('layout.App')

@section('title', 'List Blog - Portal Blog')

@section('content')
<div class="p-8 font-sans bg-white min-h-screen">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-8 flex-wrap gap-4">
        <h1 class="text-3xl font-bold text-gray-800">List Blog</h1>

        <div class="flex items-center gap-3 flex-wrap">

            <!-- SEARCH -->
            <div class="relative w-80">
                <span class="absolute left-5 top-1/2 -translate-y-1/2 text-[#4988C4] text-lg">
                    <i class="fas fa-search"></i>
                </span>
                <input type="text"
                       id="searchInput"
                       placeholder="Cari jurnal..."
                       onkeyup="filterBlog()"
                       class="w-full pl-12 pr-5 py-3 rounded-full
                              border-2 border-[#4988C4]
                              focus:outline-none focus:ring-2 focus:ring-[#4988C4]/40">
            </div>

            <!-- TAMBAH BLOG (TIDAK DIHILANGKAN) -->
            <a href="{{ route('blog.tambah') }}"
               class="px-8 py-3 bg-[#4988C4] text-white font-semibold rounded-xl
                      shadow-lg shadow-blue-500/40
                      hover:-translate-y-0.5 hover:shadow-xl transition">
                Tambah Blog
            </a>

        </div>
    </div>

    <!-- TABLE -->
    <div class="relative bg-white rounded-2xl p-6 shadow-lg border border-gray-200">
        <div class="absolute top-0 left-0 right-0 h-1 bg-[#4988C4] rounded-t-2xl"></div>

        <table class="w-full border-collapse mt-4">
            <thead class="bg-[#4988C4]">
                <tr>
                    <th class="px-4 py-4 text-white text-left">No</th>
                    <th class="px-4 py-4 text-white text-left">Foto</th>
                    <th class="px-4 py-4 text-white text-left">Judul</th>
                    <th class="px-4 py-4 text-white text-left">Penulis</th>
                    <th class="px-4 py-4 text-white text-left">Kategori</th>
                    <th class="px-4 py-4 text-white text-left">Status</th>
                    <th class="px-4 py-4 text-white text-left">Aksi</th>
                </tr>
            </thead>
            <tbody id="tableBody"></tbody>
        </table>

        <!-- PAGINATION -->
        <div class="flex justify-between items-center mt-6">
            <span id="pageInfo" class="text-gray-500"></span>

            <div class="flex gap-3">
                <button onclick="prevPage()" class="px-6 py-2 border rounded-xl">
                    Prev
                </button>
                <button onclick="nextPage()" class="px-6 py-2 border border-[#4988C4] text-[#4988C4] rounded-xl">
                    Next
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ================= POPUP HAPUS (REUSABLE) ================= -->
<div id="popupHapus"
     class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center">

    <div class="bg-white rounded-2xl p-6 w-full max-w-sm text-center animate-scale">
        <h2 class="text-xl font-bold mb-2 text-gray-800">Konfirmasi Hapus</h2>
        <p id="popupText" class="text-gray-600 mb-6">
            Yakin ingin menghapus data ini?
        </p>

        <div class="flex justify-center gap-4">
            <button onclick="closePopupHapus()"
                    class="px-6 py-2 rounded-xl border">
                Batal
            </button>
            <button id="popupHapusBtn"
                    class="px-6 py-2 rounded-xl bg-red-600 text-white">
                Hapus
            </button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
/* ================= DATA (TIDAK DIUBAH) ================= */
const blogs = [
    {id:1,foto:'https://picsum.photos/80?1',judul:'Belajar Laravel dari Nol',penulis:'Admin',kategori:'Programming',status:'publish'},
    {id:2,foto:'https://picsum.photos/80?2',judul:'Mengenal MVC pada Laravel',penulis:'Admin',kategori:'Framework',status:'draft'},
    {id:3,foto:'https://picsum.photos/80?3',judul:'Tips UI Dashboard Modern',penulis:'Editor',kategori:'UI/UX',status:'publish'},
    {id:4,foto:'https://picsum.photos/80?4',judul:'CRUD Laravel Best Practice',penulis:'Admin',kategori:'Programming',status:'publish'},
    {id:5,foto:'https://picsum.photos/80?5',judul:'Blade Template Laravel',penulis:'Admin',kategori:'Framework',status:'draft'},
    {id:6,foto:'https://picsum.photos/80?6',judul:'Validasi Form Laravel',penulis:'Editor',kategori:'Backend',status:'publish'},
    {id:7,foto:'https://picsum.photos/80?7',judul:'Relasi Database Eloquent',penulis:'Admin',kategori:'Database',status:'publish'},
    {id:8,foto:'https://picsum.photos/80?8',judul:'Pagination Manual vs Laravel',penulis:'Admin',kategori:'Backend',status:'draft'},
    {id:9,foto:'https://picsum.photos/80?9',judul:'Auth Login Laravel',penulis:'Editor',kategori:'Security',status:'publish'},
    {id:10,foto:'https://picsum.photos/80?10',judul:'Middleware Laravel',penulis:'Admin',kategori:'Framework',status:'publish'},
    {id:11,foto:'https://picsum.photos/80?11',judul:'Seeder & Factory Laravel',penulis:'Admin',kategori:'Database',status:'draft'},
    {id:12,foto:'https://picsum.photos/80?12',judul:'Optimasi Query Eloquent',penulis:'Editor',kategori:'Performance',status:'publish'},
    {id:13,foto:'https://picsum.photos/80?13',judul:'REST API dengan Laravel',penulis:'Admin',kategori:'API',status:'publish'},
    {id:14,foto:'https://picsum.photos/80?14',judul:'Deploy Laravel ke Hosting',penulis:'Admin',kategori:'DevOps',status:'draft'},
    {id:15,foto:'https://picsum.photos/80?15',judul:'Struktur Project Laravel',penulis:'Editor',kategori:'Framework',status:'publish'}
];

let currentPage = 1;
let searchKeyword = '';
const perPage = 10;
let deleteCallback = null;

/* ================= POPUP ================= */
function openPopupHapus(callback, text = 'Yakin ingin menghapus data ini?'){
    deleteCallback = callback;
    popupText.innerText = text;
    popupHapus.classList.remove('hidden');
}

function closePopupHapus(){
    popupHapus.classList.add('hidden');
    deleteCallback = null;
}

popupHapusBtn.onclick = () => {
    if(deleteCallback) deleteCallback();
    closePopupHapus();
};

/* ================= SEARCH ================= */
function filterBlog(){
    searchKeyword = searchInput.value.toLowerCase();
    currentPage = 1;
    renderTable();
}

/* ================= RENDER ================= */
function renderTable(){
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
                <span class="px-3 py-1 bg-[#4988C4] text-white rounded-full text-xs">
                    ${blog.kategori}
                </span>
            </td>
            <td class="px-4 py-4 capitalize">${blog.status}</td>

            <!-- AKSI (EDIT TIDAK DIHILANGKAN) -->
            <td class="px-4 py-4 relative">
                <button onclick="toggleMenu(${blog.id})"
                        class="w-8 h-8 rounded-full hover:bg-gray-200 flex items-center justify-center">
                    ⋮
                </button>

                <div id="menu-${blog.id}"
                     class="hidden absolute right-0 top-10 z-50 w-36
                            bg-white border rounded-xl shadow-lg">

                    <a href="/blog/edit/${blog.id}"
                       class="flex items-center gap-3 px-4 py-3 hover:bg-blue-50">
                        <i class="fas fa-edit text-blue-500"></i> Edit
                    </a>

                    <button onclick="hapusBlog(${blog.id})"
                        class="w-full flex items-center gap-3 px-4 py-3
                               text-red-600 hover:bg-red-50">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
            </td>
        </tr>`;
    });

    pageInfo.innerText = `Hal ${currentPage} / ${Math.ceil(filtered.length / perPage) || 1}`;
}

/* ================= DROPDOWN ================= */
function toggleMenu(id){
    document.querySelectorAll('[id^="menu-"]').forEach(m => {
        if(m.id !== `menu-${id}`) m.classList.add('hidden');
    });
    document.getElementById(`menu-${id}`).classList.toggle('hidden');
}

/* ================= DELETE (PAKAI POPUP) ================= */
function hapusBlog(id){
    openPopupHapus(() => {
        const index = blogs.findIndex(b => b.id === id);
        if(index !== -1){
            blogs.splice(index, 1);
            renderTable();
        }
    }, 'Yakin ingin menghapus blog ini?');
}

/* ================= PAGINATION ================= */
function prevPage(){ if(currentPage > 1){ currentPage--; renderTable(); } }
function nextPage(){ currentPage++; renderTable(); }

/* ================= CLICK OUTSIDE ================= */
document.addEventListener('click', e => {
    if(!e.target.closest('td')){
        document.querySelectorAll('[id^="menu-"]').forEach(m => m.classList.add('hidden'));
    }
});

document.addEventListener('DOMContentLoaded', renderTable);
</script>
@endpush
