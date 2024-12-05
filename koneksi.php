<?php
// Set variabel koneksi
$servername = "localhost";  // Ganti dengan nama server MySQL Anda, misalnya localhost
$username = "root";         // Ganti dengan username MySQL Anda
$password = "";             // Ganti dengan password MySQL Anda
$dbname = "artikel";  // Ganti dengan nama database yang Anda gunakan

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
} else {
    // Menampilkan pesan jika koneksi berhasil
    echo "";
}


?>
