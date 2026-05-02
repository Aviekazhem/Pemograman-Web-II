<?php
// 1. Buat koneksi
$con = mysqli_connect("localhost", "root", "");

if (!$con) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

echo "Koneksi Berhasil! <br>";

// 2. Jalankan perintah buat database
// Format: mysqli_query(variabel_koneksi, perintah_sql)
$dbname = "lat_dbase";
$sql = "CREATE DATABASE $dbname";

$cek = mysqli_query($con, $sql) or die("Gagal membuat database: " . mysqli_error($con));

if ($cek) {
    echo "Database $dbname berhasil dibuat";
}
?>