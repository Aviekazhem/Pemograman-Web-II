<HTML>
<HEAD>
    <TITLE>Penggunaan Join</TITLE>
</HEAD>
<BODY>
<?php
    $var = array('18', '11', '2010');
    
    // Menggabungkan array menggunakan "/"
    $tanggal = join("/", $var);

    echo "$tanggal";
?>
</BODY>
</HTML>