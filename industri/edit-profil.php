<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['username'])) {
    // Jika belum, redirect pengguna ke halaman login
    header("Location: ../login/login.php");
    exit(); // Pastikan untuk keluar dari skrip setelah redirect
}

// Ambil parameter dari URL
$nama = $_SESSION['nama'];
$username = $_GET['username'];


// Query untuk mengambil data profil berdasarkan username
$query = "SELECT * FROM t_responden_industri 
          JOIN m_survey ON m_survey.survey_id = t_responden_industri.survey_id
          JOIN m_user ON m_user.user_id = m_survey.user_id
          WHERE username = '$username'";

$res = mysqli_query($kon, $query);

// Pastikan data ditemukan sebelum menampilkan form edit
if(mysqli_num_rows($res) > 0) {
    $mhs = mysqli_fetch_assoc($res);

    if(isset($_FILES["fileImg"]["name"])){ // Change this line
        $id = $_POST["responden_industri_id"];
    
        $src = $_FILES["fileImg"]["tmp_name"];
        $imageName = uniqid() . $_FILES["fileImg"]["name"]; // Change this line
    
        $target = "img/" . $imageName;
    
        move_uploaded_file($src, $target);
    
        $query = "UPDATE t_responden_industri SET image = '$imageName' WHERE responden_industri_id = $id"; // Change this line
        mysqli_query($kon, $query);
    
        header("Location: profil.php");
    }
    
    $query_get_profil_image = "SELECT image FROM t_responden_industri WHERE responden_nama = '$nama'";
    $result_get_profil_image = mysqli_query($kon, $query_get_profil_image);
    $row_get_profil_image = mysqli_fetch_assoc($result_get_profil_image);
    $profil_image = $row_get_profil_image['image'];
    
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

        .form-profile {
            margin-top: 20px;
            margin-bottom: 20px;
            margin-right: 100px;
            background-color: white; /* Tambahkan background color merah */
            padding: 10px; /* Tambahkan padding untuk memberi jarak antara konten dan border */
            width : 1000px;
            border-radius: 10px;
        }

            .card-body {
            background-color: #ececed;
        }

        .bg-custom {
            background-color: #ececed;
            width:700px;
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
            font-size: 14px;
        }

        .button-kembali {
            background-color: white;
            outline: black;
        }

        .button-simpan {
            margin-left: 835px; 
            background-color: #2d1b6b;
            color: white;

        }

        .username img {
            margin-left: 795px;
        }




    .upload{
      width: 140px;
      margin-bottom: 20px;
      
    }
    .upload img{
      border: 2px solid #DCDCDC;
      width: 150px;
      height: 150x;
    }
    .upload .rightRound{
        background: #00B4FF;
        width: 32px;
        height: 32px;
        line-height: 32px;
        text-align: center;
        border-radius: 50%;
        overflow: hidden;
        cursor: pointer;
    }
    .upload .leftRound{
      bottom: 0;
      left: 0;
      background: red;
      width: 32px;
      height: 32px;
      line-height: 33px;
      text-align: center;
      border-radius: 50%;
      overflow: hidden;
      cursor: pointer;
    }
    .upload .fa{
      color: white;
    }
    .upload input{
      position: absolute;
      transform: scale(2);
      opacity: 0;
    }
    .upload input::-webkit-file-upload-button, .upload input[type=submit]{
      cursor: pointer;
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
                <span><?php echo $nama; ?> | Industri</span>
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
                <a href="dashboard-industri.php" class="">
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
                    <li><a href="survey-pelayanan.php"><i class="fa-solid fa-handshake"></i>  Pelayanan</a></li>
                    <li><a href="survey-lulusan.php"><i class="fa-solid fa-graduation-cap"></i>  Lulusan</a></li>
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
        <h2>Edit Profil</h2>
            <div class="form-profile">
                <table class="table">
                    <div class="form-group text-left font-weight-bold">
                        <div class="profile-label">Foto Profil</div>
                            <form class="form" id = "form" action="" enctype="multipart/form-data" method="post">
                            <input type="hidden" name="responden_industri_id" value="<?php echo $mhs['responden_industri_id']; ?>">
                            <div class="upload">
                            <div class="rightRound" id = "upload">
                                    <input type="file" name="fileImg" id = "fileImg" accept=".jpg, .jpeg, .png">
                                    <i class = "fa fa-camera"></i>
                                </div>
                                <img src="img/<?php echo $mhs['image']; ?>" id = "image">

                                <div class="leftRound" id = "cancel" style = "display: none;">
                                    <i class = "fa fa-times"></i>
                                </div>
                                <div class="rightRound" id = "confirm" style = "display: none;">
                                    <input type="submit">
                                    <i class = "fa fa-check"></i>
                                </div>
                            </div>     
                            </form>                        
                    <form action="proses-edit.php" method="POST">

                        </div>					
                        <div class="form-group text-left font-weight-bold">
    <label for="responden_nama">Nama Lengkap</label>
    <input type="text" class="form-control bg-custom" name="responden_nama" id="responden_nama" value="<?php echo $mhs['responden_nama']; ?>">
</div>

<div class="form-group text-left font-weight-bold">
    <label for="responden_jabatan">Jabatan</label>
    <input type="text" class="form-control bg-custom" name="responden_jabatan" id="responden_jabatan" value="<?php echo $mhs['responden_jabatan']; ?>">
</div>

<div class="form-group text-left font-weight-bold">
    <label for="responden_perusahaan">Perusahaan</label>
    <input type="text" class="form-control bg-custom" name="responden_perusahaan" id="responden_perusahaan" value="<?php echo $mhs['responden_perusahaan']; ?>">
</div>

<div class="form-group text-left font-weight-bold">
    <label for="responden_email">Email</label>
    <input type="text" class="form-control bg-custom" name="responden_email" id="responden_email" value="<?php echo $mhs['responden_email']; ?>">
</div>

<div class="form-group text-left font-weight-bold">
    <label for="responden_hp">No. Hp</label>
    <input type="text" class="form-control bg-custom" name="responden_hp" id="responden_hp" value="<?php echo $mhs['responden_hp']; ?>">
</div>

<div class="form-group text-left font-weight-bold">
    <label for="responden_kota">Kota</label>
    <input type="text" class="form-control bg-custom" name="responden_kota" id="responden_kota" value="<?php echo $mhs['responden_kota']; ?>">
</div>

                    </div>					
                </table>
            </div>

        <!-- Button container -->
            <div class="button-container">
                <a href="profil.php" class="btn btn-light btn-outline-dark button-kembali">Kembali</a>
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

    
<script type="text/javascript">
      document.getElementById("fileImg").onchange = function(){
        document.getElementById("image").src = URL.createObjectURL(fileImg.files[0]); // Preview new image

        document.getElementById("cancel").style.display = "block";
        document.getElementById("confirm").style.display = "block";

        document.getElementById("upload").style.display = "none";
      }

      var userImage = document.getElementById('image').src;
      document.getElementById("cancel").onclick = function(){
        document.getElementById("image").src = userImage; // Back to previous image

        document.getElementById("cancel").style.display = "none";
        document.getElementById("confirm").style.display = "none";

        document.getElementById("upload").style.display = "block";
      }
    </script>
</body>
</html>
<?php
} else {
    echo "Data profil tidak ditemukan.";
}

// Tutup koneksi
mysqli_close($kon);
?>