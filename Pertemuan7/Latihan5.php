<HTML>
<HEAD>
    <TITLE>Penggunaan List</TITLE>
</HEAD>
<BODY>
<?php
    $program = array('Haikyuu','Avenger End Game','The Counjuring');
    
    // Mengambil komponen array menjadi variabel terpisah
    list($Majalah, $Komik, $Film) = $program;

    echo "Jenis Buku & Hiburan :";
    echo "<br />";
    echo "Cerpen : $Majalah"; 
    echo "<br />";
    echo "Cerita Bergambar : $Komik"; 
    echo "<br />";
    echo "Bioskop : $Film";
?>
</BODY>
</HTML>