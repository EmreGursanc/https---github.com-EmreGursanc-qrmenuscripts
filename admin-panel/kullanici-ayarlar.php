<?php
include("login-kontrol.php");
if ($kullanicicek["admin_yetki"] == 0) {
    header("Location:index.php");
}
$not = "";
$not2 = "";
if ($_POST) {
    $kad = htmlspecialchars($_POST['k-ad']);
    $ktakmaad = htmlspecialchars($_POST['k-takmad']);
    $kmail = htmlspecialchars($_POST['k-email']);
    $ksifre = md5($_POST['k-sifre']);
    $ksifretekrar = md5($_POST['k-sifre-tekrar']);
    if ($ksifre == $ksifretekrar) {
        $ekle = $db->prepare("INSERT INTO admin_tablo SET admin_ad=?, admin_kad=?,admin_email=?,admin_sifre=?,admin_yetki=? ");
        $ekle->execute([$kad, $ktakmaad, $kmail, $ksifre, 0]);
        if ($ekle) {
            $not = "<div class='alert success' role='alert'>Kullanıcı Başarıyla Eklendi.</div>";
            header("refresh:1;kullanici-ayarlar.php");
        }else{
            $not = "<div class='alert alert-danger text-center font-weight-bold' role='alert'>Kullanıcı Eklenemedi.</div>";
        }
    } else {
        $not = "<div class='alert alert-danger text-center font-weight-bold' role='alert'>Şifreler Birbirine Uyuşmuyor. Lütfen Tekrar Deneyiniz</div>";
        header("refresh:1;kullanici-ayarlar.php");
    }
}
if (isset($_POST['kullanici-listesi'])) {
    $ksira = $_POST["kategori-sira"];
    $kkid = $_POST["kategori-id"];
    $siraguncelle = $db->prepare("UPDATE kategori_tablosu SET kategori_sira=?WHERE kategori_id=?");
    $siraguncelle->execute([$ksira, $kkid]);
    if ($siraguncelle) {
        header("Location:kategori-ayarlari.php");
    }
}
?>


<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="tr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kullanıcı Ayarları</title>
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
                    <h2 class="my-6 text-2xl font-semibold text-center  text-gray-700 dark:text-gray-200">
                        &RightArrow; Kullanıcı Ayarları &LeftArrow;
                    </h2>

                    <div class="grid gap-6 mb-8 md:grid-cols-2">
                        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                                Yeni Kullanıcı Ekle
                            </h4>
                            <form enctype="multipart/form-data" method="POST">
                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Kullanıcı Adı </span>
                                    <input type="text" name="k-ad" maxlength="30" placeholder="Kullanıcı Adı" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required />
                                </label>
                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Kullanıcı Takma Ad </span>
                                    <input type="text" name="k-takmad" maxlength="30" placeholder="Kullanıcı Takma Adı. Giriş yaparken kullanacağı ad." class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                                </label>
                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Kullanıcı E Mail Adresi </span>
                                    <input type="email" name="k-email" maxlength="100" placeholder="Mail Adresi" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                                </label>
                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Kullanıcı Şifre </span>
                                    <input type="password" name="k-sifre" maxlength="15" placeholder="Şifre" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                                </label>
                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Kullanıcı Şifre Tekrar </span>
                                    <input type="password" name="k-sifre-tekrar" maxlength="15" placeholder="Şifre Tekrar" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                                </label>
                                <label class="block text-sm mt-2">
                                    <input type="submit" class="block w-full mt-1 bg-purple-600 text-sm text-white dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                                </label>
                            </form>
                            <?php echo $not; ?>
                        </div>
                        <div class="min-w-0 p-4 text-white bg-purple-600 rounded-lg shadow-xs">
                            <h4 class="mb-4 font-semibold">
                                Kullanıcı Listesi
                            </h4>
                            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                                <div class="w-full overflow-x-auto">
                                    <table class="w-full whitespace-no-wrap text-center">
                                        <thead>
                                            <tr class="text-xs font-semibold text-center tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                                <th class="px-4 py-3">No</th>
                                                <th class="px-4 py-3">Ad</th>
                                                <th class="px-4 py-3">Takma Ad</th>
                                                <th class="px-4 py-3">Mail</th>
                                                <th class="px-4 py-3">Düzenle/Sil</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                            <?php

                                            $sorgu = "SELECT * FROM admin_tablo  WHERE admin_yetki=0 ORDER BY admin_id ASC";
                                            $sonuc = $db->query($sorgu, PDO::FETCH_ASSOC);
                                            $ksira = 0;
                                            foreach ($sonuc as $satir) {
                                                $aid = $satir["admin_id"];
                                                $ksira += 1;
                                                $aad = $satir["admin_ad"];
                                                $takmad = $satir["admin_kad"];
                                                $aemail = $satir["admin_email"];
                                                echo "
                                                <tr class='text-gray-700 dark:text-gray-4'>
                                                <td class='px-4 py-3 text-xs'>
                                                  <span class='px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100'>
                                                    $ksira
                                                  </span>
                                                </td>
                                                <td class='px-4 py-3 text-sm dark:text-white'>
                                                 $aad
                                                </td>
                                                <td class='px-4 py-3 text-sm dark:text-white'>
                                                $takmad
                                               </td>
                                                <td class='px-4 py-3 text-sm dark:text-white'>
                                                $aemail
                                               </td>
                                                <td class='px-4 py-3'>
                                                  <div class='flex items-center space-x-4 text-sm'>
                                                  <a href='kullanici-duzenle.php?id=$aid''>
                                                    <button class='flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray' aria-label='Edit'>
                                                      <svg class='w-5 h-5' aria-hidden='true' fill='currentColor' viewBox='0 0 20 20'>
                                                        <path d='M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z'>
                                                        </path>
                                                      </svg>
                                                    </button>
                                                        </a>
                                                    <form method='POST' action='kullanici-sil.php'>
                                                    <input type='hidden' value='$aid' name='admin_id'>
                                                    <button class='flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray' aria-label='Delete'>
                                                      <svg class='w-5 h-5' aria-hidden='true' fill='currentColor' viewBox='0 0 20 20'>
                                                        <path fill-rule='evenodd' d='M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z' clip-rule='evenodd'></path>
                                                      </svg>
                                                    </button>
                                                    </form>
                                                  </div>
                                                </td>
                                              </tr>
                                                ";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </main>
        </div>
    </div>
</body>

</html>