<?php
ob_start();
session_start();
include "koneksi.php"; // Pastikan koneksi.php berfungsi dengan baik


if (!isset($_SESSION['user_id'])) {
    // Redirect ke halaman login jika pengguna belum login
    header("Location: login.php");
    exit;
}


// Debugging: Cek apakah koneksi berhasil
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil data artikel
$sql = "SELECT * FROM berita"; // Ganti 'artikel' dengan nama tabel Anda
$result = $conn->query($sql);

// Debugging: Cek apakah query berhasil
if (!$result) {
    die("Query gagal: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Manajemen Artikel
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <link href="assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo">
        <a href="https://www.creative-tim.com" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="uploads/logo.jpeg">
          </div>
          <p>CT</p>
        </a>
        <a href="https://www.creative-tim.com" class="simple-text logo-normal">
          Manajemen Artikel
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="active ">
            <a href="./dashboard.html">
              <i class="nc-icon nc-bank"></i>
              <p>Manajemen Berita</p>
            </a>
          </li>
          <li>
            <a href="logout.php">
              <i class="nc-icon nc-button-power"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Berita</h3>
                </div>
                <div class="card-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Sumber</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                     if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {
                          echo "<tr class='odd'>";
                          echo "<td>" . htmlspecialchars($row["Id_Artikel"]) . "</td>";
                          echo "<td class='dtr-control' tabindex='0'>" . htmlspecialchars($row["judul"]) . "</td>";
                          echo "<td>" . htmlspecialchars($row["penulis"]) . "</td>";
                          echo "<td>" . htmlspecialchars($row["sumber"]) . "</td>";
                          echo "<td class=''>" . htmlspecialchars($row["deskripsi"]) . "</td>";
                          echo "<td><img src='uploads/" . htmlspecialchars($row["gambar"]) . "' alt='Gambar' width='100'></td>";
                          echo "<td>" . htmlspecialchars($row["tanggal"]) . "</td>";
                          echo "<td class='sorting_1'>
                                  <a href='edit.php?Id_Artikel=" . htmlspecialchars($row["Id_Artikel"]) . "' class='btn btn-warning'>Edit</a> 
                                  <a href='tambah.php?Id_Artikel=" . htmlspecialchars($row["Id_Artikel"]) . "' class='btn btn-warning'>Tambah</a> 
                                  <a href='hapus.php?Id_Artikel=" . htmlspecialchars($row["Id_Artikel"]) . "' class='btn btn-danger' onclick='return confirm(\"Apakah Anda yakin ingin menghapus artikel ini?\");'>Hapus</a>
                                </td>";
                          echo "</tr>";
                      }
                  } else {
                      echo "<tr><td colspan='8'>Tidak ada data artikel.</td></tr>";
                  }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>  
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/paper-dashboard.js?v=2.0.1"></script>
</body>
</html>

<?php
$conn->close(); // Menutup koneksi database
?>