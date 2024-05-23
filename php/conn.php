<?php

try {
    $conn = new PDO("mysql:host=localhost;dbname=loopscard;charset=utf8", 'root', '');
} catch (PDOException $hata) {
    print($hata->getMessage());
}
