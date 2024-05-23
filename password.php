<?php
ob_start();
include("php/conn.php");

$mail = htmlspecialchars(addslashes(strip_tags($_GET["mail"])));

$user = $conn->query("SELECT * FROM users WHERE mail = '{$mail}'  ")->fetch(PDO::FETCH_ASSOC);
if ($user <= 0) {
    header('Location: https://loopscards.com?password_refresh=hatalimail');
}

if ($_POST["password_refresh"]) {
    $mail = htmlspecialchars(addslashes(strip_tags($_POST["mail"])));
    $passwordd = htmlspecialchars(addslashes(strip_tags($_POST["passwordd"])));
    if (strlen($passwordd) < 6) {
        header('Location: https://loopscards.com?password_refresh=guclusifre');
    } else {
        $query = $conn->prepare("UPDATE users SET passwordd = :passwordd WHERE mail = :mail");
        $update = $query->execute(array("passwordd" => md5($passwordd), "mail" => $mail));
        if ($update) {
            header('Location: https://loopscards.com?password_refresh=basarili');
        } else {
            header('Location: https://loopscards.com?password_refresh=hata');
        }
    }
}
?>

<!--Menu | Head-->
<?php
include("head.php");
?>
<!--Menu | Head-->
<section id="giris" style="margin-top: -50px; padding-bottom: 100px;">
    <!-- üst başlık -->
    <div class="container py-2">
        <div class="row" style="margin-top: 80px;">
            <h1 class="text-center">
                Şifreni Sıfırla
            </h1>
        </div>
    </div>
    <!-- aktivasyon -->
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-4">
                <img src="img/check.svg" class="img-fluid">
            </div>
            <div class="col-11 col-lg-4">
                <form action="" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <input class="form-control" value="<?php print($mail); ?>" disabled type="text" placeholder="E-posta adresiniz">
                            <input class="form-control" value="<?php print($mail); ?>" type="hidden" name="mail">
                        </div>
                        <div class="mb-3">
                            <input class="form-control" type="password" name="passwordd" placeholder="Yeni Şifreniz">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="password_refresh" value="Şifreni Sıfırla" class="btn w-100 btn-primary">
                                Şifreni Sıfırla
                            </button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <!-- aktivasyon -->
</section>
<!--Footer-->
<?php
include("footer.php");
?>
<!--Footer-->