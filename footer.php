<?php
// Site Bilgi Çekme
$footersorgu = $db->prepare("SELECT * FROM footer_tablo");
$footersorgu->execute();
$footercek = $footersorgu->fetch(PDO::FETCH_ASSOC);
?>

<footer class="ftco-footer ftco-no-pb  ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2"><img src="images/<?php echo $sitecikti["site_logo"]; ?>" alt="" class="img-fluid"></h2>
                    <p><?php echo $footercek["footer_aciklama"]; ?></p>
                    <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-3">
                        <?php if (!$soysalcikti["sosyal_twitter"] == null || !$soysalcikti["sosyal_twitter"] === " ") : ?> <li class="ftco-animate"><a href="https://www.twitter.com/<?php echo $soysalcikti["sosyal_twitter"]; ?>"><span class="fa fa-twitter"></span></a></li> <?php endif; ?>
                        <?php if (!$soysalcikti["sosyal_facebook"] == null || !$soysalcikti["sosyal_facebook"] === " ") : ?> <li class="ftco-animate"><a href="https://www.facebook.com/<?php echo $soysalcikti["sosyal_facebook"]; ?>"><span class="fa fa-facebook"></span></a></li> <?php endif; ?>
                        <?php if (!$soysalcikti["sosyal_instagram"] == null || !$soysalcikti["sosyal_instagram"] === " ") : ?><li class="ftco-animate"><a href="https://www.instagram.com/<?php echo $soysalcikti["sosyal_instagram"]; ?>"><span class="fa fa-instagram"></span></a></li> <?php endif; ?>
                        <?php if (!$soysalcikti["sosyal_youtube"] == null || !$soysalcikti["sosyal_youtube"] === " ") : ?><li class="ftco-animate"><a href="https://www.youtube.com/<?php echo $soysalcikti["sosyal_youtube"]; ?>"><span class="fa fa-youtube"></span></a></li> <?php endif; ?>
                    </ul>
                </div>
            </div>
            <div class="col-md-12 col-lg-6">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Açık Saatler</h2>
                    <ul class="list-unstyled open-hours">
                        <li class="d-flex"><span>Pazartesi</span><span><?php echo $footercek["f_pazartesi"]; ?></span></li>
                        <li class="d-flex"><span>Salı</span><span><?php echo $footercek["f_sali"]; ?></span></li>
                        <li class="d-flex"><span>Çarşamba</span><span><?php echo $footercek["f_carsamba"]; ?></span></li>
                        <li class="d-flex"><span>Perşembe</span><span><?php echo $footercek["f_persembe"]; ?></span></li>
                        <li class="d-flex"><span>Cuma</span><span><?php echo $footercek["f_cuma"]; ?></span></li>
                        <li class="d-flex"><span>Cumartesi</span><span><?php echo $footercek["f_cumartesi"]; ?></span></li>
                        <li class="d-flex"><span>Pazar</span><span> <?php echo $footercek["f_pazar"]; ?></span></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</footer>