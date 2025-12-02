<?php

/**
 * @var CodeIgniter\View\View $this
 */
?>
<?= $this->extend("/superadmin/layout/index") ?>
<?= $this->section("content") ?>

<div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Data Jenis Pelanggaran</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="<?= base_url('/superadmin') ?>">
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
                    <div class="card-title">Edit Jenis Pelanggaran : <?= $kategori['kategori'] ?></div>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('/superadmin/edit-jenis/' . $jenis['id_jenis']) ?>"
                        method="post">
                        <div class="row">
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="nama_pelanggaran">Nama Pelanggaran</label>
                                    <input type="text" class="form-control" name="nama_pelanggaran" id="nama_pelanggaran"
                                        value="<?= $jenis['nama_pelanggaran'] ?>" />
                                </div>
                                <div class="card-action">
                                    <button class="btn btn-success" type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // alert success 
    <?php if (!empty(session()->getFlashdata("success_edit_jenis"))) : ?>
        document.addEventListener("DOMContentLoaded", () => {
            Swal.fire({
                title: "success!",
                icon: "success",
                html: `<?= session('success_edit_jenis') ?>`
            });
        })
    <?php endif; ?>
    // alert error 
    <?php if (!empty(session()->getFlashdata("error_edit_jenis"))) : ?>
        document.addEventListener("DOMContentLoaded", () => {
            Swal.fire({
                title: "error!",
                icon: "error",
                html: `<?= session('error_edit_jenis') ?>`
            });
        })
    <?php endif; ?>
</script>
<?= $this->endSection() ?>