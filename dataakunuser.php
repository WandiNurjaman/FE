<?php
// Menghubungkan ke database
$koneksi = mysqli_connect("localhost", "root", "", "db_profile");

// Memeriksa koneksi
if (mysqli_connect_errno()) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Query untuk mengambil data dari tabel signup
$query = "SELECT * FROM signup";
$result = mysqli_query($koneksi, $query);

// Memeriksa hasil query
if (!$result) {
    die("Query error: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/dataakunuser.css">
    <title>Data Akun User</title>
</head>

<body>
    <nav class="navbar bg-body-tertiary fixed-top d-flex align-items-center" >
        <div class="container-fluid">
          <div class="title-navbar" >
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h5 class="title-navbar mx-3">SMK DARUL HIDAYAT</h5>
          </div>
        
          <div class="notifikasi-profile">
            <img class="user-notifikasi" src="img/notification.png" alt="notifikasi">
            <img class="user-profile" src="img/user-profile.jpg" alt="profile">
          </div>

          <div class="offcanvas offcanvas-start show bg-primary" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel" aria-modal="true" role="dialog">
            <div class="gambar-header">
              <img src="img/image 3.png" alt="gambar-akun" class="gambar-akun">
              <h5 class="gambar-title">SMK DARUL HIDAYAT</h5>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close bg-light"></button>
            </div>

            <div class="line">
                <span class="line"></span>
            </div>

            <div  class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <img class="icon-list" src="img/user.png" alt="icon-email"><a class="nav-link" aria-current="page" href="dataakunuser.php">Akun User</a>
                    </li>
                    <li class="nav-item">
    
                      <img class="icon-list" src="img/phone.png" alt="icon-email"><a class="nav-link" href="datapenerimaan.php">Konfirmasi Pendaftaran</a>
                    </li>
                    <li class="nav-item"> 
    
                      <img class="icon-list" src="img/email.png" alt="icon-email"><a class="nav-link" href="dataemail.php">Send Email</a>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="admin_logout.php">Sign Out</a>
                    </li>
                </ul>
              </div>
          </div>
        </div>
      </nav>

      <div class="container">
        <div class="row">
            <div class="col-md-6">
                <select id="showEntries" class="form-select">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                </select>
            </div>
            <div class="col-md-6">
                <input type="search" class="form-control" placeholder="Cari...">
            </div>
        </div>
    
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Menampilkan data dari hasil query
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['password'] . "</td>";
                    echo "<td>
                            <button class='btn btn-primary'>Edit</button>
                            <button class='btn btn-danger'>Delete</button>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>
    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>

<?php
// Menutup koneksi
mysqli_close($koneksi);
?>