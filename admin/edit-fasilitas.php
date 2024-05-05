<?php
include '../koneksi.php';

$id = $_GET['id'];
// Query untuk mengambil detail pertanyaan berdasarkan ID
$query = "SELECT soal_id, soal_nama FROM m_survey_soal WHERE soal_id = $id";
$result = mysqli_query($kon, $query);

// Periksa apakah pertanyaan ditemukan
if(mysqli_num_rows($result) > 0) {
    // Ambil detail pertanyaan
    $data = mysqli_fetch_assoc($result);
    $soal_id = $data['soal_id'];
    $soal_nama = $data['soal_nama'];
} else {
    // Handle jika pertanyaan tidak ditemukan
    echo "Pertanyaan tidak ditemukan.";
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

        .button-hapus {
            margin-left: 750px; 
            background-color: #e87818;
            color: white;
            border: 1px solid black;
        }

        .button-simpan {
            margin-left: 10px; 
            background-color: #2d1b6b;
            color: white;
            border: 1px solid black;
        }

        .kosong {
            height: 18px;
            background: #ececed;

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
                <a href="#" class="">
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
                    <li><a href="#">Kualitas Pendidikan</a></li>
                    <li><a href="survey_fasilitas.php" onclick="loadContent(this)">Fasilitas</a></li>                    
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
        <h2>Survey Fasilitas Polinema</h2>
        <div class="survey-question">
            <label for="question1">Pertanyaan</label>
            <input type="text" class="form-control form-custom" name="soal_nama" id="soal_nama" placeholder="Masukkan Pertanyaan" value="<?php echo $soal_nama; ?>" required>
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

        <!-- Tambahkan pertanyaan lainnya sesuai kebutuhan -->
       
        <!-- Tambahkan pertanyaan lainnya sesuai kebutuhan -->
        
        
        <!-- Button container -->
        <div class="button-container">
            <a href="soal-fasilitas.php" class="btn button-kembali">Kembali</a>
            <a href="tambah-fasilitas.php" class="btn button-hapus">Hapus</a>
            <a href="" class="btn button-simpan">Simpan</a>
        </div>    

        <div class="kosong">
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
