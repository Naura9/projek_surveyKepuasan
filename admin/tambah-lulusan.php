<?php
session_start();
require_once '../Koneksi.php';

$koneksi = new Koneksi();
$kon = $koneksi->kon;// Ambil data dari form

if (!isset($_SESSION['username'])) {
    // Jika belum, redirect pengguna ke halaman login
    header("Location: ../login/login.php");
    exit(); // Pastikan untuk keluar dari skrip setelah redirect
}

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
        /* CSS untuk menyesuaikan tata letak radio button */
        h2 {
            font-weight: bold;
        }

        .survey-question {
            margin-top: 20px;
            margin-bottom: 20px;
            margin-right: 100px;
            background-color: white; /* Tambahkan background color merah */
            padding: 10px; /* Tambahkan padding untuk memberi jarak antara konten dan border */
            width : 1000px;

        }

        .question1 {
            font-weight: bold;
        }

        .form-custom {
            background-color: #ececed;
                }

        .pilihan-container {
            display: flex;
        }

        .pilihan1,
        .pilihan2 {
            flex: 1;
        }

        .pilihan1 {
            margin-right: 10px;
        }

        .pilihan2 {
            margin-left: 10px;
        }

        .button-container {
            display: flex;
            margin-top: 245px;
        }

        .button-container button {
            padding: 10px 20px;
            border: black;
            border-radius: 5px;
            cursor: pointer;
        }

        .button-kembali {
            background-color: white;
            border: 1px solid black;

        }

        .button-simpan {
            margin-left: 840px; 
            background-color: #2d1b6b;
            color: white;
            border: 1px solid black;
        }

        .kosong {
            height: 18px;
            background: #ececed;

        }

        .message {
            width: 5px;
            margin-left: 885px
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
                <a href="permintaan-user.php" class="message">
                    <i class="fa-regular fa-envelope"></i>
                </a>
                <a href="../login/logout.php" class="logout">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </a>
            </div>
        </nav>
    </div>

    <nav class="sidebar">
        <ul class="sidebar-nav">
            <li class="">
                <a href="dashboard-admin.php" class="">
                    <i class="fa-solid fa-house"></i>
                    Dashboard
                </a>
            </li>
            <li class="">
                <a href="#" class="" data-bs-toggle="collapse" data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                <i class="fa-solid fa-list-ol"></i> Survey
                    <span class="lni lni-chevron-down"></span>
                </a>
                <ul id="auth" class="" data-bs-parent="#sidebar">
                    <li><a href="soal-pendidikan.php"><i class="fa-solid fa-medal"></i> Kualitas Pendidikan</a></li>
                    <li><a href="soal-fasilitas.php"><i class="fa-solid fa-layer-group"></i>     Fasilitas</a></li>                    
                    <li><a href="soal-pelayanan.php"><i class="fa-solid fa-handshake"></i>  Pelayanan</a></li>
                    <li><a href="soal-lulusan.php"><i class="fa-solid fa-graduation-cap"></i>  Lulusan</a></li>
                </ul>
            </li>
            <li class="">
                <a href="responden-survey.php" class="">
                    <i class="fa-solid fa-user-group"></i>
                    Responden
                </a>
            </li>
            <li class="">
                <a href="laporan-survey.php" class="">
                    <i class="fa-solid fa-book-open"></i>
                    Laporan
                </a>
            </li>
        </ul>
    </nav>

    <section>
    <div class="content">
        <h2>Survey Lulusan Polinema</h2>
        <div class="survey-question">
            <form action="proses-tambah-lulusan.php" method="POST">
                <label for="question1">Pertanyaan</label>
                <input type="text" class="form-control form-custom" name="question" id="question" placeholder="Masukkan Pertanyaan" required>
                <label for="question1">Keterangan</label>
                <div class="pilihan-container">
                    <div class="pilihan1">
                        <input type="radio" id="question1_kurang" name="question1" value="kurang">
                        <label for="question1_kurang">Kurang</label><br>
                        <input type="radio" id="question1_cukup" name="question1" value="cukup">
                        <label for="question1_cukup">Cukup</label>
                    </div>
                    <div class="pilihan2">
                        <input type="radio" id="question1_baik" name="question1" value="baik">
                        <label for="question1_baik">Baik</label><br>
                        <input type="radio" id="question1_sangat_baik" name="question1" value="sangat_baik">
                        <label for="question1_sangat_baik">Sangat Baik</label>
                    </div>        
                </div>
        </div>

        <!-- Tambahkan pertanyaan lainnya sesuai kebutuhan -->
       
        <!-- Tambahkan pertanyaan lainnya sesuai kebutuhan -->
        
        
        <!-- Button container -->
            <div class="button-container">
                <a href="soal-lulusan.php" class="btn button-kembali">Kembali</a>
                <button type="submit" class="btn button-simpan" name="simpan">Simpan</button>
            </div>    
        </form>
        <div class="kosong"></div>
</section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script>
        $('nav ul li').click(function(){
             $(this).addClass("active").siblings().removeClass("active");
        });    
    </script>
</body>
</html>
