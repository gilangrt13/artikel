<?php
session_start(); // Memulai sesi

// Menghapus semua sesi yang ada
session_unset();

// Menghancurkan sesi
session_destroy();

// Mengarahkan pengguna kembali ke halaman login
header("Location: login.php");
exit;
?>
