<?php
// 1. PROSES PENYIMPANAN DATA (BACKEND)
// Skrip ini hanya akan berjalan jika tombol "Kirim Data" diklik
$pesan_status = "";

if (isset($_POST['submit'])) {
    // Koneksi ke database db_bukutamu
    $con = mysqli_connect("localhost", "root", "", "db_bukutamu");

    if (!$con) {
        die("Koneksi ke database gagal: " . mysqli_connect_error());
    }

    // Mengambil data yang diketik di form website
    $nama  = mysqli_real_escape_string($con, $_POST['nama']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $pesan = mysqli_real_escape_string($con, $_POST['pesan']);

    // Query untuk menyimpan ke tabel tbl_bukutamu
    $sql = "INSERT INTO tbl_bukutamu (nama, email, pesan) VALUES ('$nama', '$email', '$pesan')";
    
    if (mysqli_query($con, $sql)) {
        // Jika sukses, buat pesan status berwarna hijau
        $pesan_status = "<div style='color: #155724; background-color: #d4edda; padding: 10px; border-radius: 4px; margin-bottom: 15px;'>
                            <strong>Sukses!</strong> Data tamu berhasil disimpan ke database.
                         </div>";
    } else {
        $pesan_status = "<div style='color: #721c24; background-color: #f8d7da; padding: 10px; border-radius: 4px; margin-bottom: 15px;'>
                            <strong>Gagal!</strong> " . mysqli_error($con) . "
                         </div>";
    }

    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buku Tamu All-in-One</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 40px; background-color: #f1f5f9; }
        .container { max-width: 450px; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); margin: 0 auto; }
        h2 { color: #0f172a; text-align: center; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 6px; font-weight: 600; color: #334155; }
        input[type="text"], input[type="email"], textarea { width: 100%; padding: 10px; box-sizing: border-box; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; }
        input[type="text"]:focus, input[type="email"]:focus, textarea:focus { outline: none; border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15); }
        button { width: 100%; padding: 12px; background-color: #3b82f6; color: white; border: none; border-radius: 6px; font-size: 16px; font-weight: bold; cursor: pointer; transition: background 0.2s; }
        button:hover { background-color: #2563eb; }
    </style>
</head>
<body>

<div class="container">
    <h2>Buku Tamu Website</h2>
    
    <?php echo $pesan_status; ?>

    <form action="" method="POST">
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" required placeholder="Ketik nama Anda">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required placeholder="Ketik email Anda">
        </div>
        <div class="form-group">
            <label>Pesan Anda</label>
            <textarea name="pesan" rows="4" required placeholder="Tulis pesan atau komentar di sini..."></textarea>
        </div>
        <button type="submit" name="submit">Kirim Data Tamu</button>
    </form>
</div>

</body>
</html>