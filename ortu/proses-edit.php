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
        $responden_nama    = $_POST['responden_nama'];
        $responden_email   = $_POST['email'];
        $responden_jk      = $_POST['responden_jk'];
        $responden_umur    = $_POST['responden_umur'];
        $responden_hp      = $_POST['responden_hp'];
        $responden_pendidikan = $_POST['responden_pendidikan'];
        $responden_penghasilan = $_POST['responden_penghasilan'];
        $mahasiswa_nim     = $_POST['mahasiswa_nim'];
        $mahasiswa_nama    = $_POST['mahasiswa_nama'];
        $mahasiswa_prodi   = $_POST['mahasiswa_prodi'];
        
        $sql_responden = "UPDATE t_responden_ortu t
                        JOIN m_survey s ON s.survey_id = t.survey_id
                        JOIN m_user u ON u.user_id = s.user_id
                        SET 
                            t.responden_nama = '$responden_nama',
                            t.email = '$responden_email',
                            t.responden_jk = '$responden_jk',
                            t.responden_umur = '$responden_umur',
                            t.responden_hp = '$responden_hp',
                            t.responden_pendidikan = '$responden_pendidikan',
                            t.responden_penghasilan = '$responden_penghasilan',
                            t.mahasiswa_nim = '$mahasiswa_nim',
                            t.mahasiswa_nama = '$mahasiswa_nama',
                            t.mahasiswa_prodi = '$mahasiswa_prodi'
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
