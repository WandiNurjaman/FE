<?php
include 'koneksi.php';

// Retrieve username and password from POST request
$username = $_POST['username'];
$password = $_POST['password'];

// Check if the variables are set
if (!isset($username) || !isset($password)) {
    header("Location: login.html?login_error=1");
    exit();
}

// Use prepared statements to prevent SQL injection
$stmt = $koneksi->prepare("SELECT * FROM admin WHERE username=? AND password=?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

// Check if data is found
if ($result->num_rows == 1) {
    // Credentials match, redirect to index.html
    header("Location: index.html");
    exit(); // Important to stop script execution after redirection
} else {
    // Credentials do not match, redirect back to login.html with error message
    header("Location: login.html?login_error=1");
    exit();
}

// Close the statement and connection
$stmt->close();
$koneksi->close();
?>
