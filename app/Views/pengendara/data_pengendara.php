<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Polres Pekalongan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>

<body class="bg-white flex flex-col min-h-screen">
    <header class="bg-gray-800 py-4 shadow-md">
        <div class="container mx-auto flex items-center justify-between">
            <a href="/login" class="text-2xl font-bold text-white">Polres Pekalongan</a>
            <!-- Logo Polres -->
            <img src="<?= base_url('assets/img/Lambang_Polda_Jateng.png') ?>" alt="Logo Polres Pekalongan" class="h-12 object-contain" />
        </div>
    </header>

    <main class="flex-grow p-6">
        <section class="bg-white dark:bg-gray-800 dark:text-gray-200 rounded-lg shadow-md p-5">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold mb-4">Detail Pengendara</h2>
                <a href="<?= base_url("tambah-email/" . $pengendara['id_pengendara']) ?>"
                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    <span class="btn-label">
                        <i class="fa fa-info"></i>
                    </span>
                    Tambah Email
                </a>
            </div>
            <div class="grid grid-cols-2 gap-x-10">
                <div class="flex items-center mb-4">
                    <label class="font-bold w-40" for="no_sim">No SIM:</label>
                    <span class="font-normal"><?= esc($pengendara['no_sim']); ?></span>
                </div>
                <div class="flex items-center mb-4">
                    <label class="font-bold w-40" for="nama_pengendara">Nama:</label>
                    <span class="font-normal"><?= esc($pengendara['nama_pengendara']); ?></span>
                </div>
                <div class="flex items-center mb-4">
                    <label class="font-bold w-40" for="tanggal_lahir">Tanggal Lahir:</label>
                    <span class="font-normal"><?= esc($pengendara['tanggal_lahir']); ?></span>
                </div>
                <div class="flex items-center mb-4">
                    <label class="font-bold w-40" for="jenis_kelamin">Jenis Kelamin:</label>
                    <span class="font-normal"><?= esc($pengendara['jenis_kelamin']); ?></span>
                </div>
                <div class="flex items-center mb-4">
                    <label class="font-bold w-40" for="alamat">Alamat:</label>
                    <span class="font-normal"><?= esc($pengendara['alamat']); ?></span>
                </div>
                <div class="flex items-center mb-4">
                    <label class="font-bold w-40" for="pekerjaan">Pekerjaan:</label>
                    <span class="font-normal"><?= esc($pengendara['pekerjaan']); ?></span>
                </div>
                <div class="flex items-center mb-4">
                    <label class="font-bold w-40" for="provinsi">Provinsi:</label>
                    <span class="font-normal"><?= esc($pengendara['provinsi']); ?></span>
                </div>
                <div class="flex items-center mb-4">
                    <label class="font-bold w-40" for="email">Email:</label>
                    <span class="font-normal"><?= esc($pengendara['email']); ?></span>
                </div>
            </div>
        </section>

        <section class="mt-6">
            <h2 class="text-xl font-semibold mb-4">Riwayat Poin Pelanggaran</h2>
            <div class="relative overflow-x-auto shadow-md rounded-lg">
                <table class="min-w-full bg-white dark:bg-gray-800">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Tilang</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Sidang</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total Point</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($point)) : ?>
                            <tr>
                                <td class="px-6 py-4 font-bold text-xl text-center" colspan="4">Data nilai kosong</td>
                            </tr>
                        <?php else : ?>
                            <?php foreach ($point as $value) : ?>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 font-bold">
                                        <?php
                                        $date = new DateTime($value['created_at']);
                                        echo $date->format('d-m-Y');
                                        ?>
                                    </td>
                                    <td class="px-6 py-4 font-bold">
                                        <?php
                                        $sidang = new DateTime($value['tanggal_sidang']);
                                        echo $sidang->format('d-m-Y');
                                        ?>
                                    </td>
                                    <td class="px-6 py-4 font-bold"><?= $total_point; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <footer class="bg-gray-800 text-white py-4">
        <div class="container mx-auto text-center">
            <p>&copy; 2025 Polres Pekalongan. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>