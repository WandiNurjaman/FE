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
        <form action="proses_signup.php" method="POST">
            <div class="title">
                <h2>Sign Up</h2>
                <p>Isi Data Dibawah</p>
            </div>
            <input type="email" name="email" id="email" placeholder="Email">
            <input type="text" name="username" id="username" placeholder="Username">
            <input type="password" name="password" id="password" placeholder="Password">
            <button type="button" onclick="location.href='login.php'">OK</button>
            
        </form>
    </div>
</body>
</html>
