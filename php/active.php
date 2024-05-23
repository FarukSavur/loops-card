<?php
ob_start();
require_once("conn.php");

$mail = htmlspecialchars(addslashes(strip_tags($_POST["mail"])));

if (isset($_POST["aktivasyon"])) {
    $kullanicisay = $conn->query("SELECT * FROM users WHERE mail = '{$mail}'  ")->fetch(PDO::FETCH_ASSOC);
    if ($kullanicisay <= 0) {
        header('Location: https://loopscards.com?register=KodYadaMailHatali');
    } else {

        $guncelle = $conn->prepare("UPDATE users SET active = :active WHERE mail = :mail");
        $guncelle = $guncelle->execute(array(
            "active" => 1,
            "mail" => $mail
        ));
        if ($guncelle) {
            header('Location: https://loopscards.com?register=aktive');
        } else {
            header('Location: https://loopscards.com?register=aktivehata');
        }
    }
}
