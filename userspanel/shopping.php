<?php
require_once("head.php");
?>

<div class="container">
    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-12">
        </div>
    </div>
</div>

<div class="container mt-5 pt-5">
    <div class="row gap-5">
        <div class="col-12 col-lg-6 shopping">
            <h2 class="title" style="font-size: 2.4rem;">
                <?php
                $name = explode(" ", $query["full_name"]);
                print($name[0] . ", " . "Sipariş Oluştur");
                ?>
            </h2>
            <p class="bg-artist">
                Yinelenen bir sayfa içeriğinin okuyucunun dikkatini dağıttığı
                bilinen bir gerçektir. Lorem Ipsum kullanmanın amacı, sürekli
                'buraya metin gelecek, buraya metin gelecek' yazmaya kıyasla
                daha dengeli bir harf dağılımı sağlayarak okunurluğu artırmasıdır.
                Şu anda birçok masaüstü yayıncılık paketi ve web sayfa düzenleyicisi,
                varsayılan mıgır metinler olarak Lorem Ipsum kullanmaktadır.
            </p>
        </div>
        <div class="col-12 col-lg-4 d-flex justify-content-center align-self-start position-relative">
            <div class="card-container">
                <div class="front flex-column d-flex align-items-center justify-content-center">
                    <img class="card-title" src="../img/card/card-title.png" alt="">
                    <img class="card-p" src="../img/card/card-p.png" alt="">
                    <img class="card-logo position-absolute" src="../img/card/card-logo.png" alt="">
                </div>
                <div class="back flex-column d-flex align-items-center justify-content-center">
                    <h1>Faruk Savur</h1>
                    <h6>“Yeni Nesil Dijital Kartınız”</h6>
                    <img src="img/qr-code.png" alt="">
                    <a href="https://loopscards.com" target="blank">loopscards.com</a>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br>

<?php
require_once("footer.php");
?>