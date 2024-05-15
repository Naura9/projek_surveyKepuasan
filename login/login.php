<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/survey/login/login.css">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/96cfbc074b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="login.css">


</head>
<body>
    <div class="login-container">
        <div class="img">
            <img src="../img/logo.png" alt="Polinema Logo">
        </div>
        <h2>Survey Kepuasan Polinema</h2>
        <h4>Selamat Datang! Silahkan Masukkan Detail Akun Anda.</h4>
        <?php
        // Periksa apakah ada parameter login_error pada URL
        if(isset($_GET['login_error']) && $_GET['login_error'] == 'true') {
            echo '<p class="error-message">Username atau password salah. Silakan coba lagi.</p>';
        }
        ?>
        <form action="login-proses.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan Username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan Password Anda" required>
            </div>
            <!-- <div class="forgot">
                <a href="#" class="link"> Forgot Your Password?</a>
            </div> -->

            <button type="submit" class="btn btn-primary btn-block btn-login">Masuk</button>        
        </form>
        <br>
        <h4>Belum Memiliki Akun? <a href="profil-form.php" class="link"> Register</h4>

    </div>
</body>
</html>
