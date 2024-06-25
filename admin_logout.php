<?php
session_start(); // Mulai sesi
session_destroy(); // Hancurkan semua sesi
header("Location: loginadmin.php"); // Arahkan ke halaman login
exit();
?>
