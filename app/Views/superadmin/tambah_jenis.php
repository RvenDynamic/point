<?php

/**
 * @var CodeIgniter\View\View $this
 */
?>
<?= $this->extend("/superadmin/layout/index") ?>
<?= $this->section("content") ?>

<div class="page-inner">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Tambah Detail Pelanggaran</h4>
                </div>
            </div>
            <div class="card-body">
                <form action="<?= base_url('/superadmin/tambah-jenis') ?>" method="post"
                    enctype="multipart/form-data">
                    <input type="hidden" value="<?= $kategori['id_kategori'] ?>" name="id_kategori">
                    <!-- Container untuk menambah baris baru -->
                    <div id="additionalRows"></div>

                    <!-- Tombol untuk menambah baris baru -->
                    <button type="button" class="btn btn-primary" id="addRowBtn">Tambah Baris</button>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk menambah baris baru -->
<script>
    document.getElementById('addRowBtn').addEventListener('click', function() {
        // Membuat elemen input baru untuk menambahkan baris baru
        const inputElement = document.createElement('input');
        inputElement.type = 'text'; // Tipe input
        inputElement.classList.add('form-control'); // Menambahkan kelas untuk styling
        inputElement.name = 'nama_pelanggaran[]'; // Nama input

        // Menambahkan label untuk input
        const label = document.createElement('label');
        label.textContent = 'Jenis Pelanggaran:';

        // Membuat div baru untuk menampung label dan input
        const newRow = document.createElement('div');
        newRow.classList.add('form-group');
        newRow.appendChild(label);
        newRow.appendChild(inputElement);

        // Menambahkan elemen input baru ke dalam container
        const container = document.getElementById('additionalRows');
        container.appendChild(newRow);
    });
</script>

<?= $this->endSection() ?>