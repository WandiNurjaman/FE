<?php
// Mengambil data dari formulir HTML
$username = $_POST['username'];
$password = $_POST['password'];

// Menghubungkan ke database
$koneksi = mysqli_connect("localhost", "root", "", "db_profile");

// Memeriksa koneksi
if (mysqli_connect_errno()) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Menjalankan query SQL untuk memeriksa kredensial login
$query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
$result = mysqli_query($koneksi, $query);

// Memeriksa apakah data ditemukan
if (mysqli_num_rows($result) == 1) {
    // Kredensial cocok, arahkan ke halaman index.php
    header("Location: index.html");
    exit(); // Penting untuk menghentikan eksekusi script setelah pengalihan
} else {
    // Kredensial tidak cocok, arahkan kembali ke halaman login.php dengan pesan error
    header("Location: login.html?login_error=1");
    exit();
}

// Menutup koneksi
mysqli_close($koneksi);
?>
