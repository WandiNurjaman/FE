<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Signup</title>
</head>
<body>
    
    <div class="container">
        <img src="img/siswa.png" alt="">
        <form action="proses_signup.php" method="POST">
           <div class="title">
            <h2>Sign up</h2>
            <p>Buat akun baru</p>
           </div>
            <input type="text" name="username" id="username" placeholder="Username" required>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <input type="email" name="email" id="email" placeholder="Email" required>
            <button type="submit">Sign up</button>
        </form>
        <?php if (isset($_GET['signup_error'])): ?>
            <p style="color: red;">Signup failed. Please try again.</p>
        <?php endif; ?>
    </div>
</body>
</html>
