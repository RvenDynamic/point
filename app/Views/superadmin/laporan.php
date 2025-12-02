<?php

/**
 * @var CodeIgniter\View\View $this
 */
?>
<?= $this->extend("/superadmin/layout/index") ?>
<?= $this->section("content") ?>

<div class="container mt-5">
    <h1 class="text-center mb-4 text-4xl">Laporan Pemberian Point Pelanggaran</h1>

    <form method="get" action="<?= base_url('superadmin/laporan/hasil') ?>" class="mb-4">
        <div class="form-group">
            <label for="start_date">Tanggal Awal:</label>
            <input type="date" name="start_date" id="start_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="end_date">Tanggal Akhir:</label>
            <input type="date" name="end_date" id="end_date" class="form-control" required>
        </div>
        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary btn-lg">Tampilkan Laporan</button>
        </div>
    </form>

</div>

<?= $this->endSection() ?>