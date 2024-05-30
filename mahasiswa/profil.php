<?php
    session_start();

    include '../Koneksi.php';
    $db = new Koneksi();
    $kon = $db->getConnection();

    if (!isset($_SESSION['username'])) {
        header("Location: ../login/login.php");
        exit(); 
    }

    $username = $_SESSION['username'];
    $role = $_SESSION['role'];
    $nama = $_SESSION['nama'];

    $query_get_profil_image = "SELECT image FROM t_responden_mahasiswa WHERE responden_nama = '$nama'";
    $result_get_profil_image = mysqli_query($kon, $query_get_profil_image);
    $row_get_profil_image = mysqli_fetch_assoc($result_get_profil_image);
    $profil_image = $row_get_profil_image['image'];

    $query_profil = "SELECT * FROM t_responden_mahasiswa 
    JOIN m_survey ON m_survey.survey_id = t_responden_mahasiswa.survey_id
    JOIN m_user ON m_user.user_id = m_survey.user_id
    WHERE responden_nama = '$nama'
    ";
    $result_profil = mysqli_query($kon, $query_profil);

    if(mysqli_num_rows($result_profil) > 0) {
        while($mhs = mysqli_fetch_array($result_profil)){
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/96cfbc074b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../header.css">
    <style>
        h2 {
            font-weight: bold;
        }

        .form-profile {
            margin-top: 20px;
            margin-bottom: 20px;
            margin-right: 100px;
            background-color: white; 
            padding: 10px; 
            width : 1050px;
            border-radius: 10px;
        }

        .username img {
            margin-left: 795px;
        }

        .card-body {
            background-color: #ececed;
        }

        .bg-custom {
            background-color: #ececed;
        }

        .profile-image {
            width: 150px; 
            height: 150px;
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
            margin-left: 1000px; 
            background-color: #2d1b6b;
            color: white;
            border: none;
        }

        .profile-label {
            width: 30%;
            font-weight: bold;
            margin-bottom: 5px; 
            margin-left: 10px;
        }

        .profile-value {
            width: 65%;
            background-color: #ececed;
            border: 1px solid #ced4da;
            padding: 5px 10px;
            border-radius: 5px;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php include '../header.php'; ?>
        <section>
            <div class="content">
                <h2>Profil</h2>
                <div class="form-profile">
                    <tr>
                        <div class="profile-label">Foto Profil</div>
                        <img src="img/<?php echo $mhs['image']; ?>" alt="Foto Profil" class="profile-image">
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
                        <div class="profile-value">*********</div>                
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
                <div class="button-container">
                    <a href="edit-profil.php?username=<?php echo $username; ?>" class="btn btn-light btn-outline-dark button-edit">Edit</a>
                </div>
            </div>
        </section>
    </div>
</body>
</html>

<?php
        }
    } else {
        echo "Data profil tidak ditemukan.";
    }
    mysqli_close($kon);
?>
