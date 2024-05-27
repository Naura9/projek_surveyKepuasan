<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../login/login.php");
    exit();
}

$username = $_SESSION['username'];
$role = $_SESSION['role'];
$nama = $_SESSION['nama'];

$query_user = "SELECT nama, role FROM m_user WHERE username = '$username'";

$result_user = mysqli_query($kon, $query_user);

if ($result_user) {
    $user_info = mysqli_fetch_assoc($result_user);

    $nama = $user_info['nama'];
    $role = $user_info['role'];
} else {
    $nama = "Nama Pengguna";
    $role = "Role";
}

$query_all_respondents = "
(
    SELECT DISTINCT m.nama, m.username, m.role, r.responden_mahasiswa_id AS responden_id, r.responden_tanggal
    FROM t_jawaban_mahasiswa j
    INNER JOIN t_responden_mahasiswa r ON j.responden_mahasiswa_id = r.responden_mahasiswa_id
    INNER JOIN m_survey s ON s.survey_id = r.survey_id
    INNER JOIN m_user m ON s.user_id = m.user_id
    )
    UNION
    (
    SELECT DISTINCT m.nama, m.username, m.role, r.responden_alumni_id AS responden_id, r.responden_tanggal
    FROM t_jawaban_alumni j
    INNER JOIN t_responden_alumni r ON j.responden_alumni_id = r.responden_alumni_id
    INNER JOIN m_survey s ON s.survey_id = r.survey_id
    INNER JOIN m_user m ON s.user_id = m.user_id
    )
    UNION
    (
    SELECT DISTINCT m.nama, m.username, m.role, r.responden_ortu_id AS responden_id, r.responden_tanggal
    FROM t_jawaban_ortu j
    INNER JOIN t_responden_ortu r ON j.responden_ortu_id = r.responden_ortu_id
    INNER JOIN m_survey s ON s.survey_id = r.survey_id
    INNER JOIN m_user m ON s.user_id = m.user_id
    )
    UNION
    (
    SELECT DISTINCT m.nama, m.username, m.role, r.responden_tendik_id AS responden_id, r.responden_tanggal
    FROM t_jawaban_tendik j
    INNER JOIN t_responden_tendik r ON j.responden_tendik_id = r.responden_tendik_id
    INNER JOIN m_survey s ON s.survey_id = r.survey_id
    INNER JOIN m_user m ON s.user_id = m.user_id
    )
    UNION
    (
    SELECT DISTINCT m.nama, m.username, m.role, r.responden_dosen_id AS responden_id, r.responden_tanggal
    FROM t_jawaban_dosen j
    INNER JOIN t_responden_dosen r ON j.responden_dosen_id = r.responden_dosen_id
    INNER JOIN m_survey s ON s.survey_id = r.survey_id
    INNER JOIN m_user m ON s.user_id = m.user_id
    )
    UNION
    (
    SELECT DISTINCT m.nama, m.username, m.role, r.responden_industri_id AS responden_id, r.responden_tanggal
    FROM t_jawaban_industri j
    INNER JOIN t_responden_industri r ON j.responden_industri_id = r.responden_industri_id
    INNER JOIN m_survey s ON s.survey_id = r.survey_id
    INNER JOIN m_user m ON s.user_id = m.user_id
    )
";

$result_all_respondents = mysqli_query($kon, $query_all_respondents);


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
        .content {
            height: 650px;
        }

        .table {
            width: 1020px;
            border-radius: 10px; 
            overflow: hidden;
            margin-bottom: 0;
            margin-right: 50px;
        }
            .table th {
            padding-top: 15px;
            padding-bottom: 15px; 
        }
    </style>
</head>
<body>
<?php include 'Header.php'; ?>
    <section>
        <div class="content">
        <h2 style="font-weight: bold;">Responden Survey</h2>
                <div style="margin-right: 50px;">
                <table class="table">
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th></th>
                        </tr>
                    </thead>
                    
                    <tbody>
                    <?php
                        while($row = mysqli_fetch_assoc($result_all_respondents)) {                
                        ?>
                        <tr>
                            <td><?php echo date('d-m-Y', strtotime($row['responden_tanggal'])); ?></td>
                            <td><?php echo $row['nama']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['role']; ?></td>
                            <td>
                                <?php 
                                    if ($row['role'] == 'mahasiswa') {
                                        $responden_id = $row['responden_id'];
                                    } elseif ($row['role'] == 'alumni') {
                                        $responden_id = $row['responden_id'];
                                    } elseif ($row['role'] == 'dosen') {
                                        $responden_id = $row['responden_id'];
                                    } elseif ($row['role'] == 'industri') {
                                        $responden_id = $row['responden_id'];
                                    } elseif ($row['role'] == 'ortu') {
                                        $responden_id = $row['responden_id'];
                                    } elseif ($row['role'] == 'tendik') {
                                        $responden_id = $row['responden_id'];
                                    } else {
                                        $responden_id = ''; 
                                    }
                                    echo "<a href=\"detail-responden.php?responden_id=$responden_id&role={$row['role']}&username={$row['username']}\" class=\"btn btn-light btn-outline-dark button-edit\">Detail</a>";
                                ?>
                            </td>

                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="kosong"></div>
    </section>


    
</body>
</html>
