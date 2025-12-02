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
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Data Jenis Pelanggaran</h4>
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
                                    <th>Nama Pelanggaran</th>
                                    <th>Aksi</th>
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
                                            <td>
                                                <a href="<?= base_url("/superadmin/edit-jenis/" . $value['id_jenis']) ?>"
                                                    class="btn btn-info">
                                                    <span class="btn-label">
                                                        <i class="fa fa-info"></i>
                                                    </span>
                                                    Edit
                                                </a>
                                                <button
                                                    onclick="deleteJenis('/superadmin/hapus-jenis', <?= $value['id_jenis'] ?>)"
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
                    <span class="fw-mediumbold"> Tambah Data </span>
                    <span class="fw-light"> Jenis Pelanggaran </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('/superadmin/tambah-jenis') ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="id_kategori">Kategori</label>
                                <select name="id_kategori" id="id_kategori" required>
                                    <option selected>Pilih Kategori</option>
                                    <?php foreach ($kategori as $key => $value) : ?>
                                        <option value="<?= $value['id_kategori'] ?>"><?= $value['kategori'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label for="nama_pelanggaran">Nama Pelanggaran</label>
                                <input id="nama_pelanggaran" name="nama_pelanggaran" type="text" class="form-control"
                                    required placeholder="nama pelanggaran" />
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
    const deleteJenis = (url, id_jenis) => {
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
                window.location.href = url + "/" + id_jenis
            }
        })
    }

    // alert success 
    <?php if (!empty(session()->getFlashdata("success_tambah_jenis"))) : ?>
        document.addEventListener("DOMContentLoaded", () => {
            Swal.fire({
                title: "success!",
                icon: "success",
                html: `<?= session('success_tambah_jenis') ?>`
            });
        })
    <?php endif; ?>

    <?php if (!empty(session()->getFlashdata("success_delete_jenis"))) : ?>
        document.addEventListener("DOMContentLoaded", () => {
            Swal.fire({
                title: "success!",
                icon: "success",
                html: `<?= session('success_delete_jenis') ?>`
            });
        })
    <?php endif; ?>

    // alert error 
    <?php if (!empty(session()->getFlashdata("error_tambah_jenis"))) : ?>
        document.addEventListener("DOMContentLoaded", () => {
            Swal.fire({
                title: "error!",
                icon: "error",
                html: `<?= session('error_tambah_jenis') ?>`
            });
        })
    <?php endif; ?>

    <?php if (!empty(session()->getFlashdata("error_delete_jenis"))) : ?>
        document.addEventListener("DOMContentLoaded", () => {
            Swal.fire({
                title: "error!",
                icon: "error",
                html: `<?= session('error_delete_jenis') ?>`
            });
        })
    <?php endif; ?>
</script>

<?= $this->endSection() ?>