<?php
ob_start();
session_start();
require_once("conn.php");

$mail = htmlspecialchars(addslashes(strip_tags($_POST["mail"])));
$passwordd = md5(htmlspecialchars(addslashes(strip_tags($_POST["passwordd"]))));


if (isset($_POST["login"])) {
    $kullanicisor = $conn->prepare("SELECT * from users where mail=:mail and passwordd=:passwordd");
    $kullanicisor->execute(array('mail' => $mail, 'passwordd' => $passwordd));
    $kullanicisay = $kullanicisor->rowCount();

    if ($kullanicisay > 0) {
        $kullanicicek =  $conn->prepare("SELECT * from users where mail=:mail");
        $kullanicicek->execute(array(':mail' => $mail));
        $kullanici    =  $kullanicicek->fetch();
        if ($kullanici['active'] < 1) {
            header("Location: https://loopscards.com?login=onaylanmamis");
        } else if ($kullanici['active'] == 2) {
            header("Location:https://loopscards.com?login=hesapkapatilmistir");
        } else if ($kullanici['active'] == 1) {
            $_SESSION['mail'] = $mail;
            header('Location: https://loopscards.com/userspanel/profile.php?login=Basarili&mod=user');
        }
    } else {
        header('Location: https://loopscards.com?login=Hatali');
    }
}
