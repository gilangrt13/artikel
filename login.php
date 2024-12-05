<?php
session_start();
include "koneksi.php"; // Pastikan koneksi.php berfungsi dengan baik

// Memeriksa apakah form login sudah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil inputan username dan password dari form
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    

    // Query untuk memeriksa apakah username dan password ada di database
    $query = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($conn, $query);

    // Jika data ditemukan, periksa passwordnya
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        // Verifikasi password (misalnya menggunakan password hash)
        if (password_verify($password, $user['password'])) {
            // Set session untuk pengguna yang login
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];  
            // Redirect ke halaman dashboard setelah login berhasil
            header("Location: dashboard.php");
            exit;
        } else {
            $error_message = "Username atau password salah.";
        }
    } else {  
        $error_message = "Username tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <link href="assets/demo/demo.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Login</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        // Menampilkan pesan kesalahan jika ada
                        if (isset($error_message)) {
                            echo "<div class='alert alert-danger'>$error_message</div>";
                        }
                        ?>
                        <form action="login.php" method="POST">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>

                        <div class="mt-3">
            <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
        </div>
    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
