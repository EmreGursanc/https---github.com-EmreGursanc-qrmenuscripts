<?php
include("login-kontrol.php");
$not = "";
$not2 = "";
$id = $_GET["id"];
$sorgu = $db->prepare("SELECT * FROM kategori_tablosu WHERE kategori_id=:id");
$sorgu->execute(array(":id" => $id));
$row = $sorgu->fetch(PDO::FETCH_ASSOC);
$kresim = $row["kategori_resim"];


// Başlık Düzenleme
if (isset($_POST["ad-duzenle"])) {
    $kad = $_POST["kategori-ad"];
    $guncelle = $db->prepare("UPDATE kategori_tablosu SET kategori_ad=? WHERE kategori_id=?");
    $guncelle->execute([$kad, $id]);
    if ($guncelle) {
        header("Location:kategori-ayarlari.php");
    }
}

// Resim Düzenleme
if (isset($_POST["resim-duzenle"])) {
    unlink("../images/kategori/$kresim");
    $yol = '../images/kategori/';
    $tmp_name = $_FILES['kategori-resim']['tmp_name'];
    $name = $_FILES['kategori-resim']['name'];
    $isim = mt_rand();
    $ext = pathinfo($_FILES['kategori-resim']['name'], PATHINFO_EXTENSION);
    $yeniad = $isim . "." . $ext;
    $tip = $_FILES['kategori-resim']['type'];
    if (strlen($name) == 0) {
        $not2 = "<div class='alert alert-info text-center font-weight-bold' role='alert'>Bir resim seçiniz</div>";
    }
    if ($tip != 'image/jpeg' && $tip != 'image/png' && $tip != 'image/jpg') {
        $not2 = "<div class='alert alert-danger text-center font-weight-bold' role='alert'>Yalnızca jpg,Jpeg ve png formatında olabilir.</div>";
    }
    move_uploaded_file($tmp_name, "$yol/$yeniad");

    $guncelle = $db->prepare("UPDATE kategori_tablosu SET kategori_resim=? WHERE kategori_id=?");
    $guncelle->execute([$yeniad, $id]);
    if ($guncelle) {
        header("Location:kategori-ayarlari.php");
    }
}

?>


<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="tr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ürün Düzenle</title>
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
                        &RightArrow; Ürün Düzenle
                    </h2>

                    <div class="grid gap-6 mb-8 md:grid-cols-2">
                        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                                Kategori Adını Düzenle
                            </h4>
                            <form method="POST">
                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Kategori Ad </span>
                                    <input type="text" name="kategori-ad" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="<?php echo $row['kategori_ad']; ?>" />
                                </label>
                                <label class="block text-sm mt-2">
                                    <input type="submit" name="ad-duzenle" class="block w-full mt-1 bg-purple-600 text-sm text-white dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                                </label>
                            </form>
                            <?php echo $not; ?>
                        </div>
                        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                                Kategori Resmini Düzenle
                            </h4>
                            <form method="POST" enctype="multipart/form-data">
                                <label class="block text-sm mt-2">
                                    <span class="text-gray-700 dark:text-gray-400">Kategori Resim </span>
                                    <input type="file" name="kategori-resim" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                                </label>
                                <label class="block text-sm mt-2">
                                    <input type="submit" name="resim-duzenle" class="block w-full mt-1 bg-purple-600 text-sm text-white dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                                </label>
                            </form>
                            <?php echo $not2; ?>
                            <img src="../images/kategori/<?php echo $kresim; ?>" class="mt-4 rounded-md w-full object-cover" alt="">
                        </div>
                    </div>
                </div>


            </main>
        </div>
    </div>
</body>

</html>