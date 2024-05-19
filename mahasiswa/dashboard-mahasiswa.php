<?php
session_start();

include '../Koneksi.php';
$koneksi = new Koneksi();
$kon = $koneksi->kon;// Ambil data dari form

// Periksa apakah pengguna telah login
if (!isset($_SESSION['username'])) {
    // Jika belum, redirect pengguna ke halaman login
    header("Location: ../login/login.php");
    exit(); // Pastikan untuk keluar dari skrip setelah redirect
}

// Ambil nilai username dan role dari sesi
$username = $_SESSION['username'];
$role = $_SESSION['role'];
$nama = $_SESSION['nama'];

$query_get_responden_id = "SELECT responden_mahasiswa_id FROM t_responden_mahasiswa WHERE responden_nama = '$nama'";
$result_get_responden_id = mysqli_query($kon, $query_get_responden_id);
$row_get_responden_id = mysqli_fetch_assoc($result_get_responden_id);
$responden_mahasiswa_id = $row_get_responden_id['responden_mahasiswa_id'];

$query_get_profil_image = "SELECT image FROM t_responden_mahasiswa WHERE responden_nama = '$nama'";
$result_get_profil_image = mysqli_query($kon, $query_get_profil_image);
$row_get_profil_image = mysqli_fetch_assoc($result_get_profil_image);
$profil_image = $row_get_profil_image['image'];

// Query untuk menghitung jumlah kategori survei yang telah ditanggapi oleh responden tertentu
$query_jumlah_survey = "SELECT COUNT(DISTINCT m_survey_soal.kategori_id) AS jumlah_survey
                        FROM t_jawaban_mahasiswa
                        INNER JOIN m_survey_soal ON t_jawaban_mahasiswa.soal_id = m_survey_soal.soal_id
                        WHERE t_jawaban_mahasiswa.responden_mahasiswa_id = '$responden_mahasiswa_id'";
$result_jumlah_survey = mysqli_query($kon, $query_jumlah_survey);
$row_jumlah_survey = mysqli_fetch_assoc($result_jumlah_survey);
$jumlah_survey_ditanggapi = $row_jumlah_survey['jumlah_survey'];

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

    .survey-box {
        background-color: #ffffff;
        border-radius: 8px;
        padding: 30px;
        display: flex;
        align-items: center;
        width: 400px;
        height: 200px;
        margin-left: 300px;
        margin-top: 60px;
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

    .username img {
        margin-left: 795px;
    }

    /* CSS untuk tulisan "Survey telah ditanggapi" */
    .survey-text {
        font-size: 13px;
        color: #555555;
    }

    .kosong {
        background: #ececed;
        height: 273px;
    }

    </style>
</head>
<body>
    <div class="container">
    <?php include '../header.php'; ?>
    <section>
        <div class="content">
            <!-- Kotak berwarna putih -->
            <div class="survey-box">
                <div class="icon">
                    <i class="fa-solid fa-list-check"></i>
                </div>


                <!-- Jumlah survey ditanggapi -->
                <div class="survey-count">
                    <span id="surveyNumber"><?php echo $jumlah_survey_ditanggapi; ?></span>
                    <div class="survey-text">Survey Telah Ditanggapi</div>
                </div>
            
        </div>
        <div class="kosong">
        </div>
    </section>
</div>
</body>
</html>
