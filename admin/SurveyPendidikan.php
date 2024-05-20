<?php
session_start();
include '../Koneksi.php';
include 'Survey.php';

class SurveyPendidikan {
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

    public function renderSurveyPendidikan() {
        if(isset($_POST['hapus']) && isset($_POST['soal_id'])) {
            $soal_id = $_POST['soal_id'];
            $pesan = $this->survey->hapusPertanyaan($soal_id); // Panggil metode hapusPertanyaan langsung
        }

        $kategori_id = 1; // Asumsikan kategori ID untuk fasilitas adalah 2
        $edit_soal = "edit-pendidikan.php";
        $questions = $this->survey->getSurveyQuestions($kategori_id);
        $this->survey->renderSurveyQuestions($questions, $kategori_id, $edit_soal, $_SERVER['PHP_SELF']);
    }

}
     
$surveyPendidikan = new SurveyPendidikan();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Kualitas Pendidikan Polinema</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/96cfbc074b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../header.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <style>
        /* Updated CSS */
        h2 {
            font-weight: bold;
            margin-bottom: 15px;
        }

        .survey-card {
            background-color: white;
            padding: 20px;
            width: 1000px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 0;
        }

        .survey-question h3 {
            font-size: 16px;
            color: #333;
        }
    
        .pilihan-container {
            display: flex;
            justify-content: space-between;
        }

        .rating, .rating2 {
            display: flex;
        }

        .label-cukup,
        .label-baik,
        .label-kurang,
        .label-sangat-baik {
            margin-right: 10px; 
        }

        .label-baik {
            margin-left: 150px; 
        }

        .label-sangat-baik {
            margin-left: 157px;
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
            padding: 5px 10px;
            border: none;
            font-size: 12px;
            height: auto;
            background-color: orange; /* Change to orange */
            color: white;
            margin-left: auto;
            border-radius: 10px;
        }

        .button-tambah {
            margin-top: 10px;
            margin-left: auto;
            background-color: #2d1b6b;
            border: 1px solid black;
            text-decoration: none;
            color: white;
            border-radius: 10px;
        }

        .button-edit {
            padding: 5px 10px;
            border: none;
            font-size: 12px;
            height: auto;
            margin-left: 10px;
            background-color: #2d1b6b;
            color: white;
            border-radius: 10px;
            text-decoration: none;

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
            <h2>Survey Kualitas Pendidikan Polinema</h2>
            <div class="survey-card">
                <?php $surveyPendidikan->renderSurveyPendidikan(); ?>
            </div>
        </div>
        
    </section>
    <div class="kosong">
            <div class="button-container">
                <a href="tambah-pendidikan.php" class=" button-tambah">Tambah</a>
            </div>
        </div>
</body>
</html>
