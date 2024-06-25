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

// Memeriksa apakah form telah dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $id_admin = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Menghindari SQL Injection
    $id_admin = mysqli_real_escape_string($koneksi, $id_admin);
    $username = mysqli_real_escape_string($koneksi, $username);
    $password = mysqli_real_escape_string($koneksi, $password);
    $email = mysqli_real_escape_string($koneksi, $email);

    // Query SQL untuk update data admin
    $query = "UPDATE admin SET username = '$username', password = '$password', email = '$email' WHERE id_admin = $id_admin";

    // Eksekusi query
    $result = mysqli_query($koneksi, $query);

    // Memeriksa apakah query berhasil dieksekusi
    if ($result) {
        // Redirect ke halaman dataakunuser.php jika berhasil
        header("Location: dataakunuser.php");
        exit();
    } else {
        // Redirect kembali ke halaman edit_admin.php dengan pesan error jika gagal
        header("Location: edit_admin.php?id=$id_admin&edit_error=1");
        exit();
    }
}

// Menutup koneksi
mysqli_close($koneksi);
?>
