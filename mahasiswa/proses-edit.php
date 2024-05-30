<?php  
    include '../Koneksi.php';
    $db = new Koneksi();
    $kon = $db->getConnection();

    if(isset($_POST['simpan'])){
        $responden_nim     = $_POST['responden_nim'];
        $responden_nama    = $_POST['responden_nama'];
        $username          = $_POST['username'];
        $responden_email   = $_POST['responden_email'];
        $responden_prodi   = $_POST['responden_prodi'];
        $responden_hp      = $_POST['responden_hp'];
        $tahun_masuk       = $_POST['tahun_masuk'];

        $sql_responden = "UPDATE t_responden_mahasiswa 
                        SET 
                            responden_nama = '$responden_nama',
                            responden_email = '$responden_email',
                            responden_prodi = '$responden_prodi',
                            responden_hp = '$responden_hp',
                            tahun_masuk = '$tahun_masuk'
                        WHERE responden_nim = '$responden_nim'";

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