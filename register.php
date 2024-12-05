<?php
session_start();
include "koneksi.php"; // Pastikan file koneksi.php sudah benar

// Memeriksa apakah form sudah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil input dari form
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password_confirm = mysqli_real_escape_string($conn, $_POST['password_confirm']);

    // Validasi: Periksa apakah password dan konfirmasi password cocok
    if ($password !== $password_confirm) {
        $error_message = "Password dan konfirmasi password tidak cocok.";
    } else {
        // Enkripsi password
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);

        // Query untuk memeriksa apakah username sudah ada
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $error_message = "Username sudah digunakan, silakan pilih yang lain.";
        } else {
            // Query untuk memasukkan data pengguna baru ke dalam database
            $insert_query = "INSERT INTO users (username, password) VALUES ('$username', '$password_hashed')";

            if (mysqli_query($conn, $insert_query)) {
                $success_message = "Pengguna berhasil didaftarkan. Anda bisa login sekarang.";
            } else {
                $error_message = "Gagal mendaftar pengguna: " . mysqli_error($conn);
            }
        }
    }
}
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <link href="assets/demo/demo.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Registrasi Pengguna</h2>
        <?php
        if (isset($error_message)) {
            echo "<div class='alert alert-danger'>$error_message</div>";
        }
        if (isset($success_message)) {
            echo "<div class='alert alert-success'>$success_message</div>";
        }
        ?>
        <form action="register.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="password_confirm">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
            </div>
            <button type="submit" class="btn btn-primary">Daftar</button>
            <a href="dashboard.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
