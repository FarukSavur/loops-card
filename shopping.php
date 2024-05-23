<?php
require_once("head.php");
?>

<div class="container pt-3">
    <div class="row gap-5 align-items-center">
        <div
            class="col-12 pt-5 col-lg-4 d-flex justify-content-center align-self-start position-relative d-none d-lg-block">
            <div class="card-container" style="margin-top:-20px">
                <div class="front flex-column d-flex align-items-center justify-content-center">
                    <img class="card-title" src="../img/card/card-title.png" alt="">
                    <img class="card-p" src="../img/card/card-p.png" alt="">
                    <img class="card-logo position-absolute" src="../img/card/card-logo.png" alt="">
                </div>
                <div class="back flex-column d-flex align-items-center justify-content-center">
                    <h1><?= $query["full_name"] ?></h1>
                    <h6>“Yeni Nesil Dijital Kartınız”</h6>
                    <img src="img/qr-code.png" alt="">
                    <a href="https://loopscards.com" target="blank">loopscards.com</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 shopping pt-3 mt-5">
            <h2 class="title" style="font-size: 2.4rem;">
                <?php
                    $name = explode(" ", $query["full_name"]);
                    print($name[0] . ", " . "Sipariş Oluştur");
                    ?>
            </h2>
            <p class="bg-artist">
                Sipariş oluşturmak için aşağıdaki formda <span class="badge bg-dark text-light">*</span>
                işareti bulunan alanları doldurabilirsin. Siparişin 2-5 iş günü içerisinde tarafınıza teslim
                ulaştırılacaktır.
                <br>
                <a href="#detail" class="btn btn-outline-info rounded-pill px-3 mt-3">Detayları Görüntüle</a>
            </p>
            <br>
        </div>
    </div>
</div>
<div class="spaces pt-4 d-none d-lg-block">
    <hr class="mt-5 border-0 bg-light">
</div>
<div class="container p-3 mb-3">
    <div class="row shopping-detail justify-content-center px-lg-5">
        <h2> Sipariş Detayları </h2>
        <div class="row row-cols-1 row-cols-md-2 justify-content-center px-lg-5">
            <div class="col mb-3">
                <label for="name" class="form-label">Adınız<span class="badge border border-dark ms-1">*</span></label>
                <input type="text" class="form-control" id="name" placeholder="Loops">
            </div>
            <div class="col mb-3">
                <label for="surname" class="form-label">Soyadınız<span class="badge border border-dark ms-1">*</span></label>
                <input type="text" class="form-control" id="surname" placeholder="Cards">
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-2 justify-content-center px-lg-5">
            <div class="col mb-3">
                <label for="email" class="form-label">Mail Adresiniz<span class="badge border border-dark ms-1">*</span></label>
                <input type="mail" class="form-control" id="email" placeholder="info@loopscards.com">
            </div>
            <div class="col mb-3">
                <label for="tel" class="form-label">İletişim Numaranız<span class="badge border border-dark ms-1">*</span></label>
                <input type="tel" class="form-control" id="tel" placeholder="0 555 555 55 55">
            </div>
        </div>
        <div class="row row-cols-1 justify-content-center px-lg-5">
            <div class="mb-3">
                <label for="adress" class="form-label">Açık Adresiniz<span class="badge border border-dark ms-1">*</span></label>
                <textarea class="form-control" id="adress" rows="3"></textarea>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-6 justify-content-end mb-4 mt-2 px-lg-5 px-4">
            <button class="btn btn-info rounded-pill text-light">Sipariş Oluştur</button>
        </div>
        <div class="row px-lg-5">
            <div class="alert alert-info shop-alert" role="alert">
                <strong>Uyarı:</strong> Yukarıdaki bilgiler iletişim bilgilerinizdir. Kartın üzerinde yer alacak
                bilgilere <a href="#" class="alert-link"><b>Profilim</b></a> menüsünden
                ulaşabilirsiniz.
            </div>
        </div>
    </div>
    <div class="row" id="detail">
        <div class="col-12 col-lg-4 d-flex justify-content-center align-self-start position-relative d-lg-none"
            style="margin-bottom:180px; margin-top:50px">
            <div class="card-container">
                <div class="front flex-column d-flex align-items-center justify-content-center"
                    style="width:330px;height:200px;left:calc(50% - 165px);">
                    <img class="card-title" src="../img/card/card-title.png" style="top:40px; width:300px">
                    <img class="card-p" src="../img/card/card-p.png" style="width:140px">
                    <img class="card-logo position-absolute" src="../img/card/card-logo.png"
                        style="top: 90px;  width: 32px;">
                </div>
                <div class="back flex-column d-flex align-items-center justify-content-center"
                    style="width:330px;height:200px;left:calc(50% - 165px);">
                    <h1><?= $query["full_name"] ?></h1>
                    <h6>“Yeni Nesil Dijital Kartınız”</h6>
                    <a href="https://loopscards.com" target="blank">loopscards.com</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once("footer.php");
?>