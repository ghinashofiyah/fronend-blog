@extends('layout.App')

@section('title', 'Kategori - Portal Blog')

@section('content')
<div class="min-h-screen bg-[#fbfbfc] p-6">
    <div class="max-w-7xl mx-auto">

        <!-- HEADER -->
        <div class="mb-8">
            <h1 class="flex items-center gap-4 text-4xl font-bold text-black">
                <div class="p-4 rounded-2xl bg-[#4988C4]">
                    <i class="fas fa-layer-group text-white text-3xl"></i>
                </div>
                Kelola Kategori & Tag
            </h1>
        </div>

        <!-- ================= KATEGORI ================= -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

            <!-- Tambah Kategori -->
            <div class="bg-white rounded-2xl p-6 shadow-xl">
                <h2 class="text-2xl font-bold text-[#4988C4] mb-4">
                    <i class="fas fa-plus-circle mr-2"></i>Tambah Kategori
                </h2>

                <input type="text" placeholder="Nama kategori"
                    class="w-full mb-3 px-4 py-3 border rounded-xl">

                <textarea rows="3" placeholder="Deskripsi"
                    class="w-full mb-3 px-4 py-3 border rounded-xl"></textarea>

                <button class="w-full bg-[#4988C4] text-white py-3 rounded-xl font-semibold">
                    Simpan Kategori
                </button>
            </div>

            <!-- Tabel Kategori -->
            <div class="bg-white rounded-2xl p-6 shadow-xl">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="flex items-center text-2xl font-bold text-[#4988C4]">
                        <i class="fas fa-list mr-2"></i>Daftar Kategori
                    </h2>

                    <div class="relative">
                        <input id="searchKategori" onkeyup="filterKategori()"
                            placeholder="Cari kategori..."
                            class="pl-10 pr-4 py-2 border rounded-xl">
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>

                <table class="w-full text-sm">
                    <thead class="bg-[#4988C4]/10 text-[#4988C4]">
                        <tr>
                            <th class="p-4 text-left">Nama</th>
                            <th class="p-4 text-left">Deskripsi</th>
                            <th class="p-4 text-center">Jumlah</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tabelKategori"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ================= MODAL EDIT ================= -->
<div id="editModal" class="hidden fixed inset-0 bg-black/40 z-50 flex items-center justify-center">
    <div class="bg-white w-full max-w-md rounded-2xl p-6 shadow-xl">
        <h3 class="text-xl font-bold text-[#4988C4] mb-4">Edit Data</h3>

        <input id="editNama" class="w-full mb-3 px-4 py-3 border rounded-xl">
        <textarea id="editDesc" rows="3" class="w-full mb-4 px-4 py-3 border rounded-xl"></textarea>

        <div class="flex justify-end gap-3">
            <button onclick="closeModal()" class="px-6 py-2 border rounded-xl">Batal</button>
            <button onclick="simpanEdit()"
                class="px-6 py-2 bg-[#4988C4] text-white rounded-xl">
                Simpan Perubahan
            </button>
        </div>
    </div>
</div>

<!-- ================= NOTIFIKASI ================= -->
<div id="notif"
    class="hidden fixed top-6 right-6 bg-green-500 text-white px-6 py-3 rounded-xl shadow-xl z-50">
    Berhasil diubah
</div>

<script>
/* ================= DATA ================= */
let kategoriData = Array.from({length:10},(_,i)=>({
    nama:`Kategori ${i+1}`,
    desc:`Deskripsi kategori ${i+1}`,
    jumlah:Math.floor(Math.random()*30)+1
}));

let kategoriKeyword = '';
let editIndex = null;

/* ================= RENDER ================= */
function renderKategori(){
    const filtered = kategoriData.filter(k =>
        k.nama.toLowerCase().includes(kategoriKeyword) ||
        k.desc.toLowerCase().includes(kategoriKeyword)
    );

    tabelKategori.innerHTML = '';
    filtered.forEach((k,i)=>{
        tabelKategori.innerHTML += `
        <tr class="border-b hover:bg-gray-50">
            <td class="p-4 font-semibold">${k.nama}</td>
            <td class="p-4">${k.desc}</td>
            <td class="p-4 text-center">
                <span class="px-3 py-1 bg-[#4988C4] text-white rounded-full text-xs">${k.jumlah}</span>
            </td>
            <td class="p-4 text-center relative">
                <button onclick="toggleMenu(${i})">
                    <i class="fas fa-ellipsis-v"></i>
                </button>

                <div id="menu-${i}"
                    class="hidden absolute right-6 top-8 bg-white border rounded-xl shadow-lg w-32 z-40">
                    <button onclick="openEdit(${i})"
                        class="w-full px-4 py-2 text-left hover:bg-blue-50">
                        Edit
                    </button>
                    <button onclick="hapus(${i})"
                        class="w-full px-4 py-2 text-left text-red-600 hover:bg-red-50">
                        Hapus
                    </button>
                </div>
            </td>
        </tr>`;
    });
}

/* ================= ACTION ================= */
function toggleMenu(i){
    document.querySelectorAll('[id^=menu-]').forEach(m=>m.classList.add('hidden'));
    document.getElementById(`menu-${i}`).classList.toggle('hidden');
}

function openEdit(i){
    editIndex = i;
    editNama.value = kategoriData[i].nama;
    editDesc.value = kategoriData[i].desc;
    editModal.classList.remove('hidden');
}

function closeModal(){
    editModal.classList.add('hidden');
}

function simpanEdit(){
    kategoriData[editIndex].nama = editNama.value;
    kategoriData[editIndex].desc = editDesc.value;
    closeModal();
    renderKategori();

    notif.classList.remove('hidden');
    setTimeout(()=>notif.classList.add('hidden'),2000);
}

function hapus(i){
    if(confirm('Yakin hapus data ini?')){
        kategoriData.splice(i,1);
        renderKategori();
    }
}

function filterKategori(){
    kategoriKeyword = searchKategori.value.toLowerCase();
    renderKategori();
}

document.addEventListener('click',e=>{
    if(!e.target.closest('td')){
        document.querySelectorAll('[id^=menu-]').forEach(m=>m.classList.add('hidden'));
    }
});

document.addEventListener('DOMContentLoaded',renderKategori);
</script>
@endsection
