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
    <nav class="navbar bg-body-tertiary fixed-top d-flex align-items-center">
        <div class="container-fluid">
            <div class="title-navbar">
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h5 class="title-navbar mx-3">SMK DARUL HIDAYAT</h5>
            </div>
            <div class="notifikasi-profile">
                <img class="user-notifikasi" src="img/notification.png" alt="notifikasi">
                <img class="user-profile" src="img/user-profile.jpg" alt="profile">
            </div>
            <div class="offcanvas offcanvas-start bg-primary" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel" aria-modal="true" role="dialog">
                <div class="gambar-header">
                    <img src="img/image 3.png" alt="gambar-akun" class="gambar-akun">
                    <h5 class="gambar-title">SMK DARUL HIDAYAT</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close bg-light"></button>
                </div>
                <div class="line"><span class="line"></span></div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <img class="icon-list" src="img/user.png" alt="icon-email"><a class="nav-link" aria-current="page" href="dataakunuser.php">Akun User</a>
                        </li>
                        <li class="nav-item">
                            <img class="icon-list" src="img/phone.png" alt="icon-email"><a class="nav-link" href="datapenerimaan.php">Konfirmasi Pendaftaran</a>
                        </li>
                        <li class="nav-item">
                            <img class="icon-list" src="img/email.png" alt="icon-email"><a class="nav-link" href="dataemail.php">Send Email</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_logout.php">Sign Out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5 pt-3">
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
                    <th>NISN</th>
                    <th>Nama</th>
                    <th>Jurusan</th>
                    <th>Email</th>
                    <th>Message</th>
                    
                </tr>
            </thead>
            <tbody>
            <?php
            include 'koneksi.php';

            $records_per_page = 10;
            $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            if ($current_page < 1) $current_page = 1;

            $offset = ($current_page - 1) * $records_per_page;

            $total_records_result = $conn->query("SELECT COUNT(*) AS total FROM data_siswa");
            $total_records = $total_records_result->fetch_assoc()['total'];

            $total_pages = ceil($total_records / $records_per_page);

            $sql = "SELECT * FROM data_siswa LIMIT $records_per_page OFFSET $offset";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $no = $offset + 1;
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . $row['nisn'] . "</td>";
                    echo "<td>" . $row['nama'] . "</td>";
                    echo "<td>" . (isset($row['jurusan']) ? $row['jurusan'] : 'N/A') . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>
                            <form action='send_email.php' method='post'>
                                <input type='hidden' name='nisn' value='" . $row['nisn'] . "'>
                                <textarea name='message' class='form-control' rows='3' placeholder='Masukkan pesan'></textarea>
                                <button type='submit' class='btn btn-success mt-2'>Kirim</button>
                            </form>
                        </td>";
                    echo "<td>";
                    if (isset($row['status'])) {
                        echo "<button class='btn btn-" . ($row['status'] == 'konfirmasi' ? 'success' : 'danger') . "'>" . $row['status'] . "</button>";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Tidak ada data</td></tr>";
            }

            $conn->close();
            ?>
            </tbody>
        </table>

        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <li class="page-item <?php if($current_page == 1) echo 'disabled'; ?>">
                    <a class="page-link" href="?page=<?php echo $current_page - 1; ?>" tabindex="-1" aria-disabled="<?php if($current_page == 1) echo 'true'; ?>">Previous</a>
                </li>
                <?php for($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php if($i == $current_page) echo 'active'; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?php if($current_page == $total_pages) echo 'disabled'; ?>">
                    <a class="page-link" href="?page=<?php echo $current_page + 1; ?>" aria-disabled="<?php if($current_page == $total_pages) echo 'true'; ?>">Next</a>
                </li>
            </ul>
        </nav>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
