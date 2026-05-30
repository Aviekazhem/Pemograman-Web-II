<?php
if(isset($_COOKIE['kazim'])) {
    echo "<h1>Cookie 'kazim' ada. Isinya : " . $_COOKIE['kazim'] . "</h1>";
} else {
    echo "<h1>Cookie 'kazim' TIDAK ada.</h1>";
}

if(isset($_COOKIE['kazim avie'])) {
    echo "<h1>Cookie 'kazim avie' ada. Isinya : " . $_COOKIE['kazim avie'] . "</h1>";
} else {
    echo "<h1>Cookie 'kazim avie' TIDAK ada.</h1>";
}

echo "<h2>Klik <a href='cookie1.php'>di sini</a> untuk penciptaan cookies</h2>";
echo "<h2>Klik <a href='cookie3.php'>di sini</a> untuk penghapusan cookies</h2>";
?>