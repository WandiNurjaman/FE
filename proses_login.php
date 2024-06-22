<?php
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

    // Melakukan sanitasi input
    $username = mysqli_real_escape_string($koneksi, $username);
    $password = mysqli_real_escape_string($koneksi, $password);

    // Query SQL untuk memeriksa kredensial login
    $query = "SELECT * FROM signup WHERE username='$username' AND password='$password'";
    $result = mysqli_query($koneksi, $query);

    // Memeriksa hasil query
    if ($result) {
        // Memeriksa apakah data ditemukan
        if (mysqli_num_rows($result) == 1) {
            // Kredensial cocok, arahkan ke halaman form1.html
            header("Location: form1.html");
            exit(); // Penting untuk menghentikan eksekusi script setelah pengalihan
        } else {
            // Kredensial tidak cocok, arahkan kembali ke halaman login.php dengan pesan error
            header("Location: login.php?login_error=1");
            exit();
        }
    } else {
        // Query error, arahkan kembali ke halaman login.php dengan pesan error
        header("Location: login.php?login_error=1");
        exit();
    }

    // Menutup koneksi
    mysqli_close($koneksi);
} else {
    // Jika tidak ada data username atau password yang dikirim, arahkan kembali ke halaman login.php
    header("Location: login.php?login_error=1");
    exit();
}
?>
