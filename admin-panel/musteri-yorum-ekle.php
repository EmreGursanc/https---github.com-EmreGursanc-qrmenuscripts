<?php
include("login-kontrol.php");
$not = "";
if ($_POST) {
    $yaciklama = addslashes($_POST["yorum-aciklama"]);
    $ymusteriad = addslashes($_POST["yorum-ad"]);
    $ymusteriunvan =  strip_tags($_POST["yorum-unvan"]);
    $yol = '../images/musteriyorum/';
    $tmp_name = $_FILES['yorum-resim']['tmp_name'];
    $name = $_FILES['yorum-resim']['name'];
    $isim = mt_rand();
    $ext = pathinfo($_FILES['yorum-resim']['name'], PATHINFO_EXTENSION);
    $yeniad = $isim . "." . $ext;
    $tip = $_FILES['yorum-resim']['type'];
    if (strlen($name) == 0) {
        $not2 = "<div class='alert alert-info text-center font-weight-bold' role='alert'>Bir resim seçiniz</div>";
    }
    if ($tip != 'image/jpeg' && $tip != 'image/png' && $tip != 'image/jpg') {
        $not2 = "<div class='alert alert-danger text-center font-weight-bold' role='alert'>Yalnızca jpg,Jpeg ve png formatında olabilir.</div>";
    }
    move_uploaded_file($tmp_name, "$yol/$yeniad");

    $sekle = $db->prepare("INSERT INTO musteri_yorum_tablosu SET yorum_aciklama=?,yorum_musteriad=?,yorum_musteriunvan=?,yorum_musterigorsel=?");
    $sekle->execute([$yaciklama, $ymusteriad, $ymusteriunvan, $yeniad]);
    if ($sekle) {
        header("refresh:2;musteri-yorum-listesi.php");
        $not = "<div class='alert alert-success text-center font-weight-bold' role='alert'>Ürün Eklendi</div>";
    } else {
        $not = "<div class='alert alert-success text-center font-weight-bold' role='alert'>Ürün Eklenemedi</div>";
    }
}
?>


<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="tr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Müşteri Yorum Ekle</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/tailwind.output.css" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="./assets/js/init-alpine.js"></script>
</head>

<body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen}">
        <?php include("sidebar.php"); ?>
        <div class="flex flex-col flex-1">
            <?php include("header.php"); ?>
            <main class="h-full pb-16 overflow-y-auto">
                <div class="container px-6 mx-auto grid ">
                    <h2 class="my-6 text-2xl font-semibold  text-gray-700 dark:text-gray-200">
                        &RightArrow; Müşteri Yorum Ekle
                    </h2>

                    <div class="grid gap-6 mb-8 ">
                        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <form enctype="multipart/form-data" method="POST">

                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Müşteri Ad </span>
                                    <input type="text" name="yorum-ad" maxlength="30" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Ahmet Demir" required />
                                </label>

                                <label class="block mt-4 text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Müşteri Yorum Açıklama</span>
                                    <textarea name="yorum-aciklama" maxlength="200" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" rows="5" placeholder="..."></textarea>
                                </label>
                                <label class="block mt-4 text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Müşteri Ünvan </span>
                                    <input type="text" name="yorum-unvan" maxlength="30" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="İş Adamı" required />
                                </label>

                                <label class="block text-sm mt-4">
                                    <span class="text-gray-700 dark:text-gray-400">Müşteri Yorum Resim </span>
                                    <input type="file" name="yorum-resim" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required />
                                </label>

                                <label class="block text-sm mt-4">
                                    <input type="submit" class="block w-full mt-1 bg-purple-600 text-sm text-white dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                                </label>
                            </form>
                            <?php echo $not; ?>
                        </div>
                    </div>
                </div>


            </main>
        </div>
    </div>
</body>

</html>