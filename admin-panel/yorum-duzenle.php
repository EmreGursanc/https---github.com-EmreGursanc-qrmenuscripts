<?php
include("login-kontrol.php");
$not = "";
$not2 = "";
$id = $_GET["id"];
$sorgu = $db->prepare("SELECT * FROM musteri_yorum_tablosu WHERE musteri_yorum_id=:id");
$sorgu->execute(array(":id" => $id));
$row = $sorgu->fetch(PDO::FETCH_ASSOC);
$mygorsel = $row["yorum_musterigorsel"];

// Başlık Düzenleme
if (isset($_POST["musteri-duzenle"])) {
    $myad = $_POST["musteri-ad"];
    $myaciklama = $_POST["musteri-aciklama"];
    $myunvan = $_POST["musteri-unvan"];
    $guncelle = $db->prepare("UPDATE musteri_yorum_tablosu SET yorum_aciklama=?,yorum_musteriad=?,yorum_musteriunvan=? WHERE musteri_yorum_id=?");
    $guncelle->execute([$myaciklama, $myad, $myunvan, $id]);
    if ($guncelle) {
        header("Location:musteri-yorum-listesi.php");
    }
}

// Resim Düzenleme
if (isset($_POST["resim-duzenle"])) {
    unlink("../images/musteriyorum/$kresim");
    $yol = '../images/musteriyorum/';
    $tmp_name = $_FILES['musteri-resim']['tmp_name'];
    $name = $_FILES['musteri-resim']['name'];
    $isim = mt_rand();
    $ext = pathinfo($_FILES['musteri-resim']['name'], PATHINFO_EXTENSION);
    $yeniad = $isim . "." . $ext;
    $tip = $_FILES['musteri-resim']['type'];
    if (strlen($name) == 0) {
        $not2 = "<div class='alert alert-info text-center font-weight-bold' role='alert'>Bir resim seçiniz</div>";
    }
    if ($tip != 'image/jpeg' && $tip != 'image/png' && $tip != 'image/jpg') {
        $not2 = "<div class='alert alert-danger text-center font-weight-bold' role='alert'>Yalnızca jpg,Jpeg ve png formatında olabilir.</div>";
    }
    move_uploaded_file($tmp_name, "$yol/$yeniad");
    if (substr($yeniad, -1) == ".") {
        $yeniad = "";
    }
    $guncelle = $db->prepare("UPDATE musteri_yorum_tablosu SET yorum_musterigorsel=? WHERE musteri_yorum_id=?");
    $guncelle->execute([$yeniad, $id]);
    if ($guncelle) {
        header("Location:musteri-yorum-listesi.php");
    }
}

?>


<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="tr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Müşteri Yorum Düzenle</title>
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
                        &RightArrow; Müşteri Yorum Düzenle
                    </h2>

                    <div class="grid gap-6 mb-8 md:grid-cols-2">
                        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                                Müşteri Yorum Bilgilerini Düzenle
                            </h4>
                            <form method="POST">
                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Müşteri Ad </span>
                                    <input type="text" name="musteri-ad" maxlength="30" value="<?php echo $row["yorum_musteriad"]; ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                                </label>

                                <label class="block mt-4 text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Müşteri Açıklama</span>
                                    <textarea name="musteri-aciklama" maxlength="200" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" rows="5"><?php echo $row["yorum_aciklama"]; ?></textarea>
                                </label>
                                <label class="block mt-4 text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Müşteri Ünvan </span>
                                    <input type="text" name="musteri-unvan" maxlength="30" value="<?php echo $row["yorum_musteriunvan"]; ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                                </label>
                                <label class="block text-sm mt-2">
                                    <input type="submit" name="musteri-duzenle" class="block w-full mt-1 bg-purple-600 text-sm text-white dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                                </label>
                            </form>
                            <?php echo $not; ?>
                        </div>
                        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                                Müşteri Yorum Resmini Düzenle
                            </h4>
                            <form method="POST" enctype="multipart/form-data">
                                <label class="block text-sm mt-2">
                                    <span class="text-gray-700 dark:text-gray-400">Müşteri Yorum Resim </span>
                                    <input type="file" name="musteri-resim" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                                </label>
                                <label class="block text-sm mt-2">
                                    <input type="submit" name="resim-duzenle" class="block w-full mt-1 bg-purple-600 text-sm text-white dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                                </label>
                            </form>
                            <?php echo $not2; ?>
                            <img src="../images/musteriyorum/<?php echo $mygorsel; ?>" class="mt-4 rounded-md w-full object-cover" alt="">
                        </div>
                    </div>
                </div>


            </main>
        </div>
    </div>
</body>

</html>