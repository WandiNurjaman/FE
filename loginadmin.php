<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Login Admin</title>
</head>
<body>
    
    <div class="container">
        <img src="img/siswa.png" alt="">
        <form action="admin_proses_login.php" method="POST">
           <div class="title">
            <h2>Login Admin</h2>
            <p>Masukan Username dan Password</p>
           </div>
            <input type="text" name="username" id="username" placeholder="Username" required>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <button type="submit">Login</button>
          
        </form>
        <?php if (isset($_GET['login_error'])): ?>
            <p style="color: red;">Login failed. Please check your username and password.</p>
        <?php endif; ?>
    </div>
</body>
</html>
