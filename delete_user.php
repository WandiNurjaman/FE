<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: dataakunuser.php");
    exit();
}

$koneksi = mysqli_connect("localhost", "root", "", "db_profile");

if (mysqli_connect_errno()) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

if (isset($_GET['id_admin'])) {
    $id_admin = $_GET['id_admin'];

    $query = "DELETE FROM admin WHERE id_admin = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id_admin);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: dataakunuser.php");
        exit();
    } else {
        echo "Delete gagal: " . mysqli_error($koneksi);
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($koneksi);
?>
