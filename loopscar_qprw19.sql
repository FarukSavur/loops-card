-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 25 Mar 2022, 18:46:11
-- Sunucu sürümü: 10.3.34-MariaDB-cll-lve
-- PHP Sürümü: 7.3.33

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
-- Tablo için tablo yapısı `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL,
  `userr_id` int(11) NOT NULL,
  `numbers` varchar(20) NOT NULL,
  `adress` varchar(500) NOT NULL,
  `sites` varchar(500) NOT NULL,
  `whatsapp` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `contact`
--

INSERT INTO `contact` (`contact_id`, `userr_id`, `numbers`, `adress`, `sites`, `whatsapp`) VALUES
(1, 1, '05379302448', 'soğuk pınar mh. 332. sk. no:19/1', 'sosyalkampus.net/demo', '05379302448'),
(7, 7, '', '', '', ''),
(27, 27, '', '', '', ''),
(9, 9, '05370127948', '', '', ''),
(10, 10, '', '', '', ''),
(11, 11, '05457408933', 'mopak', 'http://huseyinmadenci.epizy.com', '05457408933'),
(12, 12, '05452114580', '85.yıl cumhuriyet mahallesi sağlık caddesi No/69 İzmir/Kemalpaşa', '', '05452114580'),
(13, 13, '', '', '', ''),
(14, 14, '', '', '', ''),
(15, 15, '', '', '', ''),
(16, 16, '05355757365', '', '', '05355757365'),
(17, 17, '', '', '', ''),
(18, 18, '', '', '', ''),
(19, 19, '05304570749', '', '', '05304570749'),
(20, 20, '+90 552 258 89 36', 'İzmir/kemalpaşa', '', '+90 552 258 89 36'),
(21, 21, '', '', '', ''),
(22, 22, '05305140847', '', '', ''),
(23, 23, '05312233354', '', '', '05312233354'),
(24, 24, '', '', '', ''),
(25, 25, '', '', '', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `social`
--

CREATE TABLE `social` (
  `social_id` int(11) NOT NULL,
  `userr_id` int(11) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `tiktok` varchar(255) NOT NULL,
  `linkedin` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  `snapchat` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `social`
--

INSERT INTO `social` (`social_id`, `userr_id`, `facebook`, `twitter`, `tiktok`, `linkedin`, `instagram`, `snapchat`) VALUES
(1, 1, 'faruksavur.25', 'farukksavur', 'savurfaruk123', 'faruk-savur-13b79115a', 'farukksavur', 'frksvr123'),
(7, 7, 'profile.php?id=100010492567767', 'FratAkbas2', '', 'fırat-akbaş-b964a31a5/', 'frat_akbas/', ''),
(27, 27, '', '', '', '', '', ''),
(9, 9, '', '', '', '', '', 'tolgasavur21'),
(10, 10, '', '', '', '', '', ''),
(11, 11, '', '', '', '', 'm_huseyiiin', 'm_huseyiiin'),
(12, 12, '', '', '', '', 'dilemmturan._', 'dilemturan99'),
(13, 13, '', '', '', '', '', ''),
(14, 14, '', '', '', '', '', ''),
(15, 15, '', '', '', '', '', ''),
(16, 16, '', '', '', '', '_osman35', ''),
(17, 17, '', '', '', '', '', ''),
(18, 18, '', '', '', '', '', ''),
(19, 19, '', '', '', '', '', ''),
(20, 20, '', '', '', '', 'https://www.instagram.com/egeyorulmz12/', ''),
(21, 21, '', '', '', '', '', ''),
(22, 22, '', '', '', '', '', ''),
(23, 23, '', '', '', '', '', ''),
(24, 24, '', '', '', '', '', ''),
(25, 25, '', '', '', '', '', '');

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
(27, 'Faruk Savur ', 'henüz biyografi eklemedi.', 'img/man.svg', 'erkek', 'frksvr12@gmail.com', '93279e3308bdbbeed946fc965017f67a', 2147483647, 1, '2022-03-23 20:06:26'),
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
(25, 'Bilal Adı Siner', 'Ege özel', 'img/user_img/bilal_adı_siner_25.jpg', 'erkek', 'bilalbatuhan.2535@gamil.com', '18dee0b0f4962dae781ce0b95250ee65', 560184, 1, '2022-03-23 13:00:36');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Tablo için indeksler `social`
--
ALTER TABLE `social`
  ADD PRIMARY KEY (`social_id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Tablo için AUTO_INCREMENT değeri `social`
--
ALTER TABLE `social`
  MODIFY `social_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
