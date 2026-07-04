<?php
include 'koneksi.php';
$pesan = "";

if (isset($_POST['finalisasi'])) {
    $no_daftar = $_POST['no_daftar'];
    $cek_berkas = mysqli_query($conn, "SELECT * FROM daftar_ulang WHERE no_daftar = '$no_daftar' ORDER BY id DESC LIMIT 1");
    $data_berkas = mysqli_fetch_assoc($cek_berkas);
    
    if ($data_berkas && $data_berkas['keterangan'] == 'OK') {
        $berkas = "Lengkap";
        $status = "Diterima";
        $keterangan = "OK";
        $pembayaran = 355000;
        $no_antrian = $data_berkas['no_antrian'];
        
        mysqli_query($conn, "INSERT INTO pengurusan (no_daftar, no_antrian, berkas, status, keterangan, pembayaran) VALUES ('$no_daftar', '$no_antrian', '$berkas', '$status', '$keterangan', '$pembayaran')");
        
        $pesan = "<div class='alert alert-custom' role='alert'>
                    <i class='bi bi-check-all me-2'></i> Pengurusan berhasil difinalisasi! Total Tagihan: <strong>Rp 355.000</strong>
                  </div>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengurusan - Modern Dashboard</title>
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
        .card-custom { border: none; border-radius: 12px; box-shadow: 0px 0px 20px 0px rgba(76,87,125,0.05); background-color: #FFF; margin-bottom: 2rem; }
        .card-header-custom { background: transparent; border-bottom: 1px dashed #EFF2F5; padding: 1.5rem 1.75rem; font-weight: 600; font-size: 1.15rem; color: #181C32;}
        .card-body-custom { padding: 1.75rem; }
        .form-control, .form-select { border-radius: 8px; padding: 0.75rem 1rem; border: 1px solid #E4E6EF; background-color: #F9F9F9; color: #3F4254; font-weight: 500;}
        .form-control:focus, .form-select:focus { border-color: #009EF7; box-shadow: none; background-color: #FFF;}
        .btn-primary-custom { background-color: #009EF7; border: none; border-radius: 8px; padding: 0.75rem 1.5rem; font-weight: 600; color: #fff; transition: 0.3s;}
        .btn-primary-custom:hover { background-color: #0095E8; color: #fff;}
        .table-custom { border-spacing: 0 0.5rem; border-collapse: separate; width: 100%;}
        .table-custom th { border: none; color: #B5B5C3; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; padding: 1rem; }
        .table-custom td { border: none; background: #F9F9F9; padding: 1.2rem 1rem; vertical-align: middle; color: #464E5F; font-weight: 500;}
        .table-custom tr td:first-child { border-top-left-radius: 8px; border-bottom-left-radius: 8px; }
        .table-custom tr td:last-child { border-top-right-radius: 8px; border-bottom-right-radius: 8px; }
        .alert-custom { background-color: #E8FFF3; color: #50CD89; border: 1px dashed #50CD89; border-radius: 8px; font-weight: 500;}
        .badge-status { background-color: #E8FFF3; color: #50CD89; padding: 0.4rem 0.8rem; border-radius: 6px; font-weight: 600; font-size: 0.85rem;}
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-brand">Kantor Imigrasi</div>
        <div class="sidebar-programmer">Programmer: Kazhem Avie</div>
        <nav>
            <a href="index.php"><i class="bi bi-house-door me-2"></i> Beranda</a>
            <a href="input_daftar.php"><i class="bi bi-person-plus me-2"></i> Pendaftaran</a>
            <a href="daftar_ulang.php"><i class="bi bi-file-text me-2"></i> Daftar Ulang</a>
            <a href="pengurusan.php" class="active"><i class="bi bi-wallet2 me-2"></i> Pengurusan</a>
        </nav>
    </div>

    <div class="main-content">
        <h3 class="mb-4 fw-bold" style="color: #181C32;">Finalisasi Pengajuan</h3>
        
        <?php if($pesan != "") echo $pesan; ?>

        <div class="card-custom mb-4" style="max-width: 600px;">
            <div class="card-header-custom">Proses Pembayaran</div>
            <div class="card-body-custom">
                <form method="POST">
                    <div class="mb-4">
                        <label class="form-label text-muted fw-semibold small">PILIH PEMOHON (BERKAS OK)</label>
                        <select name="no_daftar" class="form-select" required>
                            <option value="">- Pilih Pemohon -</option>
                            <?php
                            $q = mysqli_query($conn, "SELECT daftar_ulang.no_daftar, pendaftar.nama_pemohon FROM daftar_ulang JOIN pendaftar ON daftar_ulang.no_daftar = pendaftar.no_daftar WHERE daftar_ulang.keterangan = 'OK'");
                            while ($p = mysqli_fetch_assoc($q)) {
                                echo "<option value='{$p['no_daftar']}'>ID: {$p['no_daftar']} - {$p['nama_pemohon']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" name="finalisasi" class="btn-primary-custom w-100"><i class="bi bi-shield-check me-2"></i>Proses Pengurusan & Cetak Tagihan</button>
                </form>
            </div>
        </div>

        <div class="card-custom">
            <div class="card-header-custom">Data Final Pengurusan Paspor</div>
            <div class="card-body-custom">
                <div class="table-responsive">
                    <table class="table-custom">
                        <thead>
                            <tr>
                                <th>No. Antrian</th>
                                <th>No. Daftar</th>
                                <th>Nama Pemohon</th>
                                <th>Berkas</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>Total Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $q_tampil = "SELECT pengurusan.*, pendaftar.nama_pemohon FROM pengurusan JOIN pendaftar ON pengurusan.no_daftar = pendaftar.no_daftar ORDER BY id DESC";
                            $tampil = mysqli_query($conn, $q_tampil);
                            while ($d = mysqli_fetch_assoc($tampil)) {
                                echo "<tr>
                                        <td><span class='text-primary fw-bold'>{$d['no_antrian']}</span></td>
                                        <td class='fw-bold'>#{$d['no_daftar']}</td>
                                        <td class='text-dark fw-bold'>{$d['nama_pemohon']}</td>
                                        <td>{$d['berkas']}</td>
                                        <td><span class='badge-status'>{$d['status']}</span></td>
                                        <td>{$d['keterangan']}</td>
                                        <td class='fw-bold text-success'>Rp " . number_format($d['pembayaran'],0,',','.') . "</td>
                                      </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>