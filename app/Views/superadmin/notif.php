<?php

/**
 * @var CodeIgniter\View\View $this
 */
?>
<?= $this->extend("/superadmin/layout/index") ?>
<?= $this->section("content") ?>
<div class="page-inner">
    <!-- Menempatkan tombol Tambah di atas -->
    <div class="d-flex justify-content-start pt-2 pb-4">
        <button class="btn btn-primary btn-round ms-2" data-bs-toggle="modal" data-bs-target="#tambah-modal">
            <i class="fa fa-plus"></i> Tambah
        </button>
    </div>

    <!-- Container untuk card-card notifikasi -->
    <div class="d-flex flex-column flex-md-row pt-2 pb-4">
        <?php foreach ($notif as $key => $value) : ?>
            <div class="card shadow-sm border-light rounded mb-3 me-md-3" style="width: 18rem;"> <!-- Tambahkan margin kanan untuk card di layar besar -->
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input"
                                onchange="handleActive(this, <?= $value['id_notif'] ?>)"
                                <?= $value['is_active'] ? 'checked' : '' ?>
                                type="checkbox"
                                id="flexSwitchCheckDefault<?= $value['id_notif'] ?>"> <!-- Tambahkan ID unik untuk setiap checkbox -->
                        </div>
                        <h5 class="card-title mb-0"><?= htmlspecialchars($value['notif']) ?></h5> <!-- Menghindari XSS dengan htmlspecialchars -->
                    </div>
                    <p class="card-text"><?= htmlspecialchars($value['pesan']) ?></p> <!-- Menghindari XSS dengan htmlspecialchars -->
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- tambah modal -->
<div id="tambah-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">
                    <span class="fw-mediumbold"> Tambah Notif</span>
                    <span class="fw-light"> Pemberitahuan</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('/superadmin/tambah-notif') ?>" method="post"
                    enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label for="notif">Judul Notif</label>
                                <input id="notif" name="notif" type="text" class="form-control" required />
                            </div>
                            <div class="form-group form-group-default">
                                <label for="pesan">Tulis Pesan</label>
                                <input id="pesan" name="pesan" type="text" class="form-control" required />
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
    function handleActive(checkbox, id_notif) {
        // Menggunakan template literal JavaScript untuk menyisipkan PHP di dalam string
        const url = checkbox.checked ? '<?= base_url('superadmin/aktif-notif/') ?>' + id_notif : '<?= base_url('superadmin/nonaktif-notif/') ?>' + id_notif;

        // Arahkan browser ke URL yang dihasilkan
        window.location.href = url;
    }

    // alert success 
    <?php if (!empty(session()->getFlashdata("success_tambah_notif"))) : ?>
        document.addEventListener("DOMContentLoaded", () => {
            Swal.fire({
                title: "success!",
                icon: "success",
                html: `<?= session('success_tambah_notif') ?>`
            });
        })
    <?php endif; ?>

    // alert error 
    <?php if (!empty(session()->getFlashdata("error_tambah_notif"))) : ?>
        document.addEventListener("DOMContentLoaded", () => {
            Swal.fire({
                title: "error!",
                icon: "error",
                html: `<?= session('error_tambah_notif') ?>`
            });
        })
    <?php endif; ?>
</script>

<?= $this->endSection() ?>