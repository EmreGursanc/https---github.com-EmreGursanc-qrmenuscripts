<?php
ob_start();
session_start(); 
include("ayarlar.php"); 
if(isset($_SESSION['adminbilgi'])){
    $kullanicisor=$db->prepare("SELECT * FROM admin_tablo WHERE admin_kad=:takma");
    $kullanicisor->execute(array('takma' => $_SESSION['adminbilgi']));
    $kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
}else{
    header("Location:login.php");
}



?>