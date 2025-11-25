<?php
$jumlah_penyelesaian_3_tingkat = 0;

echo "<h3>Versi Wajib 3 Tingkat:</h3>";

// Loop 1
for ($x = 1; $x <= 23; $x++) { 
    // Loop 2
    for ($y = 1; $y <= 23; $y++) {
        // Loop 3
        for ($z = 1; $z <= 23; $z++) {
            
            // Cek kondisi
            if ($x + $y + $z == 25) {
                echo "x = ".$x.", y = ".$y.", z = ".$z."<br>";
                $jumlah_penyelesaian_3_tingkat++;
            }
        }
    }
}
echo "<p>Jumlah penyelesaian (3 tingkat): ".$jumlah_penyelesaian_3_tingkat."</p>";
?>
