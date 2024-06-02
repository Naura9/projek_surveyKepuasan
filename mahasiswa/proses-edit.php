<?php  
    session_start();
    include '../Koneksi.php';
    $db = new Koneksi();
    $kon = $db->getConnection();

    if (!isset($_SESSION['user_id'])) {
        header("Location: ../login/login.php");
        exit(); 
    }

    if(isset($_POST['simpan'])){
        $user_id = $_SESSION['user_id'];

        $username          = $_POST['username'];
        $responden_nim     = $_POST['responden_nim'];
        $responden_nama    = $_POST['responden_nama'];
        $responden_email   = $_POST['responden_email'];
        $responden_prodi   = $_POST['responden_prodi'];
        $responden_hp      = $_POST['responden_hp'];
        $tahun_masuk       = $_POST['tahun_masuk'];

        $sql_responden = "UPDATE t_responden_mahasiswa t
                        JOIN m_survey s ON s.survey_id = t.survey_id
                        JOIN m_user u ON u.user_id = s.user_id
                        SET 
                            t.responden_nama = '$responden_nama',
                            t.responden_email = '$responden_email',
                            t.responden_prodi = '$responden_prodi',
                            t.responden_hp = '$responden_hp',
                            t.tahun_masuk = '$tahun_masuk'
                        WHERE u.user_id = '$user_id'";

        $sql_user = "UPDATE m_user SET nama = '$responden_nama' WHERE m_user.user_id = '$user_id'"; 
        mysqli_query($kon, $sql_user);

        $sql_username = "UPDATE m_user SET username = '$username' WHERE m_user.user_id = '$user_id'"; 
        mysqli_query($kon, $sql_username);

        if (!empty($_POST['password'])) {
            $password = $_POST['password'];
            $password_hashed = md5($password);
            
            $sql_password = "UPDATE m_user 
                            SET password = '$password_hashed'
                            WHERE user_id = '$user_id'";

            $res_password = mysqli_query($kon, $sql_password);

            if (!$res_password) {
                echo "Gagal memperbarui password: " . mysqli_error($kon);
                exit(); 
            }
        }

        $res_responden = mysqli_query($kon, $sql_responden);

    if($res_responden) {
            $new_nama = $responden_nama;
            setcookie("nama", $new_nama, time() + 3600, '/');
            header("Location: profil.php");
            exit(); 
        } else {
            echo "Gagal melakukan update data: " . mysqli_error($kon);
        }
    }
?>