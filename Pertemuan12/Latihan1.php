<?php

$con = mysqli_connect("localhost", "root", "", "lat_dbase");

if (!$con) {
    die('Koneksi gagal: ' . mysqli_connect_error());
}

$query = mysqli_query($con, "UPDATE tbl_mhs SET Age = '66' WHERE FirstName = 'Angga' AND LastName = 'Firman'");

if ($query) {
    echo "Data mahasiswa bernama Angga Firman berhasil diperbarui!";
} else {
    echo "Gagal memperbarui data: " . mysqli_error($con);
}

mysqli_close($con);
?>