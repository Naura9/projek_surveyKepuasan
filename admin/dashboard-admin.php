<?php
session_start();
include '../koneksi.php';

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


$query_user_survey = "SELECT 
                            (SELECT COUNT(DISTINCT responden_mahasiswa_id) FROM t_jawaban_mahasiswa) AS mahasiswa_count,
                            (SELECT COUNT(DISTINCT responden_alumni_id) FROM t_jawaban_alumni) AS alumni_count,
                            (SELECT COUNT(DISTINCT responden_ortu_id) FROM t_jawaban_ortu) AS ortu_count,
                            (SELECT COUNT(DISTINCT responden_tendik_id) FROM t_jawaban_tendik) AS tendik_count,
                            (SELECT COUNT(DISTINCT responden_industri_id) FROM t_jawaban_industri) AS industri_count,
                            (SELECT COUNT(DISTINCT responden_dosen_id) FROM t_jawaban_dosen) AS dosen_count";

$result_user_survey = mysqli_query($kon, $query_user_survey);
$row_count_survey = mysqli_fetch_assoc($result_user_survey);

// Ambil nilai-nilai jumlah survey untuk masing-masing jenis pengguna
$mahasiswa_count = $row_count_survey['mahasiswa_count'];
$alumni_count = $row_count_survey['alumni_count'];
$ortu_count = $row_count_survey['ortu_count'];
$tendik_count = $row_count_survey['tendik_count'];
$industri_count = $row_count_survey['industri_count'];
$dosen_count = $row_count_survey['dosen_count'];

// Hitung total jumlah survey
$total_user = $mahasiswa_count + $alumni_count + $ortu_count + $tendik_count + $industri_count + $dosen_count;

$query_survey_ditanggapi = "SELECT SUM(jumlah_responden) AS jumlah_survey
FROM (
    SELECT COUNT(DISTINCT jm.responden_mahasiswa_id) AS jumlah_responden
    FROM m_survey_soal
    LEFT JOIN (
        SELECT DISTINCT soal_id, responden_mahasiswa_id
        FROM t_jawaban_mahasiswa
    ) AS jm ON m_survey_soal.soal_id = jm.soal_id
    GROUP BY m_survey_soal.kategori_id
) AS subquery;
";

$result_survey_ditanggapi = mysqli_query($kon, $query_survey_ditanggapi);

if ($result_survey_ditanggapi) {
    $row_survey_ditanggapi = mysqli_fetch_assoc($result_survey_ditanggapi);
    $jumlah_survey_ditanggapi = $row_survey_ditanggapi['jumlah_survey'];
} else {
    // Penanganan kesalahan jika query gagal
    $jumlah_survey_ditanggapi = 0;
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

    
</head>
<body>
<?php include 'Header.php'; ?>

    <section>
        <div class="content">
            <div class="survey-box">
                <div class="survey-count">
                    <span id="surveyNumber1"><?php echo $total_user; ?></span>
                    <div class="survey-text">User melakukan survey</div>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-user-group"></i>
                </div>
            </div>

            <div class="survey-box">
                <div class="survey-count">
                    <span id="surveyNumber2"><?php echo $jumlah_survey_ditanggapi; ?></span>
                    <div class="survey-text">Survey Telah Ditanggapi</div>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-rectangle-list"></i>            
                </div>            
            </div>
        </div>
        <div class="kosong"></div>
    </section>

</body>
</html>