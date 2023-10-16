<?php
include("login-kontrol.php");
if ($kullanicicek["admin_yetki"] == 0) {
    header("Location:index.php");
}
$not = "";
$not2 = "";
$not3 = "";
// WHATSAPP İLETİŞİM AYARLAR
$sitesorgu = $db->prepare("SELECT * FROM whatsapp_tablo");
$sitesorgu->execute();
$sitecikti = $sitesorgu->fetch(PDO::FETCH_ASSOC);

if (isset($_POST["wp-iletisim"])) {

    $wptel = $_POST["wp-telefon"];
    $wptel = str_replace(" ", "", $wptel);

    $sekle = $db->prepare("UPDATE whatsapp_tablo SET wp_telefon=? WHERE wp_id=3");
    $sekle->execute([$wptel]);
    if ($sekle) {
        header("refresh:2;ek-ayarlar.php");
        $not = "<div class='alert success'>Başarılı Bir şekilde güncellenmiştir. Lütfen Bekleyiniz.</div>";
    } else {
        $not = "<div class='alert alert-success text-center font-weight-bold' role='alert'>Güncellenemedi.</div>";
    }
}


// SOSYAL MEDYA HESAP AYARLAR
$sosyalsorgu = $db->prepare("SELECT * FROM sosyal_medya_tablosu");
$sosyalsorgu->execute();
$sosyalcikti = $sosyalsorgu->fetch(PDO::FETCH_ASSOC);

if (isset($_POST["sosyal-medya"])) {

    $sosyalinstagram = trim($_POST["sosyal-instagram"]);
    $sosyaltwitter = trim($_POST["sosyal-twitter"]);
    $sosyalfacebook = trim($_POST["sosyal-facebook"]);
    $sosyalyoutube = trim($_POST["sosyal-youtube"]);

    $sekle = $db->prepare("UPDATE sosyal_medya_tablosu SET sosyal_instagram=?,sosyal_twitter=?,sosyal_facebook=?,sosyal_youtube=? WHERE sosyal_id=1");
    $sekle->execute([$sosyalinstagram, $sosyaltwitter, $sosyalfacebook, $sosyalyoutube]);
    if ($sekle) {
        header("refresh:2;ek-ayarlar.php");
        $not2 = "<div class='alert success'>Başarılı Bir şekilde güncellenmiştir. Lütfen Bekleyiniz.</div>";
    } else {
        $not2 = "<div class='alert alert-success text-center font-weight-bold' role='alert'>Güncellenemedi.</div>";
    }
}

// KONTROL MENÜ İŞLEMLERİ
$kontrolsorgu = $db->prepare("SELECT * FROM kontrol_tablosu");
$kontrolsorgu->execute();
$kontrolcikti = $kontrolsorgu->fetch(PDO::FETCH_ASSOC);
if (isset($_POST["kontrol-islemler"])) {
    $kmenubuton = $_POST["kontrol-menu-buton"];
    $kinstagram = $_POST["kontrol-instagram"];
    $kwhatsapp = $_POST["kontrol-whatsapp"];
    $kgarson = $_POST["kontrol-garson-cagir"];
    $kmenuslider = $_POST["kontrol-one-cikan"];
    $kmasaayirt = $_POST["kontrol-masa-ayirt"];
    $sekle = $db->prepare("UPDATE kontrol_tablosu SET kontrol_menu_buton=?,kontrol_instagram=?,kontrol_whatsapp=?,kontrol_garson_cagir=?,kontrol_one_cikan=?,kontrol_masa_ayirt=? WHERE kontrol_id=1");
    $sekle->execute([$kmenubuton, $kinstagram, $kwhatsapp, $kgarson, $kmenuslider,$kmasaayirt]);
    if ($sekle) {
        header("refresh:2;ek-ayarlar.php");
        $not3 = "<div class='alert success'>Başarılı Bir şekilde güncellenmiştir. Lütfen Bekleyiniz.</div>";
    } else {
        $not3 = "<div class='alert alert-success text-center font-weight-bold' role='alert'>Güncellenemedi.</div>";
    }
}
?>


<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="tr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ek Ayarlar</title>
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
                    <h2 class="my-6 text-center text-2xl font-semibold text-gray-700 dark:text-gray-200">
                        &RightArrow; Ek Ayarlar &LeftArrow;
                    </h2>
                    <!-- General elements -->
                    <div class="grid gap-6 mb-8 md:grid-cols-2">


                        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <h4 class="mb-4  text-center font-semibold text-gray-600 dark:text-gray-300">
                                Site AKTİF/PASİF Kontrol
                                <p class="text-center mb-4 text-gray-400">Site üzerinden aktif veya pasif edebileceğin bazı kısımlar.</p>
                            </h4>
                            <form method="POST" class="text-center">

                                <div class="mt-6 text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">
                                        <b> Menü/Kategori Hızlı Menü Buton</b> Onay Durumu
                                    </span>
                                    <div class="mt-2">
                                        <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                                            <input type="radio" class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" name="kontrol-menu-buton" value="1" <?php if ($kontrolcikti["kontrol_menu_buton"] == 1) {
                                                                                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                                                                                } ?> />
                                            <span class="ml-2">Aktif</span>
                                        </label>
                                        <label class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400">
                                            <input type="radio" class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" name="kontrol-menu-buton" value="0" <?php if ($kontrolcikti["kontrol_menu_buton"] == 0) {
                                                                                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                                                                                } ?> />
                                            <span class="ml-2">Pasif</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="mt-6 text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">
                                        <b> Kategori/Menü Garson Çağır</b> Onay Durumu
                                    </span>
                                    <div class="mt-2">
                                        <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                                            <input type="radio" class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" name="kontrol-garson-cagir" value="1" <?php if ($kontrolcikti["kontrol_garson_cagir"] == 1) {
                                                                                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                                                                                } ?> />
                                            <span class="ml-2">Aktif</span>
                                        </label>
                                        <label class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400">
                                            <input type="radio" class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" name="kontrol-garson-cagir" value="0" <?php if ($kontrolcikti["kontrol_garson_cagir"] == 0) {
                                                                                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                                                                                } ?> />
                                            <span class="ml-2">Pasif</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="mt-6 text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">
                                        <b> Öne Çıkan Ürünler</b> Onay Durumu
                                    </span>
                                    <div class="mt-2">
                                        <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                                            <input type="radio" class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" name="kontrol-one-cikan" value="1" <?php if ($kontrolcikti["kontrol_one_cikan"] == 1) {
                                                                                                                                                                                                                                                echo "checked";
                                                                                                                                                                                                                                            } ?> />
                                            <span class="ml-2">Aktif</span>
                                        </label>
                                        <label class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400">
                                            <input type="radio" class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" name="kontrol-one-cikan" value="0" <?php if ($kontrolcikti["kontrol_one_cikan"] == 0) {
                                                                                                                                                                                                                                                echo "checked";
                                                                                                                                                                                                                                            } ?> />
                                            <span class="ml-2">Pasif</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="mt-6 text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">
                                        <b> Ana Sayfa Masa Ayırt</b> Onay Durumu
                                    </span>
                                    <div class="mt-2">
                                        <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                                            <input type="radio" class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" name="kontrol-masa-ayirt" value="1" <?php if ($kontrolcikti["kontrol_masa_ayirt"] == 1) {
                                                                                                                                                                                                                                                echo "checked";
                                                                                                                                                                                                                                            } ?> />
                                            <span class="ml-2">Aktif</span>
                                        </label>
                                        <label class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400">
                                            <input type="radio" class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" name="kontrol-masa-ayirt" value="0" <?php if ($kontrolcikti["kontrol_masa_ayirt"] == 0) {
                                                                                                                                                                                                                                                echo "checked";
                                                                                                                                                                                                                                            } ?> />
                                            <span class="ml-2">Pasif</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="mt-6 text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">
                                        <b> İnstagram</b> Onay Durumu
                                    </span>
                                    <div class="mt-2">
                                        <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                                            <input type="radio" class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" name="kontrol-instagram" value="1" <?php if ($kontrolcikti["kontrol_instagram"] == 1) {
                                                                                                                                                                                                                                                echo "checked";
                                                                                                                                                                                                                                            } ?> />
                                            <span class="ml-2">Aktif</span>
                                        </label>
                                        <label class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400">
                                            <input type="radio" class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" name="kontrol-instagram" value="0" <?php if ($kontrolcikti["kontrol_instagram"] == 0) {
                                                                                                                                                                                                                                                echo "checked";
                                                                                                                                                                                                                                            } ?> />
                                            <span class="ml-2">Pasif</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="mt-6 text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">
                                        <b> Whatsapp</b> Onay Durumu
                                    </span>
                                    <div class="mt-2">
                                        <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                                            <input type="radio" class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" name="kontrol-whatsapp" value="1" <?php if ($kontrolcikti["kontrol_whatsapp"] == 1) {
                                                                                                                                                                                                                                                echo "checked";
                                                                                                                                                                                                                                            } ?> />
                                            <span class="ml-2">Aktif</span>
                                        </label>
                                        <label class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400">
                                            <input type="radio" class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" name="kontrol-whatsapp" value="0" <?php if ($kontrolcikti["kontrol_whatsapp"] == 0) {
                                                                                                                                                                                                                                                echo "checked";
                                                                                                                                                                                                                                            } ?> />
                                            <span class="ml-2">Pasif</span>
                                        </label>
                                    </div>
                                </div>
                                <label class="block text-sm mt-2">
                                    <input type="submit" name="kontrol-islemler" class="block w-full mt-1 bg-purple-600 text-sm text-white dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                                </label>
                            </form>
                            <?php echo $not3; ?>
                        </div>
                        <!-- SOSYAL MEDYA FORM -->

                        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <h4 class="mb-4  text-center font-semibold text-gray-600 dark:text-gray-300">
                                Sosyal Medya Hesapları
                                <p class="text-center mb-4 text-gray-400">Müşterilerinizde daha hızlı iletişime geçiniz. <br> Boş bırakırsanız pasif duruma geçer.</p>
                            </h4>
                            <form method="POST">
                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">İnstagram</span>
                                    <div class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                                        <input type="text" placeholder="/ekinden sonrasını yazınız." name="sosyal-instagram" value="<?php echo $sosyalcikti["sosyal_instagram"]; ?>" class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" />
                                        <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </label>

                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Facebook</span>
                                    <div class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                                        <input type="text" placeholder="/ekinden sonrasını yazınız." name="sosyal-facebook" value="<?php echo $sosyalcikti["sosyal_facebook"]; ?>" class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" />
                                        <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </label>

                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Twitter</span>
                                    <div class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                                        <input type="text" placeholder="/ekinden sonrasını yazınız." name="sosyal-twitter" value="<?php echo $sosyalcikti["sosyal_twitter"]; ?>" class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" />
                                        <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </label>

                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Youtube</span>
                                    <div class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                                        <input type="text"placeholder="/ekinden sonrasını yazınız." name="sosyal-youtube" value="<?php echo $sosyalcikti["sosyal_youtube"]; ?>" class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" />
                                        <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </label>

                                <label class="block text-sm mt-2">
                                    <input type="submit" name="sosyal-medya" class="block w-full mt-1 bg-purple-600 text-sm text-white dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                                </label>
                            </form>
                            <?php echo $not2; ?>
                        </div>




                        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <h4 class="mb-4  text-center font-semibold text-gray-600 dark:text-gray-300">
                                Whatsapp Üzerinden İletişim
                                <p class="text-center mb-4 text-gray-400">Müşterilerinizde daha hızlı iletişime geçiniz.</p>
                            </h4>
                            <form method="POST">
                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Telefon Numarası (<b>05554442211</b> şeklinde giriniz.) </span>
                                    <!-- focus-within sets the color for the icon when input is focused -->
                                    <div class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">

                                        <input type="tel" pattern="[0-9]{11}" name="wp-telefon" maxlength="11" value="<?php echo $sitecikti["wp_telefon"]; ?>" class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" />
                                        <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </label>

                                <label class="block text-sm mt-2">
                                    <input type="submit" name="wp-iletisim" class="block w-full mt-1 bg-purple-600 text-sm text-white dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
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