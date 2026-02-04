@extends('layout.App')

@section('title', 'Admin - Portal Blog')

@section('content')
<div class="p-6 max-w-7xl mx-auto">

    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-bold text-gray-800 flex items-center gap-3">
            <i class="fas fa-users-cog text-[#4988C4]"></i>
            Kelola Admin
        </h1>

        <button onclick="openTambahModal()"
            class="bg-[#4988C4] text-white px-6 py-3 rounded-xl font-semibold
                   shadow-lg hover:shadow-xl transition-all
                   flex items-center gap-2">
            <i class="fas fa-plus-circle"></i>
            Tambah Admin
        </button>
    </div>

    <!-- Card Table -->
    <div class="bg-white rounded-2xl shadow-xl p-6
                transition-all duration-300
                hover:-translate-y-0.5 hover:shadow-2xl">

        <!-- Search -->
        <div class="flex justify-between items-center mb-6">
            <div></div>
            <div class="relative">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="text" placeholder="Cari admin..."
                    class="pl-12 pr-4 py-2 border-2 border-gray-200 rounded-xl
                           focus:border-[#4988C4]
                           focus:ring-4 focus:ring-[#4988C4]/20
                           outline-none transition-all">
            </div>
        </div>

        @php
            $admins = [
                ['nama'=>'Administrator','email'=>'admin@example.com','inisial'=>'AD'],
                ['nama'=>'Budi Santoso','email'=>'budi@example.com','inisial'=>'BS'],
                ['nama'=>'Siti Rahma','email'=>'siti@example.com','inisial'=>'SR'],
                ['nama'=>'Dewi Lestari','email'=>'dewi@example.com','inisial'=>'DL'],
            ];
        @endphp

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-[#4988C4] text-white">
                    <tr>
                        <th class="py-4 px-4 text-left rounded-tl-xl">No</th>
                        <th class="py-4 px-4 text-left">Foto</th>
                        <th class="py-4 px-4 text-left">Nama</th>
                        <th class="py-4 px-4 text-left">Email</th>
                        <th class="py-4 px-4 text-left">Password</th>
                        <th class="py-4 px-4 text-center rounded-tr-xl">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($admins as $index => $admin)
                    <tr class="border-b hover:bg-[#4988C4]/10 transition-all">
                        <td class="py-4 px-4 font-semibold">{{ $index + 1 }}</td>

                        <td class="py-4 px-4">
                            <div class="w-12 h-12 bg-[#4988C4] rounded-full
                                        flex items-center justify-center
                                        text-white font-bold text-lg">
                                {{ $admin['inisial'] }}
                            </div>
                        </td>

                        <td class="py-4 px-4 font-semibold text-gray-800">
                            {{ $admin['nama'] }}
                        </td>

                        <td class="py-4 px-4 text-gray-600">
                            {{ $admin['email'] }}
                        </td>

                        <td class="py-4 px-4">
                            <span class="bg-gray-200 px-3 py-1 rounded-full text-xs font-mono">
                                ••••••••
                            </span>
                        </td>

                        <td class="py-4 px-4 text-center">
                            <button
                                onclick="openEditModal('{{ $admin['nama'] }}','{{ $admin['email'] }}', this)"
                                class="bg-[#4988C4] hover:bg-[#3a6fa0]
                                       text-white px-4 py-2 rounded-lg
                                       font-semibold mr-2
                                       shadow-md hover:shadow-lg transition-all">
                                <i class="fas fa-edit"></i>
                            </button>

                            <button
                                onclick="hapusAdmin(this)"
                                class="bg-red-500 hover:bg-red-600
                                       text-white px-4 py-2 rounded-lg
                                       font-semibold
                                       shadow-md hover:shadow-lg transition-all">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ================= MODAL EDIT ================= -->
<div id="modalEdit"
     class="hidden fixed inset-0 bg-black/60 backdrop-blur-md
            flex items-center justify-center z-50 p-4">

    <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full">
        <div class="bg-[#4988C4] text-white p-6 rounded-t-3xl">
            <h3 class="text-2xl font-bold flex items-center gap-2">
                <i class="fas fa-user-edit"></i> Edit Admin
            </h3>
        </div>

        <div class="p-6 space-y-4">

            <!-- Foto Profil -->
            <div class="flex flex-col items-center gap-3">
                <img id="previewFoto"
                     src="https://ui-avatars.com/api/?name=Admin&background=4988C4&color=fff"
                     class="w-24 h-24 rounded-full object-cover shadow">

                <input id="editFoto" type="file" accept="image/*"
                       onchange="previewImage(event)"
                       class="text-sm text-gray-600">
            </div>

            <!-- Nama -->
            <div>
                <label class="block text-sm font-semibold mb-2">Nama</label>
                <input id="editNama" type="text"
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl
                           focus:border-[#4988C4] focus:ring-4
                           focus:ring-[#4988C4]/20 outline-none">
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-semibold mb-2">Email</label>
                <input id="editEmail" type="email"
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl
                           focus:border-[#4988C4] focus:ring-4
                           focus:ring-[#4988C4]/20 outline-none">
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-semibold mb-2">
                    Password <span class="text-xs text-gray-500">(kosongkan jika tidak diubah)</span>
                </label>
                <input id="editPassword" type="password"
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl
                           focus:border-[#4988C4] focus:ring-4
                           focus:ring-[#4988C4]/20 outline-none">
            </div>

            <!-- Action -->
            <div class="flex gap-3 pt-2">
                <button onclick="closeEditModal()"
                    class="flex-1 bg-gray-400 text-white py-3 rounded-xl font-semibold">
                    Batal
                </button>
                <button onclick="simpanEdit()"
                    class="flex-1 bg-[#4988C4] text-white py-3 rounded-xl font-semibold">
                    Simpan
                </button>
            </div>

        </div>
    </div>
</div>


<!-- ================= SCRIPT ================= -->
<script>
    let rowAktif = null;

    function openEditModal(nama, email, btn) {
        rowAktif = btn.closest('tr');

        document.getElementById('editNama').value = nama;
        document.getElementById('editEmail').value = email;
        document.getElementById('editPassword').value = '';

        // Update preview foto pakai inisial
        const inisial = nama.split(' ').map(n => n[0]).join('');
        document.getElementById('previewFoto').src =
            `https://ui-avatars.com/api/?name=${inisial}&background=4988C4&color=fff`;

        document.getElementById('modalEdit').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('modalEdit').classList.add('hidden');
    }

    function simpanEdit() {
        const nama = editNama.value;
        const email = editEmail.value;

        rowAktif.children[2].innerText = nama;
        rowAktif.children[3].innerText = email;

        closeEditModal();
    }

    function hapusAdmin(btn) {
        if (confirm('Yakin ingin menghapus admin ini?')) {
            btn.closest('tr').remove();
        }
    }

    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function () {
            document.getElementById('previewFoto').src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

@endsection
