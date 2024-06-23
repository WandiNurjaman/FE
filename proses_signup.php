<?php

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];


$koneksi = mysqli_connect("localhost", "root", "", "db_profile");


if (mysqli_connect_errno()) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}


$query = "INSERT INTO signup (username, password, email) VALUES ('$username', '$password', '$email')";
if (mysqli_query($koneksi, $query)) {
    
    header("Location: login.php?signup_success=1");
    exit();
} else {
    
    header("Location: signup.php?signup_error=1");
    exit();
}

mysqli_close($koneksi);
?>
