<?php
include("admin-panel/ayarlar.php");
$sayfa = "kategori";
$garsonnot = "";
if (isset($_POST["garson-cagir"])) {
	$masano = strip_tags($_POST["masa-no"]);
	$gekle = $db->prepare("INSERT INTO garson_tablosu SET garson_masa_no=?");
	$gekle->execute([$masano]);
	if ($gekle) {
		header("refresh:2;menu");
		$garsonnot = "<div class='alert alert-success text-center font-weight-bold' role='alert'>Garson İsteğiniz alınmıştır. En kısa sürede yanınızdayız.</div>";
	} else {
		$garsonnot = "<div class='alert alert-danger text-center font-weight-bold' role='alert'>Ürün Eklenemedi</div>";
	}
}
$kid = $_GET["id"];
$ksorgu = $db->prepare("SELECT * FROM kategori_tablosu WHERE kategori_id=$kid");
$ksorgu->execute();
$kcikti = $ksorgu->fetch(PDO::FETCH_ASSOC);
$kad = $kcikti['kategori_ad'];

// Site Bilgi Çekme
$sbilgisorgu = $db->prepare("SELECT * FROM site_bilgi_tablosu");
$sbilgisorgu->execute();
$sbilgicikti = $sbilgisorgu->fetch(PDO::FETCH_ASSOC);

// Kontrol İşlemleri Çekme
$kontrolsorgu = $db->prepare("SELECT * FROM kontrol_tablosu");
$kontrolsorgu->execute();
$kontrolcikti = $kontrolsorgu->fetch(PDO::FETCH_ASSOC);

if(isset($_GET["id"])==null){
	header("Location:kategori");
}
?>

<!DOCTYPE html>
<html lang="tr">

<head>
	<title><?php  echo $sbilgicikti["site_baslik"]; ?> | <?php echo $kad; ?></title>
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
	<link rel="stylesheet" href="css/flaticon.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/menu.css">
</head>

<body>

	<?php include("header.php"); ?>

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
				$tel = $wpcikti["wp_telefon"];
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
					<h1 class="mb-2 bread"><?php echo $kad; ?></h1>
					<p class="breadcrumbs"><span class="mr-2"><a href="index">Ana Sayfa <i class="fa fa-chevron-right"></i></a></span> <span><a href="menu">Menü <i class="fa fa-chevron-right"></i></a></span></span> <span><?php echo $kad; ?> <i class="fa fa-chevron-right"></i></span></p>
				</div>
			</div>
		</div>
		<?php echo $garsonnot; ?>
	</section>



	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center mb-5 pb-2">
				<div class="col-md-7 text-center heading-section ftco-animate">

					<span class="subheading"><?php  echo $sbilgicikti["site_baslik"]; ?></span>
					<h2 class="mb-4"><?php echo $kad; ?></h2>
				</div>
			</div>
			<div class="row">
				<?php

				$asorgu = "SELECT * FROM urun_tablosu WHERE urun_kategori=$kid ORDER BY urun_sira ASC";
				$asonuc = $db->query($asorgu, PDO::FETCH_ASSOC);
				echo "<div class='col-md-12 col-lg-12'>";
				echo "<div class='menu-wrap'>";
				foreach ($asonuc as $satir) {
					$uid = $satir["urun_id"];
					$uad = $satir["urun_ad"];
					$uaciklama = $satir["urun_aciklama"];
					$ukategori = $satir["urun_kategori"];
					$ufiyat = $satir["urun_fiyat"];
					$ugorsel = $satir["urun_gorsel"];

					echo "<div class='menus d-flex ftco-animate'>
							<div class='menu-img img' style='background-image: url(images/urun/$ugorsel);'></div>
							<div class='text'>
								<div class='d-flex'>
									<div class='one-half'>
										<h3>$uad</h3>
									</div>
									<div class='one-forth'>
										<span class='price'>$ufiyat ₺</span>
									</div>
								</div>
								<p>$uaciklama</p>
							</div>
						</div>";
				}
				echo "</div>
					</div>";

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
	<a id="menubuton" href="kategori"><i class="fa fa-cutlery" aria-hidden="true"></i></a>
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
	<script src="js/menu.js"></script>

</body>

</html>