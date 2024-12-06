<?php
    require 'resources/functions.php';
    handleLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Risiko Mitigasi</title>
    <link rel="stylesheet" href="resources/index.css">
</head>
<body>
    <h1>Aplikasi Manajemen Risiko</h1>
    <div class="form-container">
        <form action="" method="post">
            <div class="inputs">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" placeholder="Masukkan username" required>

                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="Masukkan password" required>
            </div>
            
            <div class="login-button">
                <button type="submit" name="login">Login</button>
            </div>
        </form>
    </div>
</body>
</html>