<?php
session_start();
// Koneksi ke database
include '../koneksi.php';

// Ambil nama pengguna dari sesi
$username = $_SESSION['username'];
$role = $_SESSION['role'];
$nama = $_SESSION['nama'];


// Query untuk mengambil data dari t_responden_mahasiswa berdasarkan nama pengguna
$query_profil = "SELECT * FROM t_responden_mahasiswa 
JOIN m_survey ON m_survey.survey_id = t_responden_mahasiswa.survey_id
JOIN m_user ON m_user.user_id = m_survey.user_id
WHERE responden_nama = '$nama'
";
$result_profil = mysqli_query($kon, $query_profil);

// Periksa apakah data ditemukan
if(mysqli_num_rows($result_profil) > 0) {
    // Tampilkan data profil
    while($mhs = mysqli_fetch_array($result_profil)){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">   
    <link rel="stylesheet" href="../header.css">
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

        .button-edit {
            margin-left: 945px; 
            background-color: #2d1b6b;
            color: white;
        }

        .profile-label {
            width: 30%;
            font-weight: bold;
            margin-bottom: 5px; /* Jarak di bawah label */
        }

        .profile-value {
            width: 65%;
            background-color: #ececed;
            border: 1px solid #ced4da; /* Grey border */
            padding: 5px 10px;
            border-radius: 5px;
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
                <span><?php echo $nama; ?> | <?php echo $role; ?></span>
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
                    <li><a href="#">Kualitas Pendidikan</a></li>
                    <li><a href="survey_fasilitas.php" onclick="loadContent(this)">Fasilitas</a></li>                    
                    <li><a href="#">Pelayanan</a></li>
                    <li><a href="#">Lulusan</a></li>
                </ul>
            </li>
            <li class="">
                <a href="profil-user.php" class="">
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
            <h2>Profil</h2>
            <div class="form-profile">
                <tr>
                    <div class="profile-label">Foto Profil</div>
                    <img src="../img/profil-kotak.jfif" alt="Foto Profil">
                </tr>
                <tr>
                    <div class="profile-label">NIM</div>
                    <div class="profile-value"><?php echo $mhs['responden_nim']; ?></div>
                </tr>
                <tr>
                    <div class="profile-label">Nama Lengkap</div>
                    <div class="profile-value"><?php echo $mhs['responden_nama']; ?></div>
                </tr>
                <tr>
                    <div class="profile-label">Username</div>
                    <div class="profile-value"><?php echo $mhs['username']; ?></div>
                </tr>
                <tr>
                    <div class="profile-label">Password</div>
                    <div class="profile-value"><?php echo $mhs['password']; ?></div>
                </tr>
                <tr>
                    <div class="profile-label">Email</div>
                    <div class="profile-value"><?php echo $mhs['responden_email']; ?></div>
                </tr>
                <tr>
                    <div class="profile-label">Program Studi</div>
                    <div class="profile-value"><?php echo $mhs['responden_prodi']; ?></div>
                </tr>
                <tr>
                    <div class="profile-label">No. Hp</div>
                    <div class="profile-value"><?php echo $mhs['responden_hp']; ?></div>
                </tr>
                <tr>
                    <div class="profile-label">Tahun Masuk</div>
                    <div class="profile-value"><?php echo $mhs['tahun_masuk']; ?></div>
                </tr>
            </div>
            <!-- Button container -->
            <div class="button-container">
                <a href="edit-profil.php?username=<?php echo $username; ?>" class="btn btn-light btn-outline-dark button-edit">Edit</a>
            </div>
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
<?php
    }
} else {
    echo "Data profil tidak ditemukan.";
}

// Tutup koneksi
mysqli_close($kon);
?>
