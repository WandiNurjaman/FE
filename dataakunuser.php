<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: loginadmin.php");
    exit();
}

// Menghubungkan ke database
$koneksi = mysqli_connect("localhost", "root", "", "db_profile");

// Memeriksa koneksi
if (mysqli_connect_errno()) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Cek jika ada permintaan untuk logout
if (isset($_GET['logout'])) {
    session_destroy(); // Hancurkan semua sesi
    header("Location: loginadmin.php");
    exit();
}

// Mendapatkan parameter pencarian dan pagination
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
$offset = ($page - 1) * $limit;

// Query dengan pencarian dan pagination
$query = "SELECT * FROM admin WHERE username LIKE ? OR email LIKE ? LIMIT ? OFFSET ?";
$stmt = mysqli_prepare($koneksi, $query);
$searchTermLike = '%' . $searchTerm . '%';
mysqli_stmt_bind_param($stmt, 'ssii', $searchTermLike, $searchTermLike, $limit, $offset);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Menghitung total hasil untuk pagination
$totalQuery = "SELECT COUNT(*) as total FROM admin WHERE username LIKE ? OR email LIKE ?";
$totalStmt = mysqli_prepare($koneksi, $totalQuery);
mysqli_stmt_bind_param($totalStmt, 'ss', $searchTermLike, $searchTermLike);
mysqli_stmt_execute($totalStmt);
$totalResult = mysqli_stmt_get_result($totalStmt);
$totalRow = mysqli_fetch_assoc($totalResult);
$totalRecords = $totalRow['total'];
$totalPages = ceil($totalRecords / $limit);

// Menutup statement
mysqli_stmt_close($stmt);
mysqli_stmt_close($totalStmt);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/dataakunuser.css">
    <title>Data Akun Admin</title>
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

            <div class="offcanvas offcanvas-start show bg-primary" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel" aria-modal="true" role="dialog">
                <div class="gambar-header">
                    <img src="img/image 3.png" alt="gambar-akun" class="gambar-akun">
                    <h5 class="gambar-title">SMK DARUL HIDAYAT</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close bg-light"></button>
                </div>

                <div class="line">
                    <span class="line"></span>
                </div>

                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <img class="icon-list" src="img/user.png" alt="icon-email"><a class="nav-link" aria-current="page" href="dataakunuser.php">Akun Admin</a>
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

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <form method="get" action="dataakunuser.php">
                    <input type="search" name="search" class="form-control" placeholder="Cari..." value="<?php echo htmlspecialchars($searchTerm); ?>">
                </form>
            </div>
            <div class="col-md-6 text-end">
                <form method="get" action="dataakunuser.php">
                    <select name="limit" class="form-select" onchange="this.form.submit()">
                        <option value="10" <?php if ($limit == 10) echo 'selected'; ?>>10</option>
                        <option value="20" <?php if ($limit == 20) echo 'selected'; ?>>20</option>
                        <option value="50" <?php if ($limit == 50) echo 'selected'; ?>>50</option>
                    </select>
                    <input type="hidden" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>">
                </form>
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
            $no = $offset + 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($no++) . "</td>";
                echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td>" . htmlspecialchars($row['password']) . "</td>";
                echo "<td>";
                if (isset($row['id_admin'])) {
                    echo "<a href='edit_admin.php?id_admin=" . htmlspecialchars($row['id_admin']) . "' class='btn btn-primary'>Edit</a>";
                    echo "<a href='delete_admin.php?id_admin=" . htmlspecialchars($row['id_admin']) . "' class='btn btn-danger' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Delete</a>";
                }
                echo "</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>

        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                    <a class="page-link" href="?page=<?php echo $page - 1; ?>&search=<?php echo htmlspecialchars($searchTerm); ?>&limit=<?php echo $limit; ?>">Previous</a>
                </li>
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?php if ($page == $i) echo 'active'; ?>"><a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo htmlspecialchars($searchTerm); ?>&limit=<?php echo $limit; ?>"><?php echo $i; ?></a></li>
                <?php endfor; ?>
                <li class="page-item <?php if ($page >= $totalPages) echo 'disabled'; ?>">
                    <a class="page-link" href="?page=<?php echo $page + 1; ?>&search=<?php echo htmlspecialchars($searchTerm); ?>&limit=<?php echo $limit; ?>">Next</a>
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
