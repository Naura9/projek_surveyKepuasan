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

    if(isset($_GET['responden_id']) && isset($_GET['role']) && isset($_GET['username'])) {
        $responden_id = $_GET['responden_id'];
        $role = $_GET['role'];
        $username = $_GET['username'];

        switch ($role) {
            case 'mahasiswa':
                $query_detail_responden = "SELECT * FROM t_responden_mahasiswa WHERE responden_mahasiswa_id = $responden_id";
                break;
            case 'alumni':
                $query_detail_responden = "SELECT * FROM t_responden_alumni WHERE responden_alumni_id = $responden_id";
                break;
            case 'ortu':
                $query_detail_responden = "SELECT * FROM t_responden_ortu WHERE responden_ortu_id = $responden_id";
                break;
            case 'dosen':
                $query_detail_responden = "SELECT * FROM t_responden_dosen WHERE responden_dosen_id = $responden_id";
                break;
            case 'tendik':
                $query_detail_responden = "SELECT * FROM t_responden_tendik WHERE responden_tendik_id = $responden_id";
                break;
            case 'industri':
                $query_detail_responden = "SELECT * FROM t_responden_industri WHERE responden_industri_id = $responden_id";
                break;
            default:
                echo "Role responden tidak valid";
                exit;
        }

        $result_detail_responden = mysqli_query($kon, $query_detail_responden);

        if($result_detail_responden && mysqli_num_rows($result_detail_responden) > 0) {
            $detail_responden = mysqli_fetch_assoc($result_detail_responden);
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Responden</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/96cfbc074b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../header.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <style>
        .username span {
            margin-left: 45px;
        }

        .username {
            background-color: #ececed;
            flex-grow: 1;
            display: flex;
            align-items: center; 
            border-left: 2px solid #ccc;
            height: 80px;
            border-bottom: 2px solid #a9a9ac;
            justify-content: space-between;
        }

        .username i {
            font-size: 23px;
            color: black;
        }

        .sidebar-nav li a {
            color: #333;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 10px 8px;
            transition: background-color 0.3s, color 0.3s;
        }

        .sidebar-nav li a i {
            margin-right: 10px;
        }

        .sidebar-nav li {
            margin-bottom: 10px;
        }

        .sidebar-nav .collapse li a:hover, .sidebar-nav .collapse li.active > a {
            background-color: #BEB8D1;
            border-radius: 4px;
        }

        .message {
            width: 5px;
            margin-left: 885px;
        }

        .sidebar-nav .active > a {
            background-color: #BEB8D1;
            border-radius: 4px;
        }

        .logout {
            margin-left: 0px;
            margin-right: 30px;
        }

        h2 {
            font-weight: bold;
        }

        .profile-img {
            width: 150px;
            height: 150px; 
        }

        .role {
            position: absolute;
            top: 190px;
            left: 1133px;
            background-color: #2D1B6B;
            color: white;
            padding: 5px;
            border-radius: 10px;
        }

        .form-profile {
            margin-top: 20px;
            margin-bottom: 20px;
            margin-right: 100px;
            background-color: white;
            padding: 30px;
            width : 1000px;
            border-radius: 10px;
        }

        .table-bordered {
            margin-top: 20px;
            border-color: black;
        }

        .table-bordered td, .table-bordered th {
            border-right-color: black; 
            border-left-color: black;
            width: 50%;
            height: 30px;
        }

        .btn-kembali {
            margin-bottom: 10px;
        }

        .kosong {
            height: 20px;
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
                <span><?php echo $nama; ?> | Admin </span>
                <a href="permintaan-user.php" class="message">
                    <i class="fa-regular fa-envelope"></i>
                </a>
                <a href="../login/logout.php" class="logout">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </a>
            </div>
        </nav>
    </div>
    <nav class="sidebar">
        <ul class="sidebar-nav">
            <li>
                <a href="dashboard-admin.php">
                    <i class="fa-solid fa-house"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="#" data-bs-toggle="collapse" data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                    <i class="fa-solid fa-list-ol"></i> Survey
                    <span class="lni lni-chevron-down"></span>
                </a>
                <ul id="auth" class="collapse" data-bs-parent="#sidebar">
                    <li><a href="SurveyPendidikan.php"><i class="fa-solid fa-medal"></i> Kualitas Pendidikan</a></li>
                    <li><a href="SurveyFasilitas.php"><i class="fa-solid fa-layer-group"></i> Fasilitas</a></li>                    
                    <li><a href="SurveyPelayanan.php"><i class="fa-solid fa-handshake"></i> Pelayanan</a></li>
                    <li><a href="SurveyLulusan.php"><i class="fa-solid fa-graduation-cap"></i> Lulusan</a></li>
                </ul>
            </li>
            <li>
                <a href="responden-survey.php">
                    <i class="fa-solid fa-user-group"></i>
                    Responden
                </a>
            </li>
            <li>
                <a href="laporan-survey.php">
                    <i class="fa-solid fa-book-open"></i>
                    Laporan
                </a>
            </li>
        </ul>
    </nav>
    <section>
        <div class="content">
            <h2>Profil Responden</h2>
            <div class="form-profile">
                <tr>
                    <?php 
                        switch ($role) {
                            case 'mahasiswa':
                                echo "<tr><td><img src='../mahasiswa/img/{$detail_responden['image']}' alt='Foto Profil' class='profile-img'></td></tr>";
                                break;
                            case 'alumni':
                                echo "<tr><td><img src='../alumni/img/{$detail_responden['image']}' alt='Foto Profil' class='profile-img'></td></tr>";
                                break;
                            case 'dosen':
                                echo "<tr><td><img src='../dosen/img/{$detail_responden['image']}' alt='Foto Profil' class='profile-img'></td></tr>";
                                break;
                            case 'ortu':
                                echo "<tr><td><img src='../ortu/img/{$detail_responden['image']}' alt='Foto Profil' class='profile-img'></td></tr>";
                                break;
                            case 'tendik':
                                echo "<tr><td><img src='../tendik/img/{$detail_responden['image']}' alt='Foto Profil' class='profile-img'></td></tr>";
                                break;
                            case 'industri':
                                echo "<tr><td><img src='../industri/img/{$detail_responden['image']}' alt='Foto Profil' class='profile-img'></td></tr>";
                                break;
                            default:
                                echo "Role responden tidak valid";
                                break;
                        }
                    ?>
                    <span class="role"><?php echo $role; ?></span>
                </tr>
                <table class="table table-bordered">
                        <?php
                            switch ($role) {
                                case 'mahasiswa':
                                    echo "<tr><td><strong>NIM</strong></td><td>{$detail_responden['responden_nim']}</td></tr>";
                                    echo "<tr><td><strong>Nama</strong></td><td>{$detail_responden['responden_nama']}</td></tr>";
                                    echo "<tr><td><strong>Email</strong></td><td>{$detail_responden['responden_email']}</td></tr>";
                                    echo "<tr><td><strong>Nomor Telepon</strong></td><td>{$detail_responden['responden_hp']}</td></tr>";
                                    echo "<tr><td><strong>Username</strong></td><td>{$username}</td></tr>";
                                    echo "<tr><td><strong>Program Studi</strong></td><td>{$detail_responden['responden_prodi']}</td></tr>";
                                    echo "<tr><td><strong>Tahun Masuk</strong></td><td>{$detail_responden['tahun_masuk']}</td></tr>";
                                    break;
                                case 'alumni':
                                    echo "<tr><td><strong>NIP</strong></td><td>{$detail_responden['responden_nip']}</td></tr>";
                                    echo "<tr><td><strong>Nama Lengkap</strong></td><td>{$detail_responden['responden_nama']}</td></tr>";
                                    echo "<tr><td><strong>Program Studi</strong></td><td>{$detail_responden['responden_prodi']}</td></tr>";
                                    echo "<tr><td><strong>Email</strong></td><td>{$detail_responden['responden_email']}</td></tr>";
                                    echo "<tr><td><strong>Nomor Telepon</strong></td><td>{$detail_responden['responden_hp']}</td></tr>";
                                    echo "<tr><td><strong>Tahun Lulus</strong></td><td>{$detail_responden['tahun_lulus']}</td></tr>";
                                    echo "<tr><td><strong>Username</strong></td><td>{$username}</td></tr>";
                                    break;
                                case 'dosen':
                                    echo "<tr><td><strong>NIP</strong></td><td>{$detail_responden['responden_nip']}</td></tr>";
                                    echo "<tr><td><strong>Nama Lengkap</strong></td><td>{$detail_responden['responden_nama']}</td></tr>";
                                    echo "<tr><td><strong>Email</strong></td><td>{$detail_responden['email']}</td></tr>";
                                    echo "<tr><td><strong>Unit</strong></td><td>{$detail_responden['responden_unit']}</td></tr>";
                                    echo "<tr><td><strong>Username</strong></td><td>{$username}</td></tr>";
                                    break;
                                case 'ortu':
                                    echo "<tr><td><strong>Nama Lengkap</strong></td><td>{$detail_responden['responden_nama']}</td></tr>";
                                    echo "<tr><td><strong>Email</strong></td><td>{$detail_responden['email']}</td></tr>";
                                    echo "<tr><td><strong>Jenis Kelamin</strong></td><td>{$detail_responden['responden_jk']}</td></tr>";
                                    echo "<tr><td><strong>Umur</strong></td><td>{$detail_responden['responden_umur']}</td></tr>";
                                    echo "<tr><td><strong>Nomor Telepon</strong></td><td>{$detail_responden['responden_hp']}</td></tr>";
                                    echo "<tr><td><strong>Penghasilan</strong></td><td>{$detail_responden['responden_penghasilan']}</td></tr>";
                                    echo "<tr><td><strong>NIM Mahasiswa</strong></td><td>{$detail_responden['mahasiswa_nim']}</td></tr>";
                                    echo "<tr><td><strong>Nama Mahasiswa</strong></td><td>{$detail_responden['mahasiswa_nama']}</td></tr>";
                                    echo "<tr><td><strong>Program Studi Mahasiswa</strong></td><td>{$detail_responden['mahasiswa_prodi']}</td></tr>";
                                    echo "<tr><td><strong>Username</strong></td><td>{$username}</td></tr>";
                                    break;
                                case 'tendik':
                                    echo "<tr><td><strong>Nomor Pegawai</strong></td><td>{$detail_responden['responden_nopeg']}</td></tr>";
                                    echo "<tr><td><strong>Nama Lengkap</strong></td><td>{$detail_responden['responden_nama']}</td></tr>";
                                    echo "<tr><td><strong>Email</strong></td><td>{$detail_responden['email']}</td></tr>";
                                    echo "<tr><td><strong>Unit</strong></td><td>{$detail_responden['responden_unit']}</td></tr>";
                                    echo "<tr><td><strong>Username</strong></td><td>{$username}</td></tr>";
                                    break;
                                case 'industri':
                                    echo "<tr><td><strong>Nama Lengkap</strong></td><td>{$detail_responden['responden_nama']}</td></tr>";
                                    echo "<tr><td><strong>Jabatan</strong></td><td>{$detail_responden['responden_jabatan']}</td></tr>";
                                    echo "<tr><td><strong>Nama Perusahaan</strong></td><td>{$detail_responden['responden_perusahaan']}</td></tr>";
                                    echo "<tr><td><strong>Email</strong></td><td>{$detail_responden['responden_email']}</td></tr>";
                                    echo "<tr><td><strong>Nomor Telepon</strong></td><td>{$detail_responden['responden_hp']}</td></tr>";
                                    echo "<tr><td><strong>Kota</strong></td><td>{$detail_responden['responden_kota']}</td></tr>";
                                    echo "<tr><td><strong>Username</strong></td><td>{$username}</td></tr>";
                                    break;
                                default:
                                    echo "Role responden tidak valid";
                                    break;
                            }
                        ?>
                    </table>
                </div>
                <tr>
                <td class="text-rigth" colspan="2">
                    <a href="responden-survey.php" class="btn btn-light btn-kembali">Kembali</a>
                </td>
            </tr>
            </div>
        </section>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
            var sidebarItems = document.querySelectorAll('.sidebar-nav > li > a');
            var subSidebarItems = document.querySelectorAll('.sidebar-nav .collapse li > a');

            function removeActiveClass() {
                sidebarItems.forEach(function(el) {
                    el.parentElement.classList.remove('active');
                });
                subSidebarItems.forEach(function(el) {
                    el.parentElement.classList.remove('active');
                });
            }

            sidebarItems.forEach(function(item) {
                item.addEventListener('click', function() {
                    removeActiveClass();

                    this.parentElement.classList.add('active');

                    localStorage.setItem('activeSidebarItem', this.getAttribute('href'));
                    localStorage.removeItem('activeSubSidebarItem');
                });
            });

            subSidebarItems.forEach(function(item) {
                item.addEventListener('click', function(event) {
                    event.stopPropagation();
                    removeActiveClass();

                    this.parentElement.classList.add('active');
                    this.closest('.collapse').previousElementSibling.parentElement.classList.add('active');

                    localStorage.setItem('activeSubSidebarItem', this.getAttribute('href'));
                    localStorage.setItem('activeSidebarItem', this.closest('.collapse').previousElementSibling.getAttribute('href'));
                });
            });

            var activeItem = localStorage.getItem('activeSidebarItem');
            var activeSubItem = localStorage.getItem('activeSubSidebarItem');

            if (activeItem) {
                sidebarItems.forEach(function(item) {
                    if (item.getAttribute('href') === activeItem) {
                        item.parentElement.classList.add('active');
                    }
                });
            }

            if (activeSubItem) {
                subSidebarItems.forEach(function(item) {
                    if (item.getAttribute('href') === activeSubItem) {
                        item.parentElement.classList.add('active');
                        item.closest('.collapse').classList.add('show');
                        item.closest('.collapse').previousElementSibling.parentElement.classList.add('active');
                    }
                });
            }
        });
    </script>
</body>
</html>
<?php
    } else {
        echo "Data responden tidak ditemukan";
    }
} else {
    echo "Parameter responden_id atau role tidak ditemukan";
}
?>
