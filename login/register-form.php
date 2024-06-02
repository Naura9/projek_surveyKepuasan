<?php
session_start();
include '../Koneksi.php';
$db = new Koneksi();
$kon = $db->getConnection();

if (!isset($_SESSION['role'])) {
    header('Location: profil_form.php');
    exit;
}

if(isset($_POST['submit'])){
    $username = mysqli_real_escape_string($kon, $_POST['username']);
    $nama = mysqli_real_escape_string($kon, $_POST['nama']);
    $password = mysqli_real_escape_string($kon, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($kon, $_POST['confirm_password']);
    $role = $_SESSION['role'];  

    if ($password !== $confirm_password) {
        $error[] = 'Password tidak cocok!';
    } else {
        $pass = md5($password); 
        $select = "SELECT * FROM m_registrasi WHERE nama = '$nama' && password = '$pass'";
        $result = mysqli_query($kon, $select);
        if(mysqli_num_rows($result) > 0){
            $error[] = 'user already exist!';
        }else{
            $insert = "INSERT INTO m_registrasi(username, nama, password, role) VALUES('$username','$nama','$pass','$role')";
            mysqli_query($kon, $insert);
            header('Location: login.php');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <link rel="stylesheet" href="login.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .reg-container {
            max-width: 433px;
            font-size: 15px;
        }

        .form-group {
            width: 430px;
            margin-top: 20px;
            padding: 0px;
        }

        h3 {
            margin-top: 0;
        }

        h4 {
            color: #A1A5B7;   
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
        }

        .input-group input[type="text"],
        .input-group input[type="password"]{
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 20px;
            background-color: #ececed; 
        }

        .input-group input[type="submit"] {
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

    
        .error-message {
            color: red;
            text-align: center;
        }

        .success-message {
            color: green;
        }

        .btn-lanjut {
            width: 430px;
            height: 38px;
            background-color: #2d1b6b;
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 15px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="reg-container">
    <div class="img">
        <img src="../img/logo.png" alt="Polinema Logo">
    </div>
        <h2>Register Akun</h2>
        <h4>Silahkan isi username dan password Anda untuk membuat akun.</h4>
        <div class="error-message">
                    <?php 
                    if(isset($error)) {
                        foreach($error as $err) {
                            echo $err . "<br>";
                        }
                    }
                    ?>
                </div>
        <div class="form-group">
            <form action="" method="post">
                <input type="hidden" name="nama" value="<?php echo isset($_SESSION['responden_nama']) ? htmlspecialchars($_SESSION['responden_nama']) : ''; ?>">
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" placeholder="Masukkan Username Anda" required >
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Masukkan Password Anda" required >
                </div>
                <div class="input-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="confirm_password" placeholder="Masukkan Ulang Password Anda" required >
                </div>
                <input type="submit" name="submit" value="Daftar" class="btn-lanjut">
            </form>
        </div>
    </div>
</body>
</html>
