<!-- POPUP HAPUS GLOBAL -->
<div id="popupHapus"
     class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

    <div class="bg-white rounded-xl w-full max-w-md p-6 shadow-2xl animate-fadeIn">

        <!-- HEADER -->
        <h3 class="text-xl font-bold text-red-600 mb-4 flex items-center gap-2">
            <i class="fas fa-trash"></i>
            Konfirmasi Hapus
        </h3>

        <!-- PESAN -->
        <p id="popupHapusMessage" class="text-gray-700 mb-6">
            Apakah Anda yakin ingin menghapus data ini?
        </p>

        <!-- BUTTON -->
        <div class="flex justify-end gap-3">
            <button onclick="closePopupHapus()"
                class="px-4 py-2 rounded-lg border font-semibold hover:bg-gray-100">
                Batal
            </button>

            <button id="popupHapusConfirmBtn"
                class="px-4 py-2 rounded-lg bg-red-600 text-white font-semibold hover:bg-red-700">
                Hapus
            </button>
        </div>

    </div>
</div>

<script>
let popupHapusCallback = null;

/**
 * Buka popup hapus
 * @param {Function} callback → fungsi yang dipanggil saat klik Hapus
 * @param {String} message → custom pesan (optional)
 */
function openPopupHapus(callback, message = 'Apakah Anda yakin ingin menghapus data ini?') {
    popupHapusCallback = callback;
    document.getElementById('popupHapusMessage').innerText = message;

    popupHapus.classList.remove('hidden');
    popupHapus.classList.add('flex');
}

/**
 * Tutup popup hapus
 */
function closePopupHapus() {
    popupHapus.classList.add('hidden');
    popupHapus.classList.remove('flex');
    popupHapusCallback = null;
}

/**
 * Klik tombol Hapus
 */
document.getElementById('popupHapusConfirmBtn').onclick = function () {
    if (typeof popupHapusCallback === 'function') {
        popupHapusCallback();
    }
    closePopupHapus();
};
</script>
