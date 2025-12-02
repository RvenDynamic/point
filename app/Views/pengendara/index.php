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
            <img src="<?= base_url('assets/img/Lambang_Polda_Jateng.png') ?>" alt="Logo Polres Pekalongan" class="h-12 object-contain" />
        </div>
    </header>

    <main class="flex-grow container mx-auto py-16">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Gambar Polres Pekalongan -->
            <div class="flex-1 relative">
                <img src="https://i0.wp.com/beritamotor.net/wp-content/uploads/2020/09/Perpanjang-SIM-C-Satlantas-Polres-Pekalongan-scaled.jpg?fit=2560%2C1639&ssl=1"
                    alt="Polres Pekalongan"
                    class="w-full rounded-md object-cover h-96" />
                <div class="absolute bottom-0 left-0 p-4 bg-white rounded-md shadow-md w-full">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Polres Pekalongan</h2>
                    <p class="text-gray-600">
                        Menyediakan pelayanan kepada masyarakat di Polres Pekalongan
                    </p>
                </div>
            </div>

            <!-- Form Input Data Pengendara -->
            <div class="flex-1">
                <h3 class="text-2xl font-bold mb-4">Form Input Data Pengendara</h3>
                <form action="<?= base_url('/') ?>" method="get" id="dataForm">
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama Pengendara</label>
                        <input type="text" id="name" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required />
                    </div>
                    <div class="mb-4">
                        <label for="idNumber" class="block text-gray-700 text-sm font-bold mb-2">No. SIM</label>
                        <input type="text" id="idNumber" name="idNumber" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required />
                    </div>
                    <div class="mt-6">
                        <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabel Data Pengendara -->
        <div class="mt-8" id="dataTable">
            <h3 class="text-2xl font-bold mb-4">Data Pengendara</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 text-left">
                            <th class="py-2 px-4 border-b">No</th>
                            <th class="py-2 px-4 border-b">No SIM</th>
                            <th class="py-2 px-4 border-b">Tipe SIM</th>
                            <th class="py-2 px-4 border-b">Nama Pengendara</th>
                            <th class="py-2 px-4 border-b">Tanggal Lahir</th>
                            <th class="py-2 px-4 border-b">Jenis Kelamin</th>
                            <th class="py-2 px-4 border-b">Alamat</th>
                            <th class="py-2 px-4 border-b">Pekerjaan</th>
                            <th class="py-2 px-4 border-b">Provinsi</th>
                            <th class="py-2 px-4 border-b">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($pengendara)) : ?>
                            <tr>
                                <td colspan="10" class="text-center py-4">Data tidak ditemukan</td>
                            </tr>
                        <?php else : ?>
                            <?php $no = 1; ?>
                            <?php foreach ($pengendara as $value) : ?>
                                <tr class="hover:bg-gray-100 ">
                                    <td class="py-2 px-4 border-b text-center"><?= $no ?></td>
                                    <td class="py-2 px-4 border-b text-center"><?= $value['no_sim'] ?></td>
                                    <td class="py-2 px-4 border-b text-center"><?= $value['tipe_sim'] ?></td>
                                    <td class="py-2 px-4 border-b text-center"><?= $value['nama_pengendara'] ?></td>
                                    <td class=" py-2 px-4 border-b text-center">
                                        <?php
                                        $tanggalLahir = $value['tanggal_lahir'];
                                        $date = new DateTime($tanggalLahir);
                                        $bulan = array(1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember");
                                        echo $date->format('d') . ' ' . $bulan[(int)$date->format('m')] . ' ' . $date->format('Y');
                                        ?>
                                    </td>
                                    <td class="py-2 px-4 border-b text-center"><?= $value['jenis_kelamin'] ?></td>
                                    <td class="py-2 px-4 border-b text-center"><?= $value['alamat'] ?></td>
                                    <td class="py-2 px-4 border-b text-center"><?= $value['pekerjaan'] ?></td>
                                    <td class="py-2 px-4 border-b text-center"><?= $value['provinsi'] ?></td>
                                    <td class="py-2 px-4 border-b text-center">
                                        <div class="flex flex-col space-y-1">
                                            <a href="<?= base_url("data-pengendara/" . $value['id_pengendara']) ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Cek Point</a>
                                        </div>
                                    </td>
                                </tr>
                                <?php $no++; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <footer class="bg-gray-800 text-white py-4">
        <div class="container mx-auto text-center">
            <p>&copy; 2025 Polres Pekalongan. All rights reserved.</p>
        </div>
    </footer>

    <script>
        document.getElementById('dataForm').onsubmit = function() {
            document.getElementById('dataTable').style.display = 'block';
        };
    </script>
</body>

</html>