<?php

/**
 * @var CodeIgniter\View\View $this
 */
?>
<?= $this->extend("/superadmin/layout/index") ?>
<?= $this->section("content") ?>

<div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">DataTables.Net</h3>
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
                <a href="#">Tables</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Datatables</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Data Akun Pengguna</h4>
                        <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                            data-bs-target="#register-modal">
                            <i class="fa fa-plus"></i>
                            Register
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($users)) : ?>
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
                                    <?php foreach ($users as $key => $value) : ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $value['username'] ?></td>
                                            <td><?= $value['email'] ?></td>
                                            <td><?= $value['role'] ?></td>
                                            <td>
                                                <span class="px-2 py-1 <?= $value['is_verified'] ? 'text-green-800 bg-green-100' : 'text-red-800 bg-red-100' ?> rounded-lg">
                                                    <?= $value['is_verified'] ? 'active' : 'non-active' ?>
                                                </span>
                                            </td>
                                            <td>
                                                <button
                                                    onclick="deleteAkun('/superadmin/hapus-akun', <?= $value['id_user'] ?>)"
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

<!-- modal register -->
<div id="register-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">
                    <span class="fw-mediumbold"> Register</span>
                    <span class="fw-light"> Akun</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('/superadmin/register') ?>" method="post"
                    enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label for="username">Username</label>
                                <input id="username" name="username" type="text" class="form-control" required
                                    placeholder="username" />
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label for="email">Email</label>
                                <input id="email" name="email" type="email" class="form-control" required
                                    placeholder="email anda" />
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role" id="role" required>
                                    <option selected>Pilih Role</option>
                                    <option value="superadmin">Super Admin</option>
                                    <option value="satlantas">Satlantas</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label for="password">Password</label>
                                <input id="password" name="password" type="password" class="form-control" required
                                    placeholder="********" />
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label for="password_conf">Konfirmasi Password</label>
                                <input name="password_conf" type="password" class="form-control" required
                                    placeholder="********" />
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
    const deleteAkun = (url, id_user) => {
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
                window.location.href = url + "/" + id_user
            }
        })
    }

    // alert success 
    <?php if (!empty(session()->getFlashdata("success_register"))) : ?>
        document.addEventListener("DOMContentLoaded", () => {
            Swal.fire({
                title: "success!",
                icon: "success",
                html: `<?= session('success_register') ?>`
            });
        })
    <?php endif; ?>

    <?php if (!empty(session()->getFlashdata("success_delete_akun"))) : ?>
        document.addEventListener("DOMContentLoaded", () => {
            Swal.fire({
                title: "success!",
                icon: "success",
                html: `<?= session('success_delete_akun') ?>`
            });
        })
    <?php endif; ?>

    // alert error 
    <?php if (!empty(session()->getFlashdata("error_register"))) : ?>
        document.addEventListener("DOMContentLoaded", () => {
            Swal.fire({
                title: "error!",
                icon: "error",
                html: `<?= session('error_register') ?>`
            });
        })
    <?php endif; ?>

    <?php if (!empty(session()->getFlashdata("error_delete_akun"))) : ?>
        document.addEventListener("DOMContentLoaded", () => {
            Swal.fire({
                title: "error!",
                icon: "error",
                html: `<?= session('error_delete_akun') ?>`
            });
        })
    <?php endif; ?>
</script>

<?= $this->endSection() ?>