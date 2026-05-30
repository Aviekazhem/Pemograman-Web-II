<?php
// set the expiration date to one hour ago
setcookie ("kazim", "", time() - 3600);
setcookie ("kazim_avie", "", time() - 3600); // Spasi diganti dengan underscore

echo "<h1>Cookie Berhasil dihapus.</h1>";
echo "<h2>Klik <a href='cookie1.php'>di sini</a> untuk penciptaan cookies</h2>";
echo "<h2>Klik <a href='cookie2.php'>di sini</a> untuk pemeriksaan cookies</h2>";
?>