<?php
include("login-kontrol.php");
if (!empty($_POST["musteri_yorum_id"]) && is_numeric($_POST["musteri_yorum_id"])) {
    $id = $_POST["musteri_yorum_id"];
    $kresim = $_POST["yorum_musterigorsel"];
    try {
        $sorgu = "DELETE FROM musteri_yorum_tablosu WHERE musteri_yorum_id=:id";
        $sonuc = $db->prepare($sorgu);
        $sonuc->bindParam(":id", $id, PDO::PARAM_INT);
        $sonuc->execute();
        unlink("../images/musteriyorum/$kresim");
        $not = "Başarılı Bir şekilde silinmiştir. 2 Saniye içerisinde yönlendirileceksiniz. Lütfen Bekleyiniz.";
        header("refresh:2;musteri-yorum-listesi.php");
    } catch (PDOException $ex) {
        $hata = $ex->getMessage();
        $not = "Hata ile karşılaşıldı. Sayfa listesine geri dönmek için<a href='urun-listesi.php' class='alert-link'> tıklayınız </a>veya 2 sayiye içerisinde yönlendirileceksiniz.<br>Hata:$hata ";
        header("refresh:2;musteri-yorum-listesi.php");
    }
} else {
    $not = "Silinecek sayfa bilgisine ulaşılamadı. Sayfa listesine geri dönmek için<a href='urun-listesi.php' class='alert-link'> tıklayınız </a>veya 5 sayiye içerisinde yönlendirileceksiniz.";
    header("refresh:2;musteri-yorum-listesi.php");
}
?>

<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="tr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Müşteri Yorum Sil</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/tailwind.output.css" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="./assets/js/init-alpine.js"></script>
</head>

<body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen}">
        <div class="flex flex-col flex-1">
            <?php include("header.php"); ?>
            <main class="h-full pb-16 overflow-y-auto">
                <div class="container px-6 mx-auto grid ">
                    <div class="px-4 py-3 mb-8 mt-6 text-2xl bg-white text-center font-bold rounded-lg shadow-md dark:bg-gray-800">
                        <p class="text-2xl text-gray-600 dark:text-gray-400">
                            <?php echo $not; ?>

                        </p>
                    </div>

                </div>
            </main>
        </div>
    </div>
</body>

</html>