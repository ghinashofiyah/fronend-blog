@extends('layout.App')

@section('title', 'Iklan - Portal Blog')

@section('content')
<div class="min-h-screen bg-white p-6">

    <!-- HEADER -->
    <div class="mb-8 animate-slide">
        <h1 class="flex items-center gap-4 text-4xl font-bold text-black drop-shadow-lg">
            <span class="p-4 bg-white rounded-xl shadow-xl">
                <i class="fas fa-ad text-[#4988C4] text-3xl"></i>
            </span>
            Kelola Iklan
        </h1>
    </div>

    <!-- GRID -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- FORM -->
        <div class="relative bg-white rounded-2xl shadow-xl p-8 hover:-translate-y-1 hover:shadow-2xl transition animate-slide">
            <div class="absolute top-0 left-0 w-full h-1 bg-[#4988C4] rounded-t-2xl"></div>

            <h2 class="text-2xl font-bold text-[#4988C4] flex items-center gap-2 mb-6">
                <i class="fas fa-plus-circle"></i> Tambah Iklan
            </h2>

            <form id="formTambah" class="flex flex-col gap-6">

                <div>
                    <label class="font-semibold text-[#4988C4] flex items-center gap-2 mb-2">
                        <i class="fas fa-heading"></i> Judul Iklan
                    </label>
                    <input id="inputJudul" type="text"
                        class="w-full rounded-xl border-2 border-[#4988C4] px-4 py-3 focus:ring-4 focus:ring-blue-300 outline-none"
                        placeholder="Masukkan judul iklan">
                </div>

                <div>
                    <label class="font-semibold text-[#4988C4] flex items-center gap-2 mb-2">
                        <i class="fas fa-layer-group"></i> Tipe Iklan
                    </label>
                    <select id="inputTipe"
                        class="w-full rounded-xl border-2 border-[#4988C4] px-4 py-3 focus:ring-4 focus:ring-blue-300 outline-none">
                        <option value="">Pilih Tipe</option>
                        <option>1:1 Slide</option>
                        <option>3:1 Kanan</option>
                        <option>3:1 Kiri</option>
                        <option>3:1 Tengah</option>
                        <option>1:3 Atas</option>
                        <option>1:3 Tengah</option>
                    </select>
                </div>

                <div>
                    <label class="font-semibold text-[#4988C4] flex items-center gap-2 mb-2">
                        <i class="fas fa-link"></i> Link URL
                    </label>
                    <input id="inputLink" type="text"
                        class="w-full rounded-xl border-2 border-[#4988C4] px-4 py-3 focus:ring-4 focus:ring-blue-300 outline-none"
                        placeholder="https://example.com">
                </div>

                <div>
                    <label class="font-semibold text-[#4988C4] flex items-center gap-2 mb-2">
                        <i class="fas fa-image"></i> Gambar Iklan
                    </label>

                    <input id="inputGambar" type="file" accept="image/*" class="hidden" onchange="previewGambar(event)">
                    <label for="inputGambar"
                        id="labelPilihGambar"
                        class="cursor-pointer block text-center border-2 border-[#4988C4] text-[#4988C4] rounded-xl py-3 hover:bg-blue-50 transition">
                        <i class="fas fa-cloud-upload-alt mr-2"></i> Pilih Gambar
                    </label>

                    <div id="previewContainer" class="hidden mt-4 relative">
                        <img id="previewImage" class="w-full h-48 object-cover rounded-xl border-2 border-[#4988C4]">
                        <button type="button" onclick="hapusGambar()"
                            class="absolute top-2 right-2 bg-red-500 text-white w-8 h-8 rounded-full flex items-center justify-center">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <button type="button" onclick="tambahIklan()"
                    class="mt-4 w-full bg-[#4988C4] text-white font-bold py-4 rounded-xl hover:scale-105 hover:bg-[#3a6ea0] transition shadow-xl">
                    <i class="fas fa-paper-plane mr-2"></i> Upload Iklan
                </button>
            </form>
        </div>

        <!-- TABLE -->
        <div class="lg:col-span-2 relative bg-white rounded-2xl shadow-xl p-8 animate-slide">
            <div class="absolute top-0 left-0 w-full h-1 bg-[#4988C4] rounded-t-2xl"></div>

            <h2 class="text-2xl font-bold text-[#4988C4] flex items-center gap-2 mb-6">
                <i class="fas fa-list"></i> Daftar Iklan
            </h2>

            <div class="overflow-auto max-h-[600px] border-2 border-[#4988C4] rounded-xl">
                <table class="w-full border-collapse">
                    <thead class="sticky top-0 bg-[#4988C4] text-white">
                        <tr>
                            <th class="p-4 text-center">No</th>
                            <th class="p-4 text-left">Judul</th>
                            <th class="p-4">Tipe</th>
                            <th class="p-4">Link</th>
                            <th class="p-4">Gambar</th>
                            <th colspan="2" class="p-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tabelIklan"></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- SUCCESS MODAL -->
    <div id="successModal"
        class="hidden fixed inset-0 bg-blue-500/60 backdrop-blur flex items-center justify-center z-50">
        <div class="bg-white rounded-3xl shadow-2xl p-10 text-center">
            <div class="text-5xl text-[#4988C4] mb-4">✓</div>
            <h3 id="successMessage" class="text-2xl font-bold text-[#4988C4] mb-4">Berhasil</h3>
            <button onclick="tutupSuccess()"
                class="bg-[#4988C4] text-white px-8 py-3 rounded-xl hover:bg-[#3a6ea0] transition">
                OK
            </button>
        </div>
    </div>
</div>

<script>
let currentRow = null;

function previewGambar(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = ev => {
        previewImage.src = ev.target.result;
        previewContainer.classList.remove('hidden');
        labelPilihGambar.classList.add('hidden');
    };
    reader.readAsDataURL(file);
}

function hapusGambar() {
    inputGambar.value = '';
    previewContainer.classList.add('hidden');
    labelPilihGambar.classList.remove('hidden');
}

function tambahIklan() {
    const judul = inputJudul.value.trim();
    const tipe = inputTipe.value;
    const link = inputLink.value;
    const gambar = inputGambar.files[0];

    if (!judul || !tipe || !link || !gambar) {
        alert('Semua field wajib diisi!');
        return;
    }

    const row = document.createElement('tr');
    row.className = 'hover:bg-blue-50 transition';
    row.innerHTML = `
        <td class="p-4 text-center"></td>
        <td class="p-4 font-semibold text-[#4988C4]">${judul}</td>
        <td class="p-4 text-center font-bold text-[#4988C4]">${tipe}</td>
        <td class="p-4 text-center text-[#4988C4]">
            <a href="${link}" target="_blank" class="underline">${link}</a>
        </td>
        <td class="p-4 text-center">
            <img src="${URL.createObjectURL(gambar)}" class="w-32 h-20 object-cover rounded-lg mx-auto">
        </td>
        <td class="p-4 text-center">
            <button class="bg-[#4988C4] text-white px-3 py-2 rounded">Edit</button>
        </td>
        <td class="p-4 text-center">
            <button onclick="this.closest('tr').remove()" class="bg-red-600 text-white px-3 py-2 rounded">Hapus</button>
        </td>
    `;
    tabelIklan.appendChild(row);
    showSuccess('Iklan berhasil ditambahkan!');
    formTambah.reset();
    hapusGambar();
}

function showSuccess(msg) {
    successMessage.textContent = msg;
    successModal.classList.remove('hidden');
}
function tutupSuccess() {
    successModal.classList.add('hidden');
}
</script>
@endsection
