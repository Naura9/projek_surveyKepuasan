
<?php
    session_start();

    include '../Koneksi.php';
    
    if (!isset($_SESSION['username'])) {
        header("Location: ../login/login.php");
        exit(); 
    }
    
    $username = $_SESSION['username'];
    $role = $_SESSION['role'];
    $nama = $_SESSION['nama'];

    $query_get_responden_id = "SELECT responden_industri_id FROM t_responden_industri WHERE responden_nama = '$nama'";
    $result_get_responden_id = mysqli_query($kon, $query_get_responden_id);
    $row_get_responden_id = mysqli_fetch_assoc($result_get_responden_id);
    $responden_industri_id = $row_get_responden_id['responden_industri_id'];

    $query_get_profil_image = "SELECT image FROM t_responden_industri WHERE responden_nama = '$nama'";
    $result_get_profil_image = mysqli_query($kon, $query_get_profil_image);
    $row_get_profil_image = mysqli_fetch_assoc($result_get_profil_image);
    $profil_image = $row_get_profil_image['image'];

    $query_check_survey = "SELECT COUNT(*) AS jumlah_survey FROM t_jawaban_industri
                            JOIN m_survey_soal ON t_jawaban_industri.soal_id = m_survey_soal.soal_id
                            WHERE m_survey_soal.kategori_id = 3
                            AND t_jawaban_industri.responden_industri_id = '$responden_industri_id'";
    $result_check_survey = mysqli_query($kon, $query_check_survey);
    $row_check_survey = mysqli_fetch_assoc($result_check_survey);
    $jumlah_survey = $row_check_survey['jumlah_survey'];

    $query = "SELECT m_survey_soal.soal_id, m_survey_soal.soal_nama
        FROM m_survey_soal
        JOIN m_survey ON m_survey_soal.survey_id = m_survey.survey_id
        JOIN m_kategori ON m_survey_soal.kategori_id = m_kategori.kategori_id
        JOIN m_user ON m_survey.user_id = m_user.user_id
        WHERE m_kategori.kategori_id = 3
        AND m_user.role = 'industri'
        AND (m_survey_soal.soal_nama, m_survey_soal.soal_id) IN (
            SELECT soal_nama, MIN(soal_id)
            FROM m_survey_soal
            JOIN m_survey ON m_survey_soal.survey_id = m_survey.survey_id
            JOIN m_kategori ON m_survey_soal.kategori_id = m_kategori.kategori_id
            JOIN m_user ON m_survey.user_id = m_user.user_id
            WHERE m_kategori.kategori_id = 3
            AND m_user.role = 'industri'
            GROUP BY soal_nama
        )";

        
    $result = mysqli_query($kon, $query);

    $pelayanan = array();
	while ($data = mysqli_fetch_assoc($result)) {
		$pelayanan[] = $data;
	}
    
    if(isset($_POST['simpan'])) {
        $username = $_SESSION['username']; 
        $nama = $_SESSION['nama']; 
        $query_responden = "SELECT responden_industri_id FROM t_responden_industri WHERE responden_nama = '$nama'";
        $result_responden = mysqli_query($kon, $query_responden);
        if(mysqli_num_rows($result_responden) > 0) {
            $data_responden = mysqli_fetch_assoc($result_responden);
            $responden_industri_id = $data_responden['responden_industri_id'];
        } else {
            echo "Data responden tidak ditemukan.";
            exit; 
        }
    
        $query_soal_id = "SELECT m_survey_soal.soal_id
                          FROM m_survey_soal
                          JOIN m_survey ON m_survey_soal.survey_id = m_survey.survey_id
                          JOIN m_kategori ON m_survey_soal.kategori_id = m_kategori.kategori_id
                          JOIN m_user ON m_survey.user_id = m_user.user_id
                          WHERE m_kategori.kategori_id = 3
                          AND m_user.role = 'industri'";
        $result_soal_id = mysqli_query($kon, $query_soal_id);
    
        while ($row = mysqli_fetch_assoc($result_soal_id)) {
            $soal_id = $row['soal_id'];
            $jawaban = mysqli_real_escape_string($kon, $_POST['jawaban_' . $soal_id]);
    
            $query_insert_jawaban = "INSERT INTO t_jawaban_industri (responden_industri_id, soal_id, jawaban) 
                                     VALUES ('$responden_industri_id', '$soal_id', '$jawaban')";
            
            $result = mysqli_query($kon, $query_insert_jawaban);
            
            if (!$result) {
                echo "Gagal menyimpan jawaban untuk soal $soal_id: " . mysqli_error($kon);
            }
        }
        $query_update_tanggal = "UPDATE t_responden_industri SET responden_tanggal = CURDATE() WHERE responden_industri_id = '$responden_industri_id'";
        $result_update_tanggal = mysqli_query($kon, $query_update_tanggal);
    
        $query_update_tanggal_survey = "UPDATE m_survey SET survey_tanggal = CURDATE() WHERE survey_id = '$survey_id'";
        $result_update_tanggal_survey = mysqli_query($kon, $query_update_tanggal_survey);
    
        header("Location: dashboard-industri.php");
        exit;
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
        h2 {
            font-weight: bold;
        }

        .survey-question {
            margin-right: 100px;
            background-color: white; 
            padding: 10px; 
            width : 1045px;

        }

        .pilihan-container {
            display: flex;
        }
        
        .username img {
            margin-left: 795px;
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
            margin-left: 875px; 
            background-color: #2d1b6b;
            color: white;

        }

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
    <?php include '../header.php'; ?>

    <section>
    <div class="content">
        <h2>Survey Pelayanan</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <?php
            $no = 1;
            foreach ($pelayanan as $p) {
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
                        <hr> 
                    </div>

                <?php
                        $no++; 
                    }
                ?>
            <div class="button-container">
                <button class="button-kembali">Kembali</button>
                <input type="submit" class="btn btn-outline-light button-simpan" name="simpan" value="Simpan">
            </div> 
        </form>   
    </div>
    <div class="popup-overlay"></div>
    <div class="popup-container">
        <p class="popupmessage">Survey Pelayanan Telah Diisi</p>
        <button class="popupbutton" onclick="closePopup()">Lanjut</button>
    </div>

    <script>
        <?php if ($jumlah_survey > 0): ?>
            document.querySelector('.popup-overlay').style.display = 'block';
            document.querySelector('.popup-container').style.display = 'block';
        <?php endif; ?>

        function closePopup() {
            document.querySelector('.popup-overlay').style.display = 'none';
            document.querySelector('.popup-container').style.display = 'none';  
            window.location.href = "dashboard-industri.php";
        }
    </script>


</section>
</body>
</html>
