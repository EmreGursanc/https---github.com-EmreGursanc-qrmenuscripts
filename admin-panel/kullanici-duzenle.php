<?php
include("login-kontrol.php");
if ($kullanicicek["admin_yetki"] == 0) {
    header("Location:index.php");
}
$not = "";
$not2 = "";
$id = $_GET["id"];
$sorgu = $db->prepare("SELECT * FROM admin_tablo WHERE admin_id=:id");
$sorgu->execute(array(":id" => $id));
$row = $sorgu->fetch(PDO::FETCH_ASSOC);



// Kullanıcı Düzenleme
if (isset($_POST["ad-duzenle"])) {
    $kad = htmlspecialchars($_POST["kullanici-ad"]);
    $ktakmad = htmlspecialchars($_POST["kullanici-takmad"]);
    $kmail = htmlspecialchars($_POST["kullanici-mail"]);
    $guncelle = $db->prepare("UPDATE admin_tablo SET admin_ad=?,admin_kad=?,admin_email=? WHERE admin_id=?");
    $guncelle->execute([$kad, $ktakmad, $kmail, $id]);
    if ($guncelle) {
        header("Location:kullanici-ayarlar.php");
    }
}

if (isset($_POST["k-sifre"])) {
    $ksifre = md5($_POST["kullanici-sifre"]);
    $guncelle = $db->prepare("UPDATE admin_tablo SET admin_sifre=? WHERE admin_id=?");
    $guncelle->execute([$ksifre, $id]);
    if ($guncelle) {
        header("Location:kullanici-ayarlar.php");
    }
}

?>


<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="tr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kullanıcı Düzenle</title>
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
                        &RightArrow; Kullanıcı Düzenle
                    </h2>

                    <div class="grid gap-6 mb-8 md:grid-cols-2">
                        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                                Kullanıcı Bilgilerini Düzenle
                            </h4>
                            <form method="POST">
                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Kullanıcı Ad </span>
                                    <input type="text" name="kullanici-ad" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="<?php echo $row['admin_ad']; ?>" />
                                </label>
                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Kullanıcı Takma Ad </span>
                                    <input type="text" name="kullanici-takmad" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="<?php echo $row['admin_kad']; ?>" />
                                </label>
                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Kullanıcı E Mail </span>
                                    <input type="email" name="kullanici-mail" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="<?php echo $row['admin_email']; ?>" />
                                </label>
                                <label class="block text-sm mt-2">
                                    <input type="submit" name="ad-duzenle" class="block w-full mt-1 bg-purple-600 text-sm text-white dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                                </label>
                            </form>
                            <?php echo $not; ?>
                        </div>
                        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                                Kullanıcı Şifre Düzenle
                            </h4>
                            <form method="POST">
                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Kullanıcı Şifre</span>
                                    <input type="password" name="kullanici-sifre" maxlength="30" placeholder="***" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                                </label>
                                <label class="block text-sm mt-2">
                                    <input type="submit" name="k-sifre" class="block w-full mt-1 bg-purple-600 text-sm text-white dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                                </label>
                            </form>
                            <?php echo $not2; ?>
                        </div>
                    </div>

                </div>


            </main>
        </div>
    </div>
</body>

</html>