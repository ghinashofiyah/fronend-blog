@extends('layout.App')

@section('title', 'Admin - Portal Blog')

@section('content')

<div class="p-6 max-w-7xl mx-auto">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-8 flex-wrap gap-4">
        <h1 class="text-4xl font-bold text-gray-800 flex items-center gap-3">
            <i class="fas fa-users-cog text-[#4988C4]"></i>
            Kelola Admin
        </h1>

        <div class="flex items-center gap-4 flex-wrap">

            <!-- SEARCH -->
            <div class="relative w-72">
                <span class="absolute left-5 top-1/2 -translate-y-1/2 text-[#4988C4] text-lg">
                    <i class="fas fa-search"></i>
                </span>
                <input
                    type="text"
                    id="searchInput"
                    placeholder="Cari admin..."
                    onkeyup="filterAdmin()"
                    class="w-full pl-12 pr-5 py-3 rounded-full border-2 border-[#4988C4]
                           focus:outline-none focus:ring-2 focus:ring-[#4988C4]/40">
            </div>

            <!-- TAMBAH -->
            <button onclick="openModal()"
                class="flex items-center gap-2 bg-[#4988C4] text-white px-6 py-3 rounded-full hover:bg-blue-600 transition">
                <i class="fa fa-plus"></i>
                Tambah Admin
            </button>
        </div>
    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-2xl shadow-xl p-6">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-[#4988C4] text-white">
                    <tr>
                        <th class="py-4 px-4 text-left">No</th>
                        <th class="py-4 px-4 text-left">Foto</th>
                        <th class="py-4 px-4 text-left">Nama</th>
                        <th class="py-4 px-4 text-left">Email</th>
                        <th class="py-4 px-4 text-left">Password</th>
                        <th class="py-4 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tabelAdmin"></tbody>
            </table>
        </div>

        <!-- PAGINATION -->
        <div class="flex justify-between items-center mt-6">
            <span id="pageInfo" class="text-gray-500"></span>
            <div class="flex gap-3">
                <button id="btnPrev"
                        onclick="prevPage()"
                        class="px-4 py-2 border rounded-lg disabled:opacity-40">
                    Prev
                </button>

                <button id="btnNext"
                        onclick="nextPage()"
                        class="px-4 py-2 border rounded-lg text-[#4988C4] disabled:opacity-40">
                    Next
                </button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH ADMIN -->
<div id="adminModal"
     class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50">

    <div class="bg-white w-full max-w-xl rounded-2xl p-8">

        <h2 class="text-2xl font-bold mb-6 text-gray-800">
            Tambah Admin
        </h2>

        <form onsubmit="submitAdmin(event)" class="space-y-5">

            <!-- FOTO PROFIL -->
            <div class="flex items-center gap-6">
                <label for="fotoAdmin" class="cursor-pointer relative">
                    <img id="previewFoto"
                         src="https://via.placeholder.com/120"
                         class="w-24 h-24 rounded-full object-cover border">

                    <span class="absolute bottom-1 right-1 bg-white p-1 rounded-full shadow">
                        <i class="fas fa-camera text-gray-600"></i>
                    </span>
                </label>

                <input type="file"
                       id="fotoAdmin"
                       accept="image/*"
                       onchange="previewImage(event)"
                       class="hidden">
            </div>

            <!-- INPUT -->
            <input id="namaAdmin"
                   type="text"
                   placeholder="Nama"
                   required
                   class="w-full border px-4 py-3 rounded-xl focus:ring-2 focus:ring-[#4988C4]/40">

            <input id="emailAdmin"
                   type="email"
                   placeholder="Email"
                   required
                   class="w-full border px-4 py-3 rounded-xl focus:ring-2 focus:ring-[#4988C4]/40">

            <input id="passwordAdmin"
                   type="password"
                   placeholder="Password"
                   required
                   class="w-full border px-4 py-3 rounded-xl focus:ring-2 focus:ring-[#4988C4]/40">

            <!-- ACTION -->
            <div class="flex justify-end gap-4 pt-6">
                <button type="button"
                        onclick="closeModal()"
                        class="px-6 py-2 border rounded-xl hover:bg-gray-100">
                    Batal
                </button>

                <button type="submit"
                        class="px-6 py-2 bg-[#4988C4] text-white rounded-xl hover:bg-blue-600">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
/* ================= DATA DUMMY ================= */
const admins = Array.from({length:30},(_,i)=>({
    id:i+1,
    nama:`Admin ${i+1}`,
    email:`admin${i+1}@admin.com`,
    password:'secret',
    foto:i%2 ? `https://i.pravatar.cc/150?img=${i+1}` : null,
    initials:`A${i+1}`
}));

let filteredAdmins=[...admins];
let currentPage=1;
const perPage=10;

/* ================= SEARCH ================= */
function filterAdmin(){
    const k=searchInput.value.toLowerCase();
    filteredAdmins=admins.filter(a =>
        a.nama.toLowerCase().includes(k) ||
        a.email.toLowerCase().includes(k)
    );
    currentPage=1;
    renderTable();
}

/* ================= RENDER TABLE ================= */
function renderTable(){
    tabelAdmin.innerHTML='';
    const start=(currentPage-1)*perPage;
    const data=filteredAdmins.slice(start,start+perPage);

    data.forEach((a,i)=>{
        tabelAdmin.innerHTML+=`
        <tr class="border-b hover:bg-blue-50">
            <td class="px-4 py-3">${start+i+1}</td>
            <td class="px-4 py-3">
                ${a.foto
                    ? `<img src="${a.foto}" class="w-10 h-10 rounded-full object-cover">`
                    : `<div class="w-10 h-10 bg-[#4988C4] text-white rounded-full flex items-center justify-center">
                        ${a.initials}
                       </div>`}
            </td>
            <td class="px-4 py-3 font-semibold">${a.nama}</td>
            <td class="px-4 py-3">${a.email}</td>
            <td class="px-4 py-3">••••••</td>
            <td class="px-4 py-3 text-center">⋮</td>
        </tr>`;
    });

    updatePagination();
}

/* ================= PAGINATION ================= */
function updatePagination(){
    const totalPage=Math.ceil(filteredAdmins.length/perPage) || 1;
    pageInfo.innerText=`Halaman ${currentPage} dari ${totalPage}`;
    btnPrev.disabled=currentPage===1;
    btnNext.disabled=currentPage===totalPage;
}

function prevPage(){
    if(currentPage>1){currentPage--;renderTable();}
}

function nextPage(){
    if(currentPage<Math.ceil(filteredAdmins.length/perPage)){
        currentPage++;renderTable();
    }
}

/* ================= MODAL ================= */
function openModal(){adminModal.classList.remove('hidden');}
function closeModal(){
    adminModal.classList.add('hidden');
    previewFoto.src='https://via.placeholder.com/120';
}

/* ================= PREVIEW FOTO ================= */
function previewImage(e){
    const reader=new FileReader();
    reader.onload=()=>previewFoto.src=reader.result;
    reader.readAsDataURL(e.target.files[0]);
}

/* ================= SUBMIT ================= */
function submitAdmin(e){
    e.preventDefault();

    const file=fotoAdmin.files[0];
    const foto=file?URL.createObjectURL(file):null;

    admins.unshift({
        id:admins.length+1,
        nama:namaAdmin.value,
        email:emailAdmin.value,
        password:passwordAdmin.value,
        foto:foto,
        initials:namaAdmin.value[0].toUpperCase()
    });

    filteredAdmins=[...admins];
    currentPage=1;
    renderTable();
    e.target.reset();
    closeModal();
}

document.addEventListener('DOMContentLoaded',renderTable);
</script>

@endsection
