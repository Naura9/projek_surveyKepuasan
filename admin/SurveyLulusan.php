<?php
session_start();
include '../Koneksi.php';
include 'Survey.php';

class SurveyLulusan {
    private $db;
    public $username;
    public $role;
    public $nama;
    
    public function __construct() {
        $this->db = new Koneksi();
        $this->survey = new Survey($this->db);
         // Set session variables to class properties
         if (isset($_SESSION['username'])) {
            $this->username = $_SESSION['username'];
            $this->role = $_SESSION['role'];
            $this->nama = $_SESSION['nama'];
        } else {
            header("Location: ../login/login.php");
            exit();
        }
    }

    public function renderSurveyLulusan() {
        if(isset($_POST['hapus']) && isset($_POST['soal_id'])) {
            $soal_id = $_POST['soal_id'];
            $pesan = $this->survey->hapusPertanyaan($soal_id); // Panggil metode hapusPertanyaan langsung
        }

        $kategori_id = 4; // Asumsikan kategori ID untuk fasilitas adalah 2
        $edit_soal = "edit-lulusan.php";
        $questions = $this->survey->getSurveyQuestions($kategori_id);
        $this->survey->renderSurveyQuestions($questions, $kategori_id, $edit_soal, $_SERVER['PHP_SELF']);
    }

}
     
$surveyLulusan = new SurveyLulusan();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Kualitas Lulusan Polinema</title>
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

        .survey-card {
            background-color: white; /* Tambahkan background color merah */
            padding: 20px; /* Tambahkan padding untuk memberi jarak antara konten dan border */
            width: 1000px; /* Sesuaikan dengan lebar yang diinginkan */
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 0;
        }

        

        .survey-question h3 {
            font-size: 16px; /* Ubah ukuran font menjadi 16px */
            color: #333;
        }
    

        .pilihan-container {
            display: flex;
            justify-content: space-between;
        }

        .rating {
            display: flex;
        }

        .label-cukup,
        .label-baik,
        .label-kurang,
        .label-sangat-baik {
            margin-right: 10px; /* Tambahkan margin kanan pada label */
        }


        .label-baik {
            margin-left: 150px; /* Tambahkan margin kiri pada label "Baik" */
        }

        .label-sangat-baik {
            margin-left: 157px; /* Tambahkan margin kiri pada label "Sangat Baik" */
        }

        .button-container {
            display: flex; 
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
            margin-left: 500px;
        }

        .button-tambah {
            margin-top: 10px;
            margin-left: 1170px;
            background-color: white;
            border: 1px solid black;
        }

        .button-edit {
            padding: 0;
            border: #2d1b6b;
            font-size: 12px;
            align-items: center;
            height: 20px;
            width: 50px;
            margin-left: 10px;
            background-color: #2d1b6b;
            color: white;
        }

        hr {
            border: none;
            border-top: 2px solid #ccc;        
        }
    
        .kosong {
            background: #ececed;
            height: 70px;
        }

    </style>
</head>
<body>
<?php include 'Header.php'; ?>

    <section>
        <div class="content">
            <h2>Survey Lulusan Polinema</h2>
            <div class="survey-card">
                <?php $surveyLulusan->renderSurveyLulusan(); ?>
            </div>
        </div>
        
    </section>
    <div class="kosong">
            <div class="button-container">
                <a href="tambah-lulusan.php" class="btn button-tambah">Tambah</a>
            </div>
        </div>
</body>
</html>
