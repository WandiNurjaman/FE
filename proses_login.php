<?php
// Ambil data dari formulir HTML jika ada
if (isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $koneksi = mysqli_connect("localhost", "root", "", "db_profile");

    
    if (mysqli_connect_errno()) {
        die("Koneksi ke database gagal: " . mysqli_connect_error());
    }

    $username = mysqli_real_escape_string($koneksi, $username);
    $password = mysqli_real_escape_string($koneksi, $password);
    $query = "SELECT * FROM signup WHERE username='$username' AND password='$password'";
    $result = mysqli_query($koneksi, $query);
    
    if ($result) {
      
        if (mysqli_num_rows($result) == 1) {
            // Kredensial cocok, arahkan ke halaman form1.html
            header("Location: form1.html");
            exit(); // Penting untuk menghentikan eksekusi script setelah pengalihan
        } else {
           
            header("Location: login.php?login_error=1");
            exit();
        }
    } else {
        
        header("Location: login.php?login_error=1");
        exit();
    }

    
    mysqli_close($koneksi);
} else {
    
    header("Location: login.php?login_error=1");
    exit();
}
?>
