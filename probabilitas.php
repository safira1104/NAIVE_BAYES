<?php
    include_once 'config.php'; // Menghubungkan ke database

    // Query untuk memanggil semua data yang diperlukan
    $sqlData = "SELECT * FROM data";
    $dataResult = $conn->query($sqlData);

    // Variabel untuk menghitung jumlah total Layak dan Tidak Layak
    $totalLayak = 0;
    $totalTidakLayak = 0;
    $data = [];

    // Menampung semua data dalam array
    while ($row = $dataResult->fetch_assoc()) {
        $data[] = $row;
    if ($row['status'] == 'Layak') {
        $totalLayak++;
    } elseif ($row['status'] == 'Tidak Layak') {
        $totalTidakLayak++;
    }
    }

    // Kriteria yang akan dihitung
    $kriteria = ['kepala_rumah_tangga', 'pkh', 'bpnt', 'kehilangan_pencaharian', 'tidak_terdata', 'anggota_keluarga_sakit_kronis'];
?>

<!DOCTYPE HTML>
<html lang="id">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, maximum-scale=1">
   <title>FP-Statkom</title>
   <link href="css/probabilitasstyle.css" rel="stylesheet" type="text/css">
   <link href="css/menubutton.css" rel="stylesheet" type="text/css">
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
</head>

<body>

<!-- Menu Gambar -->
<div class="menu-container" id="menuContainer">
    <h3><span style="color: #102a71;">Algoritma</span> <br> <span style="color: #f5c400;">Naive Bayes</span></h3>
    <div class="menu-buttons">
        <a href="index.php" class="menu-button">
            <img src="https://img.icons8.com/?size=100&id=utVqz5OlvGCj&format=png&color=000000" alt="About">
            <div>About</div>
        </a>
        <a href="dataset.php" class="menu-button">
            <img src="https://img.icons8.com/?size=100&id=1475&format=png&color=000000" alt="Dataset">
            <div>Dataset</div>
        </a>
        <a href="probabilitas.php" class="menu-button">
            <img src="https://img.icons8.com/?size=100&id=6Qu2M6pepGCE&format=png&color=000000" alt="Probabilitas">
            <div>Probabilitas</div>
        </a>
        <a href="akurasi.php" class="menu-button">
            <img src="https://img.icons8.com/ios-filled/50/000000/checklist.png" alt="Akurasi">
            <div>Akurasi</div>
        </a>
        <a href="prediksi.php" class="menu-button">
            <img src="https://img.icons8.com/?size=100&id=RYcCGyq4E6Bv&format=png&color=000000" alt="Prediksi">
            <div>Prediksi</div>
        </a>
    </div>
</div>

<!-- Tombol Panah Menu -->
<div class="toggle-arrow" id="toggleArrow">▼</div>


<div class="content-wrapper" id="content">
    <div class="hasil-probabilitas-title">
        <span class="hasil-text">Hasil</span><span class="probabilitas-text">Probabilitas</span>
    </div>

<?php
    // Menghitung probabilitas untuk setiap kriteria
    foreach ($kriteria as $k) {
       // Mengubah nama kriteria agar lebih mudah dibaca
        $formattedKriteria = ucwords(str_replace('_', ' ', $k));
        // Kondisi khusus untuk mengubah "Pkh" menjadi "PKH" dan "Bpnt" menjadi "BPNT"
            if ($formattedKriteria === 'Pkh') {
                $formattedKriteria = 'PKH';
            } elseif ($formattedKriteria === 'Bpnt') {
                $formattedKriteria = 'BPNT';
            }
       // Inisialisasi variabel untuk menghitung jumlah untuk setiap kategori
        $kategoriCount = [];
       // Menghitung jumlah untuk setiap kategori dalam kriteria
        foreach ($data as $row) {
            $kategori = $row[$k];
            if (!isset($kategoriCount[$kategori])) {
                $kategoriCount[$kategori] = ['layak' => 0, 'tidak_layak' => 0];
            }
        // Hitung jumlah Layak dan Tidak Layak berdasarkan kategori
            if ($row['status'] == 'Layak') {
                $kategoriCount[$kategori]['layak']++;
            } elseif ($row['status'] == 'Tidak Layak') {
                $kategoriCount[$kategori]['tidak_layak']++;
            }
        }
       // Menampilkan hasil untuk setiap kriteria
        echo "<h3 class='kriteria-header' style='color: #102A71;'>Kriteria: <span style='color: #F5C400;'>$formattedKriteria</span></h3>";
        echo "<table>
            <tr>
                <th>$formattedKriteria</th>
                <th>Jumlah Layak</th>
                <th>Jumlah Tidak Layak</th>
                <th style='color: #F5C400;'>Probabilitas Layak (C1)</th>
                <th style='color: #F5C400;'>Probabilitas Tidak Layak (C0)</th>
            </tr>";

        foreach ($kategoriCount as $kategori => $counts) {
            $layakCount = $counts['layak'];
            $tidakLayakCount = $counts['tidak_layak'];
            // Menghitung probabilitas Layak dan Tidak Layak
            $probLayak = $layakCount / $totalLayak;
            $probTidakLayak = $tidakLayakCount / $totalTidakLayak;
        echo "<tr>
                <td>$kategori</td>
                <td>$layakCount</td>
                <td>$tidakLayakCount</td>
                <td>" . round($probLayak, 4). "</td>
                <td>" . round($probTidakLayak, 4) . "</td>
            </tr>";
        }
        echo "</table>";
    }
?>
</div>

<script src="js/menuscript.js"></script>
</body>
</html>