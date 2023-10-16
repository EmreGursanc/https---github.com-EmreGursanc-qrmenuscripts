<?php
include("login-kontrol.php");
$not = "";
setlocale(LC_ALL, 'turkish');
?>


<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="tr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Masa Ayırtan Müşteriler</title>
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
          <h2 class="my-6 text-2xl font-semibold  text-gray-700 dark:text-gray-400">
            &RightArrow; Masa Ayırtan Müşteriler
          </h2>

          <div class="grid gap-6 mb-8">
            <div class="min-w-0 p-4 rounded-lg shadow-xs">
              <h4 class="mb-4 font-semibold">
                Masa Ayırtan Müşteriler
              </h4>
              <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                  <table class="w-full whitespace-no-wrap text-center">
                    <thead>
                      <tr class="text-xs font-semibold text-center tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Müşteri Ad</th>
                        <th class="px-4 py-3">E Mail Adresi</th>
                        <th class="px-4 py-3">Telefon</th>
                        <th class="px-4 py-3">Tarih</th>
                        <th class="px-4 py-3">Saat</th>
                        <th class="px-4 py-3">Misafir</th>
                        <th class="px-4 py-3">Düzenle/Sil</th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                      <?php

                      $sorgu = "SELECT * FROM masa_ayir_tablosu ORDER BY masa_id ASC";
                      $sonuc = $db->query($sorgu, PDO::FETCH_ASSOC);
                      $ksira = 0;
                      foreach ($sonuc as $satir) {
                        $ksira += 1;
                        $mid = $satir["masa_id"];
                        $misim = $satir["masa_isim"];
                        $memail = $satir["masa_email"];
                        $mtelefon = $satir["masa_telefon"];
                        $msaat = $satir["masa_saat"];
                        $mtarih = $satir["masa_tarih"];
                        $mmisafir = $satir["masa_misafir"];
                        echo "
                                                <tr class='text-gray-700 dark:text-gray-4'>

                                                <td class='px-4 py-3 text-xs'>
                                                  <span class='px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100'>
                                                    $ksira
                                                  </span>
                                                </td>
                                                <td class='px-4 py-3 text-sm dark:text-white'>$misim</td>
                                                <td class='px-4 py-3 text-sm dark:text-white'>$memail</td>
                                                <td class='px-4 py-3 text-sm dark:text-white'> $mtelefon </td>
                                                <td class='px-4 py-3 text-sm dark:text-white'>" . iconv('latin5', 'utf-8', strftime(' %d %B %Y', strtotime($mtarih))) . "</td>
                                                <td class='px-4 py-3 text-sm dark:text-white'> $msaat </td>
                                                <td class='px-4 py-3 text-sm dark:text-white'> $mmisafir </td>
                                                <td class='px-4 py-3'>
                                                  <div class='flex items-center space-x-4 text-sm'>
                                                    <form method='POST' action='masa-sil.php'>
                                                    <input type='hidden' value='$mid' name='masa_id'>
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