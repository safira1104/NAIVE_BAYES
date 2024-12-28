<?php
// Koneksi ke database MySQL
$servername = "localhost"; // atau sesuai dengan host MySQL Anda
$username = "root"; // Username database Anda
$password = ""; // Password database Anda
$dbname = "naive_bayes"; // Nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>