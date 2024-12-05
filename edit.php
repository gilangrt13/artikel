<?php
// Memulai session dan menghubungkan ke database
session_start();
include "koneksi.php";

// Mengecek apakah ada parameter 'Id_Artikel' di URL
if (isset($_GET['Id_Artikel'])) {
    $id = $_GET['Id_Artikel'];

    // Query untuk mengambil data artikel berdasarkan ID (menggunakan prepared statement)
    $query = $conn->prepare("SELECT * FROM berita WHERE Id_Artikel = ?");
    $query->bind_param("i", $id);
    $query->execute();
    $result = $query->get_result();

    // Memastikan artikel ditemukan di database
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Menyimpan data artikel yang ditemukan ke variabel
        $judul = $row['judul'];
        $penulis = $row['penulis'];
        $sumber = $row['sumber'];
        $deskripsi = $row['deskripsi'];
        $gambar = $row['gambar'];
        $tanggal = $row['tanggal'];
    } else {
        echo "Artikel tidak ditemukan.";
        exit;
    }
} else {
    echo "ID artikel tidak tersedia.";
    exit;
}

// Proses update artikel setelah form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data yang diinputkan dari form
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $sumber = $_POST['sumber'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = $_POST['tanggal'];

    // Proses upload gambar (jika ada file baru yang diunggah)
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

    // Query untuk memperbarui artikel di database (prepared statement)
    $update_query = $conn->prepare(
        "UPDATE berita SET judul = ?, penulis = ?, sumber = ?, deskripsi = ?, gambar = ?, tanggal = ? WHERE Id_Artikel = ?"
    );
    $update_query->bind_param("ssssssi", $judul, $penulis, $sumber, $deskripsi, $gambar, $tanggal, $id);

    // Mengeksekusi query update dan mengecek apakah berhasil
    if ($update_query->execute()) {
        // Jika update berhasil, redirect ke halaman daftar artikel
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Gagal memperbarui artikel: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Artikel</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <link href="assets/demo/demo.css" rel="stylesheet" />
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Artikel</h2>
        <form action="edit.php?Id_Artikel=<?php echo htmlspecialchars($id); ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="judul">Judul:</label>
                <input type="text" name="judul" id="judul" value="<?php echo htmlspecialchars($judul); ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="penulis">Penulis:</label>
                <input type="text" name="penulis" id="penulis" value="<?php echo htmlspecialchars($penulis); ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="sumber">Sumber:</label>
                <input type="text" name="sumber" id="sumber" value="<?php echo htmlspecialchars($sumber); ?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" required><?php echo htmlspecialchars($deskripsi); ?></textarea>
            </div>
            <div class="form-group">
                <label for="gambar">Gambar (Kosongkan jika tidak ingin mengubah):</label>
                <input type="file" name="gambar" id="gambar" class="form-control">
                <?php if ($gambar): ?>
                    <p>Gambar saat ini: <img src="uploads/<?php echo htmlspecialchars($gambar); ?>" alt="Gambar" width="150"></p>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal:</label>
                <input type="date" name="tanggal" id="tanggal" value="<?php echo htmlspecialchars($tanggal); ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Perbarui Artikel</button>
                <a href="dashboard.php" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
