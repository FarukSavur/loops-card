<?php
require_once("head.php");
?>
<?php
if (isset($_GET["mod"])) {
    $mod = $_GET["mod"];
    if ($mod != "user" && $mod != "contact" && $mod != "social" && $mod != "image") {
        $mod = "user";
    }
}
//clock
date_default_timezone_set('Europe/Istanbul');
$clock = date('H'); //saat

if ($clock >= 7 && $clock <= 11) {
    $clock = "Günaydın";
} else if ($clock >= 12 && $clock <= 15) {
    $clock = "Tünaydın";
} else if ($clock >= 16 && $clock <= 21) {
    $clock = "İyi Akşamlar";
} else {
    $clock = "İyi Geceler";
}
$link_fast = "https://loopscards.com/userspanel/userdetail/user/" . $query["activation_code"];
if (isset($_POST["user"])) {
    $full_name = trim(addslashes(strip_tags($_POST["full_name"])));
    $mail = trim(addslashes(strip_tags($_POST["mail"])));
    $biography = trim(addslashes(strip_tags($_POST["biography"])));
    $gender = trim(addslashes(strip_tags($_POST["gender"])));

    $query_update = $conn->prepare("UPDATE users SET full_name=:full_name, biography=:biography, mail=:mail, gender=:gender WHERE mail = :mail");
    $update = $query_update->execute(array("full_name" => $full_name, "biography" => $biography, "mail" => $mail, "gender" => $gender, "mail" => $_SESSION["mail"]));
    if ($update) {
        header("Location:https://loopscards.com/userspanel/profile.php?update=Basarili&mod=user");
    } else {
        header("Location:https://loopscards.com/userspanel/profile.php?update=Hata&mod=user");
    }
}
if (isset($_POST["social"])) {
    $facebook = trim(addslashes(strip_tags($_POST["facebook"])));
    $twitter = trim(addslashes(strip_tags($_POST["twitter"])));
    $tiktok = trim(addslashes(strip_tags($_POST["tiktok"])));
    $instagram = trim(addslashes(strip_tags($_POST["instagram"])));
    $linkedin = trim(addslashes(strip_tags($_POST["linkedin"])));
    $snapchat = trim(addslashes(strip_tags($_POST["snapchat"])));

    $userr_id =  trim(addslashes(strip_tags($_POST["userr_id"])));
    $query_update = $conn->prepare("UPDATE social SET facebook=:facebook, twitter=:twitter, tiktok=:tiktok, instagram=:instagram, linkedin=:linkedin, snapchat=:snapchat WHERE userr_id = :userr_id");
    $update = $query_update->execute(array("facebook" => $facebook, "twitter" => $twitter, "tiktok" => $tiktok, "instagram" => $instagram, "linkedin" => $linkedin, "snapchat" => $snapchat, "userr_id" => $userr_id));

    if ($update) {
        header("Location:https://loopscards.com/userspanel/profile.php?update=Basarili&mod=social");
    } else {
        header("Location:https://loopscards.com/userspanel/profile.php?update=Hata&mod=social");
    }
}
if (isset($_POST["contact"])) {
    $whatsapp = trim(addslashes(strip_tags($_POST["whatsapp"])));
    $numbers = trim(addslashes(strip_tags($_POST["numbers"])));
    $adress = trim(addslashes(strip_tags($_POST["adress"])));
    $sites = trim(addslashes(strip_tags($_POST["sites"])));

    $userr_id =  trim(addslashes(strip_tags($_POST["userr_id"])));
    $query_update = $conn->prepare("UPDATE contact SET whatsapp=:whatsapp, numbers=:numbers, adress=:adress, sites=:sites WHERE userr_id = :userr_id");
    $update = $query_update->execute(array("whatsapp" => $whatsapp, "numbers" => $numbers, "adress" => $adress, "sites" => $sites, "userr_id" => $userr_id));

    if ($update) {
        header("Location:https://loopscards.com/userspanel/profile.php?update=Basarili&mod=contact");
    } else {
        header("Location:https://loopscards.com/userspanel/profile.php?update=Hata&mod=contact");
    }
}
if (isset($_FILES['img'])) {
    $dosya_adi = $_FILES['img']['name'];
    $dosya_boyutu = $_FILES['img']['size'];
    $gecici_yol = $_FILES['img']['tmp_name'];
    $dosta_tipi = $_FILES['img']['type'];
    $uzanti = strtolower(end(explode('.', $_FILES['img']['name'])));
    //kullanıcının adını ve soyadını düzenleme
    $kullanici_adi = strtolower(str_replace(" ", "_", $query["full_name"]));

    //yanlış uzantı içeren bir resim yada dosya gönderildi. :/
    if ($uzanti == "jpg" || $uzanti == "png" || $uzanti == "gif" || $uzanti == "jpeg") {
        //geçerli dosya boyutu 7 mb olmalıdır
        $gecerlidosyaboyutu = (1024 * 1024 * 7);
        if ($dosya_boyutu > $gecerlidosyaboyutu) {
            header("Location:https://loopscards.com/userspanel/profile.php?images=Boyut&mod=images");
        }
        //dosyanın adını ayarlama
        $resimadi = $kullanici_adi .  "_" .  $query["id"] . "." . $uzanti;
        //önceki resmi sil
        $resmisil = $kullanici_adi .  "_" .  $query["id"];
        unlink('img/user_img/' . $resmisil . ".png");
        unlink('img/user_img/' . $resmisil . ".jpg");
        unlink('img/user_img/' . $resmisil . ".gif");

        $kaydet = "img/user_img/" . $resimadi;
        //resmi yükle
        if (move_uploaded_file($_FILES['img']['tmp_name'], $kaydet)) {
            $userr_id =  trim(addslashes(strip_tags($_POST["userr_id"])));
            $query_update = $conn->prepare("UPDATE users SET img=:img WHERE id = :id");
            $update = $query_update->execute(array("img" =>  $kaydet, "id" => $userr_id));

            if ($update) {
                header("Location:https://loopscards.com/userspanel/profile.php?images=Basarili&mod=image");
            } else {
                header("Location:https://loopscards.com/userspanel/profile.php?images=Hata&mod=image");
            }
        } else {
            header("Location:https://loopscards.com/userspanel/profile.php?images=Hata2&mod=image");
        }
    } else {
        header("Location:https://loopscards.com/userspanel/profile.php?images=Uzanti&mod=images");
    }
}
?>
<br><br>
<div class="container">
    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-12">
            <h1 class="title">
                <?php

                $name = explode(" ", $query["full_name"]);
                print($name[0] . ", " . $clock);

                ?></h1>
        </div>
    </div>
</div>

<div class="container">
    <div class="row my-2 align-items-center">
        <div class="col-lg-2"></div>
        <div class="col-12 col-lg-8">
            <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link <?= $mod == 'user' ? 'active' : ''; ?>" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="false">
                        Kişisel
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link <?= $mod == 'image' ? 'active' : ''; ?>" id="pills-img-tab" data-bs-toggle="pill" data-bs-target="#pills-img" type="button" role="tab" aria-controls="pills-img" aria-selected="true">
                        Profil Resmi
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link <?= $mod == 'social' ? 'active' : ''; ?>" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                        Sosyal Medya
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link <?= $mod == 'contact' ? 'active' : ''; ?>" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
                        İletişim
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <!--USERS-->
                <div class="tab-pane fade <?= $mod == 'user' ? 'show active' : ''; ?>" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <form action="profile.php" method="POST">
                        <div class="row mt-2">
                            <div class="col-12 d-flex flex-column gap-2 justify-content-center align-items-center">
                                <div class="col-4 col-lg-4 user-img d-flex flex-column justify-content-center align-items-center">
                                    <div style="background: url('<?= $query["img"] ?>'); background-position: center center;background-size: cover;">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-9 mt-3">
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="addon-wrapping">Ad | Soyad:</span>
                                        <input type="text" name="full_name" class="form-control" placeholder="Adınız ve soyadınız" value="<?= ucwords($query["full_name"]) ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3"></div>
                                <div class="col-12 col-lg-9">
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="addon-wrapping">Biyografi:</span>
                                        <input type="text" name="biography" class="form-control" placeholder="Kısaca kendinizi anlatın" value="<?= $query["biography"] ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3"></div>
                                <div class="col-12 col-lg-9">
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="addon-wrapping">Mail:</span>
                                        <input type="mail" name="mail" class="form-control" placeholder="Mail adresiniz" value="<?= $query["mail"] ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3"></div>
                                <div class="col-12 col-lg-9">
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="addon-wrapping">Cinsiyet:</span>
                                        <div class="form-check form-check-inline ms-3 pt-1">
                                            <input class="form-check-input" <?= ($query["gender"] == 'erkek') ? 'checked' : ""; ?> type="radio" name="gender" id="gender-e" value="erkek">
                                            <label class="form-check-label" for="gender-e">Erkek</label>
                                        </div>
                                        <div class="form-check form-check-inline ms-3 pt-1">
                                            <input class="form-check-input" <?= ($query["gender"] == 'kadın') ? 'checked' : ""; ?> type="radio" name="gender" id="gender-k" value="kadın">
                                            <label class="form-check-label" for="gender-k">Kadın</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3"></div>
                                <div class="col-12 col-lg-9">
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="addon-wrapping">Kayıt:</span>
                                        <input type="text" class="form-control" placeholder="Kayıt Zamanınız" value="<?= date("d/m/Y", strtotime($query["time"])); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-9 col-12 d-flex justify-content-between">
                                    <a href="<?= $link_fast ?>" target="blank" class="btn btn-primary px-4 my-3">Profili Önizle </a>
                                    <button type="submit" name="user" class="btn btn-dark px-4 my-3">Bilgileri güncelle</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!--IMAGES-->
                <div class="tab-pane fade <?= $mod == 'image' ? 'show active' : ''; ?>" id="pills-img" role="tabpanel" aria-labelledby="pills-img-tab">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="row mt-2">
                            <div class="col-12 d-flex flex-column gap-2 justify-content-center align-items-center">
                                <div class="col-4 col-lg-4 user-img d-flex flex-column justify-content-center align-items-center">
                                    <div style="background: url('<?= $query["img"] ?>'); background-position: center center;background-size: cover;">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-9 mt-3">
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="addon-wrapping">Profil Resmi:</span>
                                        <input type="file" name="img" class="form-control">
                                        <input type="hidden" name="userr_id" value="<?= $query["id"] ?>">
                                    </div>
                                    <div class="ms-1 mt-2">
                                        <span>Geçerli formatlar:</span>
                                        <span><i class="bi bi-check-lg text-success"></i> .JPG</span>,
                                        <span><i class="bi bi-check-lg text-success"></i> .PNG </span>,
                                        <span><i class="bi bi-check-lg text-success"></i> .GIF </span>
                                    </div>
                                </div>
                                <div class="col-lg-3"></div>
                                <div class="col-12 col-lg-9 mt-1">
                                    <div class="alert alert-info px-2 py-2 mb-0">
                                        Dosya boyutu maksimum <b>7 MB</b> boyuntunda olmalıdır.
                                    </div>
                                </div>
                                <div class="col-lg-9 col-12 d-flex justify-content-between">
                                    <a href="<?= $link_fast ?>" target="blank" class="btn btn-primary px-4 my-3">Profili Önizle </a>
                                    <button type="submit" name="images" class="btn btn-dark px-4 my-3">Profil resmi ekle</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!--SOCİAL-->
                <div class="tab-pane fade  <?= $mod == 'social' ? 'show active' : ''; ?>" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <form action="profile.php" method="POST">
                        <div class="row mt-2">
                            <div class="col-12 d-flex flex-column align-items-center gap-2 social">
                                <div class="col-4 col-lg-4 user-img d-flex flex-column justify-content-center align-items-center">
                                    <div style="background: url('<?= $query["img"] ?>'); background-position: center center;background-size: cover;">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-9 mt-3">
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text bg-primary" id="addon-wrapping">facebook.com/</span>
                                        <input type="text" name="facebook" class="form-control" placeholder="Örn: loopscard" value="<?= $social_query["facebook"] ?>">
                                        <input type="hidden" name="userr_id" value="<?= $query["id"] ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3"></div>
                                <div class="col-12 col-lg-9">
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text bg-info" id="addon-wrapping">twitter.com/</span>
                                        <input type="text" name="twitter" class="form-control" placeholder="Örn: loopscard" value="<?= $social_query["twitter"] ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3"></div>
                                <div class="col-12 col-lg-9">
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text bg-dark" id="addon-wrapping">tiktok.com/</span>
                                        <input type="text" name="tiktok" class="form-control" placeholder="Örn: loopscard" value="<?= $social_query["tiktok"] ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3"></div>
                                <div class="col-12 col-lg-9">
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text bg-danger" id="addon-wrapping">instagram.com/</span>
                                        <input type="text" name="instagram" class="form-control" placeholder="Örn: loopscard" value="<?= $social_query["instagram"] ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3"></div>
                                <div class="col-12 col-lg-9">
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text bg-warning" id="addon-wrapping">snapchat.com/</span>
                                        <input type="text" name="snapchat" class="form-control" placeholder="Örn: loopscard" value="<?= $social_query["snapchat"] ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3"></div>
                                <div class="col-12 col-lg-9">
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text bg-primary" id="addon-wrapping">linkedin.com/in/</span>
                                        <input type="text" name="linkedin" class="form-control" placeholder="Örn: loopscard" value="<?= $social_query["linkedin"] ?>">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-9 mt-1">
                                    <div class="alert alert-info px-2 py-2 mb-0">
                                        Yukarıda ki alanlara sadece kullanıcı adlarınızı yazabilirsiniz. <b> Bağlantıyı kopyala / yapıştır yapmayın, </b>aksi halde diğer kullanıcılar sizin hesaplarınıza erişim sağlayamazlar.
                                    </div>
                                </div>
                                <div class="col-lg-9 col-12 d-flex justify-content-between">
                                    <a href="<?= $link_fast ?>" target="blank" class="btn btn-primary px-4 my-3">Profili Önizle </a>
                                    <button type="submit" name="social" class="btn btn-dark px-4 my-3">Hesaplarımı güncelle</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!--CONTACT-->
                <div class="tab-pane fade <?= $mod == 'contact' ? 'show active' : ''; ?>" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <form action="profile.php" method="POST">
                        <div class="row mt-2">
                            <div class="col-12 d-flex flex-column gap-2 justify-content-center align-items-center">
                                <div class="col-4 col-lg-4 user-img d-flex flex-column justify-content-center align-items-center">
                                    <div style="background: url('<?= $query["img"] ?>'); background-position: center center;background-size: cover;">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-9 mt-3">
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text bg-success" id="addon-wrapping">WhatsApp: </span>
                                        <input type="text" name="whatsapp" class="form-control" placeholder="WhatsApp" value="<?= $contact_query["whatsapp"] ?>">
                                        <input type="hidden" name="userr_id" value="<?= $query["id"] ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3"></div>
                                <div class="col-12 col-lg-9">
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text bg-primary" id="addon-wrapping">Telefon:</span>
                                        <input type="text" name="numbers" class="form-control" placeholder="Telefon numaranız" value="<?= $contact_query["numbers"] ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3"></div>
                                <div class="col-12 col-lg-9">
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text bg-info" id="addon-wrapping">Adres:</span>
                                        <input type="text" name="adress" class="form-control" placeholder="Şirket / şahıs adresiniz" value="<?= $contact_query["adress"] ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3"></div>
                                <div class="col-12 col-lg-9">
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" style="width: 124px;" id="addon-wrapping">Web Sayfanız:</span>
                                        <input type="text" name="sites" class="form-control" placeholder="Web sayfanızın bağlantısı." value="<?= $contact_query["sites"] ?>">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-9 mt-1">
                                    <div class="alert alert-info px-2 py-2 mb-0">
                                        Yukarıda ki alanları doldurmak zorunda değilsiniz. Eğer o bilginiz <b> eksikse / yoksa boş bırakabilirsiniz.</b>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-12 d-flex justify-content-between">
                                    <a href="<?= $link_fast ?>" target="blank" class="btn btn-primary px-4 my-3">Profili Önizle </a>
                                    <button type="submit" name="contact" class="btn btn-dark px-4 my-3">Bilgileri güncelle</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once("footer.php");
?>