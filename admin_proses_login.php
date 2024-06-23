<?php

$username = $_POST['username'];
$password = $_POST['password'];


$koneksi = mysqli_connect("localhost", "root", "", "db_profile");


if (mysqli_connect_errno()) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}


$query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
$result = mysqli_query($koneksi, $query);


if (mysqli_num_rows($result) == 1) {
  
    header("Location: index.html");
    exit(); 
} else {
    
    header("Location: login.html?login_error=1");
    exit();
}


mysqli_close($koneksi);
?>
