<?php

/**
 * @var CodeIgniter\View\View $this
 */
?>
<?= $this->extend("/superadmin/layout/index") ?>
<?= $this->section("content") ?>

<div class="page-inner">
    <div class="flex justify-between mb-5 ml-3 md:ml-0 font-extrabold text-xl items-center">
        <a href="<?= base_url("/superadmin/data-pengendara") ?>" class="hover:underline dark:text-gray-200"><i
                class="fa-solid fa-arrow-left-long mr-5"></i>Kembali</a>
        <img src="<?= base_url('/assets/img/Lambang_Polda_Jateng.png') ?>" alt="Logo" width="60px" />
    </div>
    <div class="flex flex-col mb-5 pb-5 bg-white dark:bg-gray-800 dark:text-gray-200 rounded-lg">
        <div class="flex justify-between ml-5 mr-14 mt-10">
            <h1 class="font-bold ml-10">Riwayat Pemberian Point "<?= $pengendara['nama_pengendara'] ?>"</h1>
        </div>

        <!-- Menggunakan grid untuk merapikan layout dengan 2 kolom -->
        <div class="ml-5 mt-10 grid grid-cols-2 gap-x-10">
            <div class="flex items-center mb-4">
                <label class="font-bold w-40" for="no_sim">No SIM:</label>
                <span class="font-normal"><?= $pengendara['no_sim'] ?></span>
            </div>
            <div class="flex items-center mb-4">
                <label class="font-bold w-40" for="nama_pengendara">Nama:</label>
                <span class="font-normal"><?= $pengendara['nama_pengendara'] ?></span>
            </div>
            <div class="flex items-center mb-4">
                <label class="font-bold w-40" for="tipe_sim">Tipe SIM:</label>
                <span class="font-normal"><?= $pengendara['tipe_sim'] ?></span>
            </div>
            <div class="flex items-center mb-4">
                <label class="font-bold w-40" for="tanggal_lahir">Tanggal Lahir:</label>
                <span class="font-normal"><?= $pengendara['tanggal_lahir'] ?></span>
            </div>
        </div>

        <div class="ml-5 mt-8 grid grid-cols-2 gap-x-10">
            <div class="flex items-center mb-4">
                <label class="font-bold w-40" for="jenis_kelamin">Jenis Kelamin:</label>
                <span class="font-normal"><?= $pengendara['jenis_kelamin'] ?></span>
            </div>
            <div class="flex items-center mb-4">
                <label class="font-bold w-40" for="pekerjaan">Pekerjaan:</label>
                <span class="font-normal"><?= $pengendara['pekerjaan'] ?></span>
            </div>
            <div class="flex items-center mb-4">
                <label class="font-bold w-40" for="alamat">Alamat:</label>
                <span class="font-normal"><?= $pengendara['alamat'] ?></span>
            </div>
            <div class="flex items-center mb-4">
                <label class="font-bold w-40" for="provinsi">Provinsi:</label>
                <span class="font-normal"><?= $pengendara['provinsi'] ?></span>
            </div>
        </div>
    </div>


    <div class="w-full flex flex-col md:flex-row gap-2 mt-3">
        <!-- tabel point -->
        <div class="w-full relative overflow-x-auto sm:rounded-lg bg-white dark:bg-gray-800 shadow-md rounded-md">
            <div class="d-flex justify-content-between w-100 px-4 my-2">
                <h1 class="font-bold text-slate-900 dark:text-gray-200">Tambah Point Pelanggaran</h1>
                <div class="d-flex align-items-center">
                    <span
                        class="py-2 px-3 text-white font-semibold rounded-full border
                <?= ($total_point >= 0 && $total_point <= 3) ? 'bg-success border-success' : (($total_point >= 4 && $total_point <= 7) ? 'bg-warning border-warning' : (($total_point >= 8 && $total_point <= 11) ? 'bg-danger border-danger' :
                    'bg-dark border-dark')) ?>">
                        <?= $total_point ?>
                    </span>

                    <button data-bs-toggle="modal" data-bs-target="#point-modal"
                        class="btn btn-success btn-round ms-2">
                        <i class="fa fa-plus"></i> Tambah
                    </button>
                </div>
            </div>

            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-16 py-3">Tanggal Tilang</th>
                        <th scope="col" class="px-16 py-3">Tanggal Sidang</th>
                        <th scope="col" class="px-16 py-3">Jumlah Point</th>
                        <th scope="col" class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($point)) : ?>
                        <td class="px-6 py-4 font-bold text-xl text-center" colspan="4">Data nilai kosong</td>
                    <?php else : ?>
                        <?php foreach ($point as $key => $value) : ?>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-16 py-4 font-bold">
                                    <?php
                                    $date = new DateTime($value['created_at']);  // Mengonversi string ke objek DateTime

                                    $bulan = array(1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember");

                                    // Format tanggal menjadi hari, bulan, dan tahun
                                    echo $date->format('d') . ' ' . $bulan[(int)$date->format('m')] . ' ' . $date->format('Y');
                                    ?>
                                </td>
                                <td class="px-16 py-4 font-bold">
                                    <?php
                                    $sidang = new DateTime($value['tanggal_sidang']);  // Mengonversi string ke objek DateTime
                                    echo $sidang->format('d') . ' ' . $bulan[(int)$sidang->format('m')] . ' ' . $sidang->format('Y');
                                    ?></td>
                                <td class="px-16 py-4">
                                    <?= isset($jumlah_point[$value['id_point']]) ? $jumlah_point[$value['id_point']] : 0 ?>
                                </td>
                                <td class="flex  pr-2 py-4 gap-2 items-center">
                                    <a href="<?= base_url("superadmin/edit-detail/" . $value['id_point']) ?>"
                                        class="flex justify-center items-center gap-2 font-bold text-blue-600 hover:font-bold border border-blue-600 rounded-full text-center px-3 py-0.5 hover:bg-blue-500 hover:border-blue-800 hover:text-white">
                                        <i class="fa fa-info"></i>
                                    </a>
                                    <a href="<?= base_url("superadmin/detail-point/" . $value['id_point']) ?>"
                                        class="flex justify-center items-center gap-2 font-bold text-green-600 hover:font-bold border border-green-600 rounded-full text-center px-3 py-0.5 hover:bg-green-500 hover:border-green-800 hover:text-white">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                    <button onclick="deletePoint('/superadmin/hapus-point', <?= $value['id_point'] ?>)"
                                        class="flex justify-center items-center gap-2 font-bold text-red-600 hover:font-bold border border-red-600 rounded-full text-center px-3 py-0.5 hover:bg-red-500 hover:border-red-800 hover:text-white">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <!-- /tabel -->
    </div>
</div>

<!-- point modal -->
<div id="point-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">
                    <span class="fw-mediumbold"> Tambah Point</span>
                    <span class="fw-light"> Pelanggaran</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('/superadmin/data-point') ?>" method="post"
                    enctype="multipart/form-data">
                    <input type="hidden" value="<?= $pengendara['id_pengendara'] ?>" name="id_pengendara">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label for="tanggal_sidang">Tanggal Sidang</label>
                                <input id="tanggal_sidang" name="tanggal_sidang" type="date" class="form-control" required />
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
    const deletePoint = (url, id_point) => {
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
                window.location.href = url + "/" + id_point
            }
        })
    }

    // alert success 
    <?php if (!empty(session()->getFlashdata("success_tambah_point"))) : ?>
        document.addEventListener("DOMContentLoaded", () => {
            Swal.fire({
                title: "success!",
                icon: "success",
                html: `<?= session('success_tambah_point') ?>`
            });
        })
    <?php endif; ?>

    <?php if (!empty(session()->getFlashdata("success_delete_point"))) : ?>
        document.addEventListener("DOMContentLoaded", () => {
            Swal.fire({
                title: "success!",
                icon: "success",
                html: `<?= session('success_delete_point') ?>`
            });
        })
    <?php endif; ?>

    // alert error 
    <?php if (!empty(session()->getFlashdata("error_delete_point"))) : ?>
        document.addEventListener("DOMContentLoaded", () => {
            Swal.fire({
                title: "error!",
                icon: "error",
                html: `<?= session('error_delete_point') ?>`
            });
        })
    <?php endif; ?>
</script>

<?= $this->endSection() ?>