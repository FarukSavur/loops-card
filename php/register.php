<?php
ob_start();
include("conn.php");

//mailer sınıflarını dahil etme
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if (isset($_POST["register"])) {
    $full_name = htmlspecialchars(addslashes(strip_tags($_POST["full_name"])));
    $gender = htmlspecialchars(addslashes(strip_tags($_POST["gender"])));
    $mail = htmlspecialchars(addslashes(strip_tags($_POST["mail"])));
    $where_mail = htmlspecialchars(addslashes(strip_tags($_POST["mail"])));
    $passwordd = htmlspecialchars(addslashes(strip_tags($_POST["password"])));
    $password = md5($passwordd);

    if ($_POST["gender"] != "erkek" && $_POST["gender"] != "kadın") {
        header('Location: https://loopscards.com?register=gender');
        exit;
    } else {
        if ($_POST["gender"] == "erkek") {
            $img = "img/man.svg";
        } else if ($_POST["gender"] == "kadın") {
            $img = "img/woman.svg";
        } else {
            $img = "img/null.svg";
        }
    }

    // email kontrol
    // if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    if (strlen($passwordd) < 6) {
        header('Location: https://loopscards.com?register=password');
        // daha güçlü bir şifre deneyebilirsin
    } else {
        $users = $conn->query("SELECT * FROM users WHERE mail = '{$mail}'")->fetch(PDO::FETCH_ASSOC);
        if ($users > 0) {
            // Bu mail adresi kullanımda
            header('Location: https://loopscards.com?register=mailfull');
        } else {
            $activation_code = rand(1, 999999);
            $query = $conn->prepare("INSERT INTO users SET
            full_name = ?,
            biography = ?,
            img = ?,
            mail = ?,
            passwordd = ?,
            activation_code = ?,
            active = ?,
            gender = ?");
            $users_add = $query->execute(array(
                $full_name,
                "henüz biyografi eklemedi.",
                $img,
                $mail,
                $password,
                $activation_code,
                0,
                $gender
            ));

            //sosyal hesapları ekleme / update olabilsin diye şimdi boş ekliyorum.
            $query_id = $conn->query("SELECT * FROM users WHERE mail = '{$where_mail}'")->fetch(PDO::FETCH_ASSOC);
            $query_id = $query_id["id"];
            //sosyal medyaları boş metin ekleme
            $social = $conn->prepare("INSERT INTO social SET userr_id = ?, facebook = ?, twitter = ?, tiktok = ?, instagram = ?, snapchat = ?, linkedin = ?");
            //boş ekliyorum
            $social_add = $social->execute(array($query_id, '', '', '', '', '', ''));
            //contact işlemleri boş metin
            $contact = $conn->prepare("INSERT INTO contact SET userr_id = ?, numbers = ?, adress = ?, sites = ?, whatsapp = ?");
            //boş ekliyorum
            $contact_add = $contact->execute(array($query_id, '', '', '', ''));

            if ($users_add) {
                // kayıt işlemi başarılı
                //php mailer
                $mail = new PHPMailer();
                $mail->IsSMTP();
                $mail->SMTPAuth = true;
                // SMTP Bilgileri
                // Giden gelen sunucu: mail.alanadınız.com
                // Giden port: 587
                // Smtp auth (kimlik doğrulama): açık
                // ssl: kapalı
                $mail->Host = 'mail.loopscards.com';
                $mail->Port = 587;
                $mail->Username = 'info@loopscards.com';
                $mail->Password = 'amuMiEfYpc2n837';
                $mail->SetFrom($mail->Username, 'Loops Card');
                $mail->AddAddress(trim($_POST['mail']));
                $mail->CharSet = 'UTF-8';
                $mail->Subject = 'Loops Card Üyelik Onaylama';
                $mail_link = 'https://loopscards.com/aktivasyon.php?code=' . $activation_code . '&mail=' . trim($_POST['mail']);
                $mail_icerik  = '
                   <b>"Aktivasyon Kodun: ' . $activation_code . '"</b>
                   <br>
                   <a style="text-decoration:none;" href="' . $mail_link . '">
                       Hesabı aktifleştirmek için tıkla
                   </a>';
                $mail->MsgHTML($mail_icerik);
                if ($mail->Send()) {
                    echo 'Mail gönderildi!';
                } else {
                    echo 'Mail gönderilirken bir hata oluştu: ' . $mail->ErrorInfo;
                }
                header('Location: https://loopscards.com?register=ok');
            } else {
                header('Location: https://loopscards.com?register=no');
            }
        }
    }
} else {
    //böyle bir mail adresi dünyada yok :/
    header('Location: https://loopscards.com?register=mail');
}
// }
