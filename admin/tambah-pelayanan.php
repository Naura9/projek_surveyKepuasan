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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['simpan'])) {
    // Data untuk disimpan ke dalam tabel m_survey_soal
    $soal_nama = $_POST['question']; // Ambil pertanyaan dari formulir
    $kategori_id = 3; 
    $soal_jenis = "skala"; // Jenis pertanyaan

    // Persiapkan query SQL untuk mendapatkan semua survey_id yang ada di tabel m_survey_soal
    $sql_survey_ids = "SELECT DISTINCT survey_id FROM m_survey_soal";

    // Eksekusi query untuk mendapatkan semua survey_id
    $result_survey_ids = mysqli_query($kon, $sql_survey_ids);

    // Periksa apakah query berhasil dieksekusi
    if ($result_survey_ids) {
        // Loop melalui setiap survey_id
        while ($row_survey_id = mysqli_fetch_assoc($result_survey_ids)) {
            $survey_id = $row_survey_id['survey_id'];

            // Ambil nilai no_urut terakhir untuk survey_id ini
            $sql_last_no_urut = "SELECT MAX(no_urut) AS last_no_urut FROM m_survey_soal WHERE survey_id = ?";
            $stmt_last_no_urut = $kon->prepare($sql_last_no_urut);
            $stmt_last_no_urut->bind_param("i", $survey_id);
            $stmt_last_no_urut->execute();
            $result_last_no_urut = $stmt_last_no_urut->get_result();

            if ($row_last_no_urut = $result_last_no_urut->fetch_assoc()) {
                $no_urut = $row_last_no_urut['last_no_urut'] + 1;
            } else {
                $no_urut = 1; // Jika belum ada pertanyaan untuk survey_id ini
            }

            // Persiapkan statement SQL untuk menyimpan pertanyaan
            $sql = "INSERT INTO m_survey_soal (survey_id, kategori_id, no_urut, soal_jenis, soal_nama) 
                    VALUES (?, ?, ?, ?, ?)";

            // Persiapkan dan eksekusi statement
            if ($stmt = $kon->prepare($sql)) {
                // Bind parameter ke statement
                $stmt->bind_param("iiiss", $survey_id, $kategori_id, $no_urut, $soal_jenis, $soal_nama);

                // Eksekusi statement
                if ($stmt->execute()) {
                    echo "Pertanyaan pelayanan berhasil ditambahkan untuk survey_id: $survey_id <br>";
                } else {
                    echo "Gagal menambahkan pertanyaan pelayanan untuk survey_id: $survey_id <br>";
                }

                // Tutup statement
                $stmt->close();
            } else {
                echo "Error: " . $kon->error;
            }
        }

        header("Location: SurveyPelayanan.php");
        exit();
    } else {
        // Jika query untuk mendapatkan survey_id gagal, tampilkan pesan error
        echo "Error: " . mysqli_error($kon);
    }

    // Tutup koneksi database
    $kon->close();
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
            margin-top: 20px;
            margin-bottom: 20px;
            margin-right: 100px;
            background-color: white; /* Tambahkan background color merah */
            padding: 10px; /* Tambahkan padding untuk memberi jarak antara konten dan border */
            width : 1000px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);

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
            margin-left: 825px; 
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
            margin-left: 900px
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
                    <li><a href="SurveyPendidikan.php"><i class="fa-solid fa-medal"></i> Kualitas Pendidikan</a></li>
                    <li><a href="SurveyFasilitas.php"><i class="fa-solid fa-layer-group"></i>     Fasilitas</a></li>                    
                    <li><a href="SurveyPelayanan.php"><i class="fa-solid fa-handshake"></i>  Pelayanan</a></li>
                    <li><a href="SurveyLulusan.php"><i class="fa-solid fa-graduation-cap"></i>  Lulusan</a></li>
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
        <h2>Survey Pelayanan Polinema</h2>
        <div class="survey-question">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
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
            <div class="button-container">
                <a href="SurveyPelayanan.php" class="btn button-kembali">Kembali</a>
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
