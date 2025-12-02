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
            <h3 class="fw-bold mb-3">Forms</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="#">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Forms</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Basic Form</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Edit Data Pengendara : <?= $pengendara['nama_pengendara'] ?></div>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('/superadmin/edit-pengendara/' . $pengendara['id_pengendara']) ?>"
                            method="post">
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="no_sim">No SIM</label>
                                        <input type="text" class="form-control" name="no_sim" id="no_sim"
                                            value="<?= $pengendara['no_sim'] ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="tipe_sim">Tipe SIM</label>
                                        <input type="text" class="form-control" name="tipe_sim" id="tipe_sim"
                                            value="<?= $pengendara['tipe_sim'] ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_pengendara">Nama Pengendara</label>
                                        <input type="text" class="form-control" name="nama_pengendara" id="nama_pengendara"
                                            value="<?= $pengendara['nama_pengendara'] ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                        <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir"
                                            value="<?= $pengendara['tanggal_lahir'] ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="jenis_kelamin">Jenis Kelamin</label>
                                        <input type="text" class="form-control" name="jenis_kelamin" id="jenis_kelamin"
                                            value="<?= $pengendara['jenis_kelamin'] ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control" name="alamat" id="alamat"
                                            value="<?= $pengendara['alamat'] ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="pekerjaan">Pekerjaan</label>
                                        <input type="text" class="form-control" name="pekerjaan" id="pekerjaan"
                                            value="<?= $pengendara['pekerjaan'] ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="provinsi">Provinsi</label>
                                        <input type="text" class="form-control" name="provinsi" id="provinsi"
                                            value="<?= $pengendara['provinsi'] ?>" />
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
    <?php if (!empty(session()->getFlashdata("success_edit_pengendara"))) : ?>
        document.addEventListener("DOMContentLoaded", () => {
            Swal.fire({
                title: "success!",
                icon: "success",
                html: `<?= session('success_edit_pengendara') ?>`
            });
        })
    <?php endif; ?>
    // alert error 
    <?php if (!empty(session()->getFlashdata("error_edit_pengendara"))) : ?>
        document.addEventListener("DOMContentLoaded", () => {
            Swal.fire({
                title: "error!",
                icon: "error",
                html: `<?= session('error_edit_pengendara') ?>`
            });
        })
    <?php endif; ?>
</script>
<?= $this->endSection() ?>