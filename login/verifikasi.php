<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verfifikasi Email</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/survey/login/login.css">

</head>
<body>
    <div class="login-container">
        <div class="img-logonama">
            <img src="../img/logo-nama.png" alt="Polinema Logo">
        </div>
        <h2>Verifikasi Email</h2>
        <h4>Kami akan mengirimkan permintaan reset password melalui email Anda. Silahkan masukkan email yang telah terdaftar.</h4>
        <?php
        // Periksa apakah ada parameter login_error pada URL
        if(isset($_GET['login_error']) && $_GET['login_error'] == 'true') {
            echo '<p class="error-message">Username atau password salah. Silakan coba lagi.</p>';
        }
        ?>
        <form action="login_proses.php" method="POST">
            <div class="form-group">
                <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan Email Anda" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-login">Kirim</button>        
        </form>
    </div>
</body>
</html>
 