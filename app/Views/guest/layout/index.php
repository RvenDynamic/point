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
    <title>Login</title>
    <link rel="icon" href="<?= base_url("/icon.ico") ?>" type="image/ico">
    <!--  Essential META Tags -->
    <meta property="title" content="Polres Pekalongan">
    <meta property="type" content="goverment" />
    <meta property="image" content="<?= base_url('/img/Lambang_Polda_Jateng.png') ?>">
    <meta property="url" content="<?= base_url() ?>">
    <meta name="twitter:card" content="summary_large_image">

    <!--  Non-Essential, But Recommended -->
    <meta property="description" content="Aplikasi untuk Pemberian Point Pelanggaran Lalu Lintas Polres Pekalongan.">
    <meta property="site_name" content="Polres Pekalongan RN.">
    <meta name="twitter:image:alt" content="Alt text for image">

    <!--  Non-Essential, But Required for Analytics -->
    <meta property="fb:app_id" content="your_app_id" />
    <meta name="twitter:site" content="@website-username">


    <!-- tailwind  -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <!-- sweetalert2  -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!-- content  -->
    <?= $this->renderSection("content") ?>

    <!-- utils css  -->
    <script src="https://kit.fontawesome.com/1748308ae9.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>