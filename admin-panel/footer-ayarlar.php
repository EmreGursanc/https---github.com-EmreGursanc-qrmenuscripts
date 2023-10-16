<?php
include("login-kontrol.php");
if ($kullanicicek["admin_yetki"] == 0) {
    header("Location:index.php");
}
$not = "";
$not2 = "";
$footersorgu = $db->prepare("SELECT * FROM footer_tablo");
$footersorgu->execute();
$footercek = $footersorgu->fetch(PDO::FETCH_ASSOC);

if (isset($_POST["footer-bilgi-dz"])) {

    $faciklama = $_POST["footer-aciklama"];
    $fpazartesi = $_POST["footer-pazartesi"];
    $fsali = $_POST["footer-sali"];
    $fcarsamba = $_POST["footer-carsamba"];
    $fpersembe = $_POST["footer-persembe"];
    $fcuma = $_POST["footer-cuma"];
    $fcumartesi = $_POST["footer-cumartesi"];
    $fpazar = $_POST["footer-pazar"];

    $sekle = $db->prepare("UPDATE footer_tablo SET footer_aciklama=?,f_pazartesi=?,f_sali=?,f_carsamba=?,f_persembe=?,f_cuma=?,f_cumartesi=?,f_pazar=? WHERE footer_id=1");
    $sekle->execute([$faciklama, $fpazartesi, $fsali, $fcarsamba, $fpersembe, $fcuma, $fcumartesi, $fpazar]);
    if ($sekle) {
        header("refresh:2;footer-ayarlar.php");
        $not = "<div class='alert  success text-center font-weight-bold' role='alert'>Footer Bilgileri Güncellendi.</div>";
    } else {
        $not = "<div class='alert alert-success text-center font-weight-bold' role='alert'>Footer Bilgileri Güncellenemedi.</div>";
    }
}




?>


<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="tr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Footer Ayarları</title>
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
                        &RightArrow; Footer Ayarları
                    </h2>
                    <!-- General elements -->
                    <div class="grid gap-6 mb-8 md:grid-cols-2">
                        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <h4 class="mb-4  text-center font-semibold text-gray-600 dark:text-gray-300">
                                Footer Bilgileri Güncelle
                            </h4>
                            <form enctype="multipart/form-data" method="POST">
                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Açıklama </span>
                                    <textarea name="footer-aciklama" maxlength="200" rows="4" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"><?php echo $footercek["footer_aciklama"]; ?></textarea>
                                </label>

                                <label class="block text-sm mt-2">
                                    <span class="text-gray-700 dark:text-gray-400">Pazartesi </span>
                                    <input type="text" name="footer-pazartesi" value="<?php echo $footercek["f_pazartesi"];  ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required />
                                </label>

                                <label class="block text-sm mt-2">
                                    <span class="text-gray-700 dark:text-gray-400">Salı </span>
                                    <input type="text" name="footer-sali" value="<?php echo $footercek["f_sali"];  ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required />
                                </label>

                                <label class="block text-sm mt-2">
                                    <span class="text-gray-700 dark:text-gray-400">Çarşamba </span>
                                    <input type="text" name="footer-carsamba" value="<?php echo $footercek["f_carsamba"]; ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required />
                                </label>

                                <label class="block text-sm mt-2">
                                    <span class="text-gray-700 dark:text-gray-400">Perşembe </span>
                                    <input type="text" name="footer-persembe" value="<?php echo $footercek["f_persembe"];  ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required />
                                </label>
                                <label class="block text-sm mt-2">
                                    <span class="text-gray-700 dark:text-gray-400">Cuma</span>
                                    <input type="text" name="footer-cuma" value="<?php echo $footercek["f_cuma"];  ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required />
                                </label>
                                <label class="block text-sm mt-2">
                                    <span class="text-gray-700 dark:text-gray-400">Cumartesi </span>
                                    <input type="text" name="footer-cumartesi" value="<?php echo $footercek["f_cumartesi"]; ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required />
                                </label>
                                <label class="block text-sm mt-2">
                                    <span class="text-gray-700 dark:text-gray-400">Pazar </span>
                                    <input type="text" name="footer-pazar" value="<?php echo $footercek["f_pazar"];  ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required />
                                </label>
                                <label class="block text-sm mt-2">
                                    <input type="submit" name="footer-bilgi-dz" class="block w-full mt-1 bg-purple-600 text-sm text-white dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
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