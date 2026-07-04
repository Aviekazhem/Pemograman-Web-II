<?php
include 'koneksi.php';
$pesan = "";

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama_pemohon'];
    $tgl_daftar = date('Y-m-d'); 
    
    $target_date = $tgl_daftar;
    while (true) {
        $cek = mysqli_query($conn, "SELECT COUNT(*) as total FROM pendaftar WHERE DATE(jadwal_datang) = '$target_date'");
        $row = mysqli_fetch_assoc($cek);
        if ($row['total'] < 5) break; 
        $target_date = date('Y-m-d', strtotime($target_date . ' + 1 day'));
    }

    $jadwal_datang = $target_date . ' 08:00:00';
    mysqli_query($conn, "INSERT INTO pendaftar (nama_pemohon, tgl_daftar, jadwal_datang) VALUES ('$nama', '$tgl_daftar', '$jadwal_datang')");
    $pesan = "<div class='alert alert-custom' role='alert'>
                <i class='bi bi-check-circle-fill me-2'></i> Data tersimpan! Jadwal Anda: <strong>" . date('d-m-Y H:i', strtotime($jadwal_datang)) . "</strong>
              </div>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Pendaftaran - Modern Dashboard</title>
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
        .badge-custom { background-color: #E1F0FF; color: #009EF7; padding: 0.5rem 0.75rem; border-radius: 6px; font-weight: 600; font-size: 0.85rem;}
        .alert-custom { background-color: #E8FFF3; color: #50CD89; border: 1px dashed #50CD89; border-radius: 8px; font-weight: 500;}
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-brand">Kantor Imigrasi</div>
        <div class="sidebar-programmer">Programmer: Kazhem Avie</div>
        <nav>
            <a href="index.php"><i class="bi bi-house-door me-2"></i> Beranda</a>
            <a href="input_daftar.php" class="active"><i class="bi bi-person-plus me-2"></i> Pendaftaran</a>
            <a href="daftar_ulang.php"><i class="bi bi-file-text me-2"></i> Daftar Ulang</a>
            <a href="pengurusan.php"><i class="bi bi-wallet2 me-2"></i> Pengurusan</a>
        </nav>
    </div>

    <div class="main-content">
        <h3 class="mb-4 fw-bold" style="color: #181C32;">Overview Pendaftaran</h3>
        
        <?php if($pesan != "") echo $pesan; ?>

        <div class="row">
            <div class="col-xl-4 col-lg-5">
                <div class="card-custom">
                    <div class="card-header-custom">Input Pemohon Baru</div>
                    <div class="card-body-custom">
                        <form method="POST">
                            <div class="mb-4">
                                <label class="form-label text-muted fw-semibold small">NO. DAFTAR</label>
                                <input type="text" class="form-control" disabled placeholder="Terisi Otomatis (Auto)">
                            </div>
                            <div class="mb-4">
                                <label class="form-label text-muted fw-semibold small">NAMA LENGKAP</label>
                                <input type="text" class="form-control" name="nama_pemohon" required placeholder="Masukkan nama pemohon">
                            </div>
                            <div class="mb-4">
                                <label class="form-label text-muted fw-semibold small">TANGGAL DAFTAR</label>
                                <input type="text" class="form-control" disabled value="<?php echo date('d M Y'); ?>">
                            </div>
                            <button type="submit" name="simpan" class="btn-primary-custom w-100">Simpan Data</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 col-lg-7">
                <div class="card-custom">
                    <div class="card-header-custom">Database Pendaftar</div>
                    <div class="card-body-custom">
                        <div class="table-responsive">
                            <table class="table-custom">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pemohon</th>
                                        <th>Tgl Daftar</th>
                                        <th>Jadwal Kedatangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $tampil = mysqli_query($conn, "SELECT * FROM pendaftar ORDER BY no_daftar DESC");
                                    while ($d = mysqli_fetch_assoc($tampil)) {
                                        $waktu_datang = date('d M Y, H:i', strtotime($d['jadwal_datang']));
                                        echo "<tr>
                                                <td><span class='badge-custom'>#{$d['no_daftar']}</span></td>
                                                <td><span class='text-dark fw-bold'>{$d['nama_pemohon']}</span></td>
                                                <td>" . date('d M Y', strtotime($d['tgl_daftar'])) . "</td>
                                                <td><i class='bi bi-calendar-event me-2 text-primary'></i>{$waktu_datang} WIB</td>
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