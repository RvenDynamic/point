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
    <title>Polres Pekalongan | Unauthorized</title>
    <link rel="icon" href="<?= base_url("/icon.ico") ?>" type="image/ico">
    <!-- tailwind  -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    <div class="w-full min-h-screen flex justify-center items-center">
        <div class="w-full max-w-md">
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <h1 class="text-2xl font-bold text-center mb-4">Unauthorized</h1>
                <p class="text-center">Kamu tidak ter authentikasi ke url ini.</p>
                <div class="flex items-center justify-center mt-4">
                    <?php if (user('role') == 'superadmin') : ?>
                        <a href="<?= base_url('/polres') ?>"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            kembali
                        </a>
                    <?php else : ?>
                        <a href="<?= base_url('/polsek') ?>"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            kembali
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

</body>

</html>