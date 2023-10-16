<?php
include("admin-panel/ayarlar.php");
$sayfa = "hakkimizda";
$hakkimizdasorgu = $db->prepare("SELECT * FROM hakkimizda_tablosu WHERE hakkimizda_id=1");
$hakkimizdasorgu->execute();
$hakkimizdacikti = $hakkimizdasorgu->fetch(PDO::FETCH_ASSOC);
// Site Bilgi Çekme
$sbilgisorgu = $db->prepare("SELECT * FROM site_bilgi_tablosu");
$sbilgisorgu->execute();
$sbilgicikti = $sbilgisorgu->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="tr">

<head>
  <title><?php echo $sbilgicikti["site_baslik"] . " | " . $hakkimizdacikti["hakkimizda_baslik"]; ?></title>
  <link rel="icon" href="images/<?php echo $sbilgicikti["site_favicon"]; ?>" type="image/x-icon" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="<?php echo $hakkimizdacikti["hakkimizda_aciklama"]; ?>">

  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="css/animate.css">

  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">

  <link rel="stylesheet" href="css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="css/jquery.timepicker.css">


  <link rel="stylesheet" href="css/flaticon.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/menu.css">
</head>

<body>

  <?php include("header.php"); ?>

  <section class="hero-wrap hero-wrap-2" style="background-image: url('images/<?= $hakkimizdacikti["hakkimizda_gorsel_1"]; ?>');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text align-items-end justify-content-center">
        <div class="col-md-9 ftco-animate text-center mb-5">
          <h1 class="mb-2 bread">Hakkımızda</h1>
          <p class="breadcrumbs"><span class="mr-2"><a href="index">Ana Sayfa <i class="fa fa-chevron-right"></i></a></span> <span>Hakkımızda <i class="fa fa-chevron-right"></i></span></p>
        </div>
      </div>
    </div>
  </section>


  <section class="ftco-section ">
    <div class="container">
      <div class="row d-flex">
        <div class="col-md-12 ftco-animate makereservation p-4 p-md-5">
          <div class="heading-section ftco-animate mb-5 text-center">
            <span class="subheading mb-5"><?php echo $hakkimizdacikti["hakkimizda_slogan"]; ?></span>
            <p>
              <?php echo $hakkimizdacikti["hakkimizda_icerik"]; ?>
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section ftco-counter img" id="section-counter" style="background-image: url(images/<?= $hakkimizdacikti["hakkimizda_gorsel_2"]; ?>);" data-stellar-background-ratio="0.5">
    <div class="container">
      <div class="row d-md-flex align-items-center justify-content-center">
        <div class="col-lg-10">
          <div class="row d-md-flex align-items-center">
            <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
              <div class="block-18">
                <div class="text">
                  <strong class="number" data-number="<?php echo $hakkimizdacikti["hakkimizda_yazibir_sayi"]; ?>">0</strong>
                  <span><?php echo $hakkimizdacikti["hakkimizda_yazibir"]; ?></span>
                </div>
              </div>
            </div>
            <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
              <div class="block-18">
                <div class="text">
                  <strong class="number" data-number="<?php echo $hakkimizdacikti["hakkimizda_yaziiki_sayi"]; ?>">0</strong>
                  <span><?php echo $hakkimizdacikti["hakkimizda_yaziiki"]; ?></span>
                </div>
              </div>
            </div>
            <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
              <div class="block-18">
                <div class="text">
                  <strong class="number" data-number="<?php echo $hakkimizdacikti["hakkimizda_yaziuc_sayi"]; ?>">0</strong>
                  <span><?php echo $hakkimizdacikti["hakkimizda_yaziuc"]; ?></span>
                </div>
              </div>
            </div>
            <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
              <div class="block-18">
                <div class="text">
                  <strong class="number" data-number="<?php echo $hakkimizdacikti["hakkimizda_yazidort_sayi"]; ?>">0</strong>
                  <span><?php echo $hakkimizdacikti["hakkimizda_yazidort"]; ?></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section ftco-no-pt ftco-no-pb ftco-intro bg-light">
    <div class="container py-5">
      <div class="row py-2">
        <div class="col-md-12 text-center">
          <h2 class="text-dark">Online Menümüze Göz atarak hızlı sipariş ver</h2>
          <a href="menu" class="btn btn-black btn-outline-black">Online Menü</a>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section testimony-section" style="background-image: url(images/<?= $hakkimizdacikti["hakkimizda_gorsel_3"]; ?>);">
    <div class="overlay"></div>
    <div class="container">
      <div class="row justify-content-center mb-3 pb-2">
        <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
          <span class="subheading">Müşteri Yorumları</span>
          <h2 class="mb-4">Mutlu Müşteri Yorumları</h2>
        </div>
      </div>
      <div class="row ftco-animate justify-content-center">
        <div class="col-md-7">
          <div class="carousel-testimony owl-carousel ftco-owl">
            <?php
            $mysorgu = "SELECT * FROM musteri_yorum_tablosu ORDER BY musteri_yorum_id ASC";
            $mysonuc = $db->query($mysorgu, PDO::FETCH_ASSOC);
            foreach ($mysonuc as $mysatir) {
              $ymad = $mysatir["yorum_musteriad"];
              $ymaciklama = stripslashes($mysatir["yorum_aciklama"]);
              $ymunvan = $mysatir["yorum_musteriunvan"];
              $ymgorsel = $mysatir["yorum_musterigorsel"];
              echo " 
              <div class='item'>
              <div class='testimony-wrap text-center'>
                <div class='text p-3'>
                  <p class='mb-4'> $ymaciklama</p>
                  <div class='user-img mb-4' style='background-image: url(images/musteriyorum/$ymgorsel)'>
                    <span class='quote d-flex align-items-center justify-content-center'>
                      <i class='fa fa-quote-left'></i>
                    </span>
                  </div>
                  <p class='name'>$ymad</p>
                  <span class='position'>$ymunvan</span>
                </div>
              </div>
            </div>
            ";
            }
            ?>



          </div>
        </div>
      </div>
    </div>
  </section>

  <?php include("footer.php"); ?>


  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
      <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
      <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
    </svg></div>
  <a id="buttontop"></a>
  <a id="menubuton" href="menu"><i class="fa fa-cutlery" aria-hidden="true"></i></a>

  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="js/main.js"></script>
  <script src="js/menu.js"></script>

</body>

</html>