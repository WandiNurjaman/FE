<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>
<body>
    
    <div class="container">
        <div class="login-button-left">
            <a href="loginadmin.php" class="login-button">Admin</a>
        </div>
        <img src="img/siswa.png" alt="">
        <form action="proses_login.php" method="POST">
            <div class="title">
                <h2>Sign in</h2>
            </div>
            <input type="text" name="username" id="username" placeholder="Username">
            <input type="password" name="password" id="password" placeholder="Password">
            <button type="submit">Sign In</button>
            <button type="button" onclick="location.href='signup.php'">Sign Up</button>
        </form>
    </div>
    
</body>
</html>
