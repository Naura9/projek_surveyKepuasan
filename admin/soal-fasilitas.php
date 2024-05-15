<?php
    session_start();
    include '../koneksi.php'; // Menghubungkan ke file koneksi.php
    
    if (!isset($_SESSION['username'])) {
        // Jika belum, redirect pengguna ke halaman login
        header("Location: ../login/login.php");
        exit(); // Pastikan untuk keluar dari skrip setelah redirect
    }

    $username = $_SESSION['username'];
    $role = $_SESSION['role'];
    $nama = $_SESSION['nama'];
    
    // Query untuk mengambil soal survei dengan kategori_id 1
    $query = "SELECT m_survey_soal.soal_id, m_survey_soal.soal_nama
        FROM m_survey_soal
        JOIN m_survey ON m_survey_soal.survey_id = m_survey.survey_id
        JOIN m_kategori ON m_survey_soal.kategori_id = m_kategori.kategori_id
        JOIN m_user ON m_survey.user_id = m_user.user_id
        WHERE m_kategori.kategori_id = 2
        AND m_user.role = 'mahasiswa'
        AND (m_survey_soal.soal_nama, m_survey_soal.soal_id) IN (
            SELECT soal_nama, MIN(soal_id)
            FROM m_survey_soal
            JOIN m_survey ON m_survey_soal.survey_id = m_survey.survey_id
            JOIN m_kategori ON m_survey_soal.kategori_id = m_kategori.kategori_id
            JOIN m_user ON m_survey.user_id = m_user.user_id
            WHERE m_kategori.kategori_id = 2
            AND m_user.role = 'mahasiswa'
            GROUP BY soal_nama
        )";

    $result = mysqli_query($kon, $query);

    $fasilitas = array();
	while ($data = mysqli_fetch_assoc($result)) {
		$fasilitas[] = $data;
	}
    
    
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
            margin-bottom: 15px;
        }

        .survey-question {
            background-color: white; /* Tambahkan background color merah */
            padding: 10px; /* Tambahkan padding untuk memberi jarak antara konten dan border */
            width : 1000px;
        }

        .pilihan-container {
            display: flex;
        }

        .pilihan1,
        .pilihan2 {
            margin-left: 40px;
        }

        .pilihan1 {
            margin-right: 70px;
        }

        .pilihan2 {
            margin-left: 30px;
        }

        .button-container {
            display: flex;
            margin-top: 20px;
        }

        .button-container button {
            padding: 10px 20px;
            border: black;
            border-radius: 5px;
            cursor: pointer;
        }

        .button-hapus {
            padding: 0;
            border: #2d1b6b;
            font-size: 12px;
            align-items: center;
            height: 20px;
            width: 50px;
            background-color: #e87818;
            color: white;
            margin-left: 540px;
        }
        
        .button-tambah {
            background-color: white;
            margin-left: 920px;
            border: 1px solid black;
        }

        .button-edit {
            padding: 0;
            border: #2d1b6b;
            font-size: 12px;
            align-items: center;
            height: 20px;
            width: 50px;
            margin-left: 1px;
            background-color: #2d1b6b;
            color: white;
        }

        hr {
                    border: none;
                    border-top: 2px solid #ccc;
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
        <h2>Survey Fasilitas Polinema</h2>
        <?php
            $no = 1;
            foreach ($fasilitas as $p) {
                ?>
                    <div class="survey-question">
                    <form action="hapus-fasilitas.php?id=<?php echo $p['soal_id']; ?>" method="post" id="hapusForm">

                        <label for="jawaban_<?php echo $p['soal_id']; ?>"><?php echo $p['soal_nama']; ?></label>
                        <div class="pilihan-container">
                            <div class="pilihan1">
                                <input type="radio" id="jawaban_<?php echo $p['soal_id']; ?>_kurang" name="jawaban_<?php echo $p['soal_id']; ?>" value="kurang">
                                <label for="jawaban_<?php echo $p['soal_id']; ?>_kurang">Kurang</label><br>
                                <input type="radio" id="jawaban_<?php echo $p['soal_id']; ?>_cukup" name="jawaban_<?php echo $p['soal_id']; ?>" value="cukup">
                                <label for="jawaban_<?php echo $p['soal_id']; ?>_cukup">Cukup</label>
                            </div>
                            <div class="pilihan2">
                                <input type="radio" id="jawaban_<?php echo $p['soal_id']; ?>_baik" name="jawaban_<?php echo $p['soal_id']; ?>" value="baik">
                                <label for="jawaban_<?php echo $p['soal_id']; ?>_baik">Baik</label><br>
                                <input type="radio" id="jawaban_<?php echo $p['soal_id']; ?>_sangat_baik" name="jawaban_<?php echo $p['soal_id']; ?>" value="sangat_baik">
                                <label for="jawaban_<?php echo $p['soal_id']; ?>_sangat_baik">Sangat Baik</label>
                                    <input type="submit" class="btn button-hapus" name="hapus" value="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus?');">
                                    <!-- Tambahkan input hidden untuk menyimpan ID -->
                                    <input type="hidden" name="soal_id" value="<?php echo $p['soal_id']; ?>">
                                <a href="edit-fasilitas.php?id=<?php echo $p['soal_id']; ?>" class="btn button-edit">Edit</a>

                            </div>
                            
                            
                        </div>
                        </form>

                        <hr> <!-- Garis pembatas -->
                    </div>

                <?php
                        $no++; // Increment the counter
                    }
                ?>
        
        <!-- Button container -->
        <div class="button-container">
            <a href="tambah-fasilitas.php" class="btn button-tambah">Tambah</a>
        </div>    
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
