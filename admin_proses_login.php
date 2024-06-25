<?php
session_start(); // Mulai sesi

// Ambil data dari formulir HTML jika ada
if (isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Menghubungkan ke database
    $koneksi = mysqli_connect("localhost", "root", "", "db_profile");

    // Memeriksa koneksi
    if (mysqli_connect_errno()) {
        die("Koneksi ke database gagal: " . mysqli_connect_error());
    }

    // Melindungi dari SQL injection
    $username = mysqli_real_escape_string($koneksi, $username);
    $password = mysqli_real_escape_string($koneksi, $password);

    // Query untuk memeriksa keberadaan admin dengan username dan password yang diberikan
    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($koneksi, $query);
    
    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            // Kredensial cocok, simpan informasi sesi dan arahkan ke halaman dataakunuser.php
            $_SESSION['admin'] = $username;
            header("Location: dataakunuser.php");
            exit(); // Penting untuk menghentikan eksekusi script setelah pengalihan
        } else {
            // Kredensial tidak cocok, kembali ke halaman login dengan pesan error
            header("Location: loginadmin.php?login_error=1");
            exit();
        }
    } else {
        // Query gagal, kembali ke halaman login dengan pesan error
        header("Location: loginadmin.php?login_error=1");
        exit();
    }

    // Menutup koneksi
    mysqli_close($koneksi);
} else {
    // Jika data username atau password tidak ada, kembali ke halaman login dengan pesan error
    header("Location: loginadmin.php?login_error=1");
    exit();
}
?>
