<?php
// Sertakan file koneksi ke database
include 'koneksi.php';

// Ambil data dari form
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

// Query untuk menyimpan data ke database
$sql = "INSERT INTO signup (email, username, password)
        VALUES ('$email', '$username', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "Pendaftaran berhasil. Silakan login <a href='login.php'>di sini</a>.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Tutup koneksi
$conn->close();
