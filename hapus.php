<?php
// Memulai session dan menghubungkan ke database
session_start();
include "koneksi.php";

// Mengecek apakah ada parameter 'id' di URL
if (isset($_GET['Id_Artikel'])) {
    $id = $_GET['Id_Artikel'];

    // Query untuk mengambil data artikel berdasarkan ID
    $query = "SELECT * FROM berita WHERE Id_Artikel = '$id'";
    $result = mysqli_query($conn, $query);

    // Memastikan artikel ditemukan di database
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $gambar = $row['gambar']; // Menyimpan nama gambar dari database

        // Menghapus artikel dari database
        $delete_query = "DELETE FROM berita WHERE Id_Artikel = '$id'";

        // Mengeksekusi query untuk menghapus artikel
        if (mysqli_query($conn, $delete_query)) {
            // Menghapus gambar dari folder 'uploads' jika gambar ada
            if (!empty($gambar) && file_exists("uploads/$gambar")) {
                unlink("uploads/$gambar"); // Menghapus file gambar
            }
            // Redirect ke halaman dashboard setelah artikel dihapus
            header("Location: dashboard.php");
            exit;
        } else {
            echo "Gagal menghapus artikel: " . mysqli_error($conn);
        }
    } else {
        echo "Artikel tidak ditemukan.";
        exit;
    }
} else {
    echo "ID artikel tidak tersedia.";
    exit;
}
?>
