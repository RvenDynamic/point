<?php

/**
 * @var CodeIgniter\View\View $this
 */
?>
<?= $this->extend("/superadmin/layout/index") ?>
<?= $this->section("content") ?>

<div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Data Kategori Pelanggaran</h3>
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
                <a href="#">Kategori Pelanggaran</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Data Kategori Pelanggaran</h4>
                        <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                            data-bs-target="#tambah-modal">
                            <i class="fa fa-plus"></i>
                            Tambah
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th>Bobot Point</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($kategori)) : ?>
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
                                    <?php foreach ($kategori as $key => $value) : ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $value['kategori'] ?></td>
                                            <td><?= $value['bobot_point'] ?></td>
                                            <td>
                                                <!-- Cek Button -->
                                                <!-- <a href="<?php // base_url("/superadmin/tambah-jenis/" . $value['id_kategori']) 
                                                                ?>"
                                                    class="btn btn-info">
                                                    <span class="btn-label">
                                                        <i class="fa fa-info"></i>
                                                    </span>
                                                    Tambah Jenis
                                                </a> -->
                                                <a href="<?= base_url("/superadmin/edit-kategori/" . $value['id_kategori']) ?>"
                                                    class="btn btn-info">
                                                    <span class="btn-label">
                                                        <i class="fa fa-info"></i>
                                                    </span>
                                                    Edit
                                                </a>
                                                <button
                                                    onclick="deleteKategori('/superadmin/hapus-kategori', <?= $value['id_kategori'] ?>)"
                                                    class="btn btn-danger">
                                                    <span>
                                                        <i class="fa fa-trash"></i>
                                                    </span>
                                                    Hapus
                                                </button>
                                            </td>
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

<!-- modal tambah -->
<div id="tambah-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">
                    <span class="fw-mediumbold"> Tambah Data</span>
                    <span class="fw-light"> Kategori Pelanggaran</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('/superadmin/tambah-kategori') ?>" method="post"
                    enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label for="kategori">Kategori Pelanggaran</label>
                                <input id="kategori" name="kategori" type="text" class="form-control" required
                                    placeholder="kategori" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label for="bobot_point">Bobot Point</label>
                                <input id="bobot_point" name="bobot_point" type="text" class="form-control" required
                                    placeholder="bobot point" />
                            </div>
                        </div>
                    </div>
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

<script>
    // function
    const deleteKategori = (url, id_kategori) => {
        Swal.fire({
            title: "Apakah anda yakin?",
            text: "Data yang dihapus tidak dapat dikembalikan",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Hapus",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url + "/" + id_kategori
            }
        })
    }

    // alert success 
    <?php if (!empty(session()->getFlashdata("success_tambah_kategori"))) : ?>
        document.addEventListener("DOMContentLoaded", () => {
            Swal.fire({
                title: "success!",
                icon: "success",
                html: `<?= session('success_tambah_kategori') ?>`
            });
        })
    <?php endif; ?>

    <?php if (!empty(session()->getFlashdata("success_delete_kategori"))) : ?>
        document.addEventListener("DOMContentLoaded", () => {
            Swal.fire({
                title: "success!",
                icon: "success",
                html: `<?= session('success_delete_kategori') ?>`
            });
        })
    <?php endif; ?>

    // alert error 
    <?php if (!empty(session()->getFlashdata("error_tambah_kategori"))) : ?>
        document.addEventListener("DOMContentLoaded", () => {
            Swal.fire({
                title: "error!",
                icon: "error",
                html: `<?= session('error_tambah_kategori') ?>`
            });
        })
    <?php endif; ?>

    <?php if (!empty(session()->getFlashdata("error_delete_kategori"))) : ?>
        document.addEventListener("DOMContentLoaded", () => {
            Swal.fire({
                title: "error!",
                icon: "error",
                html: `<?= session('error_delete_kategori') ?>`
            });
        })
    <?php endif; ?>
</script>

<?= $this->endSection() ?>