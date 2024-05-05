<?php
session_start();
include '../koneksi.php';

// Periksa apakah pengguna telah login

// Ambil nilai username dan role dari sesi
$username = $_SESSION['username'];
$role = $_SESSION['role'];
$nama = $_SESSION['nama'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/96cfbc074b.js" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="../header.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

    <style>
        /* CSS untuk kotak berwarna putih */
.survey-box {
    background-color: #ffffff;
    border-radius: 8px;
    padding: 30px;
    display: flex;
    align-items: center;
    width: 400px;
    height: 200px;
    margin-left: 300px;
    margin-top: 40px;
}

/* CSS untuk jumlah survey ditanggapi */
.survey-count {
    font-size: 28px;
    font-weight: bold;
    margin-left: 50px;
    margin-right: 16px; /* Jarak antara jumlah dan ikon */
}

/* CSS untuk ikon di bagian kanan */
.icon {
    margin-left: 50px; /* Mendorong ikon ke kanan */
    font-size: 60px;
}

/* CSS untuk tulisan "Survey telah ditanggapi" */
.survey-text {
    font-size: 13px;
    color: #555555;
}

.kosong {
    background: #ececed;
    height: 70px;
}

    </style>
</head>
<body>
    <div class="container">
        <nav class="navbar">
            <div class="logo">
                <img src="img/logo-nama.png" alt="Logo" width="100">
            </div>
            <div class="username">
                <span><?php echo $nama; ?> | Admin </span>
                <img src="img/profile.png" alt="User" width="30" height="30">
            </div>
        </nav>
    </div>

    <nav class="sidebar">
        <ul class="sidebar-nav">
            <li class="">
                <a href="dashboard-user.php" class="">
                    <i class="lni lni-user"></i>
                    Dashboard
                </a>
            </li>
            <li class="">
                <a href="#" class="" data-bs-toggle="collapse" data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                    <i class="lni lni-layout"></i> Survey
                    <span class="lni lni-chevron-down"></span>
                </a>
                <ul id="auth" class="" data-bs-parent="#sidebar">
                    <li><a href="#">Kualitas Pendidikan</a></li>
                    <li><a href="soal-fasilitas.php">Fasilitas</a></li>                    
                    <li><a href="#">Pelayanan</a></li>
                    <li><a href="#">Lulusan</a></li>
                </ul>
            </li>
            <li class="">
                <a href="responden-survey.php" class="">
                    <i class="lni lni-user"></i>
                     Responden
                </a>
            </li>
            <li class="">
                <a href="profil-user.php" class="">
                    <i class="lni lni-user"></i>
                     Laporan
                </a>
            </li>

            <button class="logout-btn">Logout</button>

        </ul>

    </nav>
    <section>
    <div class="content">
        <!-- Kotak berwarna putih -->
        <div class="survey-box"> 
            <!-- Jumlah survey ditanggapi -->
            <div class="survey-count">
                <span id="surveyNumber1">0</span>
                <!-- Memindahkan teks ke sini -->
                <div class="survey-text">User melakukan survey</div>
            </div>

            <div class="icon">
                <i class="fa-solid fa-list-check"></i>
            </div>
        </div>

        <!-- Kotak berwarna putih untuk survey telah ditanggapi -->
        <div class="survey-box">
        <div class="survey-count">
                <span id="surveyNumber2">0</span>
                <!-- Memindahkan teks ke sini -->
                <div class="survey-text">Survey Telah Ditanggapi</div>
            </div>
            <div class="icon">
                <i class="fa-solid fa-list-check"></i>
            </div>            
        </div>
    </div>
    <div class="kosong">
        </div>
</section>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script>
        $('nav ul li').click(function(){
             $(this).addClass("active").siblings().removeClass("active");
        });    

        
        
    </script>
</body>
</html>
