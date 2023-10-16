-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 27 Kas 2022, 22:24:55
-- Sunucu sürümü: 5.7.31
-- PHP Sürümü: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `gefqrv1`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin_tablo`
--

DROP TABLE IF EXISTS `admin_tablo`;
CREATE TABLE IF NOT EXISTS `admin_tablo` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_ad` varchar(30) NOT NULL,
  `admin_kad` varchar(30) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_sifre` varchar(60) NOT NULL,
  `admin_yetki` int(11) DEFAULT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `admin_tablo`
--

INSERT INTO `admin_tablo` (`admin_id`, `admin_ad`, `admin_kad`, `admin_email`, `admin_sifre`, `admin_yetki`) VALUES
(1, 'Emre', 'admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 1),
(5, 'kasiyer', 'kasiyer', 'kasiyer@gmail.com', '22daf5a4ad09ad301df49a0d6ed8153c', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `anasayfa_tablosu`
--

DROP TABLE IF EXISTS `anasayfa_tablosu`;
CREATE TABLE IF NOT EXISTS `anasayfa_tablosu` (
  `anasayfa_id` int(11) NOT NULL AUTO_INCREMENT,
  `anasayfa_aciklama` varchar(150) NOT NULL,
  `anasayfa_slider1_yazi` varchar(40) NOT NULL,
  `anasayfa_slider1_gorsel` varchar(20) NOT NULL,
  `anasayfa_slider2_yazi` varchar(40) NOT NULL,
  `anasayfa_slider2_gorsel` varchar(20) NOT NULL,
  `anasayfa_hk_gorsel` varchar(20) NOT NULL,
  `anasayfa_masa_baslik` varchar(40) NOT NULL,
  `anasayfa_masa_aciklama` varchar(500) NOT NULL,
  `anasayfa_slogan_baslik` varchar(20) NOT NULL,
  `anasayfa_slogan_aciklama` varchar(40) NOT NULL,
  `anasayfa_slogan_gorsel` varchar(20) NOT NULL,
  PRIMARY KEY (`anasayfa_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `anasayfa_tablosu`
--

INSERT INTO `anasayfa_tablosu` (`anasayfa_id`, `anasayfa_aciklama`, `anasayfa_slider1_yazi`, `anasayfa_slider1_gorsel`, `anasayfa_slider2_yazi`, `anasayfa_slider2_gorsel`, `anasayfa_hk_gorsel`, `anasayfa_masa_baslik`, `anasayfa_masa_aciklama`, `anasayfa_slogan_baslik`, `anasayfa_slogan_aciklama`, `anasayfa_slogan_gorsel`) VALUES
(1, 'Egv1 QR Menü uygulaması.', 'Yeni Lezzetlerle', '276328720.jpg', 'En İyi Lezzetlerle ', '1937506348.jpg', '608345790.jpg', 'Mutlu Saatler için Masa Ayırt', 'Online olarak Masa ayırtma isteğinizde bulunabilirsiniz. İstediğin saatlerde sizler için uygun masayı sizler için rezerve edeceğiz. Bizimle paylaştığınız iletişim numarası üzerinden sizleri bilgilendireceğiz. Şimdiden Afiyet olsun.', 'SLOGAN', 'Slogan Yazısı', '692066082.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `footer_tablo`
--

DROP TABLE IF EXISTS `footer_tablo`;
CREATE TABLE IF NOT EXISTS `footer_tablo` (
  `footer_id` int(11) NOT NULL AUTO_INCREMENT,
  `footer_aciklama` varchar(200) NOT NULL,
  `f_pazartesi` varchar(35) NOT NULL,
  `f_sali` varchar(35) NOT NULL,
  `f_carsamba` varchar(35) NOT NULL,
  `f_persembe` varchar(35) NOT NULL,
  `f_cuma` varchar(35) NOT NULL,
  `f_cumartesi` varchar(35) NOT NULL,
  `f_pazar` varchar(35) NOT NULL,
  PRIMARY KEY (`footer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `footer_tablo`
--

INSERT INTO `footer_tablo` (`footer_id`, `footer_aciklama`, `f_pazartesi`, `f_sali`, `f_carsamba`, `f_persembe`, `f_cuma`, `f_cumartesi`, `f_pazar`) VALUES
(1, 'QR Menü Footer Alanı.', ' 9:00 - 23:00', ' 9:00 - 22:00', ' 9:00 - 21:00', ' 9:00 - 23:00', ' 9:00 - 22:00', ' 9:00 - 21:00', 'Kapalı');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `garson_tablosu`
--

DROP TABLE IF EXISTS `garson_tablosu`;
CREATE TABLE IF NOT EXISTS `garson_tablosu` (
  `garson_id` int(11) NOT NULL AUTO_INCREMENT,
  `garson_masa_no` int(4) NOT NULL,
  PRIMARY KEY (`garson_id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hakkimizda_tablosu`
--

DROP TABLE IF EXISTS `hakkimizda_tablosu`;
CREATE TABLE IF NOT EXISTS `hakkimizda_tablosu` (
  `hakkimizda_id` int(11) NOT NULL AUTO_INCREMENT,
  `hakkimizda_baslik` varchar(60) NOT NULL,
  `hakkimizda_aciklama` varchar(150) NOT NULL,
  `hakkimizda_slogan` varchar(30) NOT NULL,
  `hakkimizda_icerik` varchar(2000) NOT NULL,
  `hakkimizda_yazibir` varchar(40) NOT NULL,
  `hakkimizda_yazibir_sayi` int(6) NOT NULL,
  `hakkimizda_yaziiki` varchar(40) NOT NULL,
  `hakkimizda_yaziiki_sayi` int(6) NOT NULL,
  `hakkimizda_yaziuc` varchar(40) NOT NULL,
  `hakkimizda_yaziuc_sayi` int(6) NOT NULL,
  `hakkimizda_yazidort` varchar(40) NOT NULL,
  `hakkimizda_yazidort_sayi` int(6) NOT NULL,
  `hakkimizda_gorsel_1` varchar(20) DEFAULT NULL,
  `hakkimizda_gorsel_2` varchar(20) DEFAULT NULL,
  `hakkimizda_gorsel_3` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`hakkimizda_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `hakkimizda_tablosu`
--

INSERT INTO `hakkimizda_tablosu` (`hakkimizda_id`, `hakkimizda_baslik`, `hakkimizda_aciklama`, `hakkimizda_slogan`, `hakkimizda_icerik`, `hakkimizda_yazibir`, `hakkimizda_yazibir_sayi`, `hakkimizda_yaziiki`, `hakkimizda_yaziiki_sayi`, `hakkimizda_yaziuc`, `hakkimizda_yaziuc_sayi`, `hakkimizda_yazidort`, `hakkimizda_yazidort_sayi`, `hakkimizda_gorsel_1`, `hakkimizda_gorsel_2`, `hakkimizda_gorsel_3`) VALUES
(1, 'Hakkımızda', 'Google tarafında açıklama kısmında görülecek kısımdır. Seo açısından önemlidir.', 'Yeni Lezzetler Peşinde', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste ipsum cupiditate nesciunt. Ipsa corporis, dolorem quod doloremque ab amet possimus, corrupti obcaecati iste reiciendis suscipit laboriosam rerum sapiente nostrum officiis. Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi nobis odio doloribus nesciunt nam inventore adipisci soluta est quaerat, eius aspernatur qui pariatur tempore. Ab inventore harum voluptatum aliquam tenetur. Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima voluptatum nesciunt mollitia, distinctio magni saepe eveniet, cum pariatur debitis maxime natus voluptatem, fugit rem praesentium est delectus sit labore id! Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi obcaecati rem inventore dolore nemo? \r\n\r\nNihil saepe, animi, molestias quae reiciendis ab tenetur quibusdam aliquam perferendis doloremque omnis adipisci! Tempora, architecto. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odio, quam excepturi, nisi iste, mollitia esse facere voluptate eveniet sit ea totam quasi veritatis autem? Perspiciatis assumenda ipsa reiciendis! Aliquam, praesentium.\r\n', 'Tekrar Eden Sipariş', 1030, 'Online Sipariş', 365, 'Restoranlar', 5, 'Mutlu Müşteri', 4564, '1077282255.png', '190073872.png', '1133541733.png');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategori_tablosu`
--

DROP TABLE IF EXISTS `kategori_tablosu`;
CREATE TABLE IF NOT EXISTS `kategori_tablosu` (
  `kategori_id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_ad` varchar(50) NOT NULL,
  `kategori_resim` varchar(50) NOT NULL,
  `kategori_sira` int(3) NOT NULL,
  PRIMARY KEY (`kategori_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `kategori_tablosu`
--

INSERT INTO `kategori_tablosu` (`kategori_id`, `kategori_ad`, `kategori_resim`, `kategori_sira`) VALUES
(1, 'Kahvaltılar', '1044744581.jpeg', 1),
(2, 'Tostlarımız', '1760915006.jpeg', 2),
(5, 'Atıştırmalıklar', '243471757.png', 3),
(6, 'Burger', '476573046.png', 5),
(7, 'Wrap', '748413824.png', 4);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kontrol_tablosu`
--

DROP TABLE IF EXISTS `kontrol_tablosu`;
CREATE TABLE IF NOT EXISTS `kontrol_tablosu` (
  `kontrol_id` int(11) NOT NULL AUTO_INCREMENT,
  `kontrol_menu_buton` int(1) DEFAULT NULL,
  `kontrol_instagram` int(1) DEFAULT NULL,
  `kontrol_whatsapp` int(1) DEFAULT NULL,
  `kontrol_garson_cagir` int(1) DEFAULT NULL,
  `kontrol_one_cikan` int(1) NOT NULL,
  `kontrol_masa_ayirt` int(1) NOT NULL,
  PRIMARY KEY (`kontrol_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `kontrol_tablosu`
--

INSERT INTO `kontrol_tablosu` (`kontrol_id`, `kontrol_menu_buton`, `kontrol_instagram`, `kontrol_whatsapp`, `kontrol_garson_cagir`, `kontrol_one_cikan`, `kontrol_masa_ayirt`) VALUES
(1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `masa_ayir_tablosu`
--

DROP TABLE IF EXISTS `masa_ayir_tablosu`;
CREATE TABLE IF NOT EXISTS `masa_ayir_tablosu` (
  `masa_id` int(11) NOT NULL AUTO_INCREMENT,
  `masa_isim` varchar(40) NOT NULL,
  `masa_email` varchar(100) NOT NULL,
  `masa_telefon` varchar(16) NOT NULL,
  `masa_tarih` varchar(30) NOT NULL,
  `masa_saat` varchar(20) NOT NULL,
  `masa_misafir` int(2) NOT NULL,
  PRIMARY KEY (`masa_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `masa_ayir_tablosu`
--

INSERT INTO `masa_ayir_tablosu` (`masa_id`, `masa_isim`, `masa_email`, `masa_telefon`, `masa_tarih`, `masa_saat`, `masa_misafir`) VALUES
(25, 'Gef Soft', 'info@gefsoft.com', '0555 55 55 55', '16.11.2022', '12:00am', 4);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `musteri_yorum_tablosu`
--

DROP TABLE IF EXISTS `musteri_yorum_tablosu`;
CREATE TABLE IF NOT EXISTS `musteri_yorum_tablosu` (
  `musteri_yorum_id` int(11) NOT NULL AUTO_INCREMENT,
  `yorum_aciklama` varchar(200) NOT NULL,
  `yorum_musteriad` varchar(30) NOT NULL,
  `yorum_musteriunvan` varchar(30) NOT NULL,
  `yorum_musterigorsel` varchar(20) NOT NULL,
  PRIMARY KEY (`musteri_yorum_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `musteri_yorum_tablosu`
--

INSERT INTO `musteri_yorum_tablosu` (`musteri_yorum_id`, `yorum_aciklama`, `yorum_musteriad`, `yorum_musteriunvan`, `yorum_musterigorsel`) VALUES
(3, 'Ahmet Demir \'in Değerli yorumu.', 'Ahmet Demir', 'İş Adamı', '1057727043.jpg'),
(6, 'Mehmet Demir \\\'in Değerli Yorumu.', 'Mehmet Demir', 'Korsan Taksi', '1002021574.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `site_bilgi_tablosu`
--

DROP TABLE IF EXISTS `site_bilgi_tablosu`;
CREATE TABLE IF NOT EXISTS `site_bilgi_tablosu` (
  `site_id` int(11) NOT NULL AUTO_INCREMENT,
  `site_baslik` varchar(50) NOT NULL,
  `site_aciklama` varchar(125) NOT NULL,
  `site_logo` varchar(22) NOT NULL,
  `site_favicon` varchar(22) NOT NULL,
  `site_telefon` varchar(15) DEFAULT NULL,
  `site_email` varchar(60) DEFAULT NULL,
  `site_calisma_saat` varchar(100) DEFAULT NULL,
  `site_adres` varchar(80) DEFAULT NULL,
  `site_kategori_gorsel` varchar(20) DEFAULT NULL,
  `site_iletisim_gorsel` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`site_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `site_bilgi_tablosu`
--

INSERT INTO `site_bilgi_tablosu` (`site_id`, `site_baslik`, `site_aciklama`, `site_logo`, `site_favicon`, `site_telefon`, `site_email`, `site_calisma_saat`, `site_adres`, `site_kategori_gorsel`, `site_iletisim_gorsel`) VALUES
(1, 'GefSoft QRv1', 'Bu kısım google tarafında gözüken meta-description kısmıdır.', '1732237933.png', '1066453323.png', '0555 444 3322', 'info@gefsoft.com', 'Hafta İçi: 08:00 - 21:00, Hafta Sonu: 10:00 - 20:00', 'Adres Bilgisi', '290057513.png', '1654116334.png');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sosyal_medya_tablosu`
--

DROP TABLE IF EXISTS `sosyal_medya_tablosu`;
CREATE TABLE IF NOT EXISTS `sosyal_medya_tablosu` (
  `sosyal_id` int(1) NOT NULL AUTO_INCREMENT,
  `sosyal_instagram` varchar(100) DEFAULT NULL,
  `sosyal_twitter` varchar(100) DEFAULT NULL,
  `sosyal_facebook` varchar(100) DEFAULT NULL,
  `sosyal_youtube` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`sosyal_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `sosyal_medya_tablosu`
--

INSERT INTO `sosyal_medya_tablosu` (`sosyal_id`, `sosyal_instagram`, `sosyal_twitter`, `sosyal_facebook`, `sosyal_youtube`) VALUES
(1, 'gefsoft', 'gefsoft', 'gefsoft', 'gefsoft');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urun_tablosu`
--

DROP TABLE IF EXISTS `urun_tablosu`;
CREATE TABLE IF NOT EXISTS `urun_tablosu` (
  `urun_id` int(11) NOT NULL AUTO_INCREMENT,
  `urun_ad` varchar(100) NOT NULL,
  `urun_aciklama` varchar(400) DEFAULT NULL,
  `urun_kategori` int(3) NOT NULL,
  `urun_fiyat` varchar(5) NOT NULL,
  `urun_gorsel` varchar(50) DEFAULT NULL,
  `urun_sira` int(3) NOT NULL DEFAULT '999',
  `one_cikar` int(1) DEFAULT '0',
  PRIMARY KEY (`urun_id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `urun_tablosu`
--

INSERT INTO `urun_tablosu` (`urun_id`, `urun_ad`, `urun_aciklama`, `urun_kategori`, `urun_fiyat`, `urun_gorsel`, `urun_sira`, `one_cikar`) VALUES
(1, 'Serpme Kahvaltı', 'Beyaz Peynir, taze kaşar peyniri, kızarmış hellim peyniri, otlu peynir, tulum peynir', 1, '69.00', '1476880282.png', 2, 0),
(4, 'Kaşarlı Tost', ' ', 2, '12.50', '1782129920.png', 1, 0),
(8, 'Parmak Patates', '', 5, '13.00', '1866968740.png', 1, 0),
(9, 'Klasik Burger', '150 gr burger köfte, göbek salata, domates, soğan halkaları, patates kızartması.', 6, '25.00', '1938830170.png', 1, 0),
(10, 'Steak Wrap', 'Tortilla ekmeğinde, kaşar peyniri, julyen dana bonfile, köy biberi, kapya biberi, mantar.', 7, '35.00', '1860368067.png', 1, 0),
(12, 'Köfteli Wrap', 'Tortilla ekmeğinde, kaşar peyniri, köfte, soğan, renkli biber, yeşillik, domates, mantar, patates kızartması.', 7, '27.00', '2084143046.png', 2, 0),
(13, 'Ayvalık Tostu', '', 2, '19.00', '262865639.png', 2, 0),
(14, 'Muhlama', 'Kolot peyniri, trabzon tereyağı, çeçil peyniri, çifte kavrulmuş mısır unu', 1, '19.00', '238335600.png', 1, 0),
(49, 'Resimsiz Ürün', 'Bu bir resimsiz üründür.', 1, '56', '', 3, 0),
(50, 'Resimli Ürün', 'bu bir resimli ürün', 1, '54', '1212727420.png', 4, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `whatsapp_tablo`
--

DROP TABLE IF EXISTS `whatsapp_tablo`;
CREATE TABLE IF NOT EXISTS `whatsapp_tablo` (
  `wp_id` int(11) NOT NULL AUTO_INCREMENT,
  `wp_telefon` varchar(13) NOT NULL,
  PRIMARY KEY (`wp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `whatsapp_tablo`
--

INSERT INTO `whatsapp_tablo` (`wp_id`, `wp_telefon`) VALUES
(3, '05554442216');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
