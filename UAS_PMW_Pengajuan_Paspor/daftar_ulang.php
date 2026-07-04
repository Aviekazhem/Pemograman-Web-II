<?php
include 'koneksi.php';
$pesan = "";

if (isset($_POST['proses'])) {
    $no_daftar = $_POST['no_daftar'];
    $ktp = $_POST['ktp'];
    $kk = $_POST['kk'];
    $ijazah = $_POST['ijazah'];
    
    if ($ktp == 'Ada' && $kk == 'Ada' && $ijazah == 'Ada') {
        $keterangan = 'OK';
        $q_antrian = mysqli_query($conn, "SELECT MAX(id) as max_id FROM daftar_ulang WHERE keterangan = 'OK'");
        $d_antrian = mysqli_fetch_assoc($q_antrian);
        $urutan = $d_antrian['max_id'] ? $d_antrian['max_id'] + 1 : 1;
        $no_antrian = 'A-' . str_pad($urutan, 3, '0', STR_PAD_LEFT);
    } else {
        $keterangan = 'Tidak';
        $no_antrian = NULL;
    }

    $antrian_val = $no_antrian ? "'$no_antrian'" : "NULL";
    mysqli_query($conn, "INSERT INTO daftar_ulang (no_daftar, ktp, kk, ijazah, keterangan, no_antrian) VALUES ('$no_daftar', '$ktp', '$kk', '$ijazah', '$keterangan', $antrian_val)");
    
    $pesan = "<div class='alert alert-custom' role='alert'>
                <i class='bi bi-info-circle-fill me-2'></i> Berkas divalidasi! Status Keterangan: <strong>{$keterangan}</strong>
              </div>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Ulang - Modern Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        /* CSS Sama Persis dengan File Input Daftar untuk konsistensi */
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
        .form-control, .form-select { border-radius: 8px; padding: 0.75rem 1rem; border: 1px solid #E4E6EF; background-color: #F9F9F9; color: #3F4254; font-weight: 500; cursor: pointer;}
        .form-control:focus, .form-select:focus { border-color: #009EF7; box-shadow: none; background-color: #FFF;}
        .btn-primary-custom { background-color: #009EF7; border: none; border-radius: 8px; padding: 0.75rem 1.5rem; font-weight: 600; color: #fff; transition: 0.3s;}
        .btn-primary-custom:hover { background-color: #0095E8; color: #fff;}
        .table-custom { border-spacing: 0 0.5rem; border-collapse: separate; width: 100%;}
        .table-custom th { border: none; color: #B5B5C3; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; padding: 1rem; }
        .table-custom td { border: none; background: #F9F9F9; padding: 1.2rem 1rem; vertical-align: middle; color: #464E5F; font-weight: 500;}
        .table-custom tr td:first-child { border-top-left-radius: 8px; border-bottom-left-radius: 8px; }
        .table-custom tr td:last-child { border-top-right-radius: 8px; border-bottom-right-radius: 8px; }
        .alert-custom { background-color: #E1F0FF; color: #009EF7; border: 1px dashed #009EF7; border-radius: 8px; font-weight: 500;}
        .status-ok { background-color: #E8FFF3; color: #50CD89; padding: 0.4rem 0.8rem; border-radius: 6px; font-weight: 600; font-size: 0.85rem;}
        .status-no { background-color: #FFF5F8; color: #F1416C; padding: 0.4rem 0.8rem; border-radius: 6px; font-weight: 600; font-size: 0.85rem;}
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-brand">Kantor Imigrasi</div>
        <div class="sidebar-programmer">Programmer: Kazhem Avie</div>
        <nav>
            <a href="index.php"><i class="bi bi-house-door me-2"></i> Beranda</a>
            <a href="input_daftar.php"><i class="bi bi-person-plus me-2"></i> Pendaftaran</a>
            <a href="daftar_ulang.php" class="active"><i class="bi bi-file-text me-2"></i> Daftar Ulang</a>
            <a href="pengurusan.php"><i class="bi bi-wallet2 me-2"></i> Pengurusan</a>
        </nav>
    </div>

    <div class="main-content">
        <h3 class="mb-4 fw-bold" style="color: #181C32;">Verifikasi Berkas Fisik</h3>
        
        <?php if($pesan != "") echo $pesan; ?>

        <div class="row">
            <div class="col-xl-4 col-lg-5">
                <div class="card-custom">
                    <div class="card-header-custom">Cek Dokumen</div>
                    <div class="card-body-custom">
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label text-muted fw-semibold small">PILIH PENDAFTAR</label>
                                <select name="no_daftar" class="form-select" required>
                                    <option value="">- Cari Nama Pendaftar -</option>
                                    <?php
                                    $q = mysqli_query($conn, "SELECT * FROM pendaftar");
                                    while ($p = mysqli_fetch_assoc($q)) echo "<option value='{$p['no_daftar']}'>ID: {$p['no_daftar']} - {$p['nama_pemohon']}</option>";
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-muted fw-semibold small">KTP</label>
                                <select name="ktp" class="form-select"><option>Ada</option><option>Tidak</option></select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-muted fw-semibold small">KARTU KELUARGA</label>
                                <select name="kk" class="form-select"><option>Ada</option><option>Tidak</option></select>
                            </div>
                            <div class="mb-4">
                                <label class="form-label text-muted fw-semibold small">IJAZAH / AKTA</label>
                                <select name="ijazah" class="form-select"><option>Ada</option><option>Tidak</option></select>
                            </div>
                            <button type="submit" name="proses" class="btn-primary-custom w-100">Validasi Berkas</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 col-lg-7">
                <div class="card-custom">
                    <div class="card-header-custom">Riwayat Validasi Berkas</div>
                    <div class="card-body-custom">
                        <div class="table-responsive">
                            <table class="table-custom">
                                <thead>
                                    <tr>
                                        <th>No. Daftar</th>
                                        <th>KTP</th>
                                        <th>KK</th>
                                        <th>Ijazah</th>
                                        <th>Status</th>
                                        <th>No. Antrian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $tampil = mysqli_query($conn, "SELECT * FROM daftar_ulang ORDER BY id DESC");
                                    while ($d = mysqli_fetch_assoc($tampil)) {
                                        $antrian = $d['no_antrian'] ? "<span class='text-primary fw-bold'><i class='bi bi-ticket-perforated'></i> {$d['no_antrian']}</span>" : "-";
                                        $badge_class = ($d['keterangan'] == 'OK') ? 'status-ok' : 'status-no';
                                        
                                        echo "<tr>
                                                <td class='fw-bold'>#{$d['no_daftar']}</td>
                                                <td>{$d['ktp']}</td>
                                                <td>{$d['kk']}</td>
                                                <td>{$d['ijazah']}</td>
                                                <td><span class='{$badge_class}'>{$d['keterangan']}</span></td>
                                                <td>{$antrian}</td>
                                              </tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>