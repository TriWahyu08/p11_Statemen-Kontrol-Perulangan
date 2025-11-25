<?php

// untuk memastikan data sdh disubmit melalui form
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ambil data dari form
    $saldo = (int)$_POST['saldo_awal'];
    $n_bulan = (int)$_POST['bulan'];

    // Konstanta
    $biaya_admin = 9000;
    $batas_saldo_bunga = 1100000;
    $bunga_rendah_pa = 0.03; // 3% p.a
    $bunga_tinggi_pa = 0.04; // 4% p.a

    // Konversi bunga tahunan (p.a) ke bunga bulanan
    // (Bunga tahunan dibagi 12)
    $bunga_rendah_pb = $bunga_rendah_pa / 12;
    $bunga_tinggi_pb = $bunga_tinggi_pa / 12;

    echo "<h2>Hasil Perhitungan Saldo</h2>";
    echo "<table>";
    echo "<tr><th>Bulan ke-</th><th>Saldo Awal Bulan</th><th>Bunga Diterima</th><th>Biaya Admin</th><th>Saldo Akhir Bulan</th></tr>";
    
    // Perulangan untuk menghitung saldo setiap bulan
    for ($i = 1; $i <= $n_bulan; $i++) {
        
        $saldo_awal_bulan = $saldo;

        // 1. Tentukan tingkat bunga bulanan
        if ($saldo_awal_bulan < $batas_saldo_bunga) {
            $tingkat_bunga = $bunga_rendah_pb; // 3% p.a / 12
        } else {
            $tingkat_bunga = $bunga_tinggi_pb; // 4% p.a / 12
        }

        // 2. Hitung Bunga
        // Pembulatan menggunakan round() agar perhitungan rapi
        $bunga_diterima = round($saldo_awal_bulan * $tingkat_bunga);

        // 3. Tambahkan Bunga dan Kurangi Biaya Administrasi
        $saldo = $saldo_awal_bulan + $bunga_diterima - $biaya_admin;

        // Pastikan saldo tidak menjadi negatif
        if ($saldo < 0) {
            $saldo = 0;
        }

        // Tampilkan detail perhitungan untuk bulan ini
        echo "<tr>";
        echo "<td>$i</td>";
        echo "<td>Rp. " . number_format($saldo_awal_bulan, 0, ',', '.') . "</td>";
        echo "<td>Rp. " . number_format($bunga_diterima, 0, ',', '.') . "</td>";
        echo "<td>Rp. " . number_format($biaya_admin, 0, ',', '.') . "</td>";
        echo "<td>Rp. " . number_format($saldo, 0, ',', '.') . "</td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "<hr>";
    echo "<h3> Saldo Akhir setelah $n_bulan bulan adalah: <span style='color: green;'>Rp. " . number_format($saldo, 0, ',', '.') . "</span></h3>";

} else {
    // Jika diakses tanpa submit form
    echo "<p>Silakan isi form di <a href='form_saldo.html'>sini</a> untuk memulai perhitungan.</p>";
}
?>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 20px;
    }
    th, td {
        border: 1px solid #ddddddff;
        padding: 8px;
        text-align: right;
    }
    th {
        background-color: #f2f2f2;
        text-align: center;
    }
</style>
