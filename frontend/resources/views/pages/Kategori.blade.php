@extends('layout.App')

@section('title', 'Kategori - Portal Blog')

@section('content')
<link rel="stylesheet" href="{{ asset('css/kategori.css') }}">

<div class="max-w-7xl mx-auto">
    <div class="mb-8 animate-slide page-header">
        <h1 class="page-title">
            <div class="title-icon">
                <i class="fas fa-layer-group"></i>
            </div>
            Kelola Kategori & Tag
        </h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Tambah Kategori -->
        <div class="card card-hover gradient-border">
            <h2 class="card-header">
                <i class="fas fa-plus-circle"></i> Tambah Kategori
            </h2>
            <div class="space-y-4">
                <input type="text" id="inputKategori" placeholder="Masukkan nama kategori" class="form-input" required>
                <textarea id="newCategoryDesc" placeholder="Deskripsi" rows="3" class="form-textarea"></textarea>   
                <button onclick="tambahKategori()" class="btn-primary">
                    <i class="fas fa-save mr-2"></i>Simpan Kategori
                </button>
            </div>
        </div>

        <!-- Tabel Kategori -->
        <div class="card card-hover gradient-border">
            <h2 class="card-header">
                <i class="fas fa-list"></i> Daftar Kategori
            </h2>
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tabelKategori">
                        <tr>
                            <td class="table-cell-name">
                                <i class="fas fa-folder"></i>Teknologi
                            </td>
                            <td class="table-cell-desc">
                                Artikel seputar teknologi terkini
                            </td>
                            <td class="text-center">
                                <span class="badge">12</span>
                            </td>
                            <td class="text-center">
                                <button onclick="editKategori(this, 'Teknologi', 12)" class="btn-action btn-edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="hapusKategori(this)" class="btn-action btn-delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Tambah Tag -->
        <div class="card card-hover gradient-border">
            <h2 class="card-header">
                <i class="fas fa-tags"></i> Tambah Tag
            </h2>
            <div class="space-y-4">
                <input type="text" id="inputTag" placeholder="Masukkan nama tag" class="form-input" required>
                <button onclick="tambahTag()" class="btn-primary">
                    <i class="fas fa-save mr-2"></i>Simpan Tag
                </button>
            </div>
        </div>

        <!-- Tabel Tag -->
        <div class="card card-hover gradient-border">
            <h2 class="card-header">
                <i class="fas fa-bookmark"></i> Daftar Tag
            </h2>
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tabelTag">
                        <tr>
                            <td class="table-cell-name">
                                <i class="fas fa-tag"></i>Programming
                            </td>
                            <td class="text-center">
                                <span class="badge">25</span>
                            </td>
                            <td class="text-center">
                                <button onclick="editTag(this, 'Programming', 25)" class="btn-action btn-edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="hapusTag(this)" class="btn-action btn-delete">
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

<!-- Modal Edit Kategori -->
<div id="modalKategori" class="modal hidden">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fas fa-edit mr-2"></i>Edit Kategori</h3>
        </div>
        <div class="modal-body space-y-4">
            <input type="text" id="editNamaKategori" class="modal-input" placeholder="Nama kategori">
            <textarea id="editDeskripsiKategori" rows="3" class="modal-textarea" placeholder="Deskripsi kategori"></textarea>
            <input type="number" id="editJumlahKategori" class="modal-input" placeholder="Jumlah">
            <div class="modal-buttons">
                <button onclick="simpanKategori()" class="modal-btn modal-btn-primary">
                    <i class="fas fa-check mr-2"></i>Simpan
                </button>
                <button onclick="tutupModal('modalKategori')" class="modal-btn modal-btn-secondary">
                    <i class="fas fa-times mr-2"></i>Batal
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Tag -->
<div id="modalTag" class="modal hidden">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fas fa-edit mr-2"></i>Edit Tag</h3>
        </div>
        <div class="modal-body space-y-4">
            <input type="text" id="editNamaTag" class="modal-input" placeholder="Nama tag">
            <input type="number" id="editJumlahTag" class="modal-input" placeholder="Jumlah">
            <div class="modal-buttons">
                <button onclick="simpanTag()" class="modal-btn modal-btn-primary">
                    <i class="fas fa-check mr-2"></i>Simpan
                </button>
                <button onclick="tutupModal('modalTag')" class="modal-btn modal-btn-secondary">
                    <i class="fas fa-times mr-2"></i>Batal
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div id="successModal" class="modal hidden">
    <div class="success-modal-content">
        <div class="success-icon">✓</div>
        <h3 class="success-message" id="successMessage">Berhasil!</h3>
        <button onclick="tutupModal('successModal')" class="success-btn">OK</button>
    </div>
</div>

<script>
    let currentRow = null;
    const colors = ['#4988C4'];

    function tambahKategori() {
        const namaInput = document.getElementById('inputKategori');
        const descInput = document.getElementById('newCategoryDesc');

        const nama = namaInput.value.trim();
        const deskripsi = descInput.value.trim();

        if (!nama) return alert('⚠️ Nama kategori tidak boleh kosong!');

        const tbody = document.getElementById('tabelKategori');
        const tr = document.createElement('tr');
        const color = colors[0];

        tr.innerHTML = `
            <td class="table-cell-name">
                <i class="fas fa-folder"></i>${nama}
            </td>
            <td class="table-cell-desc">
                ${deskripsi || '-'}
            </td>
            <td class="text-center">
                <span class="badge">0</span>
            </td>
            <td class="text-center">
                <button onclick="editKategori(this)" class="btn-action btn-edit">
                    <i class="fas fa-edit"></i>
                </button>
                <button onclick="hapusKategori(this)" class="btn-action btn-delete">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        `;
        tbody.appendChild(tr);
        namaInput.value = '';
        descInput.value = '';
        showSuccess('Kategori berhasil ditambahkan!');
    }

    function tambahTag() {
        const input = document.getElementById('inputTag');
        const nama = input.value.trim();
        if (!nama) return alert('⚠️ Nama tag tidak boleh kosong!');

        const tbody = document.getElementById('tabelTag');
        const tr = document.createElement('tr');
        const color = colors[0];
        
        tr.innerHTML = `
            <td class="table-cell-name">
                <i class="fas fa-tag"></i>${nama}
            </td>
            <td class="text-center">
                <span class="badge">0</span>
            </td>
            <td class="text-center">
                <button onclick="editTag(this, '${nama}', 0)" class="btn-action btn-edit">
                    <i class="fas fa-edit"></i>
                </button>
                <button onclick="hapusTag(this)" class="btn-action btn-delete">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        `;
        tbody.appendChild(tr);
        input.value = '';
        showSuccess('Tag berhasil ditambahkan!');
    }

    function editKategori(btn, nama, jumlah) {
        currentRow = btn.closest('tr');
        document.getElementById('editNamaKategori').value = nama;
        document.getElementById('editJumlahKategori').value = jumlah;
        document.getElementById('modalKategori').classList.remove('hidden');
    }

    function editTag(btn, nama, jumlah) {
        currentRow = btn.closest('tr');
        document.getElementById('editNamaTag').value = nama;
        document.getElementById('editJumlahTag').value = jumlah;
        document.getElementById('modalTag').classList.remove('hidden');
    }

    function simpanKategori() {
        const nama = document.getElementById('editNamaKategori').value.trim();
        const jumlah = document.getElementById('editJumlahKategori').value;
        if (!nama) return alert('⚠️ Nama tidak boleh kosong!');

        const cells = currentRow.cells;
        cells[0].innerHTML = `<i class="fas fa-folder" style="color: #4988C4;"></i>${nama}`;
        cells[2].querySelector('span').textContent = jumlah;
        tutupModal('modalKategori');
        showSuccess('Kategori berhasil diupdate!');
    }

    function simpanTag() {
        const nama = document.getElementById('editNamaTag').value.trim();
        const jumlah = document.getElementById('editJumlahTag').value;
        if (!nama) return alert('⚠️ Nama tidak boleh kosong!');

        const cells = currentRow.cells;
        cells[0].innerHTML = `<i class="fas fa-tag" style="color: #4988C4;"></i>${nama}`;
        cells[1].querySelector('span').textContent = jumlah;
        tutupModal('modalTag');
        showSuccess('Tag berhasil diupdate!');
    }

    function hapusKategori(btn) {
        if (confirm('⚠️ Yakin ingin menghapus kategori ini?')) {
            btn.closest('tr').remove();
            showSuccess('Kategori berhasil dihapus!');
        }
    }

    function hapusTag(btn) {
        if (confirm('⚠️ Yakin ingin menghapus tag ini?')) {
            btn.closest('tr').remove();
            showSuccess('Tag berhasil dihapus!');
        }
    }

    function tutupModal(id) {
        document.getElementById(id).classList.add('hidden');
    }

    function showSuccess(msg) {
        document.getElementById('successMessage').textContent = msg;
        document.getElementById('successModal').classList.remove('hidden');
        setTimeout(() => tutupModal('successModal'), 2000);
    }

    // Close modal on outside click
    document.querySelectorAll('.fixed').forEach(modal => {
        modal.addEventListener('click', e => {
            if (e.target === modal) tutupModal(modal.id);
        });
    });
</script>

@endsection