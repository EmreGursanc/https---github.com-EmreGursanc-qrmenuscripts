<?php
include("login-kontrol.php");
if ($kullanicicek["admin_yetki"] == 0) {
    header("Location:index.php");
}
$not = "";
// Anasayfa Bilgi Çekme
$anasayfasorgu = $db->prepare("SELECT * FROM anasayfa_tablosu");
$anasayfasorgu->execute();
$anasayfacikti = $anasayfasorgu->fetch(PDO::FETCH_ASSOC);

$slider1resim = $anasayfacikti["anasayfa_slider1_gorsel"];
$slider2resim = $anasayfacikti["anasayfa_slider2_gorsel"];
$hkgorsel = $anasayfacikti["anasayfa_hk_gorsel"];
$slogangorsel = $anasayfacikti["anasayfa_slogan_gorsel"];

if (isset($_POST["anasayfa-ayarlari"])) {

    $aaciklama = $_POST["anasayfa-aciklama"];
    $aslider1 = $_POST["anasayfa-slider1-yazi"];
    $aslider2 = $_POST["anasayfa-slider2-yazi"];
    $amasabaslik = $_POST["anasayfa-masa-baslik"];
    $amasaaciklama = $_POST["anasayfa-masa-aciklama"];
    $asloganbaslik = $_POST["anasayfa-slogan-baslik"];
    $asloganaciklama = $_POST["anasayfa-slogan-aciklama"];
    $sekle = $db->prepare("UPDATE anasayfa_tablosu SET anasayfa_aciklama=?,anasayfa_slider1_yazi=?,anasayfa_slider2_yazi=?,anasayfa_masa_baslik=?,anasayfa_masa_aciklama=?,anasayfa_slogan_baslik=?,anasayfa_slogan_aciklama=? WHERE anasayfa_id=1");
    $sekle->execute([$aaciklama, $aslider1, $aslider2, $amasabaslik, $amasaaciklama, $asloganbaslik, $asloganaciklama]);
    if ($sekle) {
        header("refresh:2;anasayfa-ayarlar.php");
        $not = "<div class='alert success'>Anasayfa Bilgileri Güncellenmiştir. Lütfen Bekleyiniz.</div>";
    } else {
        $not = "<div class='alert alert-success text-center font-weight-bold' role='alert'>Güncellenemedi.</div>";
    }
}

// SLİDER 1 RESİM DÜZENLEME
if (isset($_POST["slider1-resim-dz"])) {
    unlink("../images/$slider1resim");
    $yol = '../images/';
    $tmp_name = $_FILES['slider1-resim']['tmp_name'];
    $name = $_FILES['slider1-resim']['name'];
    $isim = mt_rand();
    $ext = pathinfo($_FILES['slider1-resim']['name'], PATHINFO_EXTENSION);
    $yeniad = $isim . "." . $ext;
    $tip = $_FILES['slider1-resim']['type'];
    if (strlen($name) == 0) {
        $not2 = "<div class='alert alert-info text-center font-weight-bold' role='alert'>Bir resim seçiniz</div>";
    }
    if ($tip != 'image/jpeg' && $tip != 'image/png' && $tip != 'image/jpg') {
        $not2 = "<div class='alert alert-danger text-center font-weight-bold' role='alert'>Yalnızca jpg,Jpeg ve png formatında olabilir.</div>";
    }
    move_uploaded_file($tmp_name, "$yol/$yeniad");

    $guncelle = $db->prepare("UPDATE anasayfa_tablosu SET anasayfa_slider1_gorsel=? WHERE anasayfa_id=1");
    $guncelle->execute([$yeniad]);
    if ($guncelle) {
        header("Location:anasayfa-ayarlar.php");
    }
}
// SLİDER 2 RESİM DÜZENLEME
if (isset($_POST["slider2-resim-dz"])) {
    unlink("../images/$slider2resim");
    $yol = '../images/';
    $tmp_name = $_FILES['slider2-resim']['tmp_name'];
    $name = $_FILES['slider2-resim']['name'];
    $isim = mt_rand();
    $ext = pathinfo($_FILES['slider2-resim']['name'], PATHINFO_EXTENSION);
    $yeniad = $isim . "." . $ext;
    $tip = $_FILES['slider2-resim']['type'];
    if (strlen($name) == 0) {
        $not2 = "<div class='alert alert-info text-center font-weight-bold' role='alert'>Bir resim seçiniz</div>";
    }
    if ($tip != 'image/jpeg' && $tip != 'image/png' && $tip != 'image/jpg') {
        $not2 = "<div class='alert alert-danger text-center font-weight-bold' role='alert'>Yalnızca jpg,Jpeg ve png formatında olabilir.</div>";
    }
    move_uploaded_file($tmp_name, "$yol/$yeniad");

    $guncelle = $db->prepare("UPDATE anasayfa_tablosu SET anasayfa_slider2_gorsel=? WHERE anasayfa_id=1");
    $guncelle->execute([$yeniad]);
    if ($guncelle) {
        header("Location:anasayfa-ayarlar.php");
    }
}
// HK RESİM DÜZENLEME
if (isset($_POST["hakkimizda-resim-dz"])) {
    unlink("../images/$hkgorsel");
    $yol = '../images/';
    $tmp_name = $_FILES['hakkimizda-resim']['tmp_name'];
    $name = $_FILES['hakkimizda-resim']['name'];
    $isim = mt_rand();
    $ext = pathinfo($_FILES['hakkimizda-resim']['name'], PATHINFO_EXTENSION);
    $yeniad = $isim . "." . $ext;
    $tip = $_FILES['hakkimizda-resim']['type'];
    if (strlen($name) == 0) {
        $not2 = "<div class='alert alert-info text-center font-weight-bold' role='alert'>Bir resim seçiniz</div>";
    }
    if ($tip != 'image/jpeg' && $tip != 'image/png' && $tip != 'image/jpg') {
        $not2 = "<div class='alert alert-danger text-center font-weight-bold' role='alert'>Yalnızca jpg,Jpeg ve png formatında olabilir.</div>";
    }
    move_uploaded_file($tmp_name, "$yol/$yeniad");

    $guncelle = $db->prepare("UPDATE anasayfa_tablosu SET anasayfa_hk_gorsel=? WHERE anasayfa_id=1");
    $guncelle->execute([$yeniad]);
    if ($guncelle) {
        header("Location:anasayfa-ayarlar.php");
    }
}

// SLOGAN RESİM DÜZENLEME
if (isset($_POST["slogan-resim-dz"])) {
    unlink("../images/$slogangorsel");
    $yol = '../images/';
    $tmp_name = $_FILES['slogan-resim']['tmp_name'];
    $name = $_FILES['slogan-resim']['name'];
    $isim = mt_rand();
    $ext = pathinfo($_FILES['slogan-resim']['name'], PATHINFO_EXTENSION);
    $yeniad = $isim . "." . $ext;
    $tip = $_FILES['slogan-resim']['type'];
    if (strlen($name) == 0) {
        $not2 = "<div class='alert alert-info text-center font-weight-bold' role='alert'>Bir resim seçiniz</div>";
    }
    if ($tip != 'image/jpeg' && $tip != 'image/png' && $tip != 'image/jpg') {
        $not2 = "<div class='alert alert-danger text-center font-weight-bold' role='alert'>Yalnızca jpg,Jpeg ve png formatında olabilir.</div>";
    }
    move_uploaded_file($tmp_name, "$yol/$yeniad");

    $guncelle = $db->prepare("UPDATE anasayfa_tablosu SET anasayfa_slogan_gorsel=? WHERE anasayfa_id=1");
    $guncelle->execute([$yeniad]);
    if ($guncelle) {
        header("Location:anasayfa-ayarlar.php");
    }
}

?>


<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="tr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ana Sayfa Ayarları</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/tailwind.output.css" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="./assets/js/init-alpine.js"></script>
    <style>
        .alert {
            padding: 20px;
            background-color: #f44336;
            color: white;
            text-align: center;
        }

        .alert.success {
            background-color: #04AA6D;
        }

        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebtn:hover {
            color: black;
        }
    </style>
</head>

<body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen}">
        <?php include("sidebar.php"); ?>
        <div class="flex flex-col flex-1">
            <?php include("header.php"); ?>
            <main class="h-full pb-16 overflow-y-auto">
                <div class="container px-6 mx-auto grid ">
                    <h2 class="my-6 text-2xl font-semibold   text-center text-gray-700 dark:text-gray-200">
                        <?php echo $not; ?>
                        &RightArrow; Ana Sayfa Ayarları &LeftArrow;
                    </h2>

                    <div class="grid gap-6 mb-8 md:grid-cols-2">
                        <div class="min-w-0 p-4 bg-white rounded-lg text-center shadow-xs dark:bg-gray-800">
                            <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                                ANASAYFA SAYFA AYARLARI
                            </h4>
                            <form method="POST">
                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Anasayfa Açıklama <b>(SEO) - Google Aramalar Kısmında gözükecektir.</b></span>
                                    <textarea name="anasayfa-aciklama" maxlength="150" rows="5" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"><?php echo $anasayfacikti["anasayfa_aciklama"] ?></textarea>
                                </label>
                                <label class="block text-sm mt-2">
                                    <span class="text-gray-700 dark:text-gray-400">Ana Sayfa Slider 1 Yazı Alanı</span>
                                    <input type="text" name="anasayfa-slider1-yazi" maxlength="40" value="<?php echo $anasayfacikti["anasayfa_slider1_yazi"] ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required />
                                </label>
                                <label class="block text-sm mt-2">
                                    <span class="text-gray-700 dark:text-gray-400">Ana Sayfa Slider 2 Yazı Alanı</span>
                                    <input type="text" name="anasayfa-slider2-yazi" maxlength="40" value="<?php echo $anasayfacikti["anasayfa_slider2_yazi"] ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required />
                                </label>
                                <label class="block text-sm mt-2">
                                    <span class="text-gray-700 dark:text-gray-400">Ana Sayfa Masa Başlık</span>
                                    <input type="text" name="anasayfa-masa-baslik" maxlength="40" value="<?php echo $anasayfacikti["anasayfa_masa_baslik"] ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required />
                                </label>
                                <label class="block text-sm mt-2">
                                    <span class="text-gray-700 dark:text-gray-400">Ana Sayfa Masa Açıklama </span>
                                    <textarea name="anasayfa-masa-aciklama" maxlength="150" rows="6" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"><?php echo $anasayfacikti["anasayfa_masa_aciklama"] ?></textarea>
                                </label>
                                <label class="block text-sm mt-2">
                                    <span class="text-gray-700 dark:text-gray-400">Ana Sayfa Slogan Başlık</span>
                                    <input type="text" name="anasayfa-slogan-baslik" maxlength="20" value="<?php echo $anasayfacikti["anasayfa_slogan_baslik"] ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required />
                                </label>
                                <label class="block text-sm mt-2">
                                    <span class="text-gray-700 dark:text-gray-400">Ana Sayfa Slogan Açıklama </span>
                                    <input type="text" name="anasayfa-slogan-aciklama" maxlength="40" value="<?php echo $anasayfacikti["anasayfa_slogan_aciklama"] ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required />
                                </label>
                                <label class="block text-sm mt-2">
                                    <input type="submit" name="anasayfa-ayarlari" class="block w-full mt-1 bg-purple-600 text-sm text-white dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                                </label>
                            </form>
                        </div>
                        <div class="min-w-0 p-4 bg-white rounded-lg text-center shadow-xs dark:bg-gray-800">
                            <form enctype="multipart/form-data" method="POST">
                                <label class="block text-sm mt-2">
                                    <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">&RightArrow; 1. Slider Resim Düzenle </h4>
                                    <input type="file" name="slider1-resim" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required />
                                </label>
                                <label class="block text-sm mt-2">
                                    <input type="submit" name="slider1-resim-dz" class="block w-full mt-1 bg-purple-600 text-sm text-white dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400  focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                                </label>
                            </form>
                            <h4 class="mt-4  text-center font-semibold text-gray-400 dark:text-gray-300">
                                Mevcut 1. Slider Resim
                                <center> <img src="../images/<?php echo $slider1resim ?>" alt=""></center>
                            </h4>
                            <hr class="mt-4">
                            <form enctype="multipart/form-data" method="POST">
                                <label class="block text-sm mt-2">
                                    <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">&RightArrow; 2. Slider Resim Düzenle </h4>
                                    <input type="file" name="slider2-resim" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required />
                                </label>
                                <label class="block text-sm mt-2">
                                    <input type="submit" name="slider2-resim-dz" class="block w-full mt-1 bg-purple-600 text-sm text-white dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                                </label>
                            </form>
                            <h4 class="mt-4  text-center font-semibold text-gray-400 dark:text-gray-300">
                                Mevcut 2. Slider Resim
                                <center> <img src="../images/<?php echo $slider2resim ?>" alt=""></center>
                            </h4>
                            <hr class="mt-4">
                            <form enctype="multipart/form-data" method="POST">
                                <label class="block text-sm mt-2">
                                    <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">&RightArrow; Anasayfa Hakkımızda Kısım Resim Düzenle </h4>
                                    <input type="file" name="hakkimizda-resim" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required />
                                </label>
                                <label class="block text-sm mt-2">
                                    <input type="submit" name="hakkimizda-resim-dz" class="block w-full mt-1 bg-purple-600 text-sm text-white dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                                </label>
                            </form>
                            <h4 class="mt-4  text-center font-semibold text-gray-400 dark:text-gray-300">
                                Mevcut Hakkımızda Resim
                                <center> <img src="../images/<?php echo $hkgorsel ?>" alt=""></center>
                            </h4>
                            <hr class="mt-4">
                            <form enctype="multipart/form-data" method="POST">
                                <label class="block text-sm mt-2">
                                    <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">&RightArrow; Slogan ArkaPlan Resim Düzenle </h4>
                                    <input type="file" name="slogan-resim" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required />
                                </label>
                                <label class="block text-sm mt-2">
                                    <input type="submit" name="slogan-resim-dz" class="block w-full mt-1 bg-purple-600 text-sm text-white dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                                </label>
                            </form>
                            <h4 class="mt-4  text-center font-semibold text-gray-400 dark:text-gray-300">
                                Mevcut Slogan ArkaPlan
                                <center> <img src="../images/<?php echo $slogangorsel ?>" alt=""></center>
                            </h4>
                            <hr class="mt-4">
                        </div>
                    </div>
                </div>


            </main>
        </div>
    </div>
</body>

</html>