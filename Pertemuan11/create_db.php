<?php
// Koneksi awal ke server MySQL (tanpa memilih database terlebih dahulu)
$con = mysqli_connect("localhost", "root", "");

if (!$con) {
    die("Koneksi ke MySQL Server gagal: " . mysqli_connect_error());
}

// Perintah untuk membuat database baru jika belum ada
$sql_db = "CREATE DATABASE IF NOT EXISTS db_bukutamu";

if (mysqli_query($con, $sql_db)) {
    echo "Database 'db_bukutamu' berhasil diinisialisasi.<br>";
} else {
    die("Gagal membuat database: " . mysqli_error($con));
}

// Memilih database yang baru dibuat
mysqli_select_db($con, "db_bukutamu");

// Perintah untuk membuat tabel di dalam database tersebut
$sql_table = "CREATE TABLE IF NOT EXISTS tbl_bukutamu (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    pesan TEXT NOT NULL,
    tgl_kunjung TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($con, $sql_table)) {
    echo "Tabel 'tbl_bukutamu' berhasil diinisialisasi.<br>";
    echo "<strong>Proses pembuatan database selesai secara terpisah!</strong>";
} else {
    echo "Gagal membuat tabel: " . mysqli_error($con);
}

mysqli_close($con);
?>