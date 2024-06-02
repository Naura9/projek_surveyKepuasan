<?php
session_start();

include '../Koneksi.php';
$db = new Koneksi();
$kon = $db->getConnection();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/login.php");
    exit(); 
}

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];
$nama = $_SESSION['nama'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['simpan'])) {
    $soal_nama = $_POST['question']; 
    $kategori_id = 1; 
    $soal_jenis = "skala"; 

    $sql_survey_ids = "SELECT DISTINCT survey_id FROM m_survey_soal";

    $result_survey_ids = mysqli_query($kon, $sql_survey_ids);

    if ($result_survey_ids) {
        while ($row_survey_id = mysqli_fetch_assoc($result_survey_ids)) {
            $survey_id = $row_survey_id['survey_id'];
    
            $sql_last_no_urut = "SELECT MAX(no_urut) AS last_no_urut FROM m_survey_soal WHERE survey_id = ?";
            $stmt_last_no_urut = $kon->prepare($sql_last_no_urut);
            $stmt_last_no_urut->bind_param("i", $survey_id);
            $stmt_last_no_urut->execute();
            $result_last_no_urut = $stmt_last_no_urut->get_result();
    
            if ($row_last_no_urut = $result_last_no_urut->fetch_assoc()) {
                $no_urut = $row_last_no_urut['last_no_urut'] + 1;
            } else {
                $no_urut = 1; 
            }
    
            $sql = "INSERT INTO m_survey_soal (survey_id, kategori_id, no_urut, soal_jenis, soal_nama) 
                    VALUES (?, ?, ?, ?, ?)";
    
            if ($stmt = $kon->prepare($sql)) {
                $stmt->bind_param("iiiss", $survey_id, $kategori_id, $no_urut, $soal_jenis, $soal_nama);
    
                if ($stmt->execute()) {
                    $_SESSION['success_message'] = "Pertanyaan kualitas pendidikan berhasil ditambahkan untuk survey_id: $survey_id <br>";
                } else {
                    $_SESSION['error_message'] = "Gagal menambahkan pertanyaan kualitas pendidikan untuk survey_id: $survey_id <br>";
                }
    
                $stmt->close();
    
                header("Location: SurveyPendidikan.php");
                exit();
            } else {
                echo "Error: " . $kon->error;
            }
        }
    } else {
        echo "Error: " . mysqli_error($kon);
    }
    $kon->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pendidikan</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/96cfbc074b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../header.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <style>
        .survey-question {
            margin-top: 20px;
            margin-bottom: 20px;
            margin-right: 100px;
            background-color: white; 
            padding: 10px; 
            width : 1050px;
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
            margin-top: 229px;
        }

        .button-container button {
            padding: 10px 20px;
            border: black;
            border-radius: 5px;
            cursor: pointer;
        }

        .button-kembali {
            background-color: white;
            border-radius: 8px; 
            text-decoration: none; 
            padding: 9px 10px; 
            font-size: 15px;
            color: black; 
            border: none;
            text-decoration: none;
        }

        .button-kembali:hover {
            background-color: white;
            border: 1px solid #2d1b6b;
            border-radius: 8px;
            text-decoration: none;
            color: black;
        }

        .button-simpan {
            margin-left: 875px; 
            background-color: #2d1b6b;
            color: white;
            border: 1px solid black;
            border-radius: 8px; 
            text-decoration: none; 
            padding: 9px 10px; 
            font-size: 15px;
        }

        .button-simpan:hover {
            background-color: white;
            border: 1px solid #2d1b6b;
            border-radius: 8px;
            text-decoration: none;
            color: black;
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
<?php include 'Header.php'; ?>
    <section>
    <div class="content">
        <h2 style="font-weight: bold;">Survey Kualitas Pendidikan Polinema</h2>
        <div class="survey-question">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <label for="question1" style="font-weight: 630;">Pertanyaan</label>
                <input type="text" class="form-control form-custom" name="question" id="question" placeholder="Masukkan Pertanyaan" required>
                <label for="question1" style="margin-top: 10px; font-weight: 630;">Keterangan </label>
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
                <a href="SurveyPendidikan.php" class="button-kembali">Kembali</a>
                <button type="submit" class="button-simpan" name="simpan">Simpan</button>
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
