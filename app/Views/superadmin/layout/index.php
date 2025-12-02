<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Polres Pekalongan | <?= $title ?></title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="<?= base_url("icon.ico") ?>" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="<?= base_url("assets/js/plugin/webfont/webfont.min.js") ?>"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["<?= base_url("assets/css/fonts.min.css") ?>"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="<?= base_url("assets/css/bootstrap.min.css") ?>" />
    <link rel="stylesheet" href="<?= base_url("assets/css/plugins.min.css") ?>" />
    <link rel="stylesheet" href="<?= base_url("assets/css/kaiadmin.min.css") ?>" />
</head>

<body>
    <div class="wrapper">

        <?= $this->include("superadmin/layout/sidebar") ?>

        <div class="main-panel">

            <?= $this->include("superadmin/layout/navbar") ?>

            <div class="container">

                <?= $this->renderSection("content") ?>

            </div>

            <footer class="footer">
                <div class="container-fluid d-flex justify-content-center">
                    <div class="copyright">
                        2025 | Polres Pekalongan
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="<?= base_url("assets/js/core/jquery-3.7.1.min.js") ?>"></script>
    <script src="<?= base_url("assets/js/core/popper.min.js") ?>"></script>
    <script src="<?= base_url("assets/js/core/bootstrap.min.js") ?>"></script>

    <!-- jQuery Scrollbar -->
    <script src="<?= base_url("assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js") ?>"></script>

    <!-- Datatables -->
    <script src="<?= base_url("assets/js/plugin/datatables/datatables.min.js") ?>"></script>

    <!-- Bootstrap Notify -->
    <script src="<?= base_url("assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js") ?>"></script>

    <!-- tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

    <!-- sweetalert2  -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Kaiadmin JS -->
    <script src="<?= base_url("assets/js/kaiadmin.min.js") ?>"></script>

</body>

</html>