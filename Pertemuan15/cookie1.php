<?php
// Mendefinisikan nilai yang akan disimpan
$value = 'Data milik Kazim';
$value2 = 'Data tambahan Kazim Avie';

// Proses penciptaan cookie
setcookie("kazim", $value); // Tanpa batas waktu (hilang saat browser ditutup)
setcookie("kazim_avie", $value2, time() + 3600); // Bertahan 1 jam ke depan

echo "<h1>Ini halaman pengesetan cookie</h1>";
echo "<h2>Klik <a href='cookie2.php'>di sini</a> untuk pemeriksaan cookies</h2>";
?>