<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "inventaris_lab";


$koneksi = mysqli_connect($host, $user, $pass, $db,3307);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>