<?php

/**
 * @var CodeIgniter\View\View $this
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Polres Pekalongan | error verify account</title>
    <link rel="icon" href="<?= base_url("/icon.ico") ?>" type="image/ico">
    <!-- tailwind  -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- sweetalert2  -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-50">
    <div class="w-full min-h-screen flex justify-center items-center">
        <div class="w-full max-w-md">
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <h1 class="text-2xl font-bold text-center mb-4">error verifikasi akun</h1>
                <p class="text-center">Terjadi kesalahan saat memverifikasi account anda tolong contact admin(polres)
                    untuk lebih lanjut.</p>
                <div class="flex items-center justify-center mt-4">
                    <a href="<?= base_url('/') ?>"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        kembali
                    </a>
                    >
                </div>
            </div>
        </div>

        <script>
            // alert error 
            <?php if (!empty(session()->getFlashdata("error_verify_account"))) : ?>
                document.addEventListener("DOMContentLoaded", () => {
                    Swal.fire({
                        title: "error!",
                        icon: "error",
                        html: `<?= session('error_verify_account') ?>`
                    });
                })
            <?php endif; ?>
        </script>

</body>

</html>