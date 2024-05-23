-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 02 Nis 2022, 22:53:35
-- Sunucu sürümü: 10.3.34-MariaDB-cll-lve
-- PHP Sürümü: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `loopscar_qprw19`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `biography` varchar(750) COLLATE utf8_turkish_ci NOT NULL,
  `img` varchar(500) COLLATE utf8_turkish_ci NOT NULL,
  `gender` varchar(11) COLLATE utf8_turkish_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `passwordd` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `activation_code` int(11) NOT NULL,
  `active` int(1) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `full_name`, `biography`, `img`, `gender`, `mail`, `passwordd`, `activation_code`, `active`, `time`) VALUES
(1, 'Faruk Savur', 'Web geliştirici ve tasarımcı, ve bu şaheseri geliştiren kişi. ✨', 'img/user_img/faruk_savur_1.png', 'erkek', 'frksvr123@gmail.com', '93279e3308bdbbeed946fc965017f67a', 491265, 1, '2022-03-19 20:01:44'),
(30, 'farukk savur', 'henüz biyografi eklemedi.', 'img/man.svg', 'erkek', 'frksvr12@gmail.com', '93279e3308bdbbeed946fc965017f67a', 79259, 1, '2022-03-26 12:47:19'),
(9, 'tolga', 'biyografiniz', 'img/user_img/tolga_9.jpeg', 'erkek', 'tolgasavur.963@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', 874815, 1, '2022-03-22 20:46:13'),
(7, 'Fırat Akbaş', 'biyografiniz', 'img/user_img/fırat_akbaş_7.jpg', 'erkek', 'firatakbas53@gmail.com', 'f790b69466d91ede796cce34bccd699e', 181126, 1, '2022-03-21 16:03:35'),
(10, 'Yavuz YILMAZ', 'biyografiniz', 'img/man.svg', 'erkek', 'yavuzzyilmazz@icloud.com', '41d960b01103fec2e40d54b63aba7ded', 277711, 1, '2022-03-22 21:27:19'),
(11, 'Hüseyin Madenci', 'coder', 'img/man.svg', 'erkek', 'besiktass3515@gmail.com', 'b6940c1e83abc40a286e05c7b969896d', 241795, 1, '2022-03-23 08:24:19'),
(12, 'Dilem Turan', 'A smooth sea never made a skilled sailor ????', 'img/user_img/dilem_turan_12.jpg', 'kadın', 'turandilem008@gmail.com', '568904e74ae731ac41212161b66e905c', 786081, 1, '2022-03-23 08:25:06'),
(13, 'osman öz', 'biyografiniz', 'img/man.svg', 'erkek', 'osmanoz3515@gmail.com', '93279e3308bdbbeed946fc965017f67a', 825195, 0, '2022-03-23 08:25:55'),
(14, 'sinancelik35', 'biyografiniz', 'img/man.svg', 'erkek', 'sinnclk35@gmail.com', 'dd2c3f08d8533609d0459ea16c604ac6', 566732, 1, '2022-03-23 08:27:45'),
(15, 'osman öz', 'biyografiniz', 'img/man.svg', 'erkek', 'oz9600317@gmail.com', '93279e3308bdbbeed946fc965017f67a', 237047, 0, '2022-03-23 08:31:45'),
(16, 'osman öz', 'biyografiniz', 'img/man.svg', 'erkek', 'oz769434@gmail.com', '93279e3308bdbbeed946fc965017f67a', 330733, 1, '2022-03-23 08:32:28'),
(17, 'Mehmet Ali ay', 'biyografiniz', 'img/man.svg', 'erkek', 'aliay6527@gmail.com', 'b4d2b877f852a65633862ebc2d088ede', 473526, 0, '2022-03-23 08:38:48'),
(18, 'Ömer Can', 'biyografiniz', 'img/man.svg', 'erkek', 'omerxxcan123@gmail.com', '78ec1c1847d533fd8822d80e7806c2f5', 353157, 1, '2022-03-23 08:38:54'),
(19, 'Çağrı Özkan', 'Sadece ege ve çağrı', 'img/user_img/Çağrı_Özkan_19.jpeg', 'erkek', 'turkgenc905@gmail.com', '011190df57a73d2be1e11fae26b62855', 346701, 1, '2022-03-23 12:51:03'),
(20, 'Ege yorulmaz', 'biyografiniz', 'img/user_img/ege_yorulmaz_20.jpg', 'erkek', 'eyorulmaz124@gmail.com', '958256982ddbf20c8a653f8e1404c79b', 433640, 1, '2022-03-23 12:51:10'),
(21, 'Efekan Düzmen', 'biyografiniz', 'img/man.svg', 'erkek', 'yasefekan@gmail.com', '3b531d6f6f7de85abd82644a8fb97843', 944872, 1, '2022-03-23 12:51:45'),
(22, 'mehmet ali ', 'biyografiniz', 'img/man.svg', 'erkek', 'mehmetalibas22@gmail.com', 'a0d6edea1e6cb4bb9aad390d5a4c6788', 543581, 1, '2022-03-23 12:55:17'),
(23, 'Oğuzhan AKGÜN', 'biyografiniz', 'img/man.svg', 'erkek', 'akgunoguzhan423@gmail.com', '3e63b17d68ba86597622ceead9ea59a3', 952379, 1, '2022-03-23 12:58:23'),
(24, 'Metehan Demirel', 'biyografiniz', 'img/man.svg', 'erkek', 'metehandemirel35@gmail.com', '1941978202967257416caa9bde74b1f2', 437757, 1, '2022-03-23 12:59:39'),
(25, 'Bilal Adı Siner', 'Ege özel', 'img/user_img/bilal_adı_siner_25.jpg', 'erkek', 'bilalbatuhan.2535@gamil.com', '18dee0b0f4962dae781ce0b95250ee65', 560184, 1, '2022-03-23 13:00:36'),
(28, 'Onur KILIÇ', 'AKBA İNŞAAT GIDA', 'img/user_img/onur_kiliÇ_28.jpeg', 'erkek', 'onurkilic48@hotmail.com', 'b0b869971fb1a1a9fd5798e90898ab41', 2147483647, 1, '2022-03-25 16:48:20'),
(31, 'Yavuz YILMAZ', 'henüz biyografi eklemedi.', 'img/man.svg', 'erkek', 'yvz_ylmz_1999@hotmail.com', 'ca38778a51d64093535cf7140760bfc1', 967912, 0, '2022-03-30 09:09:02');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
