<?php  
    include '../Koneksi.php';
    $db = new Koneksi();
    $kon = $db->getConnection();

    if (!isset($_SESSION['username'])) {
        header("Location: ../login/login.php");
        exit(); 
    }

    if(isset($_POST['simpan'])){
        $responden_nama    = $_POST['responden_nama'];
        $responden_nip     = $_POST['responden_nip'];
        $responden_prodi   = $_POST['responden_prodi'];
        $responden_email   = $_POST['responden_email'];
        $responden_hp      = $_POST['responden_hp'];
        $tahun_lulus       = $_POST['tahun_lulus'];
        $image             = $_POST['image'];
        
        $sql_responden = "UPDATE t_responden_alumni 
                        SET 
                            responden_nama = '$responden_nama',
                            responden_prodi = '$responden_prodi',
                            responden_email = '$responden_email',
                            responden_hp = '$responden_hp',
                            tahun_lulus = '$tahun_lulus',
                            image = '$image'
                        WHERE responden_nip = '$responden_nip'";

        $res_responden = mysqli_query($kon, $sql_responden);

        if($res_responden) {
            header("Location: profil.php");
            exit(); 
        } else {
            echo "Gagal melakukan update data: " . mysqli_error($kon);
        }
    }

    mysqli_close($kon);
?>