<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: loginadmin.php");
    exit();
}

$koneksi = mysqli_connect("localhost", "root", "", "db_profile");

if (mysqli_connect_errno()) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

if (isset($_POST['update'])) {
    $id_admin = $_POST['id_admin'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "UPDATE admin SET username = ?, email = ?, password = ? WHERE id_admin = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, 'sssi', $username, $email, $password, $id_admin);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: dataakunuser.php");
        exit();
    } else {
        echo "Update gagal: " . mysqli_error($koneksi);
    }
}

if (isset($_GET['id_admin'])) {
    $id_admin = $_GET['id_admin'];
    $query = "SELECT * FROM admin WHERE id_admin = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id_admin);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $admin = mysqli_fetch_assoc($result);
} else {
    header("Location: dataakunuser.php");
    exit();
}

mysqli_stmt_close($stmt);
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Edit Admin</title>
</head>

<body>
    <div class="container mt-5">
        <h2>Edit Admin</h2>
        <form method="post" action="edit_admin.php">
            <input type="hidden" name="id_admin" value="<?php echo htmlspecialchars($admin['id_admin']); ?>">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($admin['username']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($admin['email']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="text" name="password" class="form-control" value="<?php echo htmlspecialchars($admin['password']); ?>" required>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
        </form>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>
