<!DOCTYPE HTML>
<html lang="id">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>FP-Statkom</title>
   <link href="css/indexhomestyle.css" rel="stylesheet" type="text/css">
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

<div class="content">
<h2><span>Naive Bayes</span> Dalam Menentukan Penerima Bantuan Langsung Tunai</h2>
<div class="underline"></div>

   <div class="section pendahuluan">
      <div class="text-content">
         <h3>Pendahuluan</h3>
         <p>
            Studi kasus ini bertujuan untuk menentukan penerima Bantuan Langsung Tunai (BLT) dengan memanfaatkan algoritma Naive Bayes. Dalam situasi pandemi, banyak masyarakat yang memerlukan bantuan keuangan. Penentuan penerima bantuan ini seringkali memerlukan pendekatan berbasis data untuk memastikan distribusi yang adil dan efektif. Algoritma Naive Bayes memungkinkan kita menganalisis data penerima berdasarkan atribut/kriteria yang memengaruhi kelayakan mereka untuk menerima bantuan.
         </p>
      </div>

      <div class="slider-container">
         <div class="slider-images">
            <img src="https://upload.wikimedia.org/wikipedia/id/e/ec/55220613-BLT_-_Copy.jpg" alt="Bantuan Langsung Tunai">
            <img src="https://static.promediateknologi.id/crop/0x0:0x0/0x0/webp/photo/radarjember/2022/07/28-07-semeru-kin-lapsus-dana-BLT-DD-2.jpg" alt="Penyaluran Dana BLT">
            <img src="https://mmc.tirto.id/image/2017/02/22/20130704114115425copy.jpg" alt="Penerimaan BLT">
         </div>
         <div class="slider-nav">
            <button onclick="moveSlide(-1)">&#8249;</button>
            <button onclick="moveSlide(1)">&#8250;</button>
         </div>
      </div>
   </div>

   <div class="section dataset">
      <div class="dataset-container">
         <div class="dataset-info">
            <h3>Dataset</h3>
            <p>
               Dataset yang digunakan dalam studi ini berasal dari data pemerintah lokal yang mengelola penerima bantuan sosial, seperti Program Keluarga Harapan (PKH) dan Bantuan Pangan Non-Tunai (BPNT). Data ini meliputi berbagai atribut yang relevan dengan status kelayakan penerima bantuan.
            </p>
         </div>

      <div class="dataset-source">
         <img src="https://img.icons8.com/?size=100&id=7880&format=png&color=000000" alt="location"> <!-- Updated logo source -->
            <p><strong>Sumber Data:</strong> <em>Data Kantor Desa Perkebunan Air Batu III/IX dan Kantor Desa Sei Alim Ulu</em></p>
      </div>
      </div>
   </div>

   <div class="data-boxes">
      <div class="data-box">
         <strong>Jumlah Data:</strong>
         <p>154 data penerima bantuan</p>
      </div>
      <div class="data-box">
         <strong>Data Training:</strong>
         <p>80% (123 data)</p>
      </div>
      <div class="data-box">
         <strong>Data Testing:</strong>
         <p>20% (31 data)</p>
      </div>
   </div>

   <div class="dataset-box">
      <p>Dataset ini telah melalui tahap preprocessing, termasuk penghapusan data yang tidak lengkap dan normalisasi untuk memastikan analisis dapat dilakukan secara akurat.</p>
   </div>

   <div class="section">
      <h3>Atribut/Kriteria yang Mempengaruhi Penerima BLT</h3>
      <p>
         Beberapa atribut/kriteria yang memengaruhi keputusan penerima BLT dalam studi kasus ini adalah:
      </p>
      <div class="criteria-container">
         <div class="criteria-box">
            <strong>Jenis Kelamin:</strong>
            <p>Laki-laki atau Perempuan</p>
         </div>
         <div class="criteria-box">
            <strong>Program PKH:</strong>
            <p>Ya atau Non</p>
         </div>
         <div class="criteria-box">
            <strong>BPNT (Bantuan Pangan Non Tunai):</strong>
            <p>Ya atau Non</p>
         </div>
         <div class="criteria-box">
            <strong>Kehilangan Pekerjaan:</strong>
            <p>Ya atau Tidak</p>
         </div>
         <div class="criteria-box">
            <strong>Tidak Terdata:</strong>
            <p>Terdata atau Tidak Terdata</p>
         </div>
         <div class="criteria-box">
            <strong>Anggota Keluarga Sakit Kronis:</strong>
            <p>Ya atau Tidak</p>
         </div>
      </div>
   </div>

   <div class="section keterangan-container">
      <h3>Analisis Kriteria</h3>
      <p>
         Kriteria ini dianalisis untuk menentukan probabilitas penerima BLT berdasarkan status akhir: <strong>Layak (C1)</strong> atau <strong>Tidak Layak (C0)</strong>.
      </p>
   </div>

   <div class="section naive-bayes">
      <div style="display: flex; flex-direction: column; gap: 0.1px;">
            <h3>Algoritma Naive Bayes</h3>
      <div style="display: flex; flex-direction: column; gap: 0.0001px;">
         <p>Algoritma Naive Bayes memprediksi peluang berdasarkan data historis, menggunakan teorema Bayes. Keunggulannya meliputi kemudahan implementasi, kecepatan perhitungan, dan efisiensi data.</p>
      <div style="display: flex; flex-direction: column; gap: 0.1px;">
         <p style="text-align: center; font-style: italic; font-weight: bold;">
            P(C|X) = P(X|C) ⋅ P(C) / P(X)
      <div style="display: flex; flex-direction: column; gap: 0.1px;">
         <p>
         Keterangan:
         <ul style="list-style-type: disc; margin-left: 20px; margin-bottom: 15px;">
            <li><strong>P(C|X):</strong> Probabilitas kelas C (Layak atau Tidak Layak) diberikan data X (fitur/kriteria).</li>
            <li><strong>P(X|C):</strong> Probabilitas fitur X diberikan kelas C.</li>
            <li><strong>P(C):</strong> Probabilitas prior untuk kelas C.</li>
            <li><strong>P(X):</strong> Probabilitas fitur X di seluruh kelas.</li>
         </ul>
         </p>
      <p>
         Dengan pendekatan ini, kita dapat menghitung probabilitas penerima yang layak atau tidak layak untuk menerima BLT berdasarkan atribut/kriteria yang ada.
         Pada akhir perhitungan, status penerima ditentukan sebagai berikut:
      </p>
      <ul>
         <li>Jika hasil perhitungan menunjukkan bahwa <strong>P(C0|X) > P(C1|X)</strong>, yang berarti data tersebut diklasifikasikan sebagai <strong>Tidak Layak</strong>.</li>
         <li>Jika hasil perhitungan menunjukkan bahwa <strong>P(C1|X) > P(C0|X)</strong>, yang berarti data tersebut diklasifikasikan sebagai <strong>Layak</strong>.</li>
      </ul>
   </div>
</div>

<script src="js/menuscript.js"></script>
<script src="js/slider.js"></script>

</body>
</html>
