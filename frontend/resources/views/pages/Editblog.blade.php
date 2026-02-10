@extends('layout.App')

@section('title', 'Edit Blog - Portal Blog')

@section('content')
<div class="p-8 font-sans bg-white min-h-screen">

    <!-- HEADER -->
    <div class="mb-8 flex justify-between items-center flex-wrap gap-4">
        <h1 class="text-3xl font-bold text-gray-800">Edit Blog</h1>

        <a href="{{ route('blog.list') }}"
           class="px-6 py-3 rounded-xl border border-gray-300
                  text-gray-600 hover:bg-gray-50 transition">
            ← Kembali
        </a>
    </div>

    <!-- FORM -->
    <form action="#"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white rounded-2xl p-8 shadow-lg border border-gray-200">

        @csrf
        @method('PUT')

        <!-- JUDUL -->
        <div class="mb-6">
            <label class="block mb-2 font-semibold text-gray-700">
                Judul Blog
            </label>
            <input type="text"
       name="judul"
       value="{{ old('judul', $blog['judul']) }}"
       class="w-full px-4 py-3 rounded-xl border"
       required>

        </div>

        <!-- KATEGORI -->
        <div class="mb-6">
            <label class="block mb-2 font-semibold text-gray-700">
                Kategori
            </label>
            <select name="kategori" class="w-full px-4 py-3 rounded-xl border">
    <option value="Edukasi"
        {{ $blog['kategori'] === 'Edukasi' ? 'selected' : '' }}>
        Edukasi
    </option>
    <option value="Teknologi"
        {{ $blog['kategori'] === 'Teknologi' ? 'selected' : '' }}>
        Teknologi
    </option>
</select>

        </div>

        <!-- FOTO -->
        <div class="mb-6">
            <label class="block mb-2 font-semibold text-gray-700">
                Foto Blog
            </label>

            @if (!empty($blog['gambar']))
                <img src="{{ $blog['gambar'] }}"
                    class="w-32 h-32 object-cover rounded-xl shadow mb-4">
            @endif


            <input type="file"
                   name="foto"
                   class="w-full px-4 py-3 rounded-xl border">
        </div>

        <!-- ISI BLOG -->
        <div class="mb-8">
            <label class="block mb-2 font-semibold text-gray-700">
                Isi Blog
            </label>
            <textarea name="konten" rows="6"
          class="w-full px-4 py-3 rounded-xl border"
          required>{{ old('konten', $blog['konten']) }}</textarea>

        </div>

        <!-- STATUS -->
        <div class="mb-8">
            <label class="block mb-2 font-semibold text-gray-700">
                Status
            </label>
            <select name="status"
                    class="w-full px-4 py-3 rounded-xl border">
                <option value="publish">
                    Publish
                </option>
                <option value="draft">
                    Draft
                </option>
            </select>
        </div>

        <!-- ACTION -->
        <div class="flex gap-4">
            <button type="submit"
                    class="px-8 py-3 bg-[#4988C4] text-white
                           font-semibold rounded-xl
                           shadow-lg shadow-blue-500/40
                           hover:-translate-y-0.5 transition">
                Update Blog
            </button>

            <a href="{{ route('blog.list') }}"
               class="px-8 py-3 rounded-xl border border-gray-300
                      text-gray-600 hover:bg-gray-50 transition">
                Batal
            </a>
        </div>

    </form>
</div>
@endsection
