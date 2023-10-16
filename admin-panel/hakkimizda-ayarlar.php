<?php
include("login-kontrol.php");
if ($kullanicicek["admin_yetki"] == 0) {
    header("Location:index.php");
}
$not = "";
$hakkimizdasorgu = $db->prepare("SELECT * FROM hakkimizda_tablosu");
$hakkimizdasorgu->execute();
$hakkimizdacikti = $hakkimizdasorgu->fetch(PDO::FETCH_ASSOC);
if (isset($_POST["hk-duzenle"])) {
    $hbaslik = $_POST["hakkimizda-baslik"];
    $haciklama = $_POST["hakkimizda-aciklama"];
    $hslogan = $_POST["hakkimizda-slogan"];
    $hicerik = $_POST["hakkimizda-icerik"];
    $hbir = $_POST["hakkimizda-yazibir"];
    $hbirsayi = $_POST["hakkimizda-yazibir-sayi"];
    $hiki = $_POST["hakkimizda-yaziiki"];
    $hikisayi = $_POST["hakkimizda-yaziiki-sayi"];
    $huc = $_POST["hakkimizda-yaziuc"];
    $hucsayi = $_POST["hakkimizda-yaziuc-sayi"];
    $hdort = $_POST["hakkimizda-yazidort"];
    $hdortsayi = $_POST["hakkimizda-yazidort-sayi"];

    $sekle = $db->prepare("UPDATE hakkimizda_tablosu SET hakkimizda_baslik=?,hakkimizda_aciklama=?,hakkimizda_slogan=?,hakkimizda_icerik=?,hakkimizda_yazibir=?,hakkimizda_yazibir_sayi=?,hakkimizda_yaziiki=?,hakkimizda_yaziiki_sayi=?,hakkimizda_yaziuc=?,hakkimizda_yaziuc_sayi=?,hakkimizda_yazidort=?,hakkimizda_yazidort_sayi=? WHERE hakkimizda_id=1");
    $sekle->execute([$hbaslik, $haciklama, $hslogan, $hicerik, $hbir, $hbirsayi, $hiki, $hikisayi, $huc, $hucsayi, $hdort, $hdortsayi]);
    if ($sekle) {
        header("Location:hakkimizda-ayarlar.php");
        $not = "<div class='alert alert-success text-center font-weight-bold' role='alert'>Başarılı Bir Şekilde Güncellendi.</div>";
    } else {
        $not = "<div class='alert alert-success text-center font-weight-bold' role='alert'>Başarılı Bir Şekilde Güncellendi.</div>";
    }
}

$hkgorsel1 = $hakkimizdacikti["hakkimizda_gorsel_1"];
$hkgorsel2 = $hakkimizdacikti["hakkimizda_gorsel_2"];
$hkgorsel3 = $hakkimizdacikti["hakkimizda_gorsel_3"];
// HK 1 RESİM DÜZENLEME
if (isset($_POST["hakkimizda1-resim-dz"])) {
    unlink("../images/$hkgorsel1");
    $yol = '../images/';
    $tmp_name = $_FILES['hk1-resim']['tmp_name'];
    $name = $_FILES['hk1-resim']['name'];
    $isim = mt_rand();
    $ext = pathinfo($_FILES['hk1-resim']['name'], PATHINFO_EXTENSION);
    $yeniad = $isim . "." . $ext;
    $tip = $_FILES['hk1-resim']['type'];
    if (strlen($name) == 0) {
        $not2 = "<div class='alert alert-info text-center font-weight-bold' role='alert'>Bir resim seçiniz</div>";
    }
    if ($tip != 'image/jpeg' && $tip != 'image/png' && $tip != 'image/jpg') {
        $not2 = "<div class='alert alert-danger text-center font-weight-bold' role='alert'>Yalnızca jpg,Jpeg ve png formatında olabilir.</div>";
    }
    move_uploaded_file($tmp_name, "$yol/$yeniad");

    $guncelle = $db->prepare("UPDATE hakkimizda_tablosu SET hakkimizda_gorsel_1=? WHERE hakkimizda_id=1");
    $guncelle->execute([$yeniad]);
    if ($guncelle) {
        header("Location:hakkimizda-ayarlar.php");
    }
}

// HK 2 RESİM DÜZENLEME
if (isset($_POST["hakkimizda2-resim-dz"])) {
    unlink("../images/$hkgorsel3");
    $yol = '../images/';
    $tmp_name = $_FILES['hk2-resim']['tmp_name'];
    $name = $_FILES['hk2-resim']['name'];
    $isim = mt_rand();
    $ext = pathinfo($_FILES['hk2-resim']['name'], PATHINFO_EXTENSION);
    $yeniad = $isim . "." . $ext;
    $tip = $_FILES['hk2-resim']['type'];
    if (strlen($name) == 0) {
        $not2 = "<div class='alert alert-info text-center font-weight-bold' role='alert'>Bir resim seçiniz</div>";
    }
    if ($tip != 'image/jpeg' && $tip != 'image/png' && $tip != 'image/jpg') {
        $not2 = "<div class='alert alert-danger text-center font-weight-bold' role='alert'>Yalnızca jpg,Jpeg ve png formatında olabilir.</div>";
    }
    move_uploaded_file($tmp_name, "$yol/$yeniad");

    $guncelle = $db->prepare("UPDATE hakkimizda_tablosu SET hakkimizda_gorsel_2=? WHERE hakkimizda_id=1");
    $guncelle->execute([$yeniad]);
    if ($guncelle) {
        header("Location:hakkimizda-ayarlar.php");
    }
}
// HK 3 RESİM DÜZENLEME
if (isset($_POST["hakkimizda3-resim-dz"])) {
    unlink("../images/$hkgorsel3");
    $yol = '../images/';
    $tmp_name = $_FILES['hk3-resim']['tmp_name'];
    $name = $_FILES['hk3-resim']['name'];
    $isim = mt_rand();
    $ext = pathinfo($_FILES['hk3-resim']['name'], PATHINFO_EXTENSION);
    $yeniad = $isim . "." . $ext;
    $tip = $_FILES['hk3-resim']['type'];
    if (strlen($name) == 0) {
        $not2 = "<div class='alert alert-info text-center font-weight-bold' role='alert'>Bir resim seçiniz</div>";
    }
    if ($tip != 'image/jpeg' && $tip != 'image/png' && $tip != 'image/jpg') {
        $not2 = "<div class='alert alert-danger text-center font-weight-bold' role='alert'>Yalnızca jpg,Jpeg ve png formatında olabilir.</div>";
    }
    move_uploaded_file($tmp_name, "$yol/$yeniad");

    $guncelle = $db->prepare("UPDATE hakkimizda_tablosu SET hakkimizda_gorsel_3=? WHERE hakkimizda_id=1");
    $guncelle->execute([$yeniad]);
    if ($guncelle) {
        header("Location:hakkimizda-ayarlar.php");
    }
}
?>


<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="tr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hakkımızda Sayfa Ayarları</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/tailwind.output.css" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="./assets/js/init-alpine.js"></script>
</head>

<body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen}">
        <!-- Desktop sidebar -->
        <?php include("sidebar.php"); ?>
        <div class="flex flex-col flex-1">
            <?php include("header.php"); ?>
            <main class="h-full pb-16 overflow-y-auto">




                <div class="container px-6 mx-auto grid ">
                    <h2 class="my-6 text-2xl font-semibold   text-center text-gray-700 dark:text-gray-200">
                        <?php echo $not; ?>
                        &RightArrow; Hakkımızda Ayarları &LeftArrow;
                    </h2>

                    <div class="grid gap-6 mb-8 md:grid-cols-2">
                        <div class="min-w-0 p-4 bg-white rounded-lg text-center shadow-xs dark:bg-gray-800">
                            <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                            Hakkımızda Sayfa Ayarları
                            </h4>
                            <form enctype="multipart/form-data" method="POST">
                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Hakkımızda Başlık </span>
                                    <input type="text" name="hakkimizda-baslik" maxlength="60" value="<?php echo $hakkimizdacikti["hakkimizda_baslik"]; ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required />
                                </label>

                                <label class="block text-sm mt-2">
                                    <span class="text-gray-700 dark:text-gray-400">Hakkımızda Açıklama <b>(SEO) - Google Aramalar Kısmında gözükecektir.</b></span>
                                    <input type="text" name="hakkimizda-aciklama" maxlength="150" value="<?php echo $hakkimizdacikti["hakkimizda_aciklama"]; ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required />
                                </label>

                                <label class="block text-sm mt-2">
                                    <span class="text-gray-700 dark:text-gray-400">Hakkımızda Slogan</span>
                                    <input type="text" name="hakkimizda-slogan" maxlength="30" value="<?php echo $hakkimizdacikti["hakkimizda_slogan"]; ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required />
                                </label>

                                <label class="block text-sm mt-2">
                                    <span class="text-gray-700 dark:text-gray-400">Hakkımızda İçerik</span>
                                    <textarea name="hakkimizda-icerik" maxlength="2000" rows="8" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"><?php echo $hakkimizdacikti["hakkimizda_icerik"]; ?></textarea>
                                </label>

                                <label class="block text-sm mt-2">
                                    <span class="text-gray-700 dark:text-gray-400">Hakkımızda Birinci Yazı Alanı</span>
                                    <input type="text" name="hakkimizda-yazibir" maxlength="40" value="<?php echo $hakkimizdacikti["hakkimizda_yazibir"]; ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required />
                                </label>

                                <label class="block text-sm mt-2">
                                    <span class="text-gray-700 dark:text-gray-400">Hakkımızda Birinci Yazı Alanı Sayısı</span>
                                    <input type="text" name="hakkimizda-yazibir-sayi" maxlength="6" value="<?php echo $hakkimizdacikti["hakkimizda_yazibir_sayi"]; ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required />
                                </label>

                                <label class="block text-sm mt-2">
                                    <span class="text-gray-700 dark:text-gray-400">Hakkımızda İkinci Yazı Alanı</span>
                                    <input type="text" name="hakkimizda-yaziiki" maxlength="40" value="<?php echo $hakkimizdacikti["hakkimizda_yaziiki"]; ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required />
                                </label>

                                <label class="block text-sm mt-2">
                                    <span class="text-gray-700 dark:text-gray-400">Hakkımızda İkinci Yazı Alanı Sayısı</span>
                                    <input type="text" name="hakkimizda-yaziiki-sayi" maxlength="6" value="<?php echo $hakkimizdacikti["hakkimizda_yaziiki_sayi"]; ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required />
                                </label>


                                <label class="block text-sm mt-2">
                                    <span class="text-gray-700 dark:text-gray-400">Hakkımızda Üçüncü Yazı Alanı</span>
                                    <input type="text" name="hakkimizda-yaziuc" maxlength="40" value="<?php echo $hakkimizdacikti["hakkimizda_yaziuc"]; ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required />
                                </label>

                                <label class="block text-sm mt-2">
                                    <span class="text-gray-700 dark:text-gray-400">Hakkımızda Üçüncü Yazı Alanı Sayısı</span>
                                    <input type="text" name="hakkimizda-yaziuc-sayi" maxlength="6" value="<?php echo $hakkimizdacikti["hakkimizda_yaziuc_sayi"]; ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required />
                                </label>

                                <label class="block text-sm mt-2">
                                    <span class="text-gray-700 dark:text-gray-400">Hakkımızda Dördüncü Yazı Alanı</span>
                                    <input type="text" name="hakkimizda-yazidort" maxlength="40" value="<?php echo $hakkimizdacikti["hakkimizda_yazidort"]; ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required />
                                </label>

                                <label class="block text-sm mt-2">
                                    <span class="text-gray-700 dark:text-gray-400">Hakkımızda Dördüncü Yazı Alanı Sayısı</span>
                                    <input type="text" name="hakkimizda-yazidort-sayi" maxlength="6" value="<?php echo $hakkimizdacikti["hakkimizda_yazidort_sayi"]; ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required />
                                </label>

                                <label class="block text-sm mt-2">
                                    <input type="submit" name="hk-duzenle" class="block w-full mt-1 bg-purple-600 text-sm text-white dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                                </label>
                            </form>
                            <?php echo $not; ?>
                        </div>
                        <div class="min-w-0 p-4 bg-white rounded-lg text-center shadow-xs dark:bg-gray-800">

                            <form enctype="multipart/form-data" method="POST">
                                <label class="block text-sm mt-2">
                                    <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">&RightArrow; Hakkımızda En Üst Görsel Düzenle </h4>
                                    <input type="file" name="hk1-resim" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required />
                                </label>
                                <label class="block text-sm mt-2">
                                    <input type="submit" name="hakkimizda1-resim-dz" class="block w-full mt-1 bg-purple-600 text-sm text-white dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400  focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                                </label>
                            </form>
                            <h4 class="mt-4  text-center font-semibold text-gray-400 dark:text-gray-300">
                                Hakkımızda En Üst Görsel
                                <center> <img src="../images/<?php echo $hkgorsel1 ?>" alt=""></center>
                            </h4>
                            <hr class="mt-4">
                            <form enctype="multipart/form-data" method="POST">
                                <label class="block text-sm mt-2">
                                    <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">&RightArrow; Hakkımızda Orta Kısım Görsel Düzenle </h4>
                                    <input type="file" name="hk2-resim" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required />
                                </label>
                                <label class="block text-sm mt-2">
                                    <input type="submit" name="hakkimizda2-resim-dz" class="block w-full mt-1 bg-purple-600 text-sm text-white dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400  focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                                </label>
                            </form>
                            <h4 class="mt-4  text-center font-semibold text-gray-400 dark:text-gray-300">
                                Hakkımızda Orta Kısım Görsel
                                <center> <img src="../images/<?php echo $hkgorsel2 ?>" alt=""></center>
                            </h4>
                            <hr class="mt-4">
                            <form enctype="multipart/form-data" method="POST">
                                <label class="block text-sm mt-2">
                                    <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">&RightArrow; Hakkımızda Müşteri Yorumları Görsel Düzenle </h4>
                                    <input type="file" name="hk3-resim" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required />
                                </label>
                                <label class="block text-sm mt-2">
                                    <input type="submit" name="hakkimizda3-resim-dz" class="block w-full mt-1 bg-purple-600 text-sm text-white dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400  focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                                </label>
                            </form>
                            <h4 class="mt-4  text-center font-semibold text-gray-400 dark:text-gray-300">
                                Hakkımızda Müşteri Yorumları Görsel
                                <center> <img src="../images/<?php echo $hkgorsel3 ?>" alt=""></center>
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