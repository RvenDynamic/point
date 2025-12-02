<?= $this->extend("/admin/layout/index") ?>
<?= $this->section("content") ?>
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Dashboard</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Pengendara</p>
                                <h4 class="card-title"><?= $pengendara ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-info bubble-shadow-small">
                                <i class="fas fa-user-check"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Akun User</p>
                                <h4 class="card-title"><?= $akun ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-success bubble-shadow-small">
                                <i class="fas fa-luggage-cart"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Jumlah Tilang</p>
                                <h4 class="card-title"><?= $point ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Tilang Pengendara Terbaru -->
    <div class="mt-4">
        <h4 class="fw-bold mb-3">Tilang Pengendara Terbaru</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pengendara</th>
                    <th>Jenis Pelanggaran</th>
                    <th>Tanggal Tilang</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($tilang_terbaru)) : ?>
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data tilang terbaru.</td>
                    </tr>
                <?php else : ?>
                    <?php $no = 1; ?>
                    <?php foreach ($tilang_terbaru as $item) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($item['nama_pengendara']) ?></td>
                            <td><?= esc($item['nama_pelanggaran']) ?></td>
                            <td><?= esc(date('j F Y', strtotime($item['created_at']))) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>