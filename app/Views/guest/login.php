<?php

/**
 * @var CodeIgniter\View\View $this
 */
?>
<?= $this->extend("/guest/layout/index") ?>
<?= $this->section("content") ?>

<div class="xl:mx-72 lg:mx-48 md:mx-32 sm:mx-10 mx-5 mt-10">
    <div class="flex mt-18 justify-center items-center font-extrabold">
        <h1 class="text-4xl uppercase mb-10">Point Pelanggaran</h1>
    </div>
    <div class="flex flex-col bg-gray-100 sm:p-10 p-5 rounded-lg">
        <div class="flex flex-col items-center mb-5">
            <img src="<?= base_url('/assets/img/Lambang_Polda_Jateng.png') ?>" alt="Logo" width="100px"
                onclick="history.back()" class="cursor-pointer" />
            <h1 class="text-3xl font-extrabold mt-3 mb-3">Polres Pekalongan</h1>
        </div>
        <form action="<?= base_url("/login") ?>" method="post" enctype="multipart/form-data"
            class="flex flex-col pb-12 bg-white dark:bg-gray-800 dark:text-gray-200 rounded-lg">
            <?= csrf_field() ?>
            <div class="flex justify-center mt-3">
                <h1 class="font-bold text-3xl mt-3 mb-8">Login</h1>
            </div>
            <div class="flex flex-col xl:mx-44 lg:mx-36 mx-20">
                <label for="username" class="font-extrabold mb-2">Username :</label>
                <input type="text" name="username" value="<?= old('username') ?>" placeholder="username"
                    class="p-2 rounded-lg focus:ring-black bg-gray-100 dark:bg-gray-600 dark:border-gray-500 dark:text-white" />
            </div>
            <div class="flex flex-col xl:mx-44 lg:mx-36 mx-20 mt-3">
                <label for="password" class="font-extrabold mb-2">Password :</label>
                <input type="password" name="password" value="<?= old('password') ?>" placeholder="password"
                    class="p-2 rounded-lg focus:ring-black bg-gray-100 dark:bg-gray-600 dark:border-gray-500 dark:text-white" />
            </div>
            <div class="grid justify-items-end xl:mx-44 lg:mx-36 mx-20 mt-1">
                <a href="<?= base_url('/lupa-password') ?>" class="mb-2 text-blue-700 dark:text-gray-200 font-bold">Lupa
                    Password ?</a>
            </div>
            <div class="flex flex-col xl:mx-44 lg:mx-36 mx-20 mt-3">
                <button type="submit" class="p-2 rounded-lg text-white font-bold px-10 bg-gray-900">
                    Masuk
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // alert error 
    <?php if (!empty(session()->getFlashdata("error_login"))) : ?>
        document.addEventListener("DOMContentLoaded", () => {
            Swal.fire({
                title: "error!",
                icon: "error",
                html: `<?= session('error_login') ?>`
            });
        })
    <?php endif; ?>

    // alert success
    <?php if (!empty(session()->getFlashdata("success_lupa_password"))) : ?>
        document.addEventListener("DOMContentLoaded", () => {
            Swal.fire({
                title: "success!",
                icon: "success",
                html: `<?= session('success_lupa_password') ?>`
            });
        })
    <?php endif; ?>

    <?php if (!empty(session()->getFlashdata("success_verifikasi_akun"))) : ?>
        document.addEventListener("DOMContentLoaded", () => {
            Swal.fire({
                title: "success!",
                icon: "success",
                html: `<?= session('success_verifikasi_akun') ?>`
            });
        })
    <?php endif; ?>
</script>
<?= $this->endSection() ?>