@extends('layout.App')

@section('title', 'Iklan - Portal Blog')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/iklan.css') }}">
@endpush

@section('content')

<div class="page-container">
  <!-- Header -->
  <div class="page-header animate-slide">
    <h1 class="page-title">
      <div class="title-icon-wrapper">
        <i class="fas fa-ad title-icon"></i>
      </div>
      Kelola Iklan
    </h1>
  </div>

  <div class="content-grid">

    <!-- FORM TAMBAH IKLAN -->
    <div class="form-card card-hover gradient-border animate-slide">
      <h2 class="section-title">
        <i class="fas fa-plus-circle"></i>
        Tambah Iklan
      </h2>

      <form id="formTambah" class="form-container">
        <div class="form-fields">
          <div class="form-group">
            <label class="form-label label-with-icon">
              <i class="fas fa-heading"></i>
              Judul Iklan
            </label>
            <input 
              type="text" 
              id="inputJudul"
              placeholder="Masukkan judul iklan" 
              class="form-input"
            />
          </div>

          <div class="form-group">
            <label class="form-label label-with-icon">
              <i class="fas fa-layer-group"></i>
              Tipe Iklan
            </label>
            <select id="inputTipe" class="form-select">
              <option value="">Pilih Tipe Iklan</option>
              <option>1:1 Slide</option>
              <option>3:1 Kanan</option>
              <option>3:1 Kiri</option>
              <option>3:1 Tengah</option>
              <option>1:3 Atas</option>
              <option>1:3 Tengah</option>
            </select>
          </div>

          <div class="form-group">
            <label class="form-label label-with-icon">
              <i class="fas fa-link"></i>
              Link URL
            </label>
            <input 
              type="text" 
              id="inputLink"
              placeholder="https://example.com" 
              class="form-input"
            />
          </div>

          <div class="form-group">
            <label class="form-label label-with-icon">
              <i class="fas fa-image"></i>
              Gambar Iklan
            </label>
            <div class="relative">
              <input 
                type="file" 
                id="inputGambar" 
                accept="image/*"
                class="file-input-hidden"
                onchange="previewGambar(event)"
              >
              <label id="labelPilihGambar" for="inputGambar" class="file-upload-label">
                <i class="fas fa-cloud-upload-alt file-upload-icon"></i>
                <span>Pilih gambar</span>
              </label>
              <div id="previewContainer" class="preview-container hidden">
                <div class="relative">
                  <img id="previewImage" class="preview-image" alt="Preview">
                  <button type="button" onclick="hapusGambar()" class="delete-preview-btn">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="form-spacer"></div>

        <button 
          type="button"
          onclick="tambahIklan()" 
          class="btn-submit"
        >
          <i class="fas fa-paper-plane mr-2"></i>Upload Iklan
        </button>
      </form>
    </div>

    <!-- TABEL IKLAN -->
    <div class="table-card card-hover table-section gradient-border animate-slide">
      <h2 class="section-title">
        <i class="fas fa-list"></i>
        Daftar Iklan
      </h2>

      <div class="table-wrapper">
        <table class="data-table">
          <thead>
            <tr>
              <th>No</th>
              <th class="text-left">Judul</th>
              <th>Tipe</th>
              <th>Link</th>
              <th>Gambar</th>
              <th colspan="2">Aksi</th>
            </tr>
          </thead>
          <tbody id="tabelIklan">
            <tr>
              <td class="text-center cell-number">1</td>
              <td class="cell-title">Pemerintah Resmi Naikkan UMK 2026</td>
              <td class="text-center">
                <span class="cell-type">3:1 Tengah</span>
              </td>
              <td>
                <a href="https://berita.com/1" target="_blank" class="cell-link">
                  <i class="fas fa-external-link-alt"></i>
                  berita.com/1
                </a>
              </td>
              <td>
                <img src="https://picsum.photos/seed/1/120/80" class="cell-image" alt="Iklan 1">
              </td>
              <td class="text-center">
                <button onclick="editIklan(this, 'Pemerintah Resmi Naikkan UMK 2026', '3:1 Tengah', 'https://berita.com/1')" class="btn-edit">
                  <i class="fas fa-edit"></i>
                </button>
              </td>
              <td class="text-center">
                <button onclick="hapusIklan(this)" class="btn-delete">
                  <i class="fas fa-trash"></i>
                </button>
              </td>
            </tr>
            <tr>
              <td class="text-center cell-number">2</td>
              <td class="cell-title">Harga BBM Terbaru Berlaku Nasional</td>
              <td class="text-center">
                <span class="cell-type">1:1 Slide</span>
              </td>
              <td>
                <a href="https://berita.com/2" target="_blank" class="cell-link">
                  <i class="fas fa-external-link-alt"></i>
                  berita.com/2
                </a>
              </td>
              <td>
                <img src="https://picsum.photos/seed/2/120/80" class="cell-image" alt="Iklan 2">
              </td>
              <td class="text-center">
                <button onclick="editIklan(this, 'Harga BBM Terbaru Berlaku Nasional', '1:1 Slide', 'https://berita.com/2')" class="btn-edit">
                  <i class="fas fa-edit"></i>
                </button>
              </td>
              <td class="text-center">
                <button onclick="hapusIklan(this)" class="btn-delete">
                  <i class="fas fa-trash"></i>
                </button>
              </td>
            </tr>
            <tr>
              <td class="text-center cell-number">3</td>
              <td class="cell-title">Timnas Indonesia Lolos Piala Asia</td>
              <td class="text-center">
                <span class="cell-type">3:1 Kanan</span>
              </td>
              <td>
                <a href="https://berita.com/3" target="_blank" class="cell-link">
                  <i class="fas fa-external-link-alt"></i>
                  berita.com/3
                </a>
              </td>
              <td>
                <img src="https://picsum.photos/seed/3/120/80" class="cell-image" alt="Iklan 3">
              </td>
              <td class="text-center">
                <button onclick="editIklan(this, 'Timnas Indonesia Lolos Piala Asia', '3:1 Kanan', 'https://berita.com/3')" class="btn-edit">
                  <i class="fas fa-edit"></i>
                </button>
              </td>
              <td class="text-center">
                <button onclick="hapusIklan(this)" class="btn-delete">
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

<!-- MODAL EDIT -->
<div id="modal" class="modal hidden">
  <div class="modal-content animate-slide">
    <div class="modal-header">
      <h3 class="modal-title">
        <i class="fas fa-edit"></i>
        Edit Iklan
      </h3>
    </div>

    <form class="modal-body modal-form">
      <div class="form-group">
        <label class="form-label">Judul</label>
        <input id="modalJudul" type="text" class="modal-input">
      </div>

      <div class="form-group">
        <label class="form-label">Tipe Iklan</label>
        <select id="modalTipe" class="modal-select">
          <option>1:1 Slide</option>
          <option>3:1 Kanan</option>
          <option>3:1 Kiri</option>
          <option>3:1 Tengah</option>
          <option>1:3 Atas</option>
          <option>1:3 Tengah</option>
        </select>
      </div>

      <div class="form-group">
        <label class="form-label">Link</label>
        <input id="modalLink" type="text" placeholder="https://example.com" class="modal-input">
      </div>

      <div class="form-group">
        <label class="form-label">Gambar</label>
        <div class="modal-file-wrapper">
          <input 
            type="file" 
            id="editInputGambar" 
            accept="image/*"
            class="file-input-hidden"
            onchange="previewEditGambar(event)"
          >
          <label for="editInputGambar" class="modal-file-label">
            <i class="fas fa-image"></i>
            <span>Ganti gambar</span>
          </label>
        </div>
        <div id="editPreviewContainer" class="modal-preview-container">
          <img id="editPreviewImage" class="modal-preview-image" alt="Preview Edit">
        </div>
      </div>

      <div class="modal-actions">
        <button type="button" onclick="closeModal()" class="btn-cancel">
          <i class="fas fa-times mr-2"></i>Batal
        </button>
        <button type="button" onclick="simpanEdit()" class="btn-save">
          <i class="fas fa-check mr-2"></i>Simpan
        </button>
      </div>
    </form>
  </div>
</div>

<!-- Success Modal -->
<div id="successModal" class="success-modal hidden">
  <div class="success-modal-content">
    <div class="success-icon">✓</div>
    <h3 class="success-message" id="successMessage">Berhasil!</h3>
    <button onclick="tutupSuccess()" class="btn-success-ok">OK</button>
  </div>
</div>

@push('scripts')
<script>
  let currentRow = null;

  function previewGambar(event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById('previewImage').src = e.target.result;
        document.getElementById('labelPilihGambar').classList.add('hidden');
        document.getElementById('previewContainer').classList.remove('hidden');
      }
      reader.readAsDataURL(file);
    }
  }

  function hapusGambar() {
    document.getElementById('inputGambar').value = '';
    document.getElementById('previewImage').src = '';
    document.getElementById('labelPilihGambar').classList.remove('hidden');
    document.getElementById('previewContainer').classList.add('hidden');
  }

  function tambahIklan() {
    const judul = document.getElementById('inputJudul').value.trim();
    const tipe = document.getElementById('inputTipe').value;
    const link = document.getElementById('inputLink').value.trim();
    const gambar = document.getElementById('inputGambar').files[0];

    if (!judul || !tipe || !link || !gambar) {
      alert('⚠️ Semua field harus diisi!');
      return;
    }

    const tbody = document.getElementById('tabelIklan');
    const rowCount = tbody.rows.length + 1;

    const tr = document.createElement('tr');
    
    tr.innerHTML = `
      <td class="text-center cell-number">${rowCount}</td>
      <td class="cell-title">${judul}</td>
      <td class="text-center">
        <span class="cell-type">${tipe}</span>
      </td>
      <td>
        <a href="${link}" target="_blank" class="cell-link">
          <i class="fas fa-external-link-alt"></i>
          ${link.substring(0, 30)}...
        </a>
      </td>
      <td>
        <img src="${URL.createObjectURL(gambar)}" class="cell-image" alt="Iklan ${rowCount}">
      </td>
      <td class="text-center">
        <button onclick="editIklan(this, '${judul}', '${tipe}', '${link}')" class="btn-edit">
          <i class="fas fa-edit"></i>
        </button>
      </td>
      <td class="text-center">
        <button onclick="hapusIklan(this)" class="btn-delete">
          <i class="fas fa-trash"></i>
        </button>
      </td>
    `;
    tbody.appendChild(tr);

    document.getElementById('formTambah').reset();
    document.getElementById('labelPilihGambar').classList.remove('hidden');
    document.getElementById('previewContainer').classList.add('hidden');
    
    showSuccess('Iklan berhasil ditambahkan!');
  }

  function editIklan(btn, judul, tipe, link) {
    currentRow = btn.closest('tr');
    document.getElementById('modal').classList.remove('hidden');
    document.getElementById('modalJudul').value = judul;
    document.getElementById('modalTipe').value = tipe;
    document.getElementById('modalLink').value = link;
    
    const imgSrc = currentRow.cells[4].querySelector('img').src;
    document.getElementById('editPreviewImage').src = imgSrc;
  }

  function closeModal() {
    document.getElementById('modal').classList.add('hidden');
    currentRow = null;
  }

  function previewEditGambar(event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById('editPreviewImage').src = e.target.result;
      }
      reader.readAsDataURL(file);
    }
  }

  function simpanEdit() {
    if (!currentRow) return;
    
    const judul = document.getElementById('modalJudul').value.trim();
    const tipe = document.getElementById('modalTipe').value;
    const link = document.getElementById('modalLink').value.trim();
    const gambarFile = document.getElementById('editInputGambar').files[0];
    
    if (!judul || !tipe || !link) {
      alert('⚠️ Semua field harus diisi!');
      return;
    }
    
    currentRow.cells[1].innerHTML = `<span class="cell-title">${judul}</span>`;
    currentRow.cells[2].innerHTML = `<span class="cell-type">${tipe}</span>`;
    currentRow.cells[3].innerHTML = `<a href="${link}" target="_blank" class="cell-link">
      <i class="fas fa-external-link-alt"></i>
      ${link.substring(0, 30)}...
    </a>`;
    
    if (gambarFile) {
      const reader = new FileReader();
      reader.onload = function(e) {
        currentRow.cells[4].innerHTML = `<img src="${e.target.result}" class="cell-image" alt="Iklan">`;
      };
      reader.readAsDataURL(gambarFile);
    }
    
    currentRow.cells[5].querySelector('button').setAttribute('onclick', `editIklan(this, '${judul}', '${tipe}', '${link}')`);
    
    closeModal();
    showSuccess('Iklan berhasil diupdate!');
  }

  function hapusIklan(btn) {
    if (confirm('⚠️ Yakin ingin menghapus iklan ini?')) {
      const row = btn.closest('tr');
      row.remove();
      
      const tbody = document.getElementById('tabelIklan');
      const rows = tbody.getElementsByTagName('tr');
      for (let i = 0; i < rows.length; i++) {
        rows[i].cells[0].textContent = i + 1;
      }
      
      showSuccess('Iklan berhasil dihapus!');
    }
  }

  function showSuccess(msg) {
    document.getElementById('successMessage').textContent = msg;
    document.getElementById('successModal').classList.remove('hidden');
  }

  function tutupSuccess() {
    document.getElementById('successModal').classList.add('hidden');
  }

  document.getElementById('modal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
  });
</script>
@endpush

@endsection