<?php
// Mengambil data dari formulir HTML
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

// Menghubungkan ke database
$koneksi = mysqli_connect("localhost", "root", "", "db_profile");

// Memeriksa koneksi
if (mysqli_connect_errno()) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Menjalankan query SQL untuk memasukkan data baru
$query = "INSERT INTO signup (username, password, email) VALUES ('$username', '$password', '$email')";
if (mysqli_query($koneksi, $query)) {
    // Pendaftaran berhasil, arahkan ke halaman login dengan pesan sukses
    header("Location: login.php?signup_success=1");
    exit();
} else {
    // Pendaftaran gagal, arahkan kembali ke halaman signup dengan pesan error
    header("Location: signup.php?signup_error=1");
    exit();
}

// Menutup koneksi
mysqli_close($koneksi);
?>
