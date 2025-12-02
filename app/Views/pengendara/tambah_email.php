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

    <main class="flex-grow container mx-auto py-16">
        <div class="container">
            <div class="page-inner">
                <div class="flex-1">
                    <h3 class="text-2xl font-bold mb-4">Form Input Email Pengendara : <?= $pengendara['nama_pengendara'] ?></h3>
                    <form action="<?= base_url('tambah-email/' . $pengendara['id_pengendara']) ?>" method="post">
                        <div class="row">
                            <div class="col-md-6 col-lg-4">
                                <div class="mb-4">
                                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                                    <input type="text" name="email"
                                        id="email" value="<?= $pengendara['email'] ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required />
                                </div>
                                <div class="card-action">
                                    <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded" type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-gray-800 text-white py-4">
        <div class="container mx-auto text-center">
            <p>&copy; 2025 Polres Pekalongan. All rights reserved.</p>
        </div>
    </footer>
    <script>
        // alert success 
        <?php if (!empty(session()->getFlashdata("success_tambah_email"))) : ?>
            document.addEventListener("DOMContentLoaded", () => {
                Swal.fire({
                    title: "success!",
                    icon: "success",
                    html: `<?= session('success_tambah_email') ?>`
                });
            })
        <?php endif; ?>
        // alert error 
        <?php if (!empty(session()->getFlashdata("error_tambah_email"))) : ?>
            document.addEventListener("DOMContentLoaded", () => {
                Swal.fire({
                    title: "error!",
                    icon: "error",
                    html: `<?= session('error_tambah_email') ?>`
                });
            })
        <?php endif; ?>
    </script>
</body>

</html>