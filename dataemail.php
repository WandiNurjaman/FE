<?php
session_start(); // Mulai sesi untuk mengakses $_SESSION
include 'koneksi.php';

// Cek apakah ada pesan sukses yang disimpan dalam sesi
$success_message = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : '';
unset($_SESSION['success_message']); // Hapus pesan sukses dari sesi setelah ditampilkan
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Email</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/dataemail.css">
</head>
<body>
    <!-- Header dan navigasi -->
    <nav class="navbar bg-body-tertiary fixed-top d-flex align-items-center">
        <!-- Konten navbar -->
    </nav>

    <div class="container mt-5 pt-3">
        <!-- Konten utama -->
        <div class="row">
            <!-- Pencarian dan filter -->
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

        <!-- Tabel data email -->
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
                    while ($row = $result->fetch_assoc()) {
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
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Tidak ada data</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Pagination -->
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

        <!-- Tampilkan pesan sukses jika ada -->
        <?php if (!empty($success_message)): ?>
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                <?php echo $success_message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
