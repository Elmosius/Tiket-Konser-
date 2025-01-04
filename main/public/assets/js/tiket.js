let modalCounter = 1;
// var listTiket = []

function createModal(){
    // Membuat ID untuk modal baru (modal_1, modal_2, dst)
    const modalId = "modal_" + modalCounter;

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
            data-bs-target="#${modalId}" id="modalButton_${modalCounter}">
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

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById("buatTiket").addEventListener("click",function(){
        // inputHarga.value = 0;
        //     // Tambahkan atribut readonly
        //     inputHarga.setAttribute('readonly', true);
        createModal()
    })

    document.body.addEventListener('click', function(e) {
        var modalId = e.target.closest('.modal').id;
        var modalElement = document.getElementById(modalId);
        var modalInstance = bootstrap.Modal.getInstance(modalElement);

        if (e.target.classList.contains('edit-button')) {
            modalInstance.hide();
        }

        if (e.target.classList.contains('delete-button')) {
            modalInstance.hide();
    
            // Mendapatkan tombol yang berkaitan dengan modal ini
            var modalButtonId = "modalButton_" + modalId.replace(/modal_?/, '');
            var modalButton = document.getElementById(modalButtonId);
    
            // Mendengarkan event 'hidden.bs.modal' untuk menghapus modal dan tombol setelah benar-benar tertutup
            modalElement.addEventListener('hidden.bs.modal', function () {
                modalElement.remove(); // Menghapus modal
                if (modalButton) {
                    modalButton.closest('.row.mb-3').remove(); // Menghapus baris yang mengandung tombol
                }
            }, { once: true });
        }
    });
    
});

// Menangani klik tombol "Simpan"
document.getElementById("simpanTiket").addEventListener("click", function () {
    // Ambil nilai dari form
    const namaTiket = document.getElementsByName("nama_tiket[]")[0].value; // Ambil nilai pertama (karena array)
    const jumlahTiket = document.getElementsByName("jumlah_tiket[]")[0].value;
    const hargaTiket = document.getElementsByName("harga_tiket[]")[0].value;
    const deskripsiTiket = document.getElementsByName("deskripsi_tiket[]")[0].value;
    const tanggalMulai = document.getElementsByName("tanggal_mulai_tiket[]")[0].value;
    const tanggalSelesai = document.getElementsByName("tanggal_selesai_tiket[]")[0].value;

    // let dataTiket = {
    //     nama : namaTiket,
    //     jumlah : jumlahTiket,
    //     harga : hargaTiket,
    //     deskripsi : deskripsiTiket,
    //     tanggal_mulai : tanggalMulai,
    //     tanggal_Selesai : tanggalSelesai
    // }

    // listTiket.push(dataTiket)
    // console.log(listTiket)

    // Menutup modal pertama setelah data disimpan
    const modalTiketElement = document.getElementById('modalTiket');
    const modalTiketInstance = bootstrap.Modal.getInstance(modalTiketElement);  // Mendapatkan instance modal
    modalTiketInstance.hide();  // Menyembunyikan modal pertama

    document.getElementById('nama_tiket').value = '';
    document.getElementById('jumlah_tiket').value = '';
    document.getElementById('harga_tiket').value = '0';
    document.getElementById('deskripsi_tiket').value = '';
    document.getElementById('tanggal_mulai_tiket').value = '';
    document.getElementById('tanggal_selesai_tiket').value = '';
});

console.log(listTiket)