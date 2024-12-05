<?php
// Memulai session dan menghubungkan ke database
session_start();
include "koneksi.php";

// Proses tambah artikel setelah form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data yang diinputkan dari form
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $sumber = $_POST['sumber'];
    $deskripsi = $_POST['deskripsi'];
    $gambar = '';
    $tanggal = date('Y-m-d H:i:s'); // Menyimpan tanggal saat ini

    // Proses upload gambar
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['gambar']['tmp_name'];
        $fileName = uniqid() . '-' . $_FILES['gambar']['name'];
        $uploadDir = "uploads/";
        $destPath = $uploadDir . $fileName;

        // Memindahkan file ke folder upload
        if (move_uploaded_file($fileTmpPath, $destPath)) {
            $gambar = $fileName; // Update nama file gambar baru
        } else {
            echo "Gagal mengunggah gambar.";
            exit;
        }
    }

    // Query untuk menambah artikel ke database
    $query = "INSERT INTO berita (judul, penulis, sumber, deskripsi, gambar, tanggal) 
              VALUES ('$judul', '$penulis', '$sumber', '$deskripsi', '$gambar', '$tanggal')";

    // Mengeksekusi query dan mengecek apakah berhasil
    if (mysqli_query($conn, $query)) {
        header("Location: dashboard.php"); // Redirect ke halaman dashboard setelah berhasil
        exit;
    } else {
        echo "Gagal menambahkan artikel: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Artikel</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <link href="assets/demo/demo.css" rel="stylesheet" />
</head>
<body>
    <div class="container mt-5">
        <h2>Tambah Artikel Baru</h2>
        <form action="tambah.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="judul">Judul:</label>
                <input type="text" name="judul" id="judul" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="penulis">Penulis:</label>
                <input type="text" name="penulis" id="penulis" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="sumber">Sumber:</label>
                <input type="text" name="sumber" id="sumber" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="gambar">Gambar:</label>
                <input type="file" name="gambar" id="gambar" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal:</label>
                <input type="date" name="tanggal" id="tanggal" value="<?php echo htmlspecialchars($tanggal); ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Tambah Artikel</button>
                <a href="dashboard.php" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
