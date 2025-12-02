<?php

/**
 * @var CodeIgniter\View\View $this
 */
?>
<?= $this->extend("/admin/layout/index") ?>
<?= $this->section("content") ?>

<div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Data Jenis Pelanggaran</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="<?= base_url('/admin') ?>">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Data Master</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Jenis Pelanggaran</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Data Jenis Pelanggaran</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th>Jumlah Jenis Pelanggaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($jenis)) : ?>
                                    <?php if (isset($_GET['search'])) : ?>
                                        <td class="px-6 py-4 text-center font-bold text-lg" colspan="6">Pencarian
                                            "<?= $_GET['search'] ?>"
                                            Tidak ada</td>
                                    <?php else : ?>
                                        <td class="px-6 py-4 text-center font-bold text-lg" colspan="6">Data tidak Ditemukan
                                        </td>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <?php $no = 1 ?>
                                    <?php foreach ($jenis as $key => $value) : ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $value['kategori'] ?></td>
                                            <td><?= $value['nama_pelanggaran'] ?></td>
                                        </tr>
                                        <?php $no++ ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>