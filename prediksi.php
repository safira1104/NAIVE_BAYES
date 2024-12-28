<?php

$content = '
<section style="text-align: center; 
display: flex; 
flex-direction: column; 
justify-content: center; 
align-items: center; 
margin: 0;">
  <h2 style="color: white;">
    <strong>
      <span style="color: #f5c400;">Algoritma Naive Bayes</span> <br> 
      <span style="color: #102a71;">Menentukan Penerima Bantuan Langsung Tunai</span>
    </strong>
  </h2>
</section>

<section class="container mt-4" style="max-width: 800px; width: 90%; margin: 0 auto;">
  <div class="form-container">
    <div class="card shadow-lg" style="border-radius: 15px; width: 100%; max-width: 800px; margin: 0 auto;">
      <div class="card-body">
        <form method="post" action="hasil_prediksi.php">
          <h4 class="card-title text-center mb-4"><span style="color: #F5C400;">Input Data</span>
          <span style="color: #102a71;">Penerima Bantuan</span> </h4>
          <table class="table table-bordered">
            <tbody>
              <tr>
                <td><strong>Nama Lengkap</strong></td>
                <td><input type="text" name="nama" placeholder="Masukkan Nama Lengkap" required class="form-control"></td>
              </tr>
              <tr>
                <td><strong>Kepala Rumah Tangga</strong></td>
                <td>
                  <select name="kepala_rumah_tangga" class="form-control">
                    <option value="Perempuan">Perempuan</option>
                    <option value="Laki-Laki">Laki-Laki</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td><strong>PKH</strong></td>
                <td>
                  <select name="pkh" class="form-control">
                    <option value="Non">Non</option>
                    <option value="Ya">Ya</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td><strong>BPNT</strong></td>
                <td>
                  <select name="bpnt" class="form-control">
                    <option value="Non">Non</option>
                    <option value="Ya">Ya</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td><strong>Kehilangan Pencaharian</strong></td>
                <td>
                  <select name="kehilangan_pencaharian" class="form-control">
                    <option value="Tidak">Tidak</option>
                    <option value="Ya">Ya</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td><strong>Tidak Terdata</strong></td>
                <td>
                  <select name="tidak_terdata" class="form-control">
                    <option value="Tidak_Terdata">Tidak Terdata</option>
                    <option value="Terdata">Terdata</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td><strong>Anggota Keluarga Dengan Sakit Kronis</strong></td>
                <td>
                  <select name="anggota_keluarga_sakit_kronis" class="form-control">
                    <option value="Tidak">Tidak</option>
                    <option value="Ya">Ya</option>
                  </select>
                </td>
              </tr>
            </tbody>
          </table>
          <br>
          <button type="submit" value="Submit" class="btn btn-danger btn-block">Kalkulasi</button>
        </form>
      </div>
    </div>
  </div>
</section>';
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1">
  <title>FP-Statkom</title>
  <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/menubutton.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
</head>

<body>

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

<div class="toggle-arrow" id="toggleArrow">▼</div>

<div class="content-wrapper">
  <?php echo $content; ?>
</div>

<script src="js/menuscript.js"></script>
</body>
</html>