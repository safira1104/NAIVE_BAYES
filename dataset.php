<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FP-Statkom</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/datasetsyle.css" rel="stylesheet" type="text/css">
    <link href="css/menubutton.css" rel="stylesheet" type="text/css"> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
</head>

<body>
<!-- Menu Tombol -->
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
    <h2 class="data-training-title">
        <span class="data-text">Data</span>
        <span class="space"> </span> 
        <span class="training-text">Training dan Testing</span>
    </h2>

    <?php
        include_once 'config.php';

        // impor data dari .csv ke database (Data Training)
        $file_training = 'database/data.csv';
        if (file_exists($file_training)) {
            $handle_training = fopen($file_training, 'r');
            fgetcsv($handle_training); // pengecualian header
            while (($data = fgetcsv($handle_training, 1000, ',')) !== FALSE) {
                $no = $data[0]; 
                $nama_lengkap = $data[1]; 
                $kepala_rumah_tangga = $data[2];
                $pkh = $data[3];
                $bpnt = $data[4];
                $kehilangan_pencaharian = $data[5];
                $tidak_terdata = $data[6];
                $anggota_keluarga_sakit_kronis = $data[7];
                $status = $data[8];

                $sql_training = "INSERT IGNORE INTO data (no, nama_lengkap, kepala_rumah_tangga, pkh, bpnt, kehilangan_pencaharian, tidak_terdata, anggota_keluarga_sakit_kronis, status) 
                        VALUES ('$no', '$nama_lengkap', '$kepala_rumah_tangga', '$pkh', '$bpnt', '$kehilangan_pencaharian', '$tidak_terdata', '$anggota_keluarga_sakit_kronis', '$status')";
                mysqli_query($conn, $sql_training);
            }
            fclose($handle_training);
        }

        // impor data dari .csv ke database (Data Testing)
        $file_uji = 'database/data_uji.csv';
        if (file_exists($file_uji)) {
            $handle_uji = fopen($file_uji, 'r');
            fgetcsv($handle_uji); // pengecualian header
            while (($data = fgetcsv($handle_uji, 1000, ',')) !== FALSE) {
                $no = $data[0]; 
                $nama_lengkap = $data[1]; 
                $kepala_rumah_tangga = $data[2];
                $pkh = $data[3];
                $bpnt = $data[4];
                $kehilangan_pencaharian = $data[5];
                $tidak_terdata = $data[6];
                $anggota_keluarga_sakit_kronis = $data[7];
                $status = $data[8];

                $sql_uji = "INSERT IGNORE INTO data_uji (no, nama_lengkap, kepala_rumah_tangga, pkh, bpnt, kehilangan_pencaharian, tidak_terdata, anggota_keluarga_sakit_kronis, status) 
                        VALUES ('$no', '$nama_lengkap', '$kepala_rumah_tangga', '$pkh', '$bpnt', '$kehilangan_pencaharian', '$tidak_terdata', '$anggota_keluarga_sakit_kronis', '$status')";
                mysqli_query($conn, $sql_uji);
            }
            fclose($handle_uji);
        }
        ?>

        <!-- Tabel Data Training -->
        <h3>Data Training</h3>
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
                <?php
                $query_training = "SELECT * FROM data";
                $result_training = mysqli_query($conn, $query_training);
                while ($row = mysqli_fetch_assoc($result_training)) {
                    echo "<tr>
                            <td>{$row['no']}</td>
                            <td>{$row['nama_lengkap']}</td>
                            <td>{$row['kepala_rumah_tangga']}</td>
                            <td>{$row['pkh']}</td>
                            <td>{$row['bpnt']}</td>
                            <td>{$row['kehilangan_pencaharian']}</td>
                            <td>{$row['tidak_terdata']}</td>
                            <td>{$row['anggota_keluarga_sakit_kronis']}</td>
                            <td>{$row['status']}</td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Tabel Data Uji -->
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
                <?php
                $query_uji = "SELECT * FROM data_uji";
                $result_uji = mysqli_query($conn, $query_uji);
                while ($row = mysqli_fetch_assoc($result_uji)) {
                    echo "<tr>
                            <td>{$row['no']}</td>
                            <td>{$row['nama_lengkap']}</td>
                            <td>{$row['kepala_rumah_tangga']}</td>
                            <td>{$row['pkh']}</td>
                            <td>{$row['bpnt']}</td>
                            <td>{$row['kehilangan_pencaharian']}</td>
                            <td>{$row['tidak_terdata']}</td>
                            <td>{$row['anggota_keluarga_sakit_kronis']}</td>
                            <td>{$row['status']}</td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    
<script src="js/menuscript.js"></script> 
</body>
</html>