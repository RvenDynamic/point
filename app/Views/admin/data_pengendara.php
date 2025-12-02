<?php

/**
 * @var CodeIgniter\View\View $this
 */
?>
<?= $this->extend("/admin/layout/index") ?>
<?= $this->section("content") ?>

<div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Data Pengendara</h3>
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
                <a href="#">Pengendara</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between w-100">
                        <h4 class="card-title">Data Pengendara</h4>
                        <form class="navbar-left navbar-form nav-search" method="get" action="<?= base_url('admin/data-pengendara') ?>">
                            <div class="input-group">
                                <input type="text" name="search" placeholder="Cari Nama Pengendara ..." class="form-control" />
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                </span>
                            </div>
                        </form>
                        <div class="d-flex">
                            <button class="btn btn-success btn-round ms-2" data-bs-toggle="modal" data-bs-target="#import-modal">
                                <i class="fa fa-plus"></i> Import
                            </button>
                            <button class="btn btn-primary btn-round ms-2" data-bs-toggle="modal" data-bs-target="#tambah-modal">
                                <i class="fa fa-plus"></i> Tambah
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr class="whitespace-nowrap text-center align-middle">
                                    <th>No</th>
                                    <th>No SIM</th>
                                    <th>Tipe SIM</th>
                                    <th>Nama Pengendara</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Alamat</th>
                                    <th>Pekerjaan</th>
                                    <th>Provinsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($pengendara)) : ?>
                                    <?php if (isset($_GET['search'])) : ?>
                                        <td class="px-6 py-4 text-center font-bold text-lg" colspan="6">Pencarian
                                            "<?= $_GET['search'] ?>"
                                            Tidak ada</td>
                                    <?php else : ?>
                                        <td class="px-6 py-4 text-center font-bold text-lg" colspan="12">Data tidak Ditemukan
                                        </td>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <?php $no = 1 ?>
                                    <?php foreach ($pengendara as $key => $value) : ?>
                                        <tr class="whitespace-nowrap text-center align-middle">
                                            <td><?= $no ?></td>
                                            <td><?= $value['no_sim'] ?></td>
                                            <td><?= $value['tipe_sim'] ?></td>
                                            <td><?= $value['nama_pengendara'] ?></td>
                                            <td>
                                                <?php
                                                $tanggalLahir = $value['tanggal_lahir'];

                                                // Mengubah tanggal menjadi objek DateTime
                                                $date = new DateTime($tanggalLahir);
                                                // menentukan bulan dalam bahasa indonesia
                                                $bulan = array(1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember");

                                                // Format tanggal menjadi hari, bulan dan tahun
                                                echo $date->format('d') . ' ' . $bulan[(int)$date->format('m')] . ' ' . $date->format('Y');
                                                ?>
                                            </td>
                                            <td><?= $value['jenis_kelamin'] ?></td>
                                            <td><?= $value['alamat'] ?></td>
                                            <td><?= $value['pekerjaan'] ?></td>
                                            <td><?= $value['provinsi'] ?></td>
                                            <td>
                                                <div class="d-flex flex-column align-items-center">
                                                    <!-- Cek Button -->
                                                    <a href="<?= base_url("admin/data-point/" . $value['id_pengendara']) ?>"
                                                        class="btn btn-info mb-2 w-100">
                                                        <span class="btn-label">
                                                            <i class="fa fa-info"></i>
                                                        </span>
                                                        Cek Point
                                                    </a>

                                                    <!-- Edit Button -->
                                                    <a href="<?= base_url("admin/edit-pengendara/" . $value['id_pengendara']) ?>"
                                                        class="btn btn-info mb-2 w-100">
                                                        <span class="btn-label">
                                                            <i class="fa fa-info"></i>
                                                        </span>
                                                        Edit
                                                    </a>

                                                    <!-- Hapus Button -->
                                                    <button onclick="deletePengendara('/admin/hapus-pengendara', <?= $value['id_pengendara'] ?>)"
                                                        class="btn btn-danger w-100">
                                                        <span>
                                                            <i class="fa fa-trash"></i>
                                                        </span>
                                                        Hapus
                                                    </button>
                                                </div>
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
                <form action="<?= base_url('/admin/tambah-pengendara') ?>" method="post"
                    enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label for="no_sim">No SIM</label>
                                <input id="no_sim" name="no_sim" type="text" class="form-control" required
                                    placeholder="No SIM" />
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label for="tipe_sim">Tipe SIM</label>
                                <input id="tipe_sim" name="tipe_sim" type="text" class="form-control" required
                                    placeholder="A/B/C" />
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label for="nama_pengendara">Nama Pengendara</label>
                                <input id="nama_pengendara" name="nama_pengendara" type="text" class="form-control" required
                                    placeholder="Nama Pengendara" />
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input id="tanggal_lahir" name="tanggal_lahir" type="date" class="form-control" required />
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="jenis_kelamin">Kategori</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" required>
                                    <option selected>Pilih Kategori</option>
                                    <option value="Pria">Pria</option>
                                    <option value="Wanita">Wanita</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label for="alamat">Alamat</label>
                                <input id="alamat" name="alamat" type="text" class="form-control" required
                                    placeholder="alamat" />
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label for="pekerjaan">Pekerjaan</label>
                                <input id="pekerjaan" name="pekerjaan" type="text" class="form-control" required
                                    placeholder="pekerjaan" />
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label for="provinsi">Provinsi</label>
                                <input id="provinsi" name="provinsi" type="text" class="form-control" required
                                    placeholder="provinsi" />
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

<!-- modal import -->
<div id="import-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">
                    <span class="fw-mediumbold"> Import Data</span>
                    <span class="fw-light"> Kategori Pelanggaran</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('/admin/import-pengendara') ?>" method="post"
                    enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Import Data</label>
                                <input type="file" name="file-import" id="file-import">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn btn-primary">
                            Import
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    // function
    const deletePengendara = (url, id_pengendara) => {
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
                window.location.href = url + "/" + id_pengendara
            }
        })
    }

    // alert success 
    <?php if (!empty(session()->getFlashdata("success_tambah_pengendara"))) : ?>
        document.addEventListener("DOMContentLoaded", () => {
            Swal.fire({
                title: "success!",
                icon: "success",
                html: `<?= session('success_tambah_pengendara') ?>`
            });
        })
    <?php endif; ?>

    <?php if (!empty(session()->getFlashdata("success_import_pengendara"))) : ?>
        document.addEventListener("DOMContentLoaded", () => {
            Swal.fire({
                title: "success!",
                icon: "success",
                html: `<?= session('success_import_pengendara') ?>`
            });
        })
    <?php endif; ?>

    <?php if (!empty(session()->getFlashdata("success_delete_pengendara"))) : ?>
        document.addEventListener("DOMContentLoaded", () => {
            Swal.fire({
                title: "success!",
                icon: "success",
                html: `<?= session('success_delete_pengendara') ?>`
            });
        })
    <?php endif; ?>

    // alert error 
    <?php if (!empty(session()->getFlashdata("error_tambah_pengendara"))) : ?>
        document.addEventListener("DOMContentLoaded", () => {
            Swal.fire({
                title: "error!",
                icon: "error",
                html: `<?= session('error_tambah_pengendara') ?>`
            });
        })
    <?php endif; ?>

    <?php if (!empty(session()->getFlashdata("error_import_pengendara"))) : ?>
        document.addEventListener("DOMContentLoaded", () => {
            Swal.fire({
                title: "error!",
                icon: "error",
                html: `<?= session('error_import_pengendara') ?>`
            });
        })
    <?php endif; ?>

    <?php if (!empty(session()->getFlashdata("error_delete_pengendara"))) : ?>
        document.addEventListener("DOMContentLoaded", () => {
            Swal.fire({
                title: "error!",
                icon: "error",
                html: `<?= session('error_delete_pengendara') ?>`
            });
        })
    <?php endif; ?>
</script>

<?= $this->endSection() ?>