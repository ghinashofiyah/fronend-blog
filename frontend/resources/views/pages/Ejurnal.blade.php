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

            <h2 class="text-3xl font-bold text-[#4988C4] border-b-4 border-[#4988C4] pb-4 mb-6">
                <i class="fas fa-table mr-2"></i>Tabel Jurnal
            </h2>

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

<script>
    let dummyJurnal = [
        {
            judul: 'Pemanfaatan AI dalam Pendidikan',
            deskripsi: 'Studi tentang penggunaan Artificial Intelligence untuk meningkatkan kualitas pembelajaran.',
            user: 'Admin',
            gambar: 'https://picsum.photos/200/120?random=1'
        },
        {
            judul: 'Sistem Informasi Akademik',
            deskripsi: 'Perancangan sistem informasi akademik berbasis web.',
            user: 'Ghina',
            gambar: 'https://picsum.photos/200/120?random=2'
        },
        {
            judul: 'Keamanan Data Digital',
            deskripsi: 'Analisis metode enkripsi untuk melindungi data digital.',
            user: 'Operator',
            gambar: 'https://picsum.photos/200/120?random=3'
        },
        {
            judul: 'UI/UX Modern dengan Tailwind',
            deskripsi: 'Penerapan Tailwind CSS untuk desain antarmuka modern.',
            user: 'Developer',
            gambar: 'https://picsum.photos/200/120?random=4'
        }
    ];

    function renderDummyData() {
        const tabelJurnal = document.getElementById('tabelJurnal');
        tabelJurnal.innerHTML = '';

        dummyJurnal.forEach((item, index) => {
            tabelJurnal.innerHTML += `
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="p-4 text-center font-semibold">${index + 1}</td>
                    <td class="p-4 font-medium">${item.judul}</td>
                    <td class="p-4">${item.deskripsi}</td>
                    <td class="p-4">${item.user}</td>
                    <td class="p-4 text-center">
                        <img src="${item.gambar}"
                             class="w-20 h-12 object-cover rounded-lg mx-auto shadow">
                    </td>
                    <td class="p-4 text-center space-x-2">
                        <button onclick="bukaEdit(${index})"
                            class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-lg text-xs shadow">
                            Edit
                        </button>
                        <button onclick="hapusJurnal(${index})"
                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-xs shadow">
                            Hapus
                        </button>
                    </td>
                </tr>
            `;
        });
    }
    let editGambarBase64 = null;

function previewEditGambar(event) {
    const file = event.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = e => {
        editGambarBase64 = e.target.result;
        document.getElementById('editPreviewImage').src = editGambarBase64;
    };
    reader.readAsDataURL(file);
}


    /* ===== EDIT ===== */
function bukaEdit(index) {
    const data = dummyJurnal[index];

    document.getElementById('editIndex').value = index;
    document.getElementById('editJudul').value = data.judul;
    document.getElementById('editDeskripsi').value = data.deskripsi;
    document.getElementById('editUser').value = data.user;

    editGambarBase64 = data.gambar;
    document.getElementById('editPreviewImage').src = data.gambar;

    document.getElementById('modalEdit').classList.remove('hidden');
    document.getElementById('modalEdit').classList.add('flex');
}


function tutupModal() {
    document.getElementById('modalEdit').classList.add('hidden');
    document.getElementById('modalEdit').classList.remove('flex');
}

function simpanEdit() {
    const index = document.getElementById('editIndex').value;

    dummyJurnal[index] = {
        judul: document.getElementById('editJudul').value,
        deskripsi: document.getElementById('editDeskripsi').value,
        user: document.getElementById('editUser').value,
        gambar: editGambarBase64
    };

    tutupModal();
    renderDummyData();
}


    /* ===== HAPUS ===== */
function hapusJurnal(index) {
        if (confirm('Yakin ingin menghapus jurnal ini?')) {
            dummyJurnal.splice(index, 1);
            renderDummyData();
        }
}

    document.addEventListener('DOMContentLoaded', renderDummyData);
</script>


</body>
@endsection
