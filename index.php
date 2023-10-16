<?php
include("admin-panel/ayarlar.php");
$sayfa = "index";
// Site Bilgi Çekme
$sbilgisorgu = $db->prepare("SELECT * FROM site_bilgi_tablosu");
$sbilgisorgu->execute();
$sbilgicikti = $sbilgisorgu->fetch(PDO::FETCH_ASSOC);

$hakkimizdasorgu = $db->prepare("SELECT * FROM hakkimizda_tablosu WHERE hakkimizda_id=1");
$hakkimizdasorgu->execute();
$hakkimizdacikti = $hakkimizdasorgu->fetch(PDO::FETCH_ASSOC);

$anasayfasorgu = $db->prepare("SELECT * FROM anasayfa_tablosu");
$anasayfasorgu->execute();
$anasayfacikti = $anasayfasorgu->fetch(PDO::FETCH_ASSOC);

$asorgu = "SELECT * FROM urun_tablosu WHERE one_cikar=1";
$asonuc = $db->query($asorgu, PDO::FETCH_ASSOC);
$ocikarveri = $asonuc->rowCount();

// Kontrol İşlemleri Çekme
$kontrolsorgu = $db->prepare("SELECT * FROM kontrol_tablosu");
$kontrolsorgu->execute();
$kontrolcikti = $kontrolsorgu->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">

<head>
	<title><?php echo $sbilgicikti["site_baslik"]; ?></title>
	<meta name="description" content="<?php echo $sbilgicikti["site_aciklama"]; ?>">
	<link rel="icon" href="images/<?php echo $sbilgicikti["site_favicon"]; ?>" type="image/x-icon" />

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
	<link rel="stylesheet" href="css/menu.css">
	<style>
		.form-field option {
			color: black;
		}
	</style>
	<link rel="stylesheet" href="css/sweetalert2.min.css">
	<script src="js/sweetalert2.min.js"></script>

</head>

<body>

	<?php
	if (isset($_POST["masa-ayirtt"])) {
		$masanot = "";
		$maisim = htmlspecialchars($_POST["masa-isim"]);
		$maemail = htmlspecialchars($_POST["masa-email"]);
		$matelefon = htmlspecialchars($_POST["masa-telefon"]);
		$macheck = date('d.m.Y', strtotime($_POST['masa-tarih']));
		$msaat = htmlspecialchars($_POST["masa-saat"]);
		$mamisafir = htmlspecialchars($_POST["masa-misafir"]);
		$sekle = $db->prepare("INSERT INTO masa_ayir_tablosu SET masa_isim=?,masa_email=?,masa_telefon=?,masa_tarih=?,masa_saat=?,masa_misafir=?");
		$sekle->execute([$maisim, $maemail, $matelefon, $macheck, $msaat, $mamisafir]);
		if ($sekle) {
			echo '<script>Swal.fire("Masa Ayırttma Talebiniz alınmıştır.", "En kısa sürede sizinle iletişime geçeceğiz. ", "success"); </script>';
			header("refresh:2;./");
		}
	}

	include("header.php"); ?>



	<section class="hero-wrap">
		<div class="home-slider owl-carousel js-fullheight">
			<div class="slider-item js-fullheight" style="background-image:url(images/<?php echo $anasayfacikti["anasayfa_slider1_gorsel"] ?>);">
				<div class="overlay"></div>
				<div class="container">
					<div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
						<div class="col-md-12 ftco-animate">
							<div class="text w-100 mt-5 text-center">
								<h1><?php echo $anasayfacikti["anasayfa_slider1_yazi"] ?></h1>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="slider-item js-fullheight" style="background-image:url(images/<?php echo $anasayfacikti["anasayfa_slider2_gorsel"] ?>);">
				<div class="overlay"></div>
				<div class="container">
					<div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
						<div class="col-md-12 ftco-animate">
							<div class="text w-100 mt-5 text-center">
								<h1><?php echo $anasayfacikti["anasayfa_slider2_yazi"] ?></h1>
							</div>
						</div>
					</div>
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



	<section class="ftco-section">
		<div class="container">
			<div class="row d-flex">
				<div class="col-md-6 d-flex">
					<div class="img img-2 w-100 mr-md-2" style="background-image: url(images/<?php echo $anasayfacikti["anasayfa_hk_gorsel"] ?>);"></div>
				</div>
				<div class="col-md-6 ftco-animate makereservation p-4 p-md-5">
					<div class="heading-section ftco-animate mb-5">
						<span class="subheading mb-5">Hakkımızda</span>
						<p><?php
							echo   mb_substr($hakkimizdacikti["hakkimizda_icerik"], 0, 300) . "...";
							?></p>
						<p><a href="hakkimizda" class="btn btn-primary">Devamı İçin</a></p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php

	if ($kontrolcikti["kontrol_masa_ayirt"] == 1) {

	?>
		<section class="ftco-section ftco-wrap-about ftco-no-pt">
			<div class="container">
				<div class="row no-gutters">
					<div class="col-sm-4 p-4 p-md-5 d-flex align-items-center justify-content-center bg-dark">

						<form class="appointment-form" method="POST">
							<h3 class="mb-3">Masa Ayırt</h3>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<input type="name" maxlength="40" name="masa-isim" class="form-control" placeholder="İsim" required>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<input type="email" maxlength="100" name="masa-email" class="form-control" placeholder="E mail" required>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<input type="text" maxlength="16" name="masa-telefon" class="form-control" placeholder="Telefon" required>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<div class="input-wrap">
											<input type="date" name="masa-tarih" class="form-control" placeholder="Check-In" required>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<div class="input-wrap">
											<div class="icon"><span class="fa fa-clock-o"></span></div>
											<input type="text" name="masa-saat" class="form-control book_time" placeholder="Saat" required>
										</div>
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<div class="form-field">
											<div class="select-wrap ">
												<div class="icon"><span class="fa fa-chevron-down"></span></div>
												<select name="masa-misafir" id="" class="form-control" required>
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
													<option value="6">6</option>
													<option value="7">7</option>
												</select>
											</div>
										</div>
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<input type="submit" name="masa-ayirtt" value="Hemen Yerinizi Ayırtın" class="btn btn-white py-3 px-4">
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="col-sm-8 wrap-about py-1 ftco-animate">
						<div class="row pb-1 pb-md-0">
							<div class="col-md-12 col-lg-12">
								<div class="heading-section mt-5 mb-4">
									<div class="pl-lg-3 ml-md-5">
										<span class="subheading mb-5"><?php echo $anasayfacikti["anasayfa_masa_baslik"] ?></span>
									</div>
								</div>
								<div class="pl-lg-3 ml-md-5">
									<p><?php echo $anasayfacikti["anasayfa_masa_aciklama"] ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php
	}
	?>


	<section class="ftco-section ftco-intro" style="background-image: url(images/<?php echo $anasayfacikti["anasayfa_slogan_gorsel"] ?>);">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<span><?php echo $anasayfacikti["anasayfa_slogan_baslik"] ?></span>
					<h2><?php echo $anasayfacikti["anasayfa_slogan_aciklama"] ?></h2>
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