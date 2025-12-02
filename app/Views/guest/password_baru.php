<?php

/**
 * @var CodeIgniter\View\View $this
 */
?>
<?= $this->extend("/guest/layout/index") ?>
<?= $this->section("content") ?>

<div class="xl:mx-72 lg:mx-64 md:mx-32 sm:mx-20 mt-5 bg-gray-100 rounded-lg">
    <div class="flex justify-center mb-5">
        <img src="<?= base_url('assets/img/Lambang_Polda_Jateng.png') ?>" alt="Logo" width="100px" class="mt-5" />
    </div>
    <div class="mx-10">
        <form action="/lupa-password/reset-password" method="post" enctype="multipart/form-data"
            class="flex flex-col pb-12 bg-white dark:bg-gray-800 rounded-lg">
            <?= csrf_field() ?>
            <button type="button" class="flex justify-start md:ml-10 md:mt-10 ml-6 mt-6" onclick="history.back()"><i
                    class="fa-solid fa-chevron-left md:text-2xl dark:text-gray-200 text-xl"></i></button>
            <div class="flex flex-col items-center mt-5 mb-10">
                <div class="px-10 py-9 bg-gray-100 rounded-full mb-4">
                    <i class="fa-solid fa-key text-4xl"></i>
                </div>
                <h1 class="font-extrabold text-3xl dark:text-gray-200">Ubah Password Baru</h1>
                <p class="mt-1 text-gray-400 dark:text-gray-200">Masukan kode dan password baru</p>
            </div>
            <div class="flex flex-col xl:mx-48 lg:mx-28 mx-20 mb-6">
                <label for="kode" class="font-semibold dark:text-gray-200 mb-2">Kode :</label>
                <input type="text" name="kode" id="kode"
                    class="p-2 rounded-lg focus:ring-black bg-gray-50 dark:bg-gray-600 dark:border-gray-500 dark:text-white" />
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-200">Masukan kode yang diterima di email.</p>
            </div>
            <div class="flex flex-col xl:mx-48 lg:mx-28 mx-20 mb-6">
                <label for="new_password" class="font-semibold dark:text-gray-200 mb-2">Password Baru:</label>
                <input type="password" name="new_password" id="new_password" value=""
                    class="p-2 rounded-lg focus:ring-black bg-gray-50 dark:bg-gray-600 dark:border-gray-500 dark:text-white" />
            </div>
            <div class="flex flex-col xl:mx-48 lg:mx-28 mx-20 mb-6">
                <label for="confirm_password" class="font-semibold dark:text-gray-200 mb-2">Konfirmasi Password Baru
                    :</label>
                <input type="password" name="confirm_password" id="confirm_password" value=""
                    class="p-2 rounded-lg focus:ring-black bg-gray-50 dark:bg-gray-600 dark:border-gray-500 dark:text-white" />
            </div>
            <div class="flex justify-center items-center xl:mx-48 lg:mx-28 mx-20">
                <button type="submit" class="p-2 rounded-lg text-white font-bold w-full bg-gray-900">
                    Konfirmasi
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // error
    <?php if (!empty(session()->getFlashdata("error_lupa_password"))) : ?>
        document.addEventListener("DOMContentLoaded", () => {
            Swal.fire({
                title: "error!",
                icon: "error",
                html: `<?= session('error_lupa_password') ?>`
            });
        })
    <?php endif; ?>
</script>

<?= $this->endSection() ?>