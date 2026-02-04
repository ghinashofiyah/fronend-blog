@extends('layout.App')

@section('title', 'Tambah Blog - Portal Blog')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">

<div class="min-h-screen bg-[#f5f7fa] px-6 py-8">
    <div class="max-w-6xl mx-auto font-['Segoe_UI']">

        <!-- Title -->
        <h1 class="text-4xl font-bold text-gray-800 mb-8">
            Tambah Blog
        </h1>

        <form id="blogForm"
              action="{{ route('blog.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-6">
            @csrf

            <!-- Judul -->
            <input type="text"
                   name="judul"
                   required
                   placeholder="Judul Blog"
                   class="w-full px-5 py-4 text-lg rounded-xl border-2 border-gray-300
                          focus:outline-none focus:ring-4 focus:ring-[#4988C4]/20">

            <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Editor -->
                <div class="lg:col-span-2 bg-white rounded-xl border-2 border-gray-300 overflow-hidden flex flex-col">
                    <div id="editor" class="h-[450px] text-base"></div>
                    <input type="hidden" name="deskripsi" id="deskripsi-hidden">
                </div>

                <!-- Sidebar -->
                <div class="flex flex-col gap-4">

                    <input type="text"
                           name="penulis"
                           required
                           placeholder="Penulis"
                           class="px-4 py-3 rounded-lg border border-gray-300
                                  focus:outline-none focus:ring-2 focus:ring-[#4988C4]/20">

                    <select name="kategori"
                            required
                            class="px-4 py-3 rounded-lg border border-gray-300
                                   focus:outline-none focus:ring-2 focus:ring-[#4988C4]/20">
                        <option value="" disabled selected>Pilih Kategori</option>
                        <option value="Tutorial">Tutorial</option>
                        <option value="Web Dev">Web Dev</option>
                    </select>

                    <select name="status"
                            required
                            class="px-4 py-3 rounded-lg border border-gray-300
                                   focus:outline-none focus:ring-2 focus:ring-[#4988C4]/20">
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                    </select>

                    <!-- Upload Gambar -->
                    <div>
                        <label class="flex items-center gap-2 text-sm font-bold text-[#4988C4] mb-3">
                            <i class="fas fa-image"></i>
                            Gambar Blog
                        </label>

                        <input type="file"
                               id="inputGambar"
                               name="gambar"
                               accept="image/*"
                               class="hidden"
                               onchange="previewGambar(event)">

                        <label for="inputGambar"
                               class="flex items-center justify-center gap-2 px-4 py-4
                                      border-2 border-[#4988C4] rounded-xl cursor-pointer
                                      text-[#4988C4] font-medium transition
                                      hover:bg-[#4988C4]/10">
                            <i class="fas fa-cloud-upload-alt text-xl"></i>
                            <span id="namaFile">Pilih gambar</span>
                        </label>

                        <!-- Preview -->
                        <div id="previewContainer" class="hidden mt-4">
                            <img id="previewImage"
                                 class="w-full h-48 object-cover rounded-xl border-2 border-[#4988C4]
                                        shadow-lg"
                                 alt="Preview">
                        </div>
                    </div>

                    <!-- Submit -->
                    <button type="submit"
                            class="mt-4 px-6 py-4 rounded-xl bg-[#4988C4]
                                   text-white font-bold text-lg
                                   transition hover:bg-[#3d7ab3] hover:shadow-xl">
                        Upload Blog
                    </button>

                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

<script>
    var quill = new Quill('#editor', {
        theme: 'snow',
        placeholder: 'konten',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                ['link', 'image'],
                ['clean']
            ]
        }
    });

    function previewGambar(event) {
        const file = event.target.files[0];
        if (file) {
            document.getElementById('namaFile').textContent = file.name;
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImage').src = e.target.result;
                document.getElementById('previewContainer').classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    }

    document.getElementById('blogForm').onsubmit = function () {
        document.getElementById('deskripsi-hidden').value = quill.root.innerHTML;

        if (quill.getText().trim().length === 0) {
            alert('Konten blog tidak boleh kosong!');
            return false;
        }
        return true;
    };
</script>
@endsection
