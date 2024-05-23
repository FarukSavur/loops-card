<?php
ob_start();
include("conn.php");

//mailer sınıflarını dahil etme
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if (isset($_POST["password"])) {
    $mail_password = htmlspecialchars(addslashes(strip_tags($_POST["mail"])));
    if (filter_var($mail_password, FILTER_VALIDATE_EMAIL)) {
        $users = $conn->query("SELECT * FROM users WHERE mail = '{$mail_password}'")->fetch(PDO::FETCH_ASSOC);
        if ($users) {
            //php mailer
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->Host = 'mail.loopscards.com';
            $mail->Port = 587;
            $mail->Username = 'info@loopscards.com';
            $mail->Password = 'amuMiEfYpc2n837';
            $mail->SetFrom($mail->Username, 'Loops Card');
            $mail->AddAddress($mail_password);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = 'Loops Card Şifre Yenileme';
            $password_link = 'https://loopscards.com/password.php?mail=' . $mail_password;
            $mail_icerik  = '
                  <a style="text-decoration:none;" href="' . $password_link . '">
                      Şifreni Yenilemek İçin Buraya Tıkla
                  </a>';
            $mail->MsgHTML($mail_icerik);
            if ($mail->Send()) {
                echo 'Mail gönderildi!';
            } else {
                echo 'Mail gönderilirken bir hata oluştu: ' . $mail->ErrorInfo;
            }
            header('Location: https://loopscards.com?password_refresh=mailgonderildi');
        } else {
            header('Location: https://loopscards.com?password_refresh=kullanicibulunamadi');
            // print("kullanıcı bulunamadı");
        }
    } else {
        header('Location: https://loopscards.com?password_refresh=mailbulunamadi');
        // print("böyle bir mail yok.");
    }
}
