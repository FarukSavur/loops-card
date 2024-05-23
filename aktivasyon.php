<?php
ob_start();
include("php/conn.php");

$mail = htmlspecialchars(addslashes(strip_tags($_GET["mail"])));
$code = htmlspecialchars(addslashes(strip_tags($_GET["code"])));

$user = $conn->query("SELECT * FROM users WHERE mail = '{$mail}'  ")->fetch(PDO::FETCH_ASSOC);
if ($user <= 0) {
    header('Location: https://loopscards.com?register=KodYadaMailHatali');
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
                Hesabını Aktifleştir
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
                <form action="php/active.php" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <input class="form-control" value="<?php print($mail); ?>" disabled type="text" placeholder="E-posta adresiniz">
                            <input class="form-control" value="<?php print($mail); ?>" type="hidden" name="mail">
                        </div>
                        <div class="mb-3">
                            <input class="form-control" value="<?php print($code); ?>" disabled type="text" placeholder="Aktivasyon Kodu">
                            <input class="form-control" value="<?php print($code); ?>" type="hidden" name="aktivasyon_kodu">

                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="aktivasyon" value="Aktive et" class="btn w-100 btn-primary">
                                Aktive Et
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