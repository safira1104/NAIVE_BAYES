<?php
// Mulai sesi
session_start();

// Menghubungkan ke database
include_once 'config.php';

// Fungsi untuk menghitung probabilitas kriteria berdasarkan kategori dan status
function hitungProbabilitasKriteria($conn, $kriteria, $kategori, $status) {
    $sql = "SELECT COUNT(*) AS count 
            FROM data 
            WHERE TRIM($kriteria) = '$kategori' AND status = '$status'";
    $result = $conn->query($sql);
    if ($result) {
        return $result->fetch_assoc()['count'];
    } else {
        die("Error retrieving data for $kriteria: " . $conn->error);
    }
}

// Penyesuaian pada perhitungan untuk seluruh kriteria
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil input dari form dan trim spasi ekstra
    $nama = trim($_POST['nama']);
    $kepala_rumah_tangga = trim($_POST['kepala_rumah_tangga']);
    $pkh = trim($_POST['pkh']);
    $bpnt = trim($_POST['bpnt']);
    $kehilangan_pencaharian = trim($_POST['kehilangan_pencaharian']);
    $tidak_terdata = str_replace('_', '', trim($_POST['tidak_terdata'])); // Hapus karakter "_"
    $anggota_keluarga_sakit_kronis = trim($_POST['anggota_keluarga_sakit_kronis']);

    // Ambil total jumlah data status Layak dan Tidak Layak
    $sqlTotalLayak = "SELECT COUNT(*) AS total_layak FROM data WHERE status = 'Layak'";
    $sqlTotalTidakLayak = "SELECT COUNT(*) AS total_tidak_layak FROM data WHERE status = 'Tidak Layak'";

    $resultLayak = $conn->query($sqlTotalLayak);
    $resultTidakLayak = $conn->query($sqlTotalTidakLayak);

    if ($resultLayak && $resultTidakLayak) {
        $totalLayak = $resultLayak->fetch_assoc()['total_layak'];
        $totalTidakLayak = $resultTidakLayak->fetch_assoc()['total_tidak_layak'];
    } else {
        die("Error retrieving total counts: " . $conn->error);
    }

    // Probabilitas dasar untuk status Layak dan Tidak Layak
    $probLayak = $totalLayak / ($totalLayak + $totalTidakLayak);
    $probTidakLayak = $totalTidakLayak / ($totalLayak + $totalTidakLayak);

    // Kriteria array untuk tiap kolom yang dipilih dari form
    $kriteria = [
        'kepala_rumah_tangga' => $kepala_rumah_tangga,
        'pkh' => $pkh,
        'bpnt' => $bpnt,
        'kehilangan_pencaharian' => $kehilangan_pencaharian,
        'tidak_terdata' => $tidak_terdata,
        'anggota_keluarga_sakit_kronis' => $anggota_keluarga_sakit_kronis
    ];

    // Inisialisasi perkalian kumulatif untuk setiap kelas
    $perkalianLayak = 0.5853658537;
    $perkalianTidakLayak = 0.4146341463;

    // Hitung probabilitas untuk setiap kriteria dan simpan hasilnya
    $probabilitas = [];
    foreach ($kriteria as $k => $v) {
        $countC1 = hitungProbabilitasKriteria($conn, $k, $v, 'Layak');
        $countC0 = hitungProbabilitasKriteria($conn, $k, $v, 'Tidak Layak');

        // Hitung probabilitas dengan logika khusus untuk kriteria "tidak_terdata"
        if ($k === 'tidak_terdata' && $v === 'TidakTerdata') {
            // Kelas Layak menggunakan probabilitas biasa
            $probKriteriaC1 = $countC1 > 0 ? $countC1 / $totalLayak : 1e-6;

            // Kelas Tidak Layak menggunakan Laplace Smoothing
            $uniqueKategori = $conn->query("SELECT DISTINCT $k FROM data")->num_rows;
            $probKriteriaC0 = ($countC0 + 1) / ($totalTidakLayak + $uniqueKategori);
        } else {
            // Probabilitas biasa untuk kriteria lainnya
            $probKriteriaC1 = $countC1 > 0 ? $countC1 / $totalLayak : 1e-6;
            $probKriteriaC0 = $countC0 > 0 ? $countC0 / $totalTidakLayak : 1e-6;
        }

        // Perkalian biasa untuk Layak dan Tidak Layak
        $perkalianLayak *= $probKriteriaC1;
        $perkalianTidakLayak *= $probKriteriaC0;

        // Simpan hasil perhitungan untuk ditampilkan
        $probabilitas[] = [
            'kriteria' => $k,
            'value' => $v,
            'P(Kriteria | Layak)' => number_format($probKriteriaC1, 4),
            'P(Kriteria | Tidak Layak)' => number_format($probKriteriaC0, 4)
        ];
    }

    // Tentukan hasil prediksi berdasarkan hasil perkalian akhir
    $result = ($perkalianLayak > $perkalianTidakLayak) ? 'Layak' : 'Tidak Layak';

    // Hitung persentase probabilitas
    $persentaseLayak = $perkalianLayak / ($perkalianLayak + $perkalianTidakLayak) * 100;
    $persentaseTidakLayak = $perkalianTidakLayak / ($perkalianLayak + $perkalianTidakLayak) * 100;


// Tampilkan hasil perhitungan
echo '<div class="card">';
echo '<div class="card-body">';

// Memperbesar tulisan "Hasil Prediksi", memusatkan, dan menambahkan garis di bawahnya
echo '<div style="text-align: center; font-size: 2em; font-weight: bold; margin-bottom: 20px; border-bottom: 2px solid #d3d3d3;">
    <span style="color: #102a71;">Hasil</span> <span style="color: #f5c400;">Prediksi</span> </div>';

// Memperbesar tulisan "Nama" dan "Detail Perhitungan" dengan ukuran yang sama dan sejajar dengan tabel
echo '<div style="text-align: left; width: 60%; margin: 0 auto;">';
echo '<p style="font-size: 20px; margin-left: 0; color: #102a71;"><strong>Nama:</strong> ' . htmlspecialchars($nama) . '</p>';
echo '<h5 style="font-size: 20px; margin-left: 0; color: #102a71;"><strong>Detail Perhitungan:</strong></h5>';
echo '</div>';

// Tabel dengan ukuran lebih kecil dan berada di tengah, tulisan sejajar dengan tabel
echo '<table style="width: 60%; margin: 0 auto; border-collapse: collapse;">';
echo '<tr><th style="border: 1px solid #d3d3d3; padding: 10px;">Kriteria</th><th style="border: 1px solid #d3d3d3; padding: 10px;">Nilai</th><th style="border: 1px solid #d3d3d3; padding: 10px;">P(Kriteria | Layak)</th><th style="border: 1px solid #d3d3d3; padding: 10px;">P(Kriteria | Tidak Layak)</th></tr>';

// Definisikan manual nama kriteria
$namaKriteria = [
    'kepala_rumah_tangga' => 'Kepala Rumah Tangga',
    'pkh' => 'PKH',
    'bpnt' => 'BPNT',
    'kehilangan_pencaharian' => 'Kehilangan Pencaharian',
    'tidak_terdata' => 'Tidak Terdata',
    'anggota_keluarga_sakit_kronis' => 'Anggota Keluarga Sakit Kronis'
];

foreach ($probabilitas as $detail) {
    echo '<tr>';
    // Ganti kriteria dengan yang sudah didefinisikan secara manual
    $kriteriaManual = $namaKriteria[$detail['kriteria']] ?? $detail['kriteria']; // Jika kriteria tidak ada di array, tetap tampilkan key
    echo '<td style="border: 1px solid #d3d3d3; padding: 10px;">' . htmlspecialchars($kriteriaManual) . '</td>';
    echo '<td style="border: 1px solid #d3d3d3; padding: 10px;">' . htmlspecialchars($detail['value']) . '</td>';
    echo '<td style="border: 1px solid #d3d3d3; padding: 10px;">' . $detail['P(Kriteria | Layak)'] . '</td>';
    echo '<td style="border: 1px solid #d3d3d3; padding: 10px;">' . $detail['P(Kriteria | Tidak Layak)'] . '</td>';
    echo '</tr>';
}

// Tambahkan baris untuk total perkalian
echo '<tr>';
echo '<td colspan="2" style="border: 1px solid #d3d3d3; padding: 10px;"><strong>Total Perkalian</strong></td>';
echo '<td style="border: 1px solid #d3d3d3; padding: 10px;">' . number_format($perkalianLayak, 6) . '</td>';
echo '<td style="border: 1px solid #d3d3d3; padding: 10px;">' . number_format($perkalianTidakLayak, 6) . '</td>';
echo '</tr>';

// Menampilkan persentase
echo '<tr>';
echo '<td colspan="2" style="border: 1px solid #d3d3d3; padding: 10px;"><strong>Persentase Probabilitas</strong></td>';
echo '<td style="border: 1px solid #d3d3d3; padding: 10px;">' . number_format($persentaseLayak, 2) . '%</td>';
echo '<td style="border: 1px solid #d3d3d3; padding: 10px;">' . number_format($persentaseTidakLayak, 2) . '%</td>';
echo '</tr>';

// Keterangan hasil perbandingan
echo '<tr>';
echo '<td colspan="2" style="border: 1px solid #d3d3d3; padding: 10px;"><strong>Hasil Prediksi</strong></td>';
echo '<td colspan="2" style="border: 1px solid #d3d3d3; padding: 10px;">' . ($perkalianLayak > $perkalianTidakLayak ? "Layak > Tidak Layak" : "Tidak Layak > Layak") . '</td>';
echo '</tr>';

echo '</table>';

echo '</div>'; // End of card-body
echo '</div>'; // End of card
}

// Tampilkan hasil status akhir dengan garis kiri tabel
echo '<div style="text-align: left; width: 60%; margin: 20px auto; display: flex; justify-content: space-between; align-items: center;">';
echo '<div>';
echo '<h4 style="font-size: 24px; font-weight: bold; color: #102a71; display: inline;"><strong>Status Akhir: </strong></h4>'; // Perbesar ukuran teks "Status Akhir" dan buatnya inline

// Mengubah warna teks berdasarkan nilai $result
if ($result == 'Layak') {
    echo '<span style="font-size: 24px; color: green; display: inline; font-weight: bold;">' . htmlspecialchars($result) . '</span>'; // Jika "layak", warna hijau
} else {
    echo '<span style="font-size: 24px; color: red; display: inline; font-weight: bold;">' . htmlspecialchars($result) . '</span>'; // Jika "tidak layak", warna merah
}
echo '</div>';

// Tambahkan tombol Back
echo '<a href="prediksi.php" style="
    text-decoration: none; 
    background-color: #102a71; 
    color: white; 
    padding: 10px 20px; 
    font-size: 16px; 
    font-weight: bold; 
    border-radius: 5px; 
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s ease, color 0.3s ease;" 
    onmouseover="this.style.backgroundColor=\'#f5c400\'; this.style.color=\'#102a71\';"
    onmouseout="this.style.backgroundColor=\'#102a71\'; this.style.color=\'white\';"
>Back</a>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input dan Hasil Prediksi</title>
    <link href="css/hasilprediksistyle.css" rel="stylesheet" type="text/css"> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
</head>
<body>
</body>
</html>  