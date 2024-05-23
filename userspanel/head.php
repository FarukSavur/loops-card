<?php
ob_start();
session_start();
require_once("php/conn.php");

if (!isset($_SESSION["mail"])) {
    header("Location:https://loopscards.com/?login=GirisYapin");
}
$url = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$url1 = "https://loopscards.com/userspanel/profile.php?update=Basarili";
$url2 = "https://loopscards.com/userspanel/profile.php?update=Hata";
$url3 = "https://loopscards.com/userspanel/profile.php";

if ($url == $url1 || $url == $url2 || $url == $url3) {
    header("Location:https://loopscards.com/userspanel/profile.php?mod=user");
}


$where_mail = trim(addslashes($_SESSION["mail"]));
//genel bilgiler
$query = $conn->query("SELECT * FROM users WHERE mail = '{$where_mail}'")->fetch(PDO::FETCH_ASSOC);

$id_search = $query["id"];
//sosyal hesaplar
$social_query = $conn->query("SELECT * FROM social WHERE userr_id = $id_search")->fetch(PDO::FETCH_ASSOC);
//iletişim bilgileri
$contact_query = $conn->query("SELECT * FROM contact WHERE userr_id = $id_search")->fetch(PDO::FETCH_ASSOC);

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
    <link rel="stylesheet" href="css/main.css">
    <link rel="shortcut icon" type="image/x-icon" href="../img/user.ico" />
    <title>Kullanıcı Paneli | <?= ucwords($query["full_name"]) ?> </title>
</head>
<!-- menu -->
<nav class="navbar navbar-expand-lg fixed-top bg-dark navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand mx-auto ps-5 d-flex align-items-center" href="#">
            <img src="../img/logo.png" width="200" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list-nested"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav mx-auto text-center my-2 my-lg-0 navbar-nav-scroll">
                <li class="nav-item">
                    <a class="nav-link text-white" aria-current="page" href="../index.php#" target="_blank">Anasayfa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../#about">Hakkımızda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../#card-properties" target="_blank">Loops Card</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../#" target="_blank">Satın Al</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../#detail" target="_blank">Nasıl Kullanılır</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../#question" target="_blank">S.S.S</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../#contact" target="_blank">İletişim</a>
                </li>
            </ul>
            <div class="d-flex gap-3 justify-content-around">
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle d-flex align-items-center" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-fill fs-5 me-2"></i>
                        <span>
                            <?= ucwords($query["full_name"]) ?> | Profil Ayarları
                        </span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="profile.php?mod=user">
                                <i class="bi bi-person fs-5 me-2"></i>
                                <span>
                                    Profilim
                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="shopping.php">
                                <i class="bi bi-shop fs-5 me-2"></i>
                                <span>
                                    Sipariş Ver
                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="php/logout.php">
                                <i class="bi bi-box-arrow-left fs-5 me-2"></i>
                                <span>
                                    Çıkış Yap
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
<!-- menu -->
<br><br><br><br>