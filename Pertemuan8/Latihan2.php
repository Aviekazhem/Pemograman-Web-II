<html>
<head><title>Contoh Penggunaan UDF</title></head>
<body>
    <form method="POST">
        Masukkan Bilangan Pertama : <br>
        <input type="text" name="A" size=10> <br>
        Masukkan Bilangan Kedua : <br>
        <input type="text" name="B" size=10> <br>
        <input type="submit" name="hitung" value="hitung">
    </form>

<?php
if (isset($_POST['hitung'])) {
    $A = $_POST["A"]; // Mengambil nilai dari input A [cite: 108]
    $B = $_POST["B"]; // Mengambil nilai dari input B [cite: 109]

    // Definisi fungsi-fungsi aritmatika [cite: 110-128]
    function jumlah($A, $B) { return $A + $B; }
    function kurang($A, $B) { return $A - $B; }
    function kali($A, $B) { return $A * $B; }
    function bagi($A, $B) { return $A / $B; }

    echo "<br>";
    echo "Bilangan Pertama : $A <br>";
    echo "Bilangan Kedua : $B <br><br>";

    // Menampilkan Hasil Penjumlahan [cite: 137-141]
    $hasil_jumlah = jumlah($A, $B);
    printf("Hasil Penjumlahan: %d + %d = %d <br><br>", $A, $B, $hasil_jumlah);

    // Menampilkan Hasil Pengurangan [cite: 143-146]
    $hasil_kurang = kurang($A, $B);
    printf("Hasil Pengurangan: %d - %d = %d <br><br>", $A, $B, $hasil_kurang);

    // Menampilkan Hasil Perkalian [cite: 148-152]
    $hasil_kali = kali($A, $B);
    printf("Hasil Perkalian: %d * %d = %d <br><br>", $A, $B, $hasil_kali);

    // Menampilkan Hasil Pembagian [cite: 154-157]
    $hasil_bagi = bagi($A, $B);
    printf("Hasil Pembagian: %d / %d = %d <br><br>", $A, $B, $hasil_bagi);
}
?>
</body>
</html>