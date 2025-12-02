<?php

/**
 * @var CodeIgniter\View\View $this
 */
?>
<?= $this->extend("/superadmin/layout/index") ?>
<?= $this->section("content") ?>

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Data Kategori Pelanggaran</h3>
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
                    <a href="#">Kategori Pelanggaran</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Edit Kategori Pelanggaran : <?= $kategori['kategori'] ?></div>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('/superadmin/edit-kategori/' . $kategori['id_kategori']) ?>"
                            method="post">
                            <div class="row">
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="kategori">Kategori</label>
                                        <input type="text" class="form-control" name="kategori" id="kategori"
                                            value="<?= $kategori['kategori'] ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="bobot_point">Bobot Point</label>
                                        <input type="text" class="form-control" name="bobot_point" id="bobot_point"
                                            value="<?= $kategori['bobot_point'] ?>" />
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
</div>
<script>
    // alert success 
    <?php if (!empty(session()->getFlashdata("success_edit_kategori"))) : ?>
        document.addEventListener("DOMContentLoaded", () => {
            Swal.fire({
                title: "success!",
                icon: "success",
                html: `<?= session('success_edit_kategori') ?>`
            });
        })
    <?php endif; ?>
    // alert error 
    <?php if (!empty(session()->getFlashdata("error_edit_kategori"))) : ?>
        document.addEventListener("DOMContentLoaded", () => {
            Swal.fire({
                title: "error!",
                icon: "error",
                html: `<?= session('error_edit_kategori') ?>`
            });
        })
    <?php endif; ?>
</script>
<?= $this->endSection() ?>