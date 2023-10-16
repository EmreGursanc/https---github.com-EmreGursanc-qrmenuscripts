<?php
include("login-kontrol.php");
if ($kullanicicek["admin_yetki"] == 0) {
    header("Location:index.php");
}
$not = "";
$not2 = "";

$sitesorgu = $db->prepare("SELECT * FROM site_bilgi_tablosu");
$sitesorgu->execute();
$sitecikti = $sitesorgu->fetch(PDO::FETCH_ASSOC);
$logo=$sitecikti["site_logo"];
$favicon=$sitecikti["site_favicon"];
$kategori=$sitecikti["site_kategori_gorsel"];
$iletisim=$sitecikti["site_iletisim_gorsel"];
if (isset($_POST["sayfa-bilgi-dz"])) {

    $sbaslik = $_POST["sayfa-baslik"];
    $saciklama = $_POST["sayfa-aciklama"];
    $stelefon = trim($_POST["sayfa-telefon"]);
    $semail = trim($_POST["sayfa-email"]);
    $scalismasaat = trim($_POST["sayfa-calisma-saat"]);
    $sadres = $_POST["sayfa-adres"];
    $sekle = $db->prepare("UPDATE site_bilgi_tablosu SET site_baslik=?,site_aciklama=?,site_telefon=?,site_email=?,site_calisma_saat=?,site_adres=? WHERE site_id=1");
    $sekle->execute([$sbaslik, $saciklama, $stelefon, $semail, $scalismasaat, $sadres]);
    if ($sekle) {
        header("refresh:2;sayfa-ayarlari.php");
        $not = "<div class='alert  success text-center font-weight-bold' role='alert'>Sayfa Bilgileri Güncellendi.</div>";
    } else {
        $not = "<div class='alert alert-success text-center font-weight-bold' role='alert'>Sayfa Bilgileri Güncellenemedi.</div>";
    }
}

// LOGO DÜZENLE
if (isset($_POST["logo-dz"])) {
    unlink("../images/$logo");
    $yol = '../images/';
    $tmp_name = $_FILES['logo-img']['tmp_name'];
    $name = $_FILES['logo-img']['name'];
    $isim = mt_rand();
    $ext = pathinfo($_FILES['logo-img']['name'], PATHINFO_EXTENSION);
    $yeniad = $isim . "." . $ext;
    $tip = $_FILES['logo-img']['type'];
    if (strlen($name) == 0) {
        $not2 = "<div class='alert alert-info text-center font-weight-bold' role='alert'>Bir resim seçiniz</div>";
    }
    if ($tip != 'image/jpeg' && $tip != 'image/png' && $tip != 'image/jpg') {
        $not2 = "<div class='alert alert-danger text-center font-weight-bold' role='alert'>Yalnızca jpg,Jpeg ve png formatında olabilir.</div>";
    }
    move_uploaded_file($tmp_name, "$yol/$yeniad");

    $guncelle = $db->prepare("UPDATE site_bilgi_tablosu SET site_logo=? WHERE site_id=1");
    $guncelle->execute([$yeniad]);
    if ($guncelle) {
        header("Location:sayfa-ayarlari.php");
    }
}


// FAVİCON DÜZENLE
if (isset($_POST["favicon-dz"])) {
    unlink("../images/$favicon");
    $yol = '../images/';
    $tmp_name = $_FILES['favicon-img']['tmp_name'];
    $name = $_FILES['favicon-img']['name'];
    $isim = mt_rand();
    $ext = pathinfo($_FILES['favicon-img']['name'], PATHINFO_EXTENSION);
    $yeniad = $isim . "." . $ext;
    $tip = $_FILES['favicon-img']['type'];
    if (strlen($name) == 0) {
        $not2 = "<div class='alert alert-info text-center font-weight-bold' role='alert'>Bir resim seçiniz</div>";
    }
    if ($tip != 'image/jpeg' && $tip != 'image/png' && $tip != 'image/jpg') {
        $not2 = "<div class='alert alert-danger text-center font-weight-bold' role='alert'>Yalnızca jpg,Jpeg ve png formatında olabilir.</div>";
    }
    move_uploaded_file($tmp_name, "$yol/$yeniad");

    $guncelle = $db->prepare("UPDATE site_bilgi_tablosu SET site_favicon=? WHERE site_id=1");
    $guncelle->execute([$yeniad]);
    if ($guncelle) {
        header("Location:sayfa-ayarlari.php");
    }
}

// KATEGORİ GÖRSEL DÜZENLE
if (isset($_POST["kategori-gorsel-dz"])) {
    unlink("../images/$kategori");
    $yol = '../images/';
    $tmp_name = $_FILES['kategori-img']['tmp_name'];
    $name = $_FILES['kategori-img']['name'];
    $isim = mt_rand();
    $ext = pathinfo($_FILES['kategori-img']['name'], PATHINFO_EXTENSION);
    $yeniad = $isim . "." . $ext;
    $tip = $_FILES['kategori-img']['type'];
    if (strlen($name) == 0) {
        $not2 = "<div class='alert alert-info text-center font-weight-bold' role='alert'>Bir resim seçiniz</div>";
    }
    if ($tip != 'image/jpeg' && $tip != 'image/png' && $tip != 'image/jpg') {
        $not2 = "<div class='alert alert-danger text-center font-weight-bold' role='alert'>Yalnızca jpg,Jpeg ve png formatında olabilir.</div>";
    }
    move_uploaded_file($tmp_name, "$yol/$yeniad");

    $guncelle = $db->prepare("UPDATE site_bilgi_tablosu SET site_kategori_gorsel=? WHERE site_id=1");
    $guncelle->execute([$yeniad]);
    if ($guncelle) {
        header("Location:sayfa-ayarlari.php");
    }
}

// İLETİŞİM GÖRSEL DÜZENLE
if (isset($_POST["iletisim-gorsel-dz"])) {
    unlink("../images/$iletisim");
    $yol = '../images/';
    $tmp_name = $_FILES['iletisim-img']['tmp_name'];
    $name = $_FILES['iletisim-img']['name'];
    $isim = mt_rand();
    $ext = pathinfo($_FILES['iletisim-img']['name'], PATHINFO_EXTENSION);
    $yeniad = $isim . "." . $ext;
    $tip = $_FILES['iletisim-img']['type'];
    if (strlen($name) == 0) {
        $not2 = "<div class='alert alert-info text-center font-weight-bold' role='alert'>Bir resim seçiniz</div>";
    }
    if ($tip != 'image/jpeg' && $tip != 'image/png' && $tip != 'image/jpg') {
        $not2 = "<div class='alert alert-danger text-center font-weight-bold' role='alert'>Yalnızca jpg,Jpeg ve png formatında olabilir.</div>";
    }
    move_uploaded_file($tmp_name, "$yol/$yeniad");

    $guncelle = $db->prepare("UPDATE site_bilgi_tablosu SET site_iletisim_gorsel=? WHERE site_id=1");
    $guncelle->execute([$yeniad]);
    if ($guncelle) {
        header("Location:sayfa-ayarlari.php");
    }
}
?>


<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="tr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sayfa Ayarları</title>
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
        <!-- Desktop sidebar -->
        <?php include("sidebar.php"); ?>
        <div class="flex flex-col flex-1">
            <?php include("header.php"); ?>
            <main class="h-full pb-16 overflow-y-auto">


                <div class="container px-6 mx-auto grid">
                    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                        &RightArrow; Sayfa Ayarları
                    </h2>
                    <!-- General elements -->
                    <div class="grid gap-6 mb-8 md:grid-cols-2">
                        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <h4 class="mb-4  text-center font-semibold text-gray-600 dark:text-gray-300">
                                Sayfa Bilgileri Güncelle
                            </h4>
                            <form enctype="multipart/form-data" method="POST">
                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Sayfa Başlık </span>
                                    <input type="text" name="sayfa-baslik" value="<?php echo $sitecikti["site_baslik"]; ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required />
                                </label>

                                <label class="block text-sm mt-2">
                                    <span class="text-gray-700 dark:text-gray-400">Sayfa Açıklama </span>
                                    <input type="text" name="sayfa-aciklama" value="<?php echo $sitecikti["site_aciklama"]; ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required />
                                </label>

                                <label class="block text-sm mt-2">
                                    <span class="text-gray-700 dark:text-gray-400">Telefon Numarası(Boş Bırakırsanız Pasif olacaktır.) </span>
                                    <input type="text" name="sayfa-telefon" value="<?php echo $sitecikti["site_telefon"]; ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                                </label>

                                <label class="block text-sm mt-2">
                                    <span class="text-gray-700 dark:text-gray-400">E Mail Adresi (Boş Bırakırsanız Pasif olacaktır.) </span>
                                    <input type="text" name="sayfa-email" value="<?php echo $sitecikti["site_email"]; ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                                </label>

                                <label class="block text-sm mt-2">
                                    <span class="text-gray-700 dark:text-gray-400">Çalışma Saatleri(Boş Bırakırsanız Pasif olacaktır.) </span>
                                    <input type="text" name="sayfa-calisma-saat" value="<?php echo $sitecikti["site_calisma_saat"]; ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                                </label>
                                <label class="block text-sm mt-2">
                                    <span class="text-gray-700 dark:text-gray-400">Adres Bilgisi </span>
                                    <input type="text" name="sayfa-adres" value="<?php echo $sitecikti["site_adres"]; ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required />
                                </label>
                                <label class="block text-sm mt-2">
                                    <input type="submit" name="sayfa-bilgi-dz" class="block w-full mt-1 bg-purple-600 text-sm text-white dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                                </label>
                            </form>
                            <?php echo $not; ?>
                        </div>
                        <!-- SOSYAL MEDYA FORM -->

                        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <h4 class="mb-4  text-center font-semibold text-gray-600 dark:text-gray-300">
                                Diğer Sayfa Ayarları
                            </h4>
                            <form enctype="multipart/form-data" method="POST">
                                <label class="block text-sm mt-2">
                                    <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">&RightArrow; Logo Değiştir </h4>
                                    <input type="file" name="logo-img" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required />
                                </label>
                                <label class="block text-sm mt-2">
                                    <input type="submit" name="logo-dz" class="block w-full mt-1 bg-purple-600 text-sm text-white dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400  focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                                </label>
                            </form>
                            <h4 class="mt-4  text-center font-semibold text-gray-400 dark:text-gray-300">
                                Mevcut Site Logo
                                <center> <img src="../images/<?php echo $logo ?>" alt=""></center>
                            </h4>
                            <hr class="mt-4">
                            <?php echo $not2; ?>

                            <form enctype="multipart/form-data" method="POST">
                                <label class="block text-sm mt-2">
                                    <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">&RightArrow; Favicon Değiştir </h4>
                                    <input type="file" name="favicon-img" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required />
                                </label>
                                <label class="block text-sm mt-2">
                                    <input type="submit" name="favicon-dz" class="block w-full mt-1 bg-purple-600 text-sm text-white dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400  focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                                </label>
                            </form>
                            <h4 class="mt-4  text-center font-semibold text-gray-400 dark:text-gray-300">
                                Mevcut Site Favicon
                                <center> <img src="../images/<?php echo $favicon ?>" alt=""></center>
                            </h4>
                            <hr class="mt-4">
                            <?php echo $not2; ?>
                        </div>

                        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <h4 class="mb-4  text-center font-semibold text-gray-600 dark:text-gray-300">
                               Kategori Arka Plan
                            </h4>
                            <form enctype="multipart/form-data" method="POST">
                                <label class="block text-sm mt-2">
                                    <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">&RightArrow; Kategori Arka Plan Görsel Değiştir </h4>
                                    <input type="file" name="kategori-img" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required />
                                </label>
                                <label class="block text-sm mt-2">
                                    <input type="submit" name="kategori-gorsel-dz" class="block w-full mt-1 bg-purple-600 text-sm text-white dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400  focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                                </label>
                            </form>
                            <h4 class="mt-4  text-center font-semibold text-gray-400 dark:text-gray-300">
                                Mevcut Kategori Arka Plan Görsel 
                                <center> <img src="../images/<?php echo $kategori ?>" alt=""></center>
                            </h4>
                            <hr class="mt-4">
                            <?php echo $not2; ?>

                            <form enctype="multipart/form-data" method="POST">
                                <label class="block text-sm mt-2">
                                    <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">&RightArrow; İletişim Arka Plan Değiştir </h4>
                                    <input type="file" name="iletisim-img" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required />
                                </label>
                                <label class="block text-sm mt-2">
                                    <input type="submit" name="iletisim-gorsel-dz" class="block w-full mt-1 bg-purple-600 text-sm text-white dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400  focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                                </label>
                            </form>
                            <h4 class="mt-4  text-center font-semibold text-gray-400 dark:text-gray-300">
                                Mevcut İletişim Arka Plan
                                <center> <img src="../images/<?php echo $iletisim ?>" alt=""></center>
                            </h4>
                            <hr class="mt-4">
                            <?php echo $not2; ?>
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>
</body>

</html>