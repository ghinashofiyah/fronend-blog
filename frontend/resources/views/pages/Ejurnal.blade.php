@extends('layout.App')

@section('title', 'E-Jurnal - Portal Blog')

@section('content')

<body class="bg-white min-h-screen p-6">

<div class="max-w-7xl mx-auto">

    <!-- HEADER -->
    <div class="mb-8">
        <h1 class="flex items-center gap-4 text-5xl font-bold drop-shadow-lg">
            <div class="p-4 rounded-xl border-2 border-[#4988C4] shadow-2xl bg-white">
                <i class="fas fa-book text-4xl text-[#4988C4]"></i>
            </div>
            Kelola E-Jurnal
        </h1>
    </div>

    <!-- GRID -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        <!-- FORM -->
        <div class="lg:col-span-4 h-[650px] bg-white border-2 border-[#4988C4] rounded-xl shadow-xl flex flex-col transition-all hover:-translate-y-1 hover:shadow-2xl">

            <div class="p-8 pb-4">
                <h2 class="text-3xl font-bold text-[#4988C4] border-b-4 border-[#4988C4] pb-4">
                    <i class="fas fa-plus-circle mr-2"></i>Tambah Jurnal
                </h2>
            </div>

            <div class="flex-1 overflow-y-auto px-8 space-y-5">

                <!-- Judul -->
                <div>
                    <label class="flex items-center gap-2 font-bold text-sm text-[#4988C4] mb-2">
                        <i class="fas fa-heading"></i> Judul
                    </label>
                    <input id="inputJudul" type="text"
                        class="w-full px-4 py-3 rounded-xl border-2 border-[#4988C4]
                               focus:outline-none focus:ring-4 focus:ring-[#4988C4]/20">
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="flex items-center gap-2 font-bold text-sm text-[#4988C4] mb-2">
                        <i class="fas fa-align-left"></i> Deskripsi
                    </label>
                    <textarea id="inputDeskripsi" rows="3"
                        class="w-full px-4 py-3 rounded-xl border-2 border-[#4988C4]
                               resize-none focus:outline-none focus:ring-4 focus:ring-[#4988C4]/20"></textarea>
                </div>

                <!-- User -->
                <div>
                    <label class="flex items-center gap-2 font-bold text-sm text-[#4988C4] mb-2">
                        <i class="fas fa-user"></i> Nama Pengguna
                    </label>
                    <input id="inputUserName" type="text"
                        class="w-full px-4 py-3 rounded-xl border-2 border-[#4988C4]
                               focus:outline-none focus:ring-4 focus:ring-[#4988C4]/20">
                </div>

                <!-- Upload -->
                <div>
                    <label class="flex items-center gap-2 font-bold text-sm text-[#4988C4] mb-2">
                        <i class="fas fa-image"></i> Gambar
                    </label>

                    <input type="file" id="inputGambar" accept="image/*"
                        class="hidden" onchange="previewGambar(event)">

                    <label for="inputGambar"
                        id="labelPilihGambar"
                        class="block cursor-pointer text-center px-4 py-3 rounded-xl border-2 border-[#4988C4]
                               text-[#4988C4] font-semibold hover:bg-[#4988C4]/10 transition">
                        <i class="fas fa-cloud-upload-alt mr-2"></i>Pilih Gambar
                    </label>

                    <div id="previewContainer" class="hidden mt-3 relative">
                        <img id="previewImage"
                             class="w-full h-48 object-contain rounded-xl border-2 border-[#4988C4] shadow-lg bg-gray-50">
                        <button onclick="hapusGambar()"
                            class="absolute top-2 right-2 bg-red-500 hover:bg-red-600
                                   text-white rounded-full w-8 h-8 flex items-center justify-center shadow-lg">
                            ✕
                        </button>
                    </div>
                </div>
            </div>

            <div class="p-8 pt-4">
                <button onclick="tambahJurnal()"
                    class="w-full bg-[#4988C4] text-white font-bold py-3 rounded-xl
                           shadow-lg transition-all hover:bg-[#3a6ea0] hover:scale-105 hover:shadow-2xl">
                    <i class="fas fa-upload mr-2"></i>Upload
                </button>
            </div>
        </div>

        <!-- TABLE -->
        <div class="lg:col-span-8 h-[650px] bg-white border-2 border-[#4988C4] rounded-xl shadow-xl p-8 flex flex-col transition-all hover:-translate-y-1 hover:shadow-2xl">

            <div class="flex items-center justify-between border-b-4 border-[#4988C4] pb-4 mb-6">
    
    <h2 class="text-3xl font-bold text-[#4988C4] flex items-center gap-2">
        <i class="fas fa-table"></i>
        Tabel Jurnal
    </h2>

    <!-- SEARCH -->
    <div class="relative w-64">
        <input
            type="text"
            placeholder="Cari jurnal..."
            onkeyup="filterJurnal()"
            class="w-full pl-10 pr-4 py-2 rounded-xl border-2 border-[#4988C4]
                   focus:outline-none focus:ring-4 focus:ring-[#4988C4]/20">
        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-[#4988C4]"></i>
    </div>

</div>


            <div class="flex-1 overflow-x-auto overflow-y-auto border-2 border-[#4988C4] rounded-xl">
                <table class="min-w-full text-sm">
                    <thead class="sticky top-0 bg-[#4988C4] text-white">
                        <tr>
                            <th class="p-4 text-center">No</th>
                            <th class="p-4 text-left">Judul</th>
                            <th class="p-4 text-left">Deskripsi</th>
                            <th class="p-4 text-left">User</th>
                            <th class="p-4 text-center">Gambar</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tabelJurnal">
                        <!-- ISI TETAP SAMA DENGAN PUNYA KAMU -->
                    </tbody>
                </table>
                <!-- PAGINATION -->
<div class="flex items-center justify-between mt-4 px-2">

    <span id="pageInfo" class="text-sm font-semibold text-gray-600">
        Hal 1 / 1
    </span>

    <div class="flex gap-2">
        <button onclick="prevPage()"
            class="px-4 py-2 rounded-xl border border-gray-300
                   hover:bg-gray-100 transition font-semibold">
            Prev
        </button>

        <button onclick="nextPage()"
            class="px-4 py-2 rounded-xl border border-gray-300
                   hover:bg-gray-100 transition font-semibold">
            Next
        </button>
    </div>

</div>

            </div>
        </div>
    </div>
</div>
<!-- MODAL EDIT -->
<div id="modalEdit" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl w-full max-w-lg p-6 shadow-2xl animate-fadeIn">
        <h3 class="text-2xl font-bold text-[#4988C4] mb-4">
            <i class="fas fa-edit mr-2"></i>Edit Jurnal
        </h3>

        <input type="hidden" id="editIndex">

        <div class="space-y-4">
            <div>
                <label class="text-sm font-semibold text-[#4988C4]">Judul</label>
                <input id="editJudul" type="text"
                    class="w-full mt-1 px-4 py-2 border-2 border-[#4988C4] rounded-lg focus:ring-4 focus:ring-[#4988C4]/20">
            </div>

            <div>
                <label class="text-sm font-semibold text-[#4988C4]">Deskripsi</label>
                <textarea id="editDeskripsi" rows="3"
                    class="w-full mt-1 px-4 py-2 border-2 border-[#4988C4] rounded-lg focus:ring-4 focus:ring-[#4988C4]/20"></textarea>
            </div>

            <div>
                <label class="text-sm font-semibold text-[#4988C4]">User</label>
                <input id="editUser" type="text"
                    class="w-full mt-1 px-4 py-2 border-2 border-[#4988C4] rounded-lg focus:ring-4 focus:ring-[#4988C4]/20">
            </div>
            <!-- Gambar -->
<div>
    <label class="text-sm font-semibold text-[#4988C4]">Gambar</label>

    <input type="file" id="editGambar" accept="image/*"
        class="hidden" onchange="previewEditGambar(event)">

    <label for="editGambar"
        class="block mt-1 cursor-pointer text-center px-4 py-2 rounded-lg border-2 border-[#4988C4]
               text-[#4988C4] font-semibold hover:bg-[#4988C4]/10 transition">
        <i class="fas fa-image mr-2"></i>Ganti Gambar
    </label>

    <div class="mt-3">
        <img id="editPreviewImage"
             class="w-full h-40 object-contain rounded-lg border-2 border-[#4988C4] bg-gray-50 shadow">
    </div>
</div>

        </div>

        <div class="flex justify-end gap-3 mt-6">
            <button onclick="tutupModal()"
                class="px-4 py-2 rounded-lg border font-semibold hover:bg-gray-100">
                Batal
            </button>
            <button onclick="simpanEdit()"
                class="px-4 py-2 rounded-lg bg-[#4988C4] text-white font-semibold hover:bg-[#3a6ea0]">
                Simpan
            </button>
        </div>
    </div>
</div>

<!-- MODAL DELETE -->
<div id="modalDelete"
     class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl w-full max-w-md p-6 shadow-2xl animate-fadeIn">
        <h3 class="text-xl font-bold text-red-600 mb-4">
            <i class="fas fa-trash mr-2"></i>Konfirmasi Hapus
        </h3>

        <p class="text-gray-700 mb-6">
            Apakah anda yakin menghapus jurnal ini?
        </p>

        <div class="flex justify-end gap-3">
            <button onclick="closeDeleteModal()"
                class="px-4 py-2 rounded-lg border font-semibold hover:bg-gray-100">
                Batal
            </button>
            <button onclick="confirmDelete()"
                class="px-4 py-2 rounded-lg bg-red-600 text-white font-semibold hover:bg-red-700">
                Hapus
            </button>
        </div>
    </div>
</div>


<script>
let selectedImage = null;
let editSelectedImage = null;
/* ================= SEARCH ================= */
let searchKeyword = '';
function tambahJurnal() {
    if (!inputJudul.value || !inputDeskripsi.value || !inputUserName.value || !selectedImage) {
        alert('Semua data dan gambar wajib diisi!');
        return;
    }

    dummyJurnal.unshift({
        judul: inputJudul.value,
        deskripsi: inputDeskripsi.value,
        user: inputUserName.value,
        gambar: selectedImage
    });

    inputJudul.value = '';
    inputDeskripsi.value = '';
    inputUserName.value = '';
    hapusGambar();

    renderDummyData();
}

function filterJurnal() {
    searchKeyword = event.target.value.toLowerCase();
    currentPage = 1;
    renderDummyData();
}

/* ================= PAGINATION ================= */
let currentPage = 1;
const rowsPerPage = 10;

/* ================= DUMMY DATA ================= */
let dummyJurnal = [
    {
        judul: 'Pemanfaatan AI dalam Pendidikan',
        deskripsi: 'Studi penerapan Artificial Intelligence pada sistem pembelajaran.',
        user: 'Admin',
        gambar: 'https://picsum.photos/200/120?random=1'
    },
    {
        judul: 'Sistem Informasi Akademik Berbasis Web',
        deskripsi: 'Perancangan sistem akademik modern berbasis web.',
        user: 'Ghina',
        gambar: 'https://picsum.photos/200/120?random=2'
    },
    ...Array.from({ length: 48 }, (_, i) => ({
        judul: `Penelitian Teknologi Informasi #${i + 3}`,
        deskripsi: `Pembahasan mendalam topik teknologi ke-${i + 3}.`,
        user: ['Admin', 'Editor', 'User'][i % 3],
        gambar: `https://picsum.photos/200/120?random=${i + 3}`
    }))
];

/* ================= RENDER TABLE ================= */
function renderDummyData() {
    const tabel = document.getElementById('tabelJurnal');
    tabel.innerHTML = '';

    /* FILTER DATA (INI KUNCI SEARCH) */
    const filteredData = dummyJurnal.filter(item =>
        item.judul.toLowerCase().includes(searchKeyword) ||
        item.deskripsi.toLowerCase().includes(searchKeyword) ||
        item.user.toLowerCase().includes(searchKeyword)
    );

    const totalPages = Math.ceil(filteredData.length / rowsPerPage) || 1;
    const start = (currentPage - 1) * rowsPerPage;
    const end = start + rowsPerPage;

    filteredData.slice(start, end).forEach((item, index) => {
        tabel.innerHTML += `
        <tr class="border-b hover:bg-gray-50">
            <td class="p-4 text-center">${start + index + 1}</td>
            <td class="p-4">${item.judul}</td>
            <td class="p-4">${item.deskripsi}</td>
            <td class="p-4">${item.user}</td>
            <td class="p-4 text-center">
                <img src="${item.gambar}" class="w-20 h-12 object-cover rounded mx-auto">
            </td>

            <!-- AKSI -->
<td class="p-4 text-center relative overflow-visible">
    <button onclick="toggleAksi(${start + index}, event)"
        class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-200">
        <i class="fas fa-ellipsis-v"></i>
    </button>

    <div id="aksi-${start + index}"
        class="hidden fixed w-32 bg-white border rounded-lg shadow-xl z-[9999]">

        <button onclick="editJurnal(${start + index})"
            class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 flex gap-2">
            <i class="fas fa-edit text-blue-500"></i> Edit
        </button>
        <button onclick="openDeleteModal(${start + index})"
            class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 flex gap-2 text-red-600">
            <i class="fas fa-trash"></i> Hapus
        </button>
    </div>
</td>

        </tr>
        `;
    });

    updatePagination(totalPages);
}

/* ================= DROPDOWN AKSI ================= */
function toggleAksi(index, e) {
    e.stopPropagation();

    document.querySelectorAll('[id^="aksi-"]').forEach(el => {
        if (el.id !== `aksi-${index}`) el.classList.add('hidden');
    });

    document.getElementById(`aksi-${index}`).classList.toggle('hidden');
}

document.addEventListener('click', () => {
    document.querySelectorAll('[id^="aksi-"]').forEach(el => {
        el.classList.add('hidden');
    });
});


/* ================= EDIT ================= */
function editJurnal(index) {
    const data = dummyJurnal[index];

    editIndex.value = index;
    editJudul.value = data.judul;
    editDeskripsi.value = data.deskripsi;
    editUser.value = data.user;
    editPreviewImage.src = data.gambar;

    modalEdit.classList.remove('hidden');
    modalEdit.classList.add('flex');
}

/* ================= SIMPAN EDIT ================= */
function simpanEdit() {
    const i = editIndex.value;

    dummyJurnal[i].judul = editJudul.value;
    dummyJurnal[i].deskripsi = editDeskripsi.value;
    dummyJurnal[i].user = editUser.value;

    if (editSelectedImage) {
        dummyJurnal[i].gambar = editSelectedImage;
    }

    editSelectedImage = null;
    document.getElementById('editGambar').value = '';

    tutupModal();
    renderDummyData();
}


/* ================= DELETE ================= */
function hapusJurnal(index) {
    if (confirm('Yakin ingin menghapus jurnal ini?')) {
        dummyJurnal.splice(index, 1);
        renderDummyData();
    }
}

/* ================= MODAL ================= */
function tutupModal() {
    modalEdit.classList.add('hidden');
    modalEdit.classList.remove('flex');
}

/* ================= PAGINATION ================= */
function nextPage() {
    if (currentPage < Math.ceil(dummyJurnal.length / rowsPerPage)) {
        currentPage++;
        renderDummyData();
    }
}
function prevPage() {
    if (currentPage > 1) {
        currentPage--;
        renderDummyData();
    }
}
function updatePagination(total) {
    pageInfo.innerText = `Hal ${currentPage} / ${total}`;
}

/* ================= INIT ================= */
document.addEventListener('DOMContentLoaded', renderDummyData);

let deleteIndex = null;

function openDeleteModal(index) {
    deleteIndex = index;
    modalDelete.classList.remove('hidden');
    modalDelete.classList.add('flex');
}

function closeDeleteModal() {
    modalDelete.classList.add('hidden');
    modalDelete.classList.remove('flex');
    deleteIndex = null;
}

function confirmDelete() {
    if (deleteIndex !== null) {
        dummyJurnal.splice(deleteIndex, 1);
        renderDummyData();
        closeDeleteModal();
    }
}
/* ================= PREVIEW GAMBAR TAMBAH ================= */
function previewGambar(event) {
    const file = event.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function (e) {
        selectedImage = e.target.result; // BASE64
        previewImage.src = selectedImage;
        previewContainer.classList.remove('hidden');
        labelPilihGambar.classList.add('hidden');
    };
    reader.readAsDataURL(file);
}
/* ================= PREVIEW GAMBAR EDIT ================= */
function previewEditGambar(event) {
    const file = event.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function (e) {
        editSelectedImage = e.target.result; // BASE64
        document.getElementById('editPreviewImage').src = editSelectedImage;
    };
    reader.readAsDataURL(file);
}



function hapusGambar() {
    selectedImage = null;
    document.getElementById('inputGambar').value = '';
    document.getElementById('previewContainer').classList.add('hidden');
    document.getElementById('labelPilihGambar').classList.remove('hidden');
}

</script>




</body>
@endsection
