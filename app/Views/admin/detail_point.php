<?php

/**
 * @var CodeIgniter\View\View $this
 */
?>
<?= $this->extend("/admin/layout/index") ?>
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
                <form action="<?= base_url('/admin/detail-point') ?>" method="post"
                    enctype="multipart/form-data">
                    <input type="hidden" value="<?= $point['id_point'] ?>" name="id_point">
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
        // Membuat elemen select baru untuk menambahkan baris baru
        const selectElement = document.createElement('select');
        selectElement.classList.add('form-select');
        selectElement.name = 'id_jenis[]';

        // Membuat opsi default
        const defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.textContent = '-- Pilih Jenis Pelanggaran yang dilakukan --';
        selectElement.appendChild(defaultOption);

        // Menambahkan opsi jenis pelanggaran dari PHP
        <?php foreach ($jenis as $key => $value): ?>
            selectElement.innerHTML += `<option value="<?= $value['id_jenis'] ?>"><?= $value['nama_pelanggaran'] ?></option>`;
        <?php endforeach; ?>


        // Menambahkan elemen select baru ke dalam container
        const container = document.getElementById('additionalRows');
        const newRow = document.createElement('div');
        newRow.classList.add('form-group');
        newRow.appendChild(selectElement);
        container.appendChild(newRow);
    });
</script>

<?= $this->endSection() ?>