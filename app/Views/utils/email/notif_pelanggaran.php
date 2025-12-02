<!DOCTYPE html>
<html>

<head>
    <title>Pemberitahuan Poin Pelanggaran</title>
</head>

<body>
    <h2>Halo, <?= esc($nama_pengendara) ?>!</h2>
    <p>Anda baru saja diberikan point pelanggaran sebagai berikut:</p>
    <p><strong>Point : </strong> <?= esc($point) ?></p>
    <p><strong>Jenis Pelanggaran : </strong> <?= esc($jenis_pelanggaran) ?></p>
    <p><strong>Tanggal Sidang :</strong> <?= esc($tanggal_sidang) ?></p>
    <p>Harap perhatikan dan lakukan tindakan sesuai dengan ketentuan yang berlaku.</p>
    <p>Terima kasih!</p>
</body>

</html>