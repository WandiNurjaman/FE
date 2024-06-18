<?php
// Sertakan file koneksi ke database
require_once('koneksi.php');

// Tangkap data yang dikirimkan melalui form
$username = $_POST['username'];
$password = $_POST['password'];

// Lindungi dari SQL Injection
$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);

// Query untuk memeriksa apakah username dan password cocok
$query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
$result = $conn->query($query);

// Periksa apakah query berhasil dieksekusi
if (!$result) {
    die("Gagal menjalankan query: " . $conn->error);
}

// Periksa apakah data ditemukan
if ($result->num_rows > 0) {
    // Jika ditemukan, redirect ke halaman index.html
    header("Location: index.html");
    exit(); // Pastikan exit() digunakan setelah header untuk mencegah eksekusi script lebih lanjut
} else {
    // Jika tidak ditemukan, berikan pesan error atau respons sesuai kebutuhan
    echo "Username atau Password salah!";
}

// Tutup koneksi database
$conn->close();
?>
