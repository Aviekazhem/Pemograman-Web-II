<?php

$conn = mysqli_connect("localhost", "root", ""); 

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$sql_db = "CREATE DATABASE IF NOT EXISTS kampus";
mysqli_query($conn, $sql_db);

mysqli_select_db($conn, "kampus");

$sql_table = "CREATE TABLE IF NOT EXISTS mahasiswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nim VARCHAR(20) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    jurusan VARCHAR(50) NOT NULL,
    alamat TEXT,
    no_telp VARCHAR(15),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($conn, $sql_table)) {
    echo "Sip! Database 'kampus' dan Tabel 'mahasiswa' berhasil siap digunakan.";
} else {
    echo "Eror saat membuat tabel: " . mysqli_error($conn);
}

mysqli_close($conn);
?>