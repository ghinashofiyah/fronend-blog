@extends('layout.App')

@section('title', 'Kategori - Portal Blog')

@section('content')
<div class="min-h-screen bg-[#fbfbfc] p-6">

    <div class="max-w-7xl mx-auto">

        <!-- Header -->
        <div class="mb-8 animate-[slideIn_0.5s_ease-out]">
            <h1 class="flex items-center gap-4 text-5xl font-bold text-black drop-shadow-lg">
                <div class="p-4 rounded-2xl bg-[#4988C4] shadow-2xl">
                    <i class="fas fa-layer-group text-white text-4xl"></i>
                </div>
                Kelola Kategori & Tag
            </h1>
        </div>

        <!-- KATEGORI -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

            <!-- Tambah Kategori -->
            <div class="relative bg-white rounded-2xl p-6 shadow-2xl
                        transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_20px_40px_rgba(0,0,0,0.2)]
                        before:absolute before:top-0 before:left-0 before:right-0 before:h-1
                        before:bg-[#4988C4] before:rounded-t-2xl">

                <h2 class="text-2xl font-bold text-[#4988C4] mb-5 pb-3 border-b-2 border-[#4988C4]">
                    <i class="fas fa-plus-circle mr-2"></i> Tambah Kategori
                </h2>

                <div class="space-y-4">
                    <input id="inputKategori" type="text" placeholder="Masukkan nama kategori"
                        class="w-full px-4 py-3 border-2 border-[#4988C4] rounded-xl outline-none
                               focus:ring-4 focus:ring-[#4988C4]/20">

                    <textarea id="newCategoryDesc" rows="3" placeholder="Deskripsi"
                        class="w-full px-4 py-3 border border-gray-300 rounded-md resize-none
                               focus:ring-2 focus:ring-[#4988C4]/20"></textarea>

                    <button onclick="tambahKategori()"
                        class="w-full bg-[#4988C4] text-white font-semibold py-3 rounded-xl
                               shadow-lg transition-all hover:scale-105 hover:shadow-2xl">
                        <i class="fas fa-save mr-2"></i> Simpan Kategori
                    </button>
                </div>
            </div>

            <!-- Tabel Kategori -->
            <div class="relative bg-white rounded-2xl p-6 shadow-2xl
                        transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_20px_40px_rgba(0,0,0,0.2)]
                        before:absolute before:top-0 before:left-0 before:right-0 before:h-1
                        before:bg-[#4988C4] before:rounded-t-2xl">

                <h2 class="text-2xl font-bold text-[#4988C4] mb-5 pb-3 border-b-2 border-[#4988C4]">
                    <i class="fas fa-list mr-2"></i> Daftar Kategori
                </h2>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-[#4988C4]/10 text-[#4988C4] font-bold">
                                <th class="p-4 text-left">Nama</th>
                                <th class="p-4 text-left">Deskripsi</th>
                                <th class="p-4 text-center">Jumlah</th>
                                <th class="p-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tabelKategori">
                            <tr class="border-b hover:bg-gray-50 transition">
                                <td class="p-4 font-semibold flex items-center gap-2">
                                    <i class="fas fa-folder text-[#4988C4]"></i> Teknologi
                                </td>
                                <td class="p-4 text-gray-500">
                                    Artikel seputar teknologi terkini
                                </td>
                                <td class="p-4 text-center">
                                    <span class="px-4 py-1 text-xs font-bold text-white bg-[#4988C4] rounded-full">
                                        12
                                    </span>
                                </td>
                                <td class="p-4 text-center">
                                    <button onclick="editKategori(this,'Teknologi',12)"
                                        class="p-2 rounded-lg text-[#3a6ea0] hover:bg-[#4988C4]/10 mr-2">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="hapusKategori(this)"
                                        class="p-2 rounded-lg text-red-600 hover:bg-[#4988C4]/10">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- TAG -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <!-- Tambah Tag -->
            <div class="relative bg-white rounded-2xl p-6 shadow-2xl
                        transition-all hover:-translate-y-1 hover:shadow-[0_20px_40px_rgba(0,0,0,0.2)]
                        before:absolute before:top-0 before:left-0 before:right-0 before:h-1
                        before:bg-[#4988C4] before:rounded-t-2xl">

                <h2 class="text-2xl font-bold text-[#4988C4] mb-5 pb-3 border-b-2 border-[#4988C4]">
                    <i class="fas fa-tags mr-2"></i> Tambah Tag
                </h2>

                <div class="space-y-4">
                    <input id="inputTag" type="text" placeholder="Masukkan nama tag"
                        class="w-full px-4 py-3 border-2 border-[#4988C4] rounded-xl outline-none
                               focus:ring-4 focus:ring-[#4988C4]/20">

                    <button onclick="tambahTag()"
                        class="w-full bg-[#4988C4] text-white font-semibold py-3 rounded-xl
                               shadow-lg transition-all hover:scale-105 hover:shadow-2xl">
                        <i class="fas fa-save mr-2"></i> Simpan Tag
                    </button>
                </div>
            </div>

            <!-- Tabel Tag -->
            <div class="relative bg-white rounded-2xl p-6 shadow-2xl
                        transition-all hover:-translate-y-1 hover:shadow-[0_20px_40px_rgba(0,0,0,0.2)]
                        before:absolute before:top-0 before:left-0 before:right-0 before:h-1
                        before:bg-[#4988C4] before:rounded-t-2xl">

                <h2 class="text-2xl font-bold text-[#4988C4] mb-5 pb-3 border-b-2 border-[#4988C4]">
                    <i class="fas fa-bookmark mr-2"></i> Daftar Tag
                </h2>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-[#4988C4]/10 text-[#4988C4] font-bold">
                                <th class="p-4 text-left">Nama</th>
                                <th class="p-4 text-center">Jumlah</th>
                                <th class="p-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tabelTag">
                            <tr class="border-b hover:bg-gray-50 transition">
                                <td class="p-4 font-semibold flex items-center gap-2">
                                    <i class="fas fa-tag text-[#4988C4]"></i> Programming
                                </td>
                                <td class="p-4 text-center">
                                    <span class="px-4 py-1 text-xs font-bold text-white bg-[#4988C4] rounded-full">
                                        25
                                    </span>
                                </td>
                                <td class="p-4 text-center">
                                    <button onclick="editTag(this,'Programming',25)"
                                        class="p-2 rounded-lg text-[#3a6ea0] hover:bg-[#4988C4]/10 mr-2">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="hapusTag(this)"
                                        class="p-2 rounded-lg text-red-600 hover:bg-[#4988C4]/10">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
