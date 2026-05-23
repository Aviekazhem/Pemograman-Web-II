<?php
$conn = mysqli_connect("localhost", "root", "", "kampus");

if (isset($_POST['submit'])) {
    $query = "INSERT INTO mahasiswa (nim, nama, jurusan, alamat, no_telp) 
              VALUES ('$_POST[nim]', '$_POST[nama]', '$_POST[jurusan]', '$_POST[alamat]', '$_POST[no_telp]')";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data Berhasil Disimpan!'); window.location='index.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Input Data Mahasiswa</title>
    <style>
        /* Mengatur isi halaman agar mulai dari tengah secara vertikal */
        body { 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 90vh; 
            font-family: sans-serif; 
        }
        /* Menyesuaikan lebar input teks agar rapi */
        input[type="text"], select { width: 100%; box-sizing: border-box; }
    </style>
</head>
<body>

<div style="width: 450px;">
    <h2 style="text-align: center; color: #fca311;">Form Input Data Mahasiswa</h2>
    
    <form action="" method="POST">
        <table cellpadding="6" style="width: 100%;">
            <tr>
                <td style="width: 160px;">ID Mahasiswa / NIM</td>
                <td><input type="text" name="nim" style="max-width: 180px;" required></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" required></td>
            </tr>
            <tr>
                <td>Jurusan</td>
                <td>
                    <select name="jurusan" style="max-width: 180px;" required>
                        <option value="">- Pilih Jurusan -</option>
                        <option value="Teknik Informatika">Teknik Informatika</option>
                        <option value="Sistem Informasi">Sistem Informasi</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><input type="text" name="alamat"></td>
            </tr>
            <tr>
                <td>No. Telp</td>
                <td><input type="text" name="no_telp" style="max-width: 180px;"></td>
            </tr>
            <tr>
                <td></td>
                <td style="padding-top: 15px;">
                    <button type="submit" name="submit">Submit</button>
                    <button type="reset">Cancel</button>
                </td>
            </tr>
        </table>
    </form>
</div>

</body>
</html>