<?php
include("admin-panel/ayarlar.php");
$sayfa = "iletişim";
$sitesorgu = $db->prepare("SELECT * FROM site_bilgi_tablosu");
$sitesorgu->execute();
$sbilgicikti = $sitesorgu->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <title><?php echo $sbilgicikti["site_baslik"]; ?> | İletişim</title>
  <link rel="icon" href="images/<?php echo $sbilgicikti["site_favicon"]; ?>" type="image/x-icon" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="<?php echo $sbilgicikti["site_baslik"]; ?> İletişim Sayfasına hoşgeldiniz. Bizimle iletişime geçip bilgi alabilirsiniz.">

  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="css/animate.css">

  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">

  <link rel="stylesheet" href="css/flaticon.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <?php include("header.php"); ?>

  <section class="hero-wrap hero-wrap-2" style="background-image: url('images/<?php echo $sbilgicikti["site_iletisim_gorsel"]; ?>');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text align-items-end justify-content-center">
        <div class="col-md-9 ftco-animate text-center mb-5">
          <h1 class="mb-2 bread">İletişim</h1>
          <p class="breadcrumbs"><span class="mr-2"><a href="index">Ana Sayfa <i class="fa fa-chevron-right"></i></a></span> <span>İletişim <i class="fa fa-chevron-right"></i></span></p>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section contact-section bg-light">
    <div class="container">
      <div class="row d-flex contact-info">
        <div class="col-md-12">
          <h2 class="h4 font-weight-bold">İletişim Bilgileri</h2>
        </div>
        <div class="w-100"></div>
        <div class="col-md-4 d-flex">
          <div class="dbox">
            <p><span>Adres :</span> <br> <?php echo $sbilgicikti["site_adres"]; ?> </p>
          </div>
        </div>
        <div class="col-md-4 d-flex">
          <div class="dbox">
            <p><span>Telefon :</span> <br> <a href="tel:<?php echo str_replace(" ", "", $sbilgicikti["site_telefon"]); ?>"><?php echo $sbilgicikti["site_telefon"]; ?></a></p>
          </div>
        </div>
        <div class="col-md-4 d-flex">
          <div class="dbox">
            <p><span>E-Mail :</span> <br> <a href="mailto:<?php echo $sbilgicikti["site_email"]; ?>"><?php echo $sbilgicikti["site_email"]; ?></a></p>
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
  <script src="js/scrollax.min.js"></script>
  <script src="js/main.js"></script>

</body>

</html>