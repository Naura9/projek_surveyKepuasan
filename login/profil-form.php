<?php
session_start();
include '../Koneksi.php';

$db = new Koneksi();
$kon = $db->getConnection();

$roleOptions = array();
$enumQuery = "SHOW COLUMNS FROM m_registrasi LIKE 'role'";
$result = mysqli_query($kon, $enumQuery);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $type = $row['Type'];
    preg_match('/^enum\((.*)\)$/', $type, $matches);
    foreach (explode(',', $matches[1]) as $value) {
        $roleOptions[] = trim($value, "'");
    }
}

if (isset($_POST['choose_role'])) {
    $_SESSION['role'] = $_POST['role'];
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}

if (isset($_POST['submit_mahasiswa']) && $_SESSION['role'] === 'Mahasiswa') {
    $_SESSION['responden_nama'] = $_POST['responden_nama'];

    $survey_id = NULL;
    $responden_tanggal = NULL; 
    $responden_nim = mysqli_real_escape_string($kon, $_POST['responden_nim']);
    $responden_nama = mysqli_real_escape_string($kon, $_POST['responden_nama']);
    $responden_prodi = mysqli_real_escape_string($kon, $_POST['responden_prodi']);
    $responden_email = mysqli_real_escape_string($kon, $_POST['responden_email']);
    $responden_hp = mysqli_real_escape_string($kon, $_POST['responden_hp']);
    $tahun_masuk = mysqli_real_escape_string($kon, $_POST['tahun_masuk']);
    $image_path = "noprofil.jpg";

    $query = "INSERT INTO t_responden_mahasiswa (survey_id, responden_tanggal, responden_nim, responden_nama, responden_prodi, responden_email, responden_hp, tahun_masuk, image)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($kon, $query);
    mysqli_stmt_bind_param($stmt, 'issssssss', $survey_id, $responden_tanggal, $responden_nim, $responden_nama, $responden_prodi, $responden_email, $responden_hp, $tahun_masuk, $image_path);
    if (mysqli_stmt_execute($stmt)) {
        header("refresh:2;url=register-form.php");
        exit;
    } else {
        echo "Error saving data: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
}

if (isset($_POST['submit_dosen']) && $_SESSION['role'] === 'Dosen') {
    $_SESSION['responden_nama'] = $_POST['responden_nama'];

    $survey_id = NULL;
    $responden_tanggal = NULL; 
    $responden_nip = mysqli_real_escape_string($kon, $_POST['responden_nip']);
    $responden_nama = mysqli_real_escape_string($kon, $_POST['responden_nama']);
    $email = mysqli_real_escape_string($kon, $_POST['email']);
    $responden_unit = mysqli_real_escape_string($kon, $_POST['responden_unit']);
    $image_path = "noprofil.jpg";

    $query = "INSERT INTO t_responden_dosen (survey_id, responden_tanggal, responden_nip, responden_nama, email, responden_unit, image)
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($kon, $query);
    mysqli_stmt_bind_param($stmt, 'issssss', $survey_id, $responden_tanggal, $responden_nip, $responden_nama, $email, $responden_unit, $image_path);
    if (mysqli_stmt_execute($stmt)) {
        header("refresh:2;url=register-form.php"); 
        exit;
    } else {
        echo "Error saving data: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
}

if (isset($_POST['submit_alumni']) && $_SESSION['role'] === 'Alumni') {
    $_SESSION['responden_nama'] = $_POST['responden_nama'];

    $survey_id = NULL;
    $responden_tanggal = NULL;
    $responden_nip = mysqli_real_escape_string($kon, $_POST['responden_nip']);
    $responden_nama = mysqli_real_escape_string($kon, $_POST['responden_nama']);
    $responden_prodi = mysqli_real_escape_string($kon, $_POST['responden_prodi']);
    $responden_email = mysqli_real_escape_string($kon, $_POST['responden_email']);
    $responden_hp = mysqli_real_escape_string($kon, $_POST['responden_hp']);
    $tahun_lulus = mysqli_real_escape_string($kon, $_POST['tahun_lulus']);
    $image_path = "noprofil.jpg";

    $query = "INSERT INTO t_responden_alumni (survey_id, responden_tanggal, responden_nip, responden_nama, responden_prodi, responden_email, responden_hp, tahun_lulus, image)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($kon, $query);
    mysqli_stmt_bind_param($stmt, 'issssssis', $survey_id, $responden_tanggal, $responden_nip, $responden_nama, $responden_prodi, $responden_email, $responden_hp, $tahun_lulus, $image_path);
    if (mysqli_stmt_execute($stmt)) {
        header("refresh:2;url=register-form.php"); 
        exit;
    } else {
        echo "Error saving data: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
}

if (isset($_POST['submit_tendik']) && $_SESSION['role'] === 'Tendik') {
    $_SESSION['responden_nama'] = $_POST['responden_nama'];

    $survey_id = NULL;
    $responden_tanggal = NULL; 
    $responden_nopeg = mysqli_real_escape_string($kon, $_POST['responden_nopeg']);
    $responden_nama = mysqli_real_escape_string($kon, $_POST['responden_nama']);
    $email = mysqli_real_escape_string($kon, $_POST['email']);
    $responden_unit = mysqli_real_escape_string($kon, $_POST['responden_unit']);
    $image_path = "noprofil.jpg";

    $query = "INSERT INTO t_responden_tendik (survey_id, responden_tanggal, responden_nopeg, responden_nama, email, responden_unit, image)
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($kon, $query);
    mysqli_stmt_bind_param($stmt, 'issssss', $survey_id, $responden_tanggal, $responden_nopeg, $responden_nama, $email, $responden_unit, $image_path);
    if (mysqli_stmt_execute($stmt)) {
        header("refresh:2;url=register-form.php"); 
        exit;
    } else {
        echo "Error saving data: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
}

if (isset($_POST['submit_ortu']) && $_SESSION['role'] === 'Ortu') {
    $_SESSION['responden_nama'] = $_POST['responden_nama'];

    $survey_id = NULL;
    $responden_tanggal = NULL;
    $responden_nama = mysqli_real_escape_string($kon, $_POST['responden_nama']);
    $email = mysqli_real_escape_string($kon, $_POST['email']);
    $responden_jk = mysqli_real_escape_string($kon, $_POST['responden_jk']);
    $responden_umur = mysqli_real_escape_string($kon, $_POST['responden_umur']);
    $responden_hp = mysqli_real_escape_string($kon, $_POST['responden_hp']);
    $responden_pendidikan = mysqli_real_escape_string($kon, $_POST['responden_pendidikan']);
    $responden_penghasilan = mysqli_real_escape_string($kon, $_POST['responden_penghasilan']);
    $mahasiswa_nim = mysqli_real_escape_string($kon, $_POST['mahasiswa_nim']);
    $mahasiswa_nama = mysqli_real_escape_string($kon, $_POST['mahasiswa_nama']);
    $mahasiswa_prodi = mysqli_real_escape_string($kon, $_POST['mahasiswa_prodi']);
    $image_path = "noprofil.jpg";

    $query = "INSERT INTO t_responden_ortu (survey_id, responden_tanggal, responden_nama, email, responden_jk, responden_umur, responden_hp, responden_pendidikan, responden_penghasilan, mahasiswa_nim, mahasiswa_nama, mahasiswa_prodi, image) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($kon, $query);
    mysqli_stmt_bind_param($stmt, 'issssisssssss', $survey_id, $responden_tanggal, $responden_nama, $email, $responden_jk, $responden_umur, $responden_hp, $responden_pendidikan, $responden_penghasilan, $mahasiswa_nim, $mahasiswa_nama, $mahasiswa_prodi, $image_path);
    if (mysqli_stmt_execute($stmt)) {
        header("refresh:2;url=register-form.php"); 
        exit;
    } else {
        echo "Error saving data: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
}

if (isset($_POST['submit_industri']) && $_SESSION['role'] === 'Industri') {
    $_SESSION['responden_nama'] = $_POST['responden_nama'];

    $survey_id = NULL;
    $responden_tanggal = NULL; 
    $responden_nama = mysqli_real_escape_string($kon, $_POST['responden_nama']);
    $responden_jabatan = mysqli_real_escape_string($kon, $_POST['responden_jabatan']);
    $responden_perusahaan = mysqli_real_escape_string($kon, $_POST['responden_perusahaan']);
    $responden_email = mysqli_real_escape_string($kon, $_POST['responden_email']);
    $responden_hp = mysqli_real_escape_string($kon, $_POST['responden_hp']);
    $responden_kota = mysqli_real_escape_string($kon, $_POST['responden_kota']);
    $image_path = "noprofil.jpg";

    $query = "INSERT INTO t_responden_industri (survey_id, responden_tanggal, responden_nama, responden_jabatan, responden_perusahaan, responden_email, responden_hp, responden_kota, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($kon, $query);
    mysqli_stmt_bind_param($stmt, 'issssssss', $survey_id, $responden_tanggal, $responden_nama, $responden_jabatan, $responden_perusahaan, $responden_email, $responden_hp, $responden_kota, $image_path);
    if (mysqli_stmt_execute($stmt)) {
        header("refresh:2;url=register-form.php"); 
        exit;
    } else {
        echo "Error saving data: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="login.css">

    <title>Profil Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .reg-container {
            max-width: 433px;
            font-size: 15px;

        }

        .form-group {
            width: 430px;
            margin-top: 20px;
            margin-left: 1px;
            padding: 0px;
        }
        

        h3 {
            margin-top: 0;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
        }

        .input-group input[type="text"],
        .input-group input[type="email"],
        .input-group select,
        .input-group input[type="number"],
        .input-group input[type="date"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 20px;
            background-color: #ececed;
        }

        .input-group input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .input-group input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error-message {
            color: red;
        }

        .success-message {
            color: green;
        }

        .btn-lanjut {
            width: 430px;
            height: 38px;
            background-color: #2d1b6b;
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 15px;
            margin-top: 7px;

        }


    </style>
</head>
<body>
    <div class="reg-container">
    <div class="img">
        <img src="../img/logo.png" alt="Polinema Logo">
    </div>
        <h2>Register Akun</h2>
        <h4>Kami akan mengirimkan permintaan register akun. Silahkan pilih role dan masukkan data diri Anda.</h4>

    <div class="form-group">

            <form action="" method="post">
                <h3>Role</h3>
                <div class="input-group">
                    <select name="role" required onchange="this.form.submit()">
                        <option value="">Select Role...</option>
                        <?php foreach ($roleOptions as $option): ?>
                            <option value="<?php echo htmlspecialchars($option); ?>" <?php echo (isset($_SESSION['role']) && $_SESSION['role'] === $option) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($option); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <input type="hidden" name="choose_role" value="1">
                <hr>

            </form>

            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'Mahasiswa'): ?>
                <form action="" method="post">
                    <div class="input-group">
                        <label for="responden_nim">NIM</label>
                        <input type="text" name="responden_nim" required placeholder="Masukkan NIM Anda">

                        <label for="responden_nama">Nama</label>
                        <input type="text" name="responden_nama" required placeholder="Masukkan Nama Anda">

                        <label for="responden_prodi">Program Studi</label>
                        <input type="text" name="responden_prodi" required placeholder="Masukkan Program Studi Anda">
                        
                        <label for="responden_email">Email</label>
                        <input type="email" name="responden_email" required placeholder="Masukkan Email Anda">

                        <label for="responden_hp">Nomor Telepon</label>
                        <input type="text" name="responden_hp" required placeholder="Masukkan Nomor Telepon Anda">

                        <label for="tahun_masuk">Tahun Masuk</label>
                        <input type="text" name="tahun_masuk" required placeholder="Masukkan Tahun Masuk Anda">
                    </div>
                    <input type="submit" name="submit_mahasiswa" value="Lanjut" class="btn-lanjut">
                </form>
            <?php endif; ?>

            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'Dosen'): ?>
                <form action="" method="post">
                    <div class="input-group">
                        <label for="responden_nip">NIP</label>
                        <input type="text" name="responden_nip" required placeholder="Masukkan NIP Anda">

                        <label for="responden_nama">Nama</label>
                        <input type="text" name="responden_nama" required placeholder="Masukkan Nama Anda">

                        <label for="email">Email</label>
                        <input type="email" name="email" required placeholder="Masukkan Email Anda">

                        <label for="responden_unit">Unit</label>
                        <input type="text" name="responden_unit" required placeholder="Masukkan Unit Anda">
                    </div>
                    <input type="submit" name="submit_dosen" value="Lanjut" class="btn-lanjut">
                </form>
            <?php endif; ?>

            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'Alumni'): ?>
                <form action="" method="post">
                    <div class="input-group">
                        <label for="responden_nip">NIP</label>
                        <input type="text" name="responden_nip" required placeholder="Masukkan NIP Anda">
                        
                        <label for="responden_nama">Nama</label>
                        <input type="text" name="responden_nama" required placeholder="Masukkan Nama Anda">

                        <label for="responden_prodi">Program Studi</label>
                        <input type="text" name="responden_prodi" required placeholder="Masukkan Program Studi Anda">
                        
                        <label for="responden_email">Email</label>
                        <input type="email" name="responden_email" required placeholder="Masukkan Email Anda">

                        <label for="responden_hp">Nomor Telepon</label>
                        <input type="text" name="responden_hp" required placeholder="Masukkan Nomor Telepon Anda">

                        <label for="tahun_lulus">Tahun Lulus</label>
                        <input type="text" name="tahun_lulus" required placeholder="Masukkan Tahun Lulus Anda">
                    </div>
                    <input type="submit" name="submit_alumni" value="Lanjut" class="btn-lanjut">
                </form>
            <?php endif; ?>

            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'Tendik'): ?>
                <form action="" method="post">
                    <div class="input-group">
                        <label for="responden_nopeg">Nomor Pegawai</label>
                        <input type="text" name="responden_nopeg" required placeholder="Masukkan Nomor Pegawai Anda">

                        <label for="responden_nama">Nama</label>
                        <input type="text" name="responden_nama" required placeholder="Masukkan Nama Anda">

                        <label for="email">Email</label>
                        <input type="email" name="email" required placeholder="Masukkan Email Anda">

                        <label for="responden_unit">Unit</label>
                        <input type="text" name="responden_unit" required placeholder="Masukkan Unit Anda">
                    </div>
                    <input type="submit" name="submit_tendik" value="Lanjut" class="btn-lanjut">
                </form>
            <?php endif; ?>
            
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'Ortu'): ?>
        <form action="" method="post">
            <div class="input-group">
                <label for="responden_nama">Nama</label>
                <input type="text" id="responden_nama" name="responden_nama" placeholder="Masukkan Nama Anda" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Masukkan Email Anda" required>

                <label for="responden_jk">Jenis Kelamin</label>
                <select id="responden_jk" name="responden_jk" required>
                    <option value="">Pilih Jenis Kelamin...</option>
                    <option value="L">Laki-Laki (Male)</option>
                    <option value="P">Perempuan (Female)</option>
                </select>

                <label for="responden_umur">Umur</label>
                <input type="number" id="responden_umur" name="responden_umur" placeholder="Masukkan Umur Anda" required>

                <label for="responden_hp">Nomor Telepon</label>
                <input type="text" id="responden_hp" name="responden_hp" placeholder="Masukkan Nomor Telepon Anda" required>

                <label for="responden_pendidikan">Pendidikan Terakhir</label>
                <input type="text" id="responden_pendidikan" name="responden_pendidikan" placeholder="Masukkan Pendidikan Terakhir Anda" required>

                <label for="responden_penghasilan">Penghasilan</label>
                <input type="text" id="responden_penghasilan" name="responden_penghasilan" placeholder="Masukkan Penghasilan Anda" required>

                <label for="mahasiswa_nim">NIM Mahasiswa</label>
                <input type="text" id="mahasiswa_nim" name="mahasiswa_nim" placeholder="Masukkan NIM Mahasiswa" required>

                <label for="mahasiswa_nama">Nama Mahasiswa</label>
                <input type="text" id="mahasiswa_nama" name="mahasiswa_nama" placeholder="Masukkan Nama Mahasiswa" required>

                <label for="mahasiswa_prodi">Program Studi Mahasiswa</label>
                <input type="text" id="mahasiswa_prodi" name="mahasiswa_prodi" placeholder="Masukkan Program Studi Mahasiswa" required>
            </div>
            <input type="submit" name="submit_ortu" value="Lanjut" class="btn-lanjut">
        </form>
    <?php endif; ?>

    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'Industri'): ?>
        <form action="" method="post">
            <div class="input-group">
                <label for="responden_nama">Nama</label>
                <input type="text" id="responden_nama" name="responden_nama" placeholder="Masukkan Nama Anda" required>

                <label for="responden_jabatan">Jabatan</label>
                <input type="text" id="responden_jabatan" name="responden_jabatan" placeholder="Masukkan Jabatan Anda">

                <label for="responden_perusahaan">Perusahaan</label>
                <input type="text" id="responden_perusahaan" name="responden_perusahaan" placeholder="Masukkan Perusahaan Anda">

                <label for="responden_email">Email</label>
                <input type="email" id="responden_email" name="responden_email" placeholder="Masukkan Email Anda" required>

                <label for="responden_hp">Nomor Telepon</label>
                <input type="text" id="responden_hp" name="responden_hp" placeholder="Masukkan Nomor Telepon Anda">

                <label for="responden_kota">Kota</label>
                <input type="text" id="responden_kota" name="responden_kota" placeholder="Masukkan Kota Anda">
            </div>
            <input type="submit" name="submit_industri" value="Lanjut" class="btn-lanjut">
        </form>
    <?php endif; ?>


    </div>
</body>
</html>
