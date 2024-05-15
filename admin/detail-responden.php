<?php
// Masukkan file koneksi.php atau sesuaikan dengan cara Anda mengakses koneksi ke database
include '../koneksi.php';
session_start();

$nama = $_SESSION['nama'];

// Ambil ID responden dari parameter URL
if(isset($_GET['responden_id']) && isset($_GET['role']) && isset($_GET['username'])) {
    $responden_id = $_GET['responden_id'];
    $role = $_GET['role'];
    $username = $_GET['username'];

    // Sesuaikan query berdasarkan role responden
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

    // Eksekusi query
    $result_detail_responden = mysqli_query($kon, $query_detail_responden);

    // Periksa apakah query berhasil dieksekusi dan apakah data responden ditemukan
    if($result_detail_responden && mysqli_num_rows($result_detail_responden) > 0) {
        // Ambil data responden dari hasil query
        $detail_responden = mysqli_fetch_assoc($result_detail_responden);
?>
<!DOCTYPE html>
<html>
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
        /* CSS */
        .profile-img {
            width: 150px; /* Atur lebar gambar */
            height: 150px; /* Atur tinggi gambar */
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



        /* CSS untuk menyesuaikan tata letak radio button */
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
            border-right-color: black; /* Ubah warna garis vertikal menjadi merah */
            border-left-color: black; /* Ubah warna garis vertikal menjadi merah */
            width: 50%;
            height: 30px;
    }

        .btn-kembali {
            margin-bottom: 10px;
        }
        .kosong {
            height: 18px;
            background: #ececed;
        }
        .message {
            width: 5px;
            margin-left: 885px
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
            <li class="">
                <a href="dashboard-admin.php" class="">
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
                    <li><a href="soal-pendidikan.php"><i class="fa-solid fa-medal"></i> Kualitas Pendidikan</a></li>
                    <li><a href="soal-fasilitas.php"><i class="fa-solid fa-layer-group"></i>     Fasilitas</a></li>                    
                    <li><a href="soal-pelayanan.php"><i class="fa-solid fa-handshake"></i>  Pelayanan</a></li>
                    <li><a href="soal-lulusan.php"><i class="fa-solid fa-graduation-cap"></i>  Lulusan</a></li>
                </ul>
            </li>
            <li class="">
                <a href="responden-survey.php" class="">
                    <i class="fa-solid fa-user-group"></i>
                    Responden
                </a>
            </li>
            <li class="">
                <a href="laporan-survey.php" class="">
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
                    // Tampilkan informasi responden sesuai dengan peran
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
                            echo "<tr><td><strong>Umur</strong></td><td>{$detail_responden['responden_umut']}</td></tr>";
                            echo "<tr><td><strong>Nomor Telepon</strong></td><td>{$detail_responden['responden_hp']}</td></tr>";
                            echo "<tr><td><strong>Penghasilan</strong></td><td>{$detail_responden['responden_penghasilan']}</td></tr>";
                            echo "<tr><td><strong>NIM Mahasiswa</strong></td><td>{$detail_responden['mahasiswa_nim']}</td></tr>";
                            echo "<tr><td><strong>Nama Mahasiswa</strong></td><td>{$detail_responden['mahasiswa_nama']}</td></tr>";
                            echo "<tr><td><strong>Program Studi Mahasiswa</strong></td><td>{$detail_responden['mahasiswa_prodi']}</td></tr>";
                            echo "<tr><td><strong>Username</strong></td><td>{$username}</td></tr>";
                            break;
                        case 'tendik':
                            echo "<tr><td><strong>Nomor Pegawai</strong></td><td>{$detail_responden['responen_nopeg']}</td></tr>";
                            echo "<tr><td><strong>Nama Lengkap</strong></td><td>{$detail_responden['responden_nama']}</td></tr>";
                            echo "<tr><td><strong>Email</strong></td><td>{$detail_responden['email']}</td></tr>";
                            echo "<tr><td><strong>Unit</strong></td><td>{$detail_responden['uresponden_nit']}</td></tr>";
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
            <!-- Tombol kembali -->
            <tr>
            <td class="text-rigth" colspan="2">
                <a href="responden-survey.php" class="btn btn-light btn-kembali">Kembali</a>
            </td>
        </tr>
        </div>
    </section>
</body>
</html>
<?php
    } else {
        // Tampilkan pesan jika data responden tidak ditemukan
        echo "Data responden tidak ditemukan";
    }
} else {
    // Tampilkan pesan jika parameter responden_id atau role tidak ditemukan
    echo "Parameter responden_id atau role tidak ditemukan";
}
?>
