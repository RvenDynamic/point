<?php

/**
 * @var CodeIgniter\View\View $this
 */
?>
<?= $this->extend("/admin/layout/index") ?>
<?= $this->section("content") ?>

<div class="xl:mx-72 lg:mx-64 md:mx-32 sm:mx-20 mx-10 mt-16 mb-10">
    <form action="<?= base_url('/admin/ganti-password') ?>" method="post" enctype="multipart/form-data"
        class="flex flex-col pb-12 bg-white dark:bg-gray-800 rounded-lg">
        <?= csrf_field() ?>
        <button type="button" class="flex justify-start dark:text-gray-200 md:ml-10 md:mt-10 ml-6 mt-6" onclick="history.back()"><i
                class="fa-solid fa-chevron-left md:text-2xl text-xl"></i></button>
        <div class="flex justify-center">
            <h1 class="font-extrabold dark:text-gray-200 text-3xl mt-5 mb-10">Ganti Password</h1>
        </div>
        <div class="flex flex-col xl:mx-48 lg:mx-28 mx-20 mb-3">
            <label for="old_password" class="font-semibold dark:text-gray-300 mb-2">Password lama :</label>
            <input type="password" name="old_password" value="" class="p-2 rounded-lg focus:ring-black bg-gray-50 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
        </div>
        <div class="flex flex-col xl:mx-48 lg:mx-28 mx-20 mb-3">
            <label for="new_password" class="font-semibold dark:text-gray-300 mb-2">Password baru :</label>
            <input type="password" name="new_password" value="" class="p-2 rounded-lg focus:ring-black bg-gray-50 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
        </div>
        <div class="flex flex-col xl:mx-48 lg:mx-28 mx-20 mb-3">
            <label for="confirm_password" class="font-semibold dark:text-gray-300 mb-2">Ulangi Password baru :</label>
            <input type="password" name="confirm_password" value=""
                class="p-2 rounded-lg focus:ring-black bg-gray-50 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
        </div>
        <div class="flex justify-center items-center xl:mx-48 lg:mx-28 mx-20 mt-8">
            <button type="submit" class="p-2 rounded-lg text-white font-bold w-full bg-gray-900 dark:border dark:border-gray-500">
                Simpan
            </button>
        </div>
    </form>
</div>

<script>
    // alert error 
    <?php if (!empty(session()->getFlashdata("error_ganti_password"))) : ?>
        document.addEventListener("DOMContentLoaded", () => {
            Swal.fire({
                title: "error!",
                icon: "error",
                html: `<?= session('error_ganti_password') ?>`
            });
        })
    <?php endif; ?>

    // alert error 
    <?php if (!empty(session()->getFlashdata("success_ganti_password"))) : ?>
        document.addEventListener("DOMContentLoaded", () => {
            Swal.fire({
                title: "success!",
                icon: "success",
                html: `<?= session('success_ganti_password') ?>`
            });
        })
    <?php endif; ?>
</script>
<?= $this->endSection() ?>