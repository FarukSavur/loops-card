<img src="img/footer-wawes.png" width="100%" style="margin-bottom: -10px;">
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
                <img src="img/card/footer-title.png" class="img-fluid d-none d-lg-block">
                <img src="img/card/footer-smart.png" class="img-fluid w-75 d-none d-lg-block">
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
                <img src="img/kredikartı.png" class="w-25 d-none d-md-block" alt="">
            </div>
            <div class="col-12 d-block d-sm-none pb-3">
                <center>
                    <img src="img/kredikartı.png" class="w-100" alt="">
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
    var swiper = new Swiper(".swiper", {
        slidesPerView: "auto",
        centeredSlides: true,
        spaceBetween: 5,
        loop: true,
        grabCursor: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        keyboard: {
            enabled: true,
            onlyInViewport: false,
        },
        effect: 'coverflow',
        coverflowEffect: {
            rotate: 35,
            slideShadows: false,
        },
        // mousewheel: {
        //     invert: true,
        // }, mouse da sıkıntı çıkartıyor
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: '.swiper-pagination',
            type: 'bullets',
            dynamicBullets: true,
        },
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
if (isset($_GET["register"])) {
    if ($_GET["register"] == "password") {
        print('<script> swal("Güvenliğin Önemli!", "Hesabının güvenliği için daha güçlü bir şifre deneyebilirsin.", "info");</script>');
    }
    if ($_GET["register"] == "mailfull") {
        print('<script> swal("Mail Kullanımda", "Girmiş olduğun mail adresi farklı bir kullanıcı tarafından kullanımda. Farklı bir mail adresi deneyebilirsin.", "info");</script>');
    }
    if ($_GET["register"] == "ok") {
        print('<script> swal("İşlem Başarılı", "Kaydınız başarıyla yapıldı. Loops Card Ailesine Hoşgeldin. Mail hesabına göndermiş olduğumuz bağlantıdan hesabını aktifleştirebilirsin.", "success");</script>');
    }
    if ($_GET["register"] == "no") {
        print('<script> swal("İşlem Yapılamadı!", "Kaydınız yapılırken bir hata oluştu. Lütfen bilgileri kontrol ederek tekrar deneyin.", "error");</script>');
    }
    if ($_GET["register"] == "mail") {
        print('<script> swal("Az önce ne oldu!", "Az önce ne olduğu hakkında bir fikrin var mı?.", "info");</script>');
    }
    if ($_GET["register"] == "KodYadaMailHatali") {
        print('<script> swal("Kod yada Mail Hatalı", "Aktivasyon kodu yada mail hatalı size gönderilen bağlantıya tekrar tıklayın.", "info");</script>');
    }
    if ($_GET["register"] == "aktive") {
        print('<script> swal("İşlem Başarılı", "Hesabınız başarıyla aktive edildi.", "success");</script>');
    }
    if ($_GET["register"] == "aktivehata") {
        print('<script> swal("İşlem Yapılamadı", "Hesabınız aktifleştirilirken bir hata oluştu.", "info");</script>');
    }
    if ($_GET["register"] == "gender") {
        print('<script> swal("İşlem Yapılamadı", "Lütfen cinsiyet alanında seçiminizi yapın. Bu bilgiler sizden izinsiz diğer kullanıcılar ile paylaşılmayacaktır.", "info");</script>');
    }
}

if (isset($_GET["login"])) {
    if ($_GET["login"] == "onaylanmamis") {
        print('<script> swal("Onaylanmamış Hesap!", "Lütfen sana gönderdiğimiz bağlantıdan hesabını onayla.", "info");</script>');
    }
    if ($_GET["login"] == "hesapkapatilmistir") {
        print('<script> swal("Hesabınız Kapatılmıştır!", "Sistemin ve diğer kullanıcıların güvenliği için hesabınız kapatılmıştır. Bir sorun olduğunu düşünüyorsanız bizimle iletişime geçin.", "error");</script>');
    }
    if ($_GET["login"] == "Hatali") {
        print('<script> swal("Mail yada Şifre Hatalı", "Mail adresini ve şifreni kontol ederek tekrar giriş yap.", "info");</script>');
    }
    if ($_GET["login"] == "GirisYapin") {
        print('<script> swal("Önce Giriş Yapın", "Sisteme giriş yapabilmek için gerekli alanları doldurun.", "info");</script>');
    }
    if ($_GET["login"] == "cikisyapildi") {
        print('<script> swal("Çıkış Yapıldı", "Hesabınız güvenli bir şekilde kapatıldı.", "success");</script>');
    }
}

if (isset($_GET["password_refresh"])) {
    if ($_GET["password_refresh"] == "hatalimail") {
        print('<script> swal("İşlem Yapılamadı", "Hatalı bir mail gönderildi.", "info");</script>');
    }
    if ($_GET["password_refresh"] == "hata") {
        print('<script> swal("İşlem Yapılamadı", "Güncelleme yapılırken bir hata oluştu.", "info");</script>');
    }
    if ($_GET["password_refresh"] == "guclusifre") {
        print('<script> swal("İşlem Yapılamadı", "Daha güçlü bir şifre deneyin.", "info");</script>');
    }
    if ($_GET["password_refresh"] == "kullanicibulunamadi") {
        print('<script> swal("İşlem Yapılamadı", "Kullanıcı bulunamadı, Bilgilerinizi kontrol ederek tekrar deneyin.", "info");</script>');
    }
    if ($_GET["password_refresh"] == "mailbulunamadi") {
        print('<script> swal("İşlem Yapılamadı", "Kullanıcı bulunamadı, Bilgilerinizi kontrol ederek tekrar deneyin.", "info");</script>');
    }
    if ($_GET["password_refresh"] == "basarili") {
        print('<script> swal("İşlem Başarılı", "Güncelleme başarılı. Şifreniz sıfırlandı.", "success");</script>');
    }
    if ($_GET["password_refresh"] == "mailgonderildi") {
        print('<script> swal("İşlem Başarılı", "Mail hesabınıza gönderildi. Bağlantıyı takip ederek şifrenizi sıfırlayabilirsiniz.", "success");</script>');
    }
}

?>
</body>

</html>