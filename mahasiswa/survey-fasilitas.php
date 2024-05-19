
<?php
    session_start();
    include '../koneksi.php';

    if (!isset($_SESSION['username'])) {
        // Jika belum, redirect pengguna ke halaman login
        header("Location: ../login/login.php");
        exit(); // Pastikan untuk keluar dari skrip setelah redirect
    }
    
    $username = $_SESSION['username'];
    $role = $_SESSION['role'];
    $nama = $_SESSION['nama'];

    $query_get_responden_id = "SELECT responden_mahasiswa_id, survey_id FROM t_responden_mahasiswa WHERE responden_nama = '$nama'";
    $result_get_responden_id = mysqli_query($kon, $query_get_responden_id);
    $row_get_responden_id = mysqli_fetch_assoc($result_get_responden_id);
    $responden_mahasiswa_id = $row_get_responden_id['responden_mahasiswa_id'];
    $survey_id = $row_get_responden_id['survey_id'];


    $query_get_profil_image = "SELECT image FROM t_responden_mahasiswa WHERE responden_nama = '$nama'";
    $result_get_profil_image = mysqli_query($kon, $query_get_profil_image);
    $row_get_profil_image = mysqli_fetch_assoc($result_get_profil_image);
    $profil_image = $row_get_profil_image['image'];


    // Query untuk memeriksa apakah survei pendidikan sudah diisi oleh responden tertentu
    $query_check_survey = "SELECT COUNT(*) AS jumlah_survey FROM t_jawaban_mahasiswa
                            JOIN m_survey_soal ON t_jawaban_mahasiswa.soal_id = m_survey_soal.soal_id
                            WHERE m_survey_soal.kategori_id = 2
                            AND t_jawaban_mahasiswa.responden_mahasiswa_id = '$responden_mahasiswa_id'";
    $result_check_survey = mysqli_query($kon, $query_check_survey);
    $row_check_survey = mysqli_fetch_assoc($result_check_survey);
    $jumlah_survey = $row_check_survey['jumlah_survey'];


    // Query untuk mengambil soal survei dengan kategori_id 2 dan survey_id yang sesuai dengan user_id
    $query = "SELECT m_survey_soal.soal_id, m_survey_soal.soal_nama
    FROM m_survey_soal
    JOIN m_survey ON m_survey_soal.survey_id = m_survey.survey_id
    JOIN m_kategori ON m_survey_soal.kategori_id = m_kategori.kategori_id
    WHERE m_kategori.kategori_id = 2
    AND m_survey_soal.survey_id = '$survey_id'";

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
        }

        .survey-question {
            margin-right: 100px;
            background-color: white; /* Tambahkan background color merah */
            padding: 10px; /* Tambahkan padding untuk memberi jarak antara konten dan border */
            width : 1000px;

        }

        .username img {
            margin-left: 795px;
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
            margin-top: 20px;
        }

        .button-container button {
            padding: 10px 20px;
            border: black;
            border-radius: 5px;
            cursor: pointer;
        }

        .button-kembali {
            background-color: white;
        }

        .button-simpan {
            margin-left: 810px; 
            background-color: #2d1b6b;
            color: white;

        }

        /* CSS untuk garis pembatas */
        hr {
            border: none;
            border-top: 2px solid #ccc;
        }

        .popup-container {
            display: none;
            position: fixed;
            width: 500px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 9999;
        }

        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9998;
        }

        /* Tambahkan CSS untuk menengahkan pesan dan tombol */
        .popupmessage {
            text-align: center;
            margin-bottom: 20px;
        }

        .popupbutton {
            padding-left: 10px;
            padding-right: 10px;
            color: white;
            background: #2d1b6b;
            display: block;
            margin: 0 auto;
            border: none;
            cursor: pointer;
            border-radius: 10px;
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
                <span><?php echo $nama; ?> | Mahasiswa</span>
                <img src="img/<?php echo $profil_image; ?>" alt="User" width="35" height="35" style="border-radius: 50%;">
                <a href="../login/logout.php" class="logout">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </a>
            </div>
        </nav>
    </div>

    <nav class="sidebar">
        <ul class="sidebar-nav">
            <li class="">
                <a href="dashboard-mahasiswa.php" class="">
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
                    <li><a href="survey-pendidikan.php"><i class="fa-solid fa-medal"></i> Kualitas Pendidikan</a></li>
                    <li><a href="survey-fasilitas.php"><i class="fa-solid fa-layer-group"></i>     Fasilitas</a></li>                    
                    <li><a href="survey-pelayanan.php"><i class="fa-solid fa-handshake"></i>  Pelayanan</a></li>
                </ul>
            </li>
            <li class="">
                <a href="profil.php" class="">
                    <i class="fa-solid fa-user"></i>
                     Profile
                </a>
            </li>
        </ul>
    </nav>
    <section>
    <div class="content">
        <h2>Survey Fasilitas</h2>
        <form action="jawaban-fasilitas-mahasiswa.php" method="post" >
        <?php
            $no = 1;
            foreach ($fasilitas as $p) {
                ?>
                    <div class="survey-question">
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
                            </div>
                        </div>
                        <hr> <!-- Garis pembatas -->
                    </div>

                <?php
                        $no++; // Increment the counter
                    }
                ?>
            <!-- Button container -->
            <div class="button-container">
                <button class="button-kembali">Kembali</button>
                <input type="submit" class="btn btn-outline-light button-simpan" name="simpan" value="Simpan">
            </div> 
        </form>   
    </div>
    <div class="popup-overlay"></div>
    <div class="popup-container">
        <p class="popupmessage">Survey Fasilitas Telah Diisi</p>
        <button class="popupbutton" onclick="closePopup()">Lanjut</button>
    </div>

    <script>
    // Tambahkan skrip JavaScript di sini
    <?php if ($jumlah_survey > 0): ?>
        // Jika survei pendidikan sudah diisi, tampilkan pesan pop-up
        document.querySelector('.popup-overlay').style.display = 'block';
        document.querySelector('.popup-container').style.display = 'block';
    <?php endif; ?>

    // Fungsi untuk menutup pesan pop-up
    function closePopup() {
        document.querySelector('.popup-overlay').style.display = 'none';
        document.querySelector('.popup-container').style.display = 'none';
        // Alihkan pengguna kembali ke dashboard-mahasiswa setelah mengklik OK pada pesan pop-up
        window.location.href = "dashboard-mahasiswa.php";
    }
    </script>

</section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script>
        $('nav ul li').click(function(){
             $(this).addClass("active").siblings().removeClass("active");
        });    
    </script>
</body>
</html>
