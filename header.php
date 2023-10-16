<?php
$sitesorgu = $db->prepare("SELECT * FROM site_bilgi_tablosu");
$sitesorgu->execute();
$sitecikti = $sitesorgu->fetch(PDO::FETCH_ASSOC);

$sosyalsorgu = $db->prepare("SELECT * FROM sosyal_medya_tablosu");
$sosyalsorgu->execute();
$soysalcikti = $sosyalsorgu->fetch(PDO::FETCH_ASSOC);
?>


<div class="wrap">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-12 col-md d-flex align-items-center">
                <p class="mb-0 phone">
                    <?php if (!$sitecikti["site_telefon"] == null) : ?> <span class="mailus">Telefon:</span> <a href="tel:<?php echo str_replace(" ", "", $sitecikti["site_telefon"]); ?>"><?php echo $sitecikti["site_telefon"]; ?></a><?php endif; ?>
                    <?php if (!$sitecikti["site_email"] == null) : ?> <span class="mailus">E-Mail:</span> <a href="mailto:<?php echo $sitecikti["site_email"]; ?>"><?php echo $sitecikti["site_email"]; ?></a><?php endif; ?>
                </p>
            </div>
            <div class="col-12 col-md d-flex justify-content-md-end">
                <?php if (!$sitecikti["site_calisma_saat"] == null) : ?><p class="mb-0 font-weight-bold text-light"><?php echo $sitecikti["site_calisma_saat"]; ?></p><?php endif; ?>
                <div class="social-media">
                    <p class="mb-0 d-flex">
                        <?php if (!$soysalcikti["sosyal_facebook"] == null || !$soysalcikti["sosyal_facebook"] === " ") : ?> <a href="https://www.facebook.com/<?php echo $soysalcikti["sosyal_facebook"]; ?>" class="d-flex align-items-center justify-content-center"><span class="fa fa-facebook"><i class="sr-only">Facebook</i></span></a> <?php endif; ?>
                        <?php if (!$soysalcikti["sosyal_twitter"] == null || !$soysalcikti["sosyal_twitter"] === " ") : ?> <a href="https://www.twitter.com/<?php echo $soysalcikti["sosyal_twitter"]; ?>" class="d-flex align-items-center justify-content-center"><span class="fa fa-twitter"><i class="sr-only">Twitter</i></span></a> <?php endif; ?>
                        <?php if (!$soysalcikti["sosyal_instagram"] == null || !$soysalcikti["sosyal_instagram"] === " ") : ?> <a href="https://www.instagram.com/<?php echo $soysalcikti["sosyal_instagram"]; ?>" class="d-flex align-items-center justify-content-center"><span class="fa fa-instagram"><i class="sr-only">Instagram</i></span></a> <?php endif; ?>
                        <?php if (!$soysalcikti["sosyal_youtube"] == null || !$soysalcikti["sosyal_youtube"] === " ") : ?> <a href="https://www.youtube.com/<?php echo $soysalcikti["sosyal_youtube"]; ?>" class="d-flex align-items-center justify-content-center"><span class="fa fa-youtube"><i class="sr-only">Youtube</i></span></a> <?php endif; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="index"><img src="images/<?php echo $sitecikti["site_logo"]; ?>" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menü
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?php if ($sayfa == "index") {
                                        echo "active";
                                    } ?> "><a href="index" class="nav-link">Ana Sayfa</a></li>
                <li class="nav-item <?php if ($sayfa == "hakkimizda") {
                                        echo "active";
                                    } ?> "><a href="hakkimizda" class="nav-link">Hakkımızda</a></li>
                <li class="nav-item <?php if ($sayfa == "kategori") {
                                        echo "active";
                                    } ?>"><a href="menu" class="nav-link">Menü</a></li>
                <li class="nav-item <?php if ($sayfa == "iletişim") {
                                        echo "active";
                                    } ?>"><a href="iletisim" class="nav-link">İletişim</a></li>
            </ul>
        </div>
    </div>
</nav>