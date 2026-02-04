@extends('layout.App')

@section('title', 'Tambah Blog - Portal Blog')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
<link href="{{ asset('css/tambahblog.css') }}" rel="stylesheet">

<div class="tambah-blog-container">   
    <h1>Tambah Blog</h1>
    
    <form id="blogForm" action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-grid">
            <input type="text" id="judul" name="judul" placeholder="Judul Blog" required class="input-judul">

            <div class="content-grid">
                
                <div class="editor-container">
                    <div id="editor"></div>
                    <input type="hidden" name="deskripsi" id="deskripsi-hidden">
                </div>
                
                <div class="sidebar-form">
                    <input type="text" name="penulis" placeholder="Penulis" required class="form-input">
                    
                    <select name="kategori" required class="form-input">
                        <option value="" disabled selected>Pilih Kategori</option>
                        <option value="Tutorial">Tutorial</option>
                        <option value="Web Dev">Web Dev</option>
                    </select>

                    <select name="status" required class="form-input">
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                    </select>

                    <div>
                        <label class="block text-sm font-bold mb-3 flex items-center gap-2 label-gambar">
                            <i class="fas fa-image"></i>
                            Gambar Blog
                        </label>
                        <div class="file-input-wrapper">
                            <input 
                                type="file" 
                                id="inputGambar"
                                name="gambar"
                                accept="image/*"
                                class="file-input-hidden"
                                onchange="previewGambar(event)"
                            >
                            <label for="inputGambar" class="file-label">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <span id="namaFile">Pilih gambar</span>
                            </label>
                        </div>
                        <div id="previewContainer" class="preview-container hidden">
                            <img id="previewImage" class="preview-image" alt="Preview">
                        </div>
                    </div>
                    
                    <button type="submit" id="submit-btn" class="submit-btn">
                        Upload Blog
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

<script>
    // 1. Inisialisasi Quill
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

    // 2. Fungsi Preview Gambar
    function previewGambar(event) {
        const file = event.target.files[0];
        if (file) {
            // Update nama file
            document.getElementById('namaFile').textContent = file.name;
            
            // Tampilkan preview
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImage').src = e.target.result;
                document.getElementById('previewContainer').classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    }

    // 3. Submit Form
    var form = document.getElementById('blogForm');
    form.onsubmit = function() {
        // Ambil konten dari Quill
        var content = document.querySelector('input[name=deskripsi]');
        
        // Set value dari Quill ke hidden input
        content.value = quill.root.innerHTML;
        
        // Validasi konten tidak boleh kosong
        if (quill.getText().trim().length === 0) {
            alert('Konten blog tidak boleh kosong!');
            return false;
        }
        
        return true;
    };
</script>

@endsection