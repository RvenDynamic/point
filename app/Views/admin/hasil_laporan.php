<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengendara</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4 text-4xl">Laporan Kegiatan Tilang</h1>
        <h3 class="text-center mb-4">Periode: <?= $start_date ?> - <?= $end_date ?></h3>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pengendara</th>
                    <th>No SIM</th>
                    <th>Jenis Pelanggaran</th>
                    <th>Tanggal Tilang</th>
                    <th>Tanggal Sidang</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($pengendara)) : ?>
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data untuk periode ini.</td>
                    </tr>
                <?php else : ?>
                    <?php $no = 1; ?>
                    <?php foreach ($pengendara as $item) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($item['nama_pengendara']) ?></td>
                            <td><?= esc($item['no_sim']) ?></td>
                            <td><?= esc($item['nama_pelanggaran']) ?></td>
                            <td><?php
                                $date = new DateTime($item['created_at']);  // Mengonversi string ke objek DateTime

                                $bulan = array(1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember");

                                // Format tanggal menjadi hari, bulan, dan tahun
                                echo $date->format('d') . ' ' . $bulan[(int)$date->format('m')] . ' ' . $date->format('Y');
                                ?></td>
                            <td><?php
                                $sidang = new DateTime($item['tanggal_sidang']);  // Mengonversi string ke objek DateTime
                                echo $sidang->format('d') . ' ' . $bulan[(int)$sidang->format('m')] . ' ' . $sidang->format('Y');
                                ?></td>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <div style="text-align: right; margin-top: 20px; display: flex; flex-direction: column; align-items: flex-end;">
            <p style="margin-bottom: 0;">Disusun oleh : <b><?= esc($username) ?></b></p>
        </div>
    </div>
</body>

</html>