<?php  
include '../Koneksi.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../login/login.php");
    exit(); 
}

if(isset($_POST['simpan'])){
    $responden_nama    = $_POST['responden_nama'];
    $username          = $_POST['username'];
    $responden_email   = $_POST['email'];
    $responden_jk      = $_POST['responden_jk'];
    $responden_umur    = $_POST['responden_umur'];
    $responden_hp      = $_POST['responden_hp'];
    $responden_pendidikan = $_POST['responden_pendidikan'];
    $responden_penghasilan = $_POST['responden_penghasilan'];
    $mahasiswa_nim     = $_POST['mahasiswa_nim'];
    $mahasiswa_nama    = $_POST['mahasiswa_nama'];
    $mahasiswa_prodi   = $_POST['mahasiswa_prodi'];
    
    $sql_responden = "UPDATE t_responden_ortu 
                      SET 
                        responden_nama = '$responden_nama',
                        email = '$responden_email',
                        responden_jk = '$responden_jk',
                        responden_umur = '$responden_umur',
                        responden_hp = '$responden_hp',
                        responden_pendidikan = '$responden_pendidikan',
                        responden_penghasilan = '$responden_penghasilan',
                        mahasiswa_nim = '$mahasiswa_nim',
                        mahasiswa_nama = '$mahasiswa_nama',
                        mahasiswa_prodi = '$mahasiswa_prodi'
                      WHERE username = '$username'";

    $res_responden = mysqli_query($kon, $sql_responden);

    if (!empty($_POST['password'])) {
        $password = $_POST['password'];
        $password_hashed = md5($password);

        $sql_password = "UPDATE m_user 
                         SET password = '$password_hashed'
                         WHERE username = '$username'";

        $res_password = mysqli_query($kon, $sql_password);

        if (!$res_password) {
            echo "Gagal memperbarui password: " . mysqli_error($kon);
            exit(); 
        }
    }

    if($res_responden && ($res_password || empty($_POST['password']))) {
        header("Location: profil.php");
        exit(); 
    } else {
        echo "Gagal melakukan update data: " . mysqli_error($kon);
    }
}

mysqli_close($kon);
?>