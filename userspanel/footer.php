<footer id="contact">
    <div class="container-fluid bg-dark">
        <div class="row py-4">
            <div class="col-lg-4 col-12 fast-link mt-3 border-end border-light">
                <h4>Hızlı Link</h4>
                <a href="#">
                    <span>Kayıt Ol</span>
                </a>
                <a href="#">
                    <span>Giriş Yap</span>
                </a>
                <a href="#">
                    <span>Anasayfa</span>
                </a>
                <a href="#">
                    <span>Şipariş Ver</span>
                </a>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-2 p-4 d-flex align-items-center justify-content-between flex-column">
                <img src="../img/card/footer-title.png" class="img-fluid d-none d-lg-block">
                <img src="../img/card/footer-smart.png" class="img-fluid w-75 d-none d-lg-block">
                <!-- TOP TO SCROOLL -->
                <a href="#" id="myBtn" class="d-none d-lg-block">
                    <div class="top-to" data-bs-toggle="tooltip" data-bs-placement="top" title="Yukarı Çık">
                        <i class="bi bi-arrow-up-circle"></i>
                    </div>
                </a>
                <!-- TOP TO SCROOLL -->
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-4 border-start border-light col-12 contact mt-3">
                <h4>İletişim Bilgileri</h4>
                <a href="#">
                    <span>0 555 555 55 55</span>
                </a>
                <a href="#">
                    <span>0 850 850 35 35</span>
                </a>
                <a href="#">
                    <span>info@loopscard.com</span>
                </a>
                <a href="#">
                    <span>İzmir / Kemalpaşa Mh. Cd. Sk. </span>
                </a>
            </div>
        </div>
        <div class="row pt-4">
            <div class="col-12 social gap-3">
                <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Facebook">
                    <i class="bi bi-facebook"></i>
                </a>
                <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Google">
                    <i class="bi bi-google"></i>
                </a>
                <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Instagram">
                    <i class="bi bi-instagram"></i>
                </a>
                <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Twitter">
                    <i class="bi bi-twitter"></i>
                </a>
                <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Whatsapp">
                    <i class="bi bi-whatsapp "></i>
                </a>
            </div>
            <div class="col-12 mt-3 mb-3 d-flex align-items-center justify-content-around">
                <p class="text-light text-center fs-5">
                    © Tüm Hakları Saklıdır. | Loops Card
                </p>
                <img src="../img/kredikartı.png" class="w-25 d-none d-md-block" alt="">
            </div>
            <div class="col-12 d-block d-sm-none pb-3">
                <center>
                    <img src="../img/kredikartı.png" class="w-100" alt="">
                </center>
            </div>
        </div>
    </div>
</footer>

</body>

<!--Swiper JS-->
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js "></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js " integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n " crossorigin="anonymous "></script>

<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip "]').tooltip();
    });
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    $(".reveal ").on('click', function() {
        var $pwd = $(".pwd ");
        if ($pwd.attr('type') === 'password') {
            $pwd.attr('type', 'text');
        } else {
            $pwd.attr('type', 'password');
        }
    });
</script>

<?php
if (isset($_GET["login"])) {
    if ($_GET["login"] == "Basarili") {
        print('<script> swal("Giriş Başarılı", "Sisteme başarıyla giriş yaptınız.", "success");</script>');
    }
}


if (isset($_GET["update"])) {
    if ($_GET["update"] == "Basarili") {
        print('<script> swal("Güncelleme Başarılı", "Bilgileriniz başarıyla güncellenmiştir.", "success");</script>');
    }
    if ($_GET["update"] == "Hata") {
        print('<script> swal("Güncelleme Yapılamadı", "Bilgileriniz güncellenirken bir hata oluştu.", "info");</script>');
    }
}

if (isset($_GET["images"])) {
    if ($_GET["images"] == "Basarili") {
        print('<script> swal("Resim Güncellendi", "İşleminiz başarıyla yapıldı.", "success");</script>');
    }
    if ($_GET["images"] == "Hata") {
        print('<script> swal("Resim Güncellenemedi", "İşleminiz yapılırken bir hata oluştu lütfen tekrar deneyin.", "info");</script>');
    }
    if ($_GET["images"] == "Hata2") {
        print('<script> swal("Dosya Taşınamadı", "İşleminiz yapılırken bir hata oluştu lütfen tekrar deneyin.", "info");</script>');
    }
    if ($_GET["images"] == "Boyut") {
        print('<script> swal("Büyük Boyut", "İşleminiz yapılırken bir hata oluştu, dosya boyutunuz maksimum 5 MB olmalıdır.", "info");</script>');
    }
    if ($_GET["images"] == "Uzanti") {
        print('<script> swal("Yanlış Uzantı", "İşleminiz yapılırken bir hata oluştu, dosya uzantınız PNG, JPG yada GIF olmalıdır.", "info");</script>');
    }
}
?>

</html>