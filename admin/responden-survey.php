<?php
include '../koneksi.php';

// Start the session
session_start();

// Get the username from the session
$username = $_SESSION['username'];

// Query to fetch user information from m_user table based on username
$query_user = "SELECT nama, role FROM m_user WHERE username = '$username'";

// Execute the query
$result_user = mysqli_query($kon, $query_user);

// Check if the query executed successfully
if ($result_user) {
    // Fetch the user's information
    $user_info = mysqli_fetch_assoc($result_user);

    // Store the user's name and role in variables
    $nama = $user_info['nama'];
    $role = $user_info['role'];
} else {
    // Handle the case where the query fails
    $nama = "Nama Pengguna";
    $role = "Role";
}
// Query untuk mengambil data responden mahasiswa
$query_mahasiswa = "SELECT m.nama, m.username, m.role
                    FROM t_jawaban_mahasiswa j
                    INNER JOIN t_responden_mahasiswa r ON j.responden_mahasiswa_id = r.responden_mahasiswa_id
                    INNER JOIN m_survey s ON s.survey_id = r.survey_id
                    INNER JOIN m_user m ON s.user_id = m.user_id";

// Query untuk mengambil data responden dari tabel t_jawaban_alumni
$query_alumni = "SELECT m.nama AS nama, m.username AS username, m.role AS role 
                 FROM t_jawaban_alumni j
                 INNER JOIN t_responden_alumni r ON j.responden_alumni_id = r.responden_alumni_id
                 INNER JOIN m_survey s ON s.survey_id = r.survey_id
                 INNER JOIN m_user m ON s.user_id = m.user_id";

// Query untuk mengambil data responden dari tabel t_jawaban_ortu
$query_ortu = "SELECT m.nama AS nama, m.username AS username, m.role AS role 
               FROM t_jawaban_ortu j
               INNER JOIN m_user m ON j.user_id = m.user_id";

// Query untuk mengambil data responden dari tabel t_jawaban_tendik
$query_tendik = "SELECT m.nama AS nama, m.username AS username, m.role AS role 
                 FROM t_jawaban_tendik j
                 INNER JOIN m_user m ON j.user_id = m.user_id";

// Query untuk mengambil data responden dari tabel t_jawaban_dosen
$query_dosen = "SELECT m.nama AS nama, m.username AS username, m.role AS role 
                FROM t_jawaban_dosen j
                INNER JOIN m_user m ON j.user_id = m.user_id";

// Query untuk mengambil data responden dari tabel t_jawaban_industri
$query_industri = "SELECT m.nama AS nama, m.username AS username, m.role AS role 
                   FROM t_jawaban_industri j
                   INNER JOIN m_user m ON j.user_id = m.user_id";

// Eksekusi query dan ambil hasilnya
$result_mahasiswa = mysqli_query($kon, $query_mahasiswa);
$result_alumni = mysqli_query($kon, $query_alumni);
$result_ortu = mysqli_query($kon, $query_ortu);
$result_tendik = mysqli_query($kon, $query_tendik);
$result_dosen = mysqli_query($kon, $query_dosen);
$result_industri = mysqli_query($kon, $query_industri);

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
        .table {
            width: 1020px;
            border-radius: 10px; /* Menambahkan radius */
            overflow: hidden;
            margin-bottom: 0;
        }

        .table th {
        padding-top: 15px; /* Menambahkan jarak di bagian atas */
        padding-bottom: 15px; /* Menambahkan jarak di bagian bawah */
    }

    .kosong {
        background-color: #ececed; /* Memberi warna latar belakang */
        height: 273px;
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
        <h2>Responden Survey</h2>
            <!-- Tabel responden survey -->
            <table class="table">
                    <tr>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th></th>
                    </tr>
                </thead>
                
                <tbody>
                <?php
                    // Loop untuk menampilkan data responden mahasiswa
                    while($row = mysqli_fetch_assoc($result_mahasiswa)) {                
                    ?>
                    <tr>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['role']; ?></td>
                        <td><a href="detail.php" class="btn btn-outline-dark">Detail</a></td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        ?>
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
