<?php
include("login-kontrol.php");
if (!empty($_POST["masa_id"]) && is_numeric($_POST["masa_id"])) {
    $id = htmlspecialchars($_POST["masa_id"]);
    try {
        $sorgu = "DELETE FROM masa_ayir_tablosu WHERE masa_id=:id";
        $sonuc = $db->prepare($sorgu);
        $sonuc->bindParam(":id", $id, PDO::PARAM_INT);
        $sonuc->execute();
        header("Location:masa-ayirtan-musteriler.php");
    } catch (PDOException $ex) {
        $hata = $ex->getMessage();
        header("Location:masa-ayirtan-musteriler.php");
    }
} else {
    header("Location:masa-ayirtan-musteriler.php");
}
