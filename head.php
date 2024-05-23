<?php
session_start();
require_once("php/conn.php");

$where_mail = "";
if (isset($_SESSION["mail"]) && !empty($_SESSION["mail"])) {
    $where_mail = trim(addslashes($_SESSION["mail"]));
}

// Veritabanından kullanıcı bilgilerini getirir
$query = $conn->query("SELECT * FROM users WHERE mail = '{$where_mail}'")->fetch(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="tr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Description" content="Loops Cards ile dijital kartvizit dünyasına hoşgeldiniz.">
    <meta name="Keywords" content="Loops Cards, Loops, Cards, Dijital Kart, Kartvizit">
    <meta http-equiv="content-language" content="tr">
    <meta name="google-site-verification" content="" />
    <meta name="robots" content="noindex,nofollow">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap 5 icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!--Swiper CSS-->
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <!-- SweetAlert JS -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Main CSS -->
    <link rel="stylesheet" href="css/main.css">
    <link rel="shortcut icon" type="image/x-icon" href="img/card-ico.ico" />
    <title>Loops Cards | Dijital Kartınız</title>
</head>

<body>

    <!-- menu -->
    <nav class="navbar navbar-expand-lg fixed-top bg-dark navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand mx-auto ps-5 d-flex align-items-center" href="#">
                <img src="img/logo.png" width="200" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list-nested"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav mx-auto text-center my-2 my-lg-0 navbar-nav-scroll">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php#">Anasayfa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">Hakkımızda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#card-properties">Loops Card</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Satın Al</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#detail">Nasıl Kullanılır</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#question">S.S.S</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">İletişim</a>
                    </li>
                </ul>
                <form class="d-flex gap-2 justify-content-around">
                    <?php
                    if (!isset($_SESSION["mail"])) { ?>
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle d-flex align-items-center" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-lines-fill fs-5 me-2"></i>
                                <span>
                                    Kullanıcı İşlemleri
                                </span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#register">
                                        <i class="bi bi-person-plus-fill fs-5 me-2"></i>
                                        <span>
                                            Kayıt Ol
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" type="button" data-bs-toggle="modal" data-bs-target="#login">
                                        <i class="bi bi-person-circle fs-5 me-2"></i>
                                        <span>
                                            Giriş Yap
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                </form>
            <?php } else { ?>
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle d-flex align-items-center" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-fill fs-5 me-2"></i>
                        <span>
                            <?= ucfirst($query["full_name"]) ?> | Profil Ayarları
                        </span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="userspanel/profile.php?mod=user">
                                <i class="bi bi-person fs-5 me-2"></i>
                                <span>
                                    Profilim
                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="userspanel/php/logout.php">
                                <i class="bi bi-box-arrow-left fs-5 me-2"></i>
                                <span>
                                    Çıkış Yap
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            <?php } ?>

            </div>
        </div>
    </nav>
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
                                <img src="img/login.svg" class="img-fluid">
                            </div>
                            <div class="col-md-7 col-12">
                                <div class="py-4 d-flex flex-column justify-content-center align-items-center">
                                    <form method="post" action="php/login.php">
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
                                <img src="img/password.svg" class="img-fluid">
                            </div>
                            <div class="col-md-7 col-12">
                                <div class="py-4 d-flex flex-column justify-content-center align-items-center">
                                    <form method="post" action="php/password.php">
                                        <div class="mb-3 w-100">
                                            <label for="mail" class="form-label mb-3 fs-5">Mail Adresiniz</label>
                                            <div class="form-focus">
                                                <input class="form-control" id="mail" required name="mail" type="email" placeholder="Mail adresinizi buraya yazın">
                                                <span class="focus-span">Gmail </span>
                                            </div>
                                        </div>
                                        <button type="submit" name="password" class="btn btn-dark w-100">Gönder</button>
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
    <!-- menu -->
</body>