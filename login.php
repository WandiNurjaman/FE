<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>login</title>
</head>
<body>
    
    <div class="container">
        <img src="img/siswa.png" alt="">
        <form action="proses_login.php" method="POST">
           <div class="title">
            <h2>Sign in</h2>
            <p>Masukan Username dengan NISN</p>
           </div>
            <input type="text" name="username" id="username" placeholder="Username">
            <input type="password" name="password" id="password" placeholder="password">
            <button type="button" onclick="location.href='form1.html'">Login</button>
            <button type="button"onclick="location.href='signup.php'">Sign up</button>
        </form>
    </div>
</body>
</html>
