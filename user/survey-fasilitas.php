
<?php
    include '../koneksi.php'; // Menghubungkan ke file koneksi.php
    // Query untuk mengambil soal survei dengan kategori_id 1
    $query = "SELECT m_survey_soal.soal_id, m_survey_soal.soal_nama
        FROM m_survey_soal
        JOIN m_survey ON m_survey_soal.survey_id = m_survey.survey_id
        JOIN m_kategori ON m_survey_soal.kategori_id = m_kategori.kategori_id
        JOIN m_user ON m_survey.user_id = m_user.user_id
        WHERE m_kategori.kategori_id = 2
        AND m_user.role = 'mahasiswa'
        ";
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
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">   
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
    </style>
</head>

<body>
    <div class="container">
        <nav class="navbar">
            <div class="logo">
                <img src="img/logo-nama.png" alt="Logo" width="100">
            </div>
            <div class="username">
                <span>Nama Pengguna</span>
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
                    <li><a href="survey-pendidikan.php">Kualitas Pendidikan</a></li>
                    <li><a href="survey-fasilitas.php">Fasilitas</a></li>                    
                    <li><a href="#">Pelayanan</a></li>
                    <li><a href="#">Lulusan</a></li>
                </ul>
            </li>
            <li class="">
                <a href="#" class="">
                    <i class="lni lni-user"></i>
                     Profile
                </a>
            </li>

            <li>
                <a href="login.php" class="btn logout-btn">Logout</a>

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

</section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script>
        $('nav ul li').click(function(){
             $(this).addClass("active").siblings().removeClass("active");
        });    
    </script>
</body>
</html>
