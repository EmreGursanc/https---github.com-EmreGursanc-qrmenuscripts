<?php
include("admin-panel/ayarlar.php");
$sayfa = "kategori";

// Site Bilgi Çekme
$sbilgisorgu = $db->prepare("SELECT * FROM site_bilgi_tablosu");
$sbilgisorgu->execute();
$sbilgicikti = $sbilgisorgu->fetch(PDO::FETCH_ASSOC);


// Kontrol İşlemleri Çekme
$kontrolsorgu = $db->prepare("SELECT * FROM kontrol_tablosu");
$kontrolsorgu->execute();
$kontrolcikti = $kontrolsorgu->fetch(PDO::FETCH_ASSOC);

$asorgu = "SELECT * FROM urun_tablosu WHERE one_cikar=1";
$asonuc = $db->query($asorgu, PDO::FETCH_ASSOC);
$ocikarveri = $asonuc->rowCount();

?>

<!DOCTYPE html>
<html lang="tr">

<head>
	<title> <?php echo $sbilgicikti["site_baslik"]; ?> | Menü</title>
	<link rel="icon" href="images/<?php echo $sbilgicikti["site_favicon"]; ?>" type="image/x-icon" />
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="<?php echo $sbilgicikti["site_baslik"]; ?> Menü Sayfasına hoşgeldiniz. Ürünlerimizi inceleyip sipariş verebilirsiniz.">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<link rel="stylesheet" href="css/magnific-popup.css">
	<link rel="stylesheet" href="css/flaticon.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/menu.css">
	<link rel="stylesheet" href="css/sweetalert2.min.css">
	<script src="js/sweetalert2.min.js"></script>
</head>

<body>

	<?php
	if (isset($_POST["garson-cagir"])) {
		$masano = strip_tags($_POST["masa-no"]);
		$kontrol = $db->prepare("SELECT * FROM garson_tablosu WHERE garson_masa_no=?");
		$kontrol->execute(array($masano));
		if ($kontrol->rowCount()) {
			echo '<script>Swal.fire("Masaya Garson Çağrılmış Gözüküyor.", "Lütfen sesli olarak garsonla iletişime geçiniz. ", "error"); </script>';
			header("refresh:3;./kategori");
		} else {
			$gekle = $db->prepare("INSERT INTO garson_tablosu SET garson_masa_no=?");
			$gekle->execute([$masano]);
			if ($gekle) {
				echo '<script>Swal.fire("Garson Çağırma Talebiniz alındı.", "Hemen Geliyoruz. ", "success"); </script>';
				header("refresh:2;./kategori");
			} else {
				echo '<script>Swal.fire("Masa Çağırma İsteğiniz Alınamadı.", "En Kısa sürede düzelteceğiz. ", "error"); </script>';
				header("refresh:2;./kategori");
			}
		}
	}
	include("header.php"); ?>

	<!-- END nav -->
	<?php if ($kontrolcikti["kontrol_menu_buton"] == 1) { ?>

		<div id="circularMenu1" class="circular-menu circular-menu-left">
			<a class="floating-btn" onclick="document.getElementById('circularMenu1').classList.toggle('active');">
				<i class="fa fa-bars"></i>
			</a>
			<menu class="items-wrapper">

			<?php

			$wpsorgu = $db->prepare("SELECT * FROM whatsapp_tablo");
			$wpsorgu->execute();
			$wpcikti = $wpsorgu->fetch(PDO::FETCH_ASSOC);
			if ($kontrolcikti["kontrol_garson_cagir"] == 1) {
				echo "<a href='#' class='menu-item fa fa-bell-o' data-toggle='modal' data-target='#exampleModalCenter'></a>";
			}

			if ($kontrolcikti["kontrol_whatsapp"] == 1) {
				$tel = str_replace(" ", "", $wpcikti["wp_telefon"]);
				echo "<a href='https://wa.me/+90$tel' class='menu-item fa fa-whatsapp'></a>";
			}


			if ($kontrolcikti["kontrol_instagram"] == 1) {
				$insta = $soysalcikti["sosyal_instagram"];
				echo "<a href='$insta' class='menu-item fa fa-instagram'></a>";
			}
			echo "<a href='iletisim' class='menu-item fa fa-comment'></a>";
			echo "</menu>
			</div>";
		}
			?>

			<!-- Modal -->

			<div class="modal fade bd-example-modal-sm" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleMo2dalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">Garson Çağır</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>

						<div class="modal-body">
							<form action="#" method="POST">
								<div class="form-group">
									<input type="number" name="masa-no" class="form-control" placeholder="Lütfen Masa No giriniz." required>
								</div>
								<div class="form-group">
									<input type="submit" style="width:100%;" name="garson-cagir" class="btn btn-dark py-3 px-5">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>





			<section class="hero-wrap hero-wrap-2" style="background-image: url('images/<?php echo $sbilgicikti["site_kategori_gorsel"]; ?>');" data-stellar-background-ratio="0.5">
				<div class="overlay"></div>
				<div class="container">
					<div class="row no-gutters slider-text align-items-end justify-content-center">
						<div class="col-md-9 ftco-animate text-center mb-5">
							<h1 class="mb-2 bread">Menü</h1>
							<p class="breadcrumbs"><span class="mr-2"><a href="index">Ana Sayfa <i class="fa fa-chevron-right"></i></a></span> <span>Menü <i class="fa fa-chevron-right"></i></span></p>
						</div>
					</div>
				</div>
			</section>
			<?php
			if ($kontrolcikti["kontrol_one_cikan"] == 1 && $ocikarveri > 0) {

			?>
				<section>
					<div class="container mt-5">
						<div class="row justify-content-center pb-2">
							<div class="col-md-7 text-center heading-section ftco-animate">
								<span class="subheading">Öne Çıkan Ürünler</span>
							</div>
						</div>

					</div>
					<div class="container-fluid mt-5">
						<div class="row">
							<div class="col-md-12">
								<div id="owl2" class="owl-carousel owl-theme">
									<?php


									foreach ($asonuc as $satir) {
										$uad = $satir["urun_ad"];
										$ukategori = $satir["urun_kategori"];
										$ufiyat = $satir["urun_fiyat"];
										$ugorsel = $satir["urun_gorsel"];
										echo "
									<div class='item text-center'>
									<img class='img-fluid one-cikan  ' src='images/urun/$ugorsel'>
									<h2>$uad </h2>
									<h3>$ufiyat  ₺</h3>
								</div>
									
									";
									}
									?>

								</div>
							</div>
						</div>
					</div>
				</section>
			<?php } ?>


			<section class="ftco-section" style="padding-top:50px;">
				<div class="container">
					<div class="row justify-content-center mb-5 pb-2">
						<div class="col-md-7 text-center heading-section ftco-animate">
							<span class="subheading"><?php echo $sbilgicikti["site_baslik"]; ?></span>
							<h2 class="mb-4">Menü</h2>
						</div>
					</div>
					<div class="row">
						<style>
							.menu-wrap::before {
								content: "";
								position: absolute;
								top: 0;
								left: 0;
								right: 0;
								bottom: 0;
								width: 100%;
								height: 100%;
								background: #000;
								opacity: .6;
							}
						</style>
						<?php

						$sorgu = "SELECT * FROM kategori_tablosu ORDER BY kategori_sira ASC";
						$sonuc = $db->query($sorgu, PDO::FETCH_ASSOC);
						foreach ($sonuc as $asatir) {
							$kid = $asatir["kategori_id"];
							$kad = $asatir["kategori_ad"];
							$kresim = $asatir["kategori_resim"];
							echo "
					<div class='col-md-12 col-lg-6'>
					<a href='urunler?id=$kid'>
					<div class='menu-wrap img-fluid' style='background-image: url(images/kategori/$kresim); background-size:cover;'>
						<div class='heading-menu text-center  ftco-animate'>
							<h3 style='color:white; letter-spacing: 10px; '>$kad</h3>
						</div>
					</div>
					</a>
					</div>
					";
						}
						?>

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
			<script>
				var owl = $('.owl-carousel');
				owl.owlCarousel({
					margin: 15,
					loop: true,
					dots: false,

					responsive: {
						0: {
							items: 1
						},
						600: {
							items: 3
						},
						1000: {
							items: 5
						}

					}
				})
			</script>
</body>

</html>