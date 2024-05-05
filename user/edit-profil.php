<?php
include '../koneksi.php';

// Ambil parameter dari URL
$username = $_GET['username'];

// Query untuk mengambil data profil berdasarkan username
$query = "SELECT * FROM t_responden_mahasiswa 
          JOIN m_survey ON m_survey.survey_id = t_responden_mahasiswa.survey_id
          JOIN m_user ON m_user.user_id = m_survey.user_id
          WHERE username = '$username'";

$res = mysqli_query($kon, $query);

// Pastikan data ditemukan sebelum menampilkan form edit
if(mysqli_num_rows($res) > 0) {
    $mhs = mysqli_fetch_assoc($res);
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
        <h2>Edit Profil</h2>
        <form action="proses-edit.php" method="POST">
            <div class="form-profile">
                <table class="table">
                    <div class="form-group text-left font-weight-bold">
                        <div class="profile-label">Foto Profil</div>
                            <img src="../img/profil-kotak.jfif" alt="Polinema Logo">                                
                        </div>					
                        <div class="form-group text-left font-weight-bold">
                            <label for="responden_nim">NIM</label>
                            <input type="text" class="form-control bg-custom" name="responden_nim" id="responden_nim" value="<?php echo $mhs['responden_nim']; ?>">
                        </div>					
                        <div class="form-group text-left font-weight-bold">
						    <label for="respinden_nama">Nama Lengkap</label>
							<input type="text" class="form-control bg-custom" name="responden_nama" id="responden_nama" value="<?php echo $mhs['responden_nama']; ?>">
						</div>						
                        <div class="form-group text-left font-weight-bold">
                            <label for="username">Username</label>
							<input type="text" class="form-control bg-custom" name="username" id="username" value="<?php echo $mhs['username']; ?>">
						</div>						
                        <div class="form-group text-left font-weight-bold">
                            <label for="password">Password</label>
							<input type="text" class="form-control bg-custom" name="password" id="password" value="<?php echo $mhs['password']; ?>">
						</div>						
                        <div class="form-group text-left font-weight-bold">
                            <label for="responden_email">Email</label>
							<input type="text" class="form-control bg-custom" name="responden_email" id="responden_email" value="<?php echo $mhs['responden_email']; ?>">
						</div>						
                        <div class="form-group text-left font-weight-bold">
                            <label for="responden_prodi">Program Studi</label>
                            <input type="text" class="form-control bg-custom" name="responden_prodi" id="responden_prodi" value="<?php echo $mhs['responden_prodi']; ?>">
                        </div>						
                        <div class="form-group text-left font-weight-bold">
							<label for="responden_hp">No. Hp</label>
							<input type="text" class="form-control bg-custom" name="responden_hp" id="responden_hp" value="<?php echo $mhs['responden_hp']; ?>">
						</div>						
                        <div class="form-group text-left font-weight-bold">
							<label for="tahun_masuk">Tahun Masuk</label>
							<input type="text" class="form-control bg-custom" name="tahun_masuk" id="tahun_masuk" value="<?php echo $mhs['tahun_masuk']; ?>">
						</div>	
                    </div>					
                </table>
            </div>

        <!-- Button container -->
            <div class="button-container">
                <a href="profil-user.php" class="btn btn-light btn-outline-dark button-kembali">Kembali</a>
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
<?php
} else {
    echo "Data profil tidak ditemukan.";
}

// Tutup koneksi
mysqli_close($kon);
?>
