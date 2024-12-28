<?php
// Fungsi untuk menghitung akurasi
function hitungAkurasi($dataUji, $hasilAktual) {
    $jumlahBenar = 0;
    $jumlahTotal = count($dataUji);

    // Loop untuk membandingkan hasil aktual dengan label prediksi
    foreach ($dataUji as $index => $data) {
        if ($data['label_prediksi'] == $hasilAktual[$index]) {
            $jumlahBenar++;
        }
    }

    // Hitung akurasi
    $akurasi = ($jumlahBenar / $jumlahTotal) * 100;
    return $akurasi;
}

// Data uji dengan label prediksi
$dataUji = [
    ['label_prediksi' => 'Tidak Layak'],
    ['label_prediksi' => 'Layak'],
    ['label_prediksi' => 'Layak'],
    ['label_prediksi' => 'Tidak Layak'],
    ['label_prediksi' => 'Tidak Layak'],
    ['label_prediksi' => 'Tidak Layak'],
    ['label_prediksi' => 'Layak'],
    ['label_prediksi' => 'Layak'],
    ['label_prediksi' => 'Tidak Layak'],
    ['label_prediksi' => 'Layak'],
    ['label_prediksi' => 'Layak'],
    ['label_prediksi' => 'Tidak Layak'],
    ['label_prediksi' => 'Tidak Layak'],
    ['label_prediksi' => 'Layak'],
    ['label_prediksi' => 'Layak'],
    ['label_prediksi' => 'Layak'],
    ['label_prediksi' => 'Layak'],
    ['label_prediksi' => 'Layak'],
    ['label_prediksi' => 'Tidak Layak'],
    ['label_prediksi' => 'Layak'],
    ['label_prediksi' => 'Layak'],
    ['label_prediksi' => 'Tidak Layak'],
    ['label_prediksi' => 'Tidak Layak'],
    ['label_prediksi' => 'Layak'],
    ['label_prediksi' => 'Tidak Layak']
];

// Contoh hasil aktual dari model
$hasilAktual = [
    'Tidak Layak', 'Layak', 'Layak', 'Tidak Layak', 'Layak',
    'Tidak Layak', 'Layak', 'Layak', 'Tidak Layak', 'Layak',
    'Layak', 'Tidak Layak', 'Tidak Layak', 'Layak', 'Layak',
    'Layak', 'Layak', 'Layak', 'Tidak Layak', 'Layak',
    'Layak', 'Tidak Layak', 'Tidak Layak', 'Layak', 'Tidak Layak'
];

// Hitung akurasi
$akurasi = hitungAkurasi($dataUji, $hasilAktual);

// Membaca file CSV
$file_uji = 'database/data_uji_label.csv';
$dataCSV = [];

if (file_exists($file_uji)) {
    $handle_uji = fopen($file_uji, 'r');
    fgetcsv($handle_uji); // Skip header CSV
    while (($data = fgetcsv($handle_uji, 1000, ',')) !== FALSE) {
        $dataCSV[] = $data;
    }
    fclose($handle_uji);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Perhitungan Akurasi Data Testing</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/akurasistyle.css" rel="stylesheet" type="text/css"> 
    <link href="css/menubutton.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
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

<!-- Main Content -->
<div class="container">
    <div class="card">
        <div class="card-header">
        Hasil Perhitungan <span class="highlight">Akurasi Data Testing</span>
        </div>
        <div class="card-body">
            <h3>Data Testing</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Kepala Rumah Tangga</th>
                        <th>PKH</th>
                        <th>BPNT</th>
                        <th>Kehilangan Pencaharian</th>
                        <th>Tidak Terdata</th>
                        <th>Anggota Keluarga Sakit Kronis</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dataCSV as $index => $data): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($index + 1); ?></td>
                            <td><?php echo htmlspecialchars($data[1]); ?></td>
                            <td><?php echo htmlspecialchars($data[2]); ?></td>
                            <td><?php echo htmlspecialchars($data[3]); ?></td>
                            <td><?php echo htmlspecialchars($data[4]); ?></td>
                            <td><?php echo htmlspecialchars($data[5]); ?></td>
                            <td><?php echo htmlspecialchars($data[6]); ?></td>
                            <td><?php echo htmlspecialchars($data[7]); ?></td>
                            <td><?php echo htmlspecialchars($data[8]); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <p><strong>Label Prediksi:</strong></p>
            <ul>
                <?php foreach ($dataUji as $index => $data): ?>
                    <li><?php echo "Data Ke-" . ($index + 1) . ": " . htmlspecialchars($data['label_prediksi']); ?></li>
                <?php endforeach; ?>
            </ul>
            <p><strong>Hasil Aktual:</strong></p>
            <ul>
                <?php foreach ($hasilAktual as $index => $aktual): ?>
                    <li><?php echo "Data Ke-" . ($index + 1) . ": " . htmlspecialchars($aktual); ?></li>
                <?php endforeach; ?>
            </ul>

            <div class="result">
                <p><strong>Akurasi Model: </strong><?php echo number_format($akurasi, 2); ?>%</p>
            </div>
        </div>
    </div>
</div>

<script src="js/menuscript.js"></script>

</body>
</html>
