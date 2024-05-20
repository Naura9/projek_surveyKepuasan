<?php  
include '../koneksi.php';

if(isset($_POST['simpan'])){
    $responden_nopeg     = $_POST['responden_nopeg'];
    $responden_nama    = $_POST['responden_nama'];
    $username          = $_POST['username'];
    $email             = $_POST['email'];
    $responden_unit   = $_POST['responden_unit'];

    $sql_responden = "UPDATE t_responden_tendik 
                      SET 
                        responden_nama = '$responden_nama',
                        email = '$email',
                        responden_unit = '$responden_unit'
                      WHERE responden_nopeg = '$responden_nopeg'";

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

?>