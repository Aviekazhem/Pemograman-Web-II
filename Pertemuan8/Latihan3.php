<?php
// Parameter $num memiliki nilai default 10
function repeat($text, $num = 15)
{
    echo "<ol>";
    for($i = 0; $i < $num; $i++)
    {
        echo "<li>$text</li>";
    }
    echo "</ol>";
}

// Panggilan 1: Mengisi kedua argumen (akan muncul 15 kali)
repeat("I'm the best", 5);

// Panggilan 2: Hanya mengisi satu argumen (akan menggunakan default 10 kali)
repeat("You're the man");
?>