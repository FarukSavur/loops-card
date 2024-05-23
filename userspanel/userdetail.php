<?php
ob_start();
session_start();
require_once("php/conn.php");

//eğer get yok olarak gelirse yönlendirme bana yapılıyor
$url = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$url1 = "https://loopscards.com/userspanel/userdetail/user/";
if ($url == $url1) {
    header("Location:https://loopscards.com");
}
$where_code = trim(addslashes($_GET["user"]));
//genel bilgiler
$query = $conn->query("SELECT * FROM users WHERE activation_code = '{$where_code}'")->fetch(PDO::FETCH_ASSOC);

$biography = $query["biography"];
if ($biography == "biyografiniz" || strlen($biography) < 3) {
    $name = explode(" ", $query["full_name"]);
    $biography = $name[0] . " " . "henüz biyografisini eklemedi.";
}

$id_search = $query["id"];
//sosyal hesaplar
$social_query = $conn->query("SELECT * FROM social WHERE userr_id = $id_search")->fetch(PDO::FETCH_ASSOC);
//iletişim bilgileri
$contact_query = $conn->query("SELECT * FROM contact WHERE userr_id = $id_search")->fetch(PDO::FETCH_ASSOC);



//social'dan gelen bilgiler ile bağlantı oluşturma
if (strlen($social_query["facebook"]) > 2) {
    $facebook = "https://www.facebook.com/" . $social_query["facebook"];
} else {
    $facebook = "#";
}
if (strlen($social_query["instagram"]) > 2) {
    $instagram = "https://www.instagram.com/" . $social_query["instagram"];
} else {
    $instagram = "#";
}
if (strlen($social_query["snapchat"]) > 2) {
    $snapchat = "https://www.snapchat.com/add/" . $social_query["snapchat"];
} else {
    $snapchat = "#";
}
if (strlen($social_query["twitter"]) > 2) {
    $twitter = "https://www.twitter.com/" . $social_query["twitter"];
} else {
    $twitter = "#";
}
if (strlen($social_query["linkedin"]) > 2) {
    $linkedin = "https://www.linkedin.com/in/" . $social_query["linkedin"];
} else {
    $linkedin = "#";
}

//contact'tan gelen bilgiler ile bağlantı oluşturma
if (strlen($contact_query["whatsapp"]) > 2) {
    $whatsapp = "https://api.whatsapp.com/send?phone=+9" . $contact_query["whatsapp"] . "&text=Merhaba Loops Card ile size ulaştım.";
} else {
    $whatsapp = "#";
}
if (strlen($contact_query["numbers"]) > 2) {
    $number = "tel:+9" . $contact_query["numbers"];
} else {
    $number = "#";
}
if (strlen($query["mail"]) > 2) {
    $mail = "mailto:" . $query["mail"];
} else {
    $mail = "#";
}

//whatsapp paylaşma linki
$whatsapp_link = "whatsapp://send?text=https://loopscards.com/userspanel/userdetail/user/" . $where_code;
//site varsa
if (strlen($contact_query["sites"]) > 7) {
    $sites = $contact_query["sites"];
    $link_site = $contact_query["sites"];
    $rest = substr($link_site, 0, 4);
    if ($rest != "http") {
        $link_site = "http://" . $link_site;
    }
} else {
    $sites = "henüz site eklemedi";
    $link_site = "#";
}

//adres varsa 
if (strlen($contact_query["adress"]) < 5) {
    $name = explode(" ", $query["full_name"]);
    $adress = ucfirst($name[0]) . " henüz adres eklemedi.";
} else {
    $adress = $contact_query["adress"];
    //adres uzunsa sadece adres görünmesi için
    $adress_lenght = strlen($adress);
    if ($adress_lenght > 34) {
        $h6 = "";
    } else {
        $h6 = "<h6> Adres </h6>";
    }
}

//rehber oluşturup kaydetme. yeni bilgiler loading :)
if (!empty($contact_query["numbers"])) {
    $number_cvs = $contact_query["numbers"];
    $fullname_cvs = $query["full_name"];
    $dicectory_content =
        "
BEGIN:VCARD
VERSION:3.0
FN:$fullname_cvs
TEL;TYPE=CELL:$number_cvs
END:VCARD
";
    $user_name_create = str_replace(" ", "-", $query["full_name"]);
    $user_name_create = strtolower($user_name_create . "-" . $query["id"] . ".vcf");
    //o kişinin dosyası var mı?
    $control = file_exists("directory/" . $user_name_create);
    if (!$control) {
        //o kişiye directory/ altında dosya oluşturma
        $create_file =  touch('directory/' . $user_name_create);
        if ($create_file) {
            $file_open = fopen("directory/" . $user_name_create, "a+");
            fwrite($file_open, trim($dicectory_content));
            //print("dosya oluşturuldu.");
        } //else {
        //  print("hata");
        //}
    }
    $download_link_cvf = "directory/" . $user_name_create;
} else {
    $download_link_cvf = "#";
}
?>

<!doctype html>
<html lang="tr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap 5 icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!--Swiper CSS-->
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <!-- SweetAlert JS -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Main CSS -->
    <link rel="stylesheet" href="https://loopscards.com/userspanel/css/userdetail1.css">
    <link rel="shortcut icon" type="image/x-icon" href="https://loopscards.com/img/user.ico" />
    <title>Kullanıcı Profili | <?= ucwords($query["full_name"]) ?> </title>
</head>

<body class="bg-dark">
    <!-- Modal Register -->
    <div class="modal fade" id="register" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header bg-dark border-0 p-2">
                    <h5 class="modal-title text-white d-flex align-items-center" id="exampleModalLabel">
                        <i class="bi bi-person-check fs-4 me-2"></i>Kayıt ol
                    </h5>
                    <div class="nav-close-btn">
                        <i class="bi bi-x-lg text-light fs-6" style="cursor: pointer;" data-bs-dismiss="modal" aria-label="Close" data-bs-toggle="tooltip" data-bs-placement="left" title="Kapat"></i>
                    </div>
                </div>
                <div class="modal-body p-0">
                    <div class="container">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-md-5 d-none d-md-block">
                                <img src="../img/register.svg" class="img-fluid">
                            </div>
                            <div class="col-md-7 col-12">
                                <div class="py-4 d-flex flex-column justify-content-center align-items-center">
                                    <form action="../php/register.php" method="post">
                                        <div class="mb-3 w-100">
                                            <label for="mail" class="form-label mb-3 fs-5">Adınız ve Soyadınız:</label>
                                            <div class="form-focus">
                                                <input class="form-control" id="full_name" required autocomplete="off" name="full_name" type="text" placeholder="Adınız ve soyadınızı bu alana yazın">
                                                <span class="focus-span">Adınız ve Soyadınız </span>
                                            </div>
                                        </div>
                                        <div class="mb-3 w-100">
                                            <label for="mail" class="form-label mb-3 fs-5">Mail Adresiniz:</label>
                                            <div class="form-focus">
                                                <input class="form-control" id="mail" required name="mail" type="email" placeholder="Mail adresinizi bu alana yazın">
                                                <span class="focus-span">Gmail </span>
                                            </div>
                                        </div>
                                        <div class="mb-3 w-100">
                                            <label for="pass" class="form-label mb-3 fs-5">Şifreniz:</label>
                                            <div class="form-focus d-flex">
                                                <div class="flex-fill">
                                                    <input type="password" name="password" required class="form-control pwd" id="pass" placeholder="Şifrenizi bu alana yazın">
                                                    <span class="focus-span">Şifre</span>
                                                </div>
                                                <span class="input-group-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Göster / Gizle">
                                                    <button class="btn btn-light btn-lg reveal" type="button">
                                                        <i class="bi bi-eye-fill"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label class="mb-2 fs-5"> Cinsiyetiniz</label>
                                            <br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="gender-e" value="erkek">
                                                <label class="form-check-label" for="gender-e">Erkek</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="gender-k" value="kadın">
                                                <label class="form-check-label" for="gender-k">Kadın</label>
                                            </div>
                                        </div>
                                        <button type="submit" name="register" class="btn btn-dark w-100">Kayıt Ol</button>
                                        <p class="fw-light align-self-start mt-3 modal-font">
                                            Hesabın var mı?
                                            <a href="#" class="text-decoration-none" data-bs-dismiss="modal" aria-label="Close" data-bs-toggle="modal" data-bs-target="#login">
                                                buradan
                                            </a> giriş yapabilirsin.
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Register -->
    <!-- Modal Login -->
    <div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header bg-dark border-0 p-2">
                    <h5 class="modal-title text-white d-flex align-items-center" id="exampleModalLabel">
                        <i class="bi bi-person-check fs-4 me-2"></i>Giriş Yap
                    </h5>
                    <div class="nav-close-btn">
                        <i class="bi bi-x-lg text-light fs-6" style="cursor: pointer;" data-bs-dismiss="modal" aria-label="Close" data-bs-toggle="tooltip" data-bs-placement="left" title="Kapat"></i>
                    </div>
                </div>
                <div class="modal-body p-0">
                    <div class="container">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-md-5 d-none d-md-block">
                                <img src="../img/login.svg" class="img-fluid">
                            </div>
                            <div class="col-md-7 col-12">
                                <div class="py-4 d-flex flex-column justify-content-center align-items-center">
                                    <form method="post" action="../php/login.php">
                                        <div class="mb-3 w-100">
                                            <label for="mail" class="form-label mb-3 fs-5">Mail Adresiniz</label>
                                            <div class="form-focus">
                                                <input class="form-control" id="mail" required name="mail" type="email" placeholder="Mail adresinizi buraya yazın">
                                                <span class="focus-span">Gmail </span>
                                            </div>
                                        </div>
                                        <div class="mb-3 w-100">
                                            <label for="pass" class="form-label mb-3 fs-5">Şifreniz</label>
                                            <div class="form-focus d-flex">
                                                <div class="flex-fill">
                                                    <input type="password" name="passwordd" required class="form-control pwd" id="pass" placeholder="Şifrenizi buraya yazın">
                                                    <span class="focus-span">Şifre</span>
                                                </div>
                                                <span class="input-group-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Göster / Gizle">
                                                    <button class="btn btn-light btn-lg reveal" type="button">
                                                        <i class="bi bi-eye-fill"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                        <button type="submit" name="login" class="btn btn-dark w-100">Giriş Yap</button>
                                        <p class="fw-light align-self-start mt-3 modal-font">
                                            Şifreni mi unuttun
                                            <a href="#" class="text-decoration-none" data-bs-dismiss="modal" aria-label="Close" data-bs-toggle="modal" data-bs-target="#password">
                                                buradan
                                            </a> sıfırlayabilirsin.
                                        </p>
                                        <p class="fw-light align-self-start mt-3 modal-font">
                                            Hesabın yok mu?
                                            <a href="#" class="text-decoration-none" data-bs-dismiss="modal" aria-label="Close" data-bs-toggle="modal" data-bs-target="#register">
                                                buradan
                                            </a> oluşturabilirsin.
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Login -->
    <!-- Modal Refresh Password -->
    <div class="modal fade" id="password" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header bg-dark border-0 p-2">
                    <h5 class="modal-title text-white d-flex align-items-center" id="exampleModalLabel">
                        <i class="bi bi-person-check fs-4 me-2"></i>Şifreni sıfırla
                    </h5>
                    <div class="nav-close-btn">
                        <i class="bi bi-x-lg text-light fs-6" style="cursor: pointer;" data-bs-dismiss="modal" aria-label="Close" data-bs-toggle="tooltip" data-bs-placement="left" title="Kapat"></i>
                    </div>
                </div>
                <div class="modal-body p-0">
                    <div class="container">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-md-5 d-none d-md-block">
                                <img src="../img/password.svg" class="img-fluid">
                            </div>
                            <div class="col-md-7 col-12">
                                <div class="py-4 d-flex flex-column justify-content-center align-items-center">
                                    <form method="GET">
                                        <div class="mb-3 w-100">
                                            <label for="mail" class="form-label mb-3 fs-5">Mail Adresiniz</label>
                                            <div class="form-focus">
                                                <input class="form-control" id="mail" required autocomplete="off" name="mail" type="email" placeholder="Mail adresinizi buraya yazın">
                                                <span class="focus-span">Gmail </span>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-dark w-100">Gönder</button>
                                        <p class="fw-light align-self-start mt-3 modal-font">
                                            İşlemini tamamladıysan
                                            <a href="#" class="text-decoration-none" data-bs-dismiss="modal" aria-label="Close" data-bs-toggle="modal" data-bs-target="#login">
                                                buradan
                                            </a> giriş yapabilirsin.
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Refresh Password -->

    <!-- Modal Favorite Users -->
    <div class="modal fade" id="favori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header bg-dark border-0 p-2">
                    <h5 class="modal-title text-white d-flex align-items-center" id="exampleModalLabel">
                        <i class="bi bi-person-check fs-4 me-2"></i>Favorilere Ekle
                    </h5>
                    <div class="nav-close-btn">
                        <i class="bi bi-x-lg text-light fs-6" style="cursor: pointer;" data-bs-dismiss="modal" aria-label="Close" data-bs-toggle="tooltip" data-bs-placement="left" title="Kapat"></i>
                    </div>
                </div>
                <div class="modal-body p-0 py-3 my-3">
                    <div class="container">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-md-6 col-12">
                                <img src="../img/favorite.svg" class="img-fluid">
                            </div>
                            <div class="col-md-6 col-12 mt-3">
                                <div class="d-flex flex-column justify-content-center align-items-center">
                                    <form method="GET">
                                        <div class="mb-3" style="width: 340px;">
                                            <label for="mail" class="form-label mb-3 fs-5">Sisteme Kayıtlı Mail Adresiniz</label>
                                            <div class="form-focus">
                                                <input class="form-control" id="mail" required autocomplete="off" name="mail" type="email" placeholder="Mail adresinizi buraya yazın">
                                                <span class="focus-span">Gmail </span>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-dark w-100">Gönder</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Favorite Users -->
    <!-- menu -->
    <nav class="navbar navbar-expand-lg fixed-top bg-dark navbar-dark" style="background-color: black!important;">
        <div class="container">
            <a href="https://loopscards.com/#" target="blank" class="navbar-brand mx-auto d-flex flex-column justify-content-center align-items-center">
                <img src="https://loopscards.com/img/logo.png" width="200" alt="">
                <img src="https://loopscards.com/img/card/card-p.png" width="180" alt="">
            </a>
        </div>
    </nav>
    <!-- menu -->
    <br><br><br><br><br>

    <section id="user_detail" class="p-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4 col-12 px-3 pb-2">
                    <div class="user-img-detail d-flex align-items-end justify-content-center">
                        <div style="background: url('https://loopscards.com/userspanel/<?= $query["img"] ?>'); background-position: center center;background-size: cover;"></div>
                    </div>
                </div>
                <div class="col-lg-4"></div>
            </div>
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-12 col-lg-4 text-center px-3">
                    <h3><?= ucfirst($query["full_name"]) ?></h3>
                    <div class="buttons d-flex justify-content-around">
                        <a href="<?= $whatsapp_link ?>" target="blank" data-bs-toggle="tooltip" data-bs-placement="left" title="Paylaş" class="btn btn-outline-primary px-5 rounded-pill">
                            Paylaş
                        </a>
                        <a href="#" class="btn btn-outline-light rounded-pill" data-bs-toggle="tooltip" data-bs-placement="right" title="Giriş Yap">
                            <div style="width: 120px;" data-bs-toggle="modal" data-bs-target="#login">Giriş Yap</div>
                        </a>
                    </div>
                    <hr class="w-100 bg-dark mx-auto">
                </div>
                <div class="col-lg-4"></div>
            </div>
            <div class="row actions">
                <div class="col-lg-4"></div>
                <div class="col-lg-4 col-12 p-3">
                    <h4>İletişim Bilgileri</h4>
                    <div class="icons">
                        <div class="item">
                            <a class="bg-primary" href="<?= $number ?>" target="blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Arama">
                                <i class="bi bi-telephone-outbound"></i>
                            </a>
                            <span>
                                Ara
                            </span>
                        </div>
                        <div class="item">
                            <a class="bg-success" href="<?= $whatsapp ?>" target="blank" data-bs-toggle="tooltip" data-bs-placement="top" title="WhatsApp">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                            <span>
                                Whatsapp
                            </span>
                        </div>
                        <div class="item">
                            <a class="bg-warning" href="<?= $mail ?>" target="blank" data-bs-toggle="tooltip" data-bs-placement="top" title="E-posta">
                                <i class="bi bi-envelope"></i>
                            </a>
                            <span>
                                E-posta
                            </span>
                        </div>
                        <div class="item">
                            <a href="<?= $download_link_cvf ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Rehbere Kaydet" style="background-color: black;">
                                <i class="bi bi-person-rolodex"></i>
                            </a>
                            <span>
                                Kaydet
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4"></div>
            </div>
            <div class="row biography">
                <div class="col-lg-4"></div>
                <div class="col-lg-4 col-12 px-3 pt-3">
                    <h4>Biyografi</h4>
                    <p>
                        <?= ucfirst($biography) ?>
                    </p>
                </div>
                <div class="col-lg-4"></div>
            </div>
            <div class="row ui-social">
                <div class="col-lg-4"></div>
                <div class="col-lg-4 col-12 p-3">
                    <h4>Sosyal Hesaplar</h4>
                    <div class="social-item">
                        <a href="<?= $facebook ?>" target="blank" data-bs-toggle="tooltip" data-bs-placement="left" title="Facebook">
                            <div class="icon bg-primary">
                                <i class="bi bi-facebook"></i>
                            </div>
                        </a>
                        <div class="social-text">
                            <h6>Facebook</h6>
                            <p>
                                <a href="<?= $facebook ?>" target="blank">
                                    <?= $facebook == "#" ? "Facebook bağlantısı bulunamadı." : "facebook.com/" . "<b>" .  $social_query["facebook"] . "</b>" ?>
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="social-item">
                        <a href="<?= $instagram ?>" target="blank" data-bs-toggle="tooltip" data-bs-placement="left" title="Instagram">
                            <div class="icon bg-danger">
                                <i class="bi bi-instagram"></i>
                            </div>
                        </a>
                        <div class="social-text">
                            <h6>Instagram</h6>
                            <p>
                                <a href="<?= $instagram ?>" target="blank">
                                    <?= $instagram == "#" ? "Instagram bağlantısı bulunamadı." : "instagram.com/" . "<b>" .  $social_query["instagram"] . "</b>" ?>
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="social-item">
                        <a href="<?= $twitter ?>" target="blank" data-bs-toggle="tooltip" data-bs-placement="left" title="Twitter">
                            <div class="icon bg-info">
                                <i class="bi bi-twitter"></i>
                            </div>
                        </a>
                        <div class="social-text">
                            <h6>Twitter</h6>
                            <p>
                                <a href="<?= $twitter ?>" target="blank">
                                    <?= $twitter == "#" ? "Twitter bağlantısı bulunamadı." : "twitter.com/" . "<b>" .  $social_query["twitter"] . "</b>" ?>
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="social-item">
                        <a href="<?= $snapchat ?>" target="blank" data-bs-toggle="tooltip" data-bs-placement="left" title="Snapchat">
                            <div class="icon bg-warning">
                                <i class="bi bi-snapchat"></i>
                            </div>
                        </a>
                        <div class="social-text">
                            <h6>Snapchat</h6>
                            <p>
                                <a href="<?= $snapchat ?>" target="blank">
                                    <?= $snapchat == "#" ? "Snapchat bağlantısı bulunamadı." : "snapchat.com/" . "<b>" .  $social_query["snapchat"] . "</b>" ?>
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="social-item">
                        <a href="<?= $linkedin ?>" target="blank" data-bs-toggle="tooltip" data-bs-placement="left" title="Linkedln">
                            <div class="icon bg-primary">
                                <i class="bi bi-linkedin"></i>
                            </div>
                        </a>
                        <div class="social-text">
                            <h6>Linkedln</h6>
                            <p>
                                <a href="<?= $linkedin ?>" target="blank">
                                    <?= $linkedin == "#" ? "Linkedln bağlantısı bulunamadı." : "linkedin.com/" . "<b>" .  $social_query["linkedin"] . "</b>" ?>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4"></div>
            </div>
            <div class="row additional">
                <div class="col-lg-4"></div>
                <div class="col-lg-4 col-12 p-3">
                    <h4>Ek Bilgiler</h4>
                    <div class="mt-3 adress">
                        <div class="social-item">
                            <a href="<?= $link_site ?>" target="blank" data-bs-toggle="tooltip" data-bs-placement="left" title="Web sayfası">
                                <div class="icon bg-warning">
                                    <i class="bi bi-globe"></i>
                                </div>
                            </a>
                            <div class="social-text">
                                <h6>Web sayfası</h6>
                                <a href="<?= $link_site ?>" target="blank">
                                    <?= $sites ?>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 adress">
                        <div class="social-item">
                            <a href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="Adres">
                                <div class="icon bg-info">
                                    <i class="bi bi-geo-alt"></i>
                                </div>
                            </a>
                            <div class="social-text">
                                <?= $h6 ?>
                                <p>
                                    <?= ucfirst($adress) ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4"></div>
            </div>
        </div>
    </section>
    <br>
    <footer id="contact">
        <div class="container-fluid">
            <div class="row py-2">
                <div class="d-flex align-items-center py-3">
                    <div class="col-12">
                        <p class="text-light text-center m-0">
                            © Tüm Hakları Saklıdır. | Loops Card
                        </p>
                    </div>
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


</html>