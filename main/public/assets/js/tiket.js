// localStorage.clear()
var tikets = JSON.parse(localStorage.getItem("allTikets")) || [];
let modalCounter = 1;
console.log("Data Tiket : ", tikets)

function createModal(modalId){
    // Membuat konten modal baru dengan nilai yang diambil dari form
    const modalContent = `
        <div class="modal fade" id="${modalId}" tabindex="-1" aria-labelledby="${modalId}Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="${modalId}Label">Detail Tiket</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama_tiket[]" class="form-label">Nama Tiket</label>
                            <input type="text" class="form-control" id="nama_tiket" name="nama_tiket[]" required>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_tiket[]" class="form-label">Jumlah Tiket</label>
                            <input type="number" class="form-control" id="jumlah_tiket" name="jumlah_tiket[]" min="1" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga_tiket[]" class="form-label">Harga</label>
                            <input type="number" class="form-control" id="harga_tiket" name="harga_tiket[]"required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi_tiket[]" class="form-label">Deskripsi Tiket</label>
                            <textarea class="form-control" id="deskripsi_tiket" name="deskripsi_tiket[]" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_mulai_tiket[]" class="form-label">Tanggal & Waktu Mulai Penjualan</label>
                            <input type="datetime-local" class="form-control" id="tanggal_mulai_tiket" name="tanggal_mulai_tiket[]" required>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_selesai_tiket[]" class="form-label">Tanggal & Waktu Selesai Penjualan</label>
                            <input type="datetime-local" class="form-control" id="tanggal_selesai_tiket" name="tanggal_selesai_tiket[]" required>
                        </div>
                        <button type="button" class="btn btn-primary edit-button">Simpan</button>
                        <button type="button" class="btn btn-danger delete-button">Hapus</button>
                    </div>
                </div>
            </div>
        </div>`;

    // Menambahkan modal baru ke dalam elemen #childTiket
    document.getElementById("childTiket").insertAdjacentHTML("beforeend", modalContent);


    // Membuat tombol baru dengan data-bs-target yang dinamis
    const buttonHTML = `
        <div class="row mb-3">
            <a href="#" class="ms-md-3 rounded btn 
            btn-outline-primary text-start" data-bs-toggle="modal" 
            data-bs-target="#${modalId}" id="modalButton_${modalCounter}"
            data-modal-id="${modalId}">
                <span id="nama_tiket_child">
                    Tiket ${modalCounter}
                </span>
            </a>
        </div>
    `;

    // Menambahkan tombol baru ke dalam #tiketContainer
    document.getElementById("tiketContainer").insertAdjacentHTML("beforeend", buttonHTML);

    modalCounter++;
}

function saveData(modalId) {
    const modalElement = document.getElementById(modalId);
    const namaTiket = modalElement.querySelector("input[name='nama_tiket[]']").value;
    const jumlahTiket = modalElement.querySelector("input[name='jumlah_tiket[]']").value;
    const hargaTiket = modalElement.querySelector("input[name='harga_tiket[]']").value;
    const deskripsiTiket = modalElement.querySelector("textarea[name='deskripsi_tiket[]']").value;
    const tanggalMulaiTiket = modalElement.querySelector("input[name='tanggal_mulai_tiket[]']").value;
    const tanggalSelesaiTiket = modalElement.querySelector("input[name='tanggal_selesai_tiket[]']").value;

    const tiketData = {
        modalId,
        namaTiket,
        jumlahTiket,
        hargaTiket,
        deskripsiTiket,
        tanggalMulaiTiket,
        tanggalSelesaiTiket
    };
    const data = tikets.findIndex(tiket => tiket.modalId === modalId);

    if(data !== -1) {
        tikets[data] = tiketData;
    }else{
        tikets.push(tiketData);
        
    }
    localStorage.setItem("allTikets", JSON.stringify(tikets));
    console.log(tikets)
}

function loadData(modalId) {
    const data = tikets.find(tiket => tiket.modalId === modalId);
    if (data) {
        // console.log("terdapat data")
        const modalElement = document.getElementById(modalId);
        modalElement.querySelector("input[name='nama_tiket[]']").value = data.namaTiket;
        modalElement.querySelector("input[name='jumlah_tiket[]']").value = data.jumlahTiket;
        modalElement.querySelector("input[name='harga_tiket[]']").value = data.hargaTiket;
        modalElement.querySelector("textarea[name='deskripsi_tiket[]']").value = data.deskripsiTiket;
        modalElement.querySelector("input[name='tanggal_mulai_tiket[]']").value = data.tanggalMulaiTiket;
        modalElement.querySelector("input[name='tanggal_selesai_tiket[]']").value = data.tanggalSelesaiTiket;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById("buatTiket").addEventListener("click",function(){
        // Membuat ID untuk modal baru (modal_1, modal_2, dst)
        const modalId = "modal_" + modalCounter + "_" + Date.now();
        createModal(modalId)
    })

    document.body.addEventListener('click', function(e) {
        // melakukan pemeriksaan model
        const modal = e.target.closest('.modal');
        const modalId = modal.id;
        var modalGet = document.getElementById(modalId);
        var modalInstance = bootstrap.Modal.getInstance(modalGet);
    
        if (e.target.classList.contains('edit-button')) { // Memastikan bahwa targetButton adalah tombol Simpan
            if (modal) {
                saveData(modalId)
                modalInstance.hide();
            }
        }

        if (e.target.classList.contains('delete-button')) {
            modalInstance.hide();
    
            // Mendapatkan tombol yang berkaitan dengan modal ini
            var modalButtonId = "modalButton_" + modalId.replace(/modal_?/, '');
            console.log(modalButtonId)
            var modalButton = document.querySelector(`[data-modal-id="${modalId}"]`);
            console.log(modalButton)
    
            // Mendengarkan event 'hidden.bs.modal' untuk menghapus modal dan tombol setelah benar-benar tertutup
            modal.addEventListener('hidden.bs.modal', function () {
                if (modalButton) {
                    console.log("model penghapusan")
                    modal.remove(); // Menghapus modal
                    modalButton.closest('.row.mb-3').remove(); // Menghapus baris yang mengandung tombol

                    tikets = tikets.filter(tiket => tiket.modalId !== modalId);
                    localStorage.setItem("allTikets", JSON.stringify(tikets));
                    console.log("tiket setelah dihapus",tikets)
                }
            }, { once: true });
        }

    })

})

// tikets.forEach(tiket => {
//     console.log("print for",tiket.modalId)
//     createModal(tiket.modalId)
//     loadData(tiket.modalId)
// });

for(let i=tikets.length-1; i> -1; i--) {
    console.log("tiket",tikets[i])
    createModal(tikets[i].modalId)
    loadData(tikets[i].modalId)
}

console.log(Date.now)