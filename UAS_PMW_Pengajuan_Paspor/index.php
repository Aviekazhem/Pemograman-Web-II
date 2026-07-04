<?php
include 'koneksi.php';

// Mengambil jumlah total pendaftar untuk ditampilkan di dashboard
$query_total = mysqli_query($conn, "SELECT COUNT(*) as total FROM pendaftar");
$data_total = mysqli_fetch_assoc($query_total);
$total_pendaftar = $data_total['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Pengajuan Paspor</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #F5F8FA; color: #3F4254; }
        .sidebar { background-color: #1E1E2D; min-height: 100vh; padding: 2rem 1rem; width: 280px; position: fixed; }
        .sidebar-brand { color: #FFF; font-weight: 700; font-size: 1.4rem; text-align: center; margin-bottom: 0.5rem; letter-spacing: 0.5px; }
        .sidebar-programmer { color: #A1A5B7; font-size: 0.85rem; text-align: center; margin-bottom: 2.5rem; font-weight: 400;}
        .sidebar a { color: #9899AC; text-decoration: none; padding: 0.85rem 1.5rem; display: block; border-radius: 8px; margin-bottom: 0.5rem; font-weight: 500; transition: all 0.3s; }
        .sidebar a:hover, .sidebar a.active { background-color: #009EF7; color: #FFF; }
        .main-content { margin-left: 280px; padding: 2.5rem; }
        .card-custom { border: none; border-radius: 12px; box-shadow: 0px 0px 20px 0px rgba(76,87,125,0.05); background-color: #FFF; margin-bottom: 2rem; overflow: hidden; }
        .welcome-banner { background: linear-gradient(135deg, #009EF7 0%, #0073C2 100%); color: white; padding: 3rem 2rem; border-radius: 12px; margin-bottom: 2rem; box-shadow: 0px 10px 30px 0px rgba(0, 158, 247, 0.2); }
        .stat-card { background-color: #FFF; padding: 1.5rem; border-radius: 12px; border: 1px solid #EFF2F5; display: flex; align-items: center; }
        .stat-icon { width: 50px; height: 50px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-right: 1rem; }
        .stat-icon-blue { background-color: #E1F0FF; color: #009EF7; }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-brand">Kantor Imigrasi</div>
        <div class="sidebar-programmer">Programmer: Kazhem Avie</div>
        <nav>
            <a href="index.php" class="active"><i class="bi bi-house-door me-2"></i> Beranda</a>
            <a href="input_daftar.php"><i class="bi bi-person-plus me-2"></i> Pendaftaran</a>
            <a href="daftar_ulang.php"><i class="bi bi-file-text me-2"></i> Daftar Ulang</a>
            <a href="pengurusan.php"><i class="bi bi-wallet2 me-2"></i> Pengurusan</a>
        </nav>
    </div>

    <div class="main-content">
        
        <div class="welcome-banner d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold mb-2">Selamat Datang, Kazhem! 👋</h2>
                <p class="mb-0 opacity-75">Sistem Pengajuan Paspor Kantor Imigrasi Cabang siap digunakan.</p>
            </div>
            <div class="d-none d-md-block">
                <i class="bi bi-passport" style="font-size: 4rem; opacity: 0.8;"></i>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="stat-card">
                    <div class="stat-icon stat-icon-blue">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-0 text-dark"><?php echo $total_pendaftar; ?></h3>
                        <span class="text-muted small fw-semibold">TOTAL PENDAFTAR</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-custom p-4">
            <h5 class="fw-bold mb-3 text-dark">Panduan Penggunaan Sistem</h5>
            <ol class="text-muted mb-0" style="line-height: 1.8;">
                <li>Mulai dengan memasukkan data pemohon baru melalui menu <strong>Pendaftaran</strong>. Sistem akan mengatur jadwal kedatangan otomatis.</li>
                <li>Gunakan menu <strong>Daftar Ulang</strong> saat pemohon datang membawa berkas fisik (KTP, KK, Ijazah).</li>
                <li>Setelah berkas divalidasi dan mendapatkan nomor antrian, proses pembayaran dapat diselesaikan di menu <strong>Pengurusan</strong>.</li>
            </ol>
        </div>

    </div>

</body>
</html>