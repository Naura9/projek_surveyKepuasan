<?php  
    include '../Koneksi.php';
    $db = new Koneksi();
    $kon = $db->getConnection();


    if(isset($_POST['simpan'])){
    $responden_nama      = $_POST['responden_nama'];
    $responden_jabatan   = $_POST['responden_jabatan'];
    $responden_perusahaan = $_POST['responden_perusahaan'];
    $responden_email     = $_POST['responden_email'];
    $responden_hp        = $_POST['responden_hp'];
    $responden_kota      = $_POST['responden_kota'];

    $sql_responden = "UPDATE t_responden_industri
                    SET 
                        responden_jabatan = '$responden_jabatan',
                        responden_perusahaan = '$responden_perusahaan',
                        responden_email = '$responden_email',
                        responden_hp = '$responden_hp',
                        responden_kota = '$responden_kota'
                    WHERE responden_nama = '$responden_nama'";

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


