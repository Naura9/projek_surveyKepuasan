<?php  
include '../koneksi.php';

if(isset($_POST['simpan'])){
    // Ambil data dari form
    $responden_nim     = $_POST['responden_nim'];
    $responden_nama    = $_POST['responden_nama'];
    $username          = $_POST['username'];
    $password          = $_POST['password'];
    $responden_email   = $_POST['responden_email'];
    $responden_prodi   = $_POST['responden_prodi'];
    $responden_hp      = $_POST['responden_hp'];
    $tahun_masuk       = $_POST['tahun_masuk'];

    // Perbarui data berdasarkan NIM
    $sql = "UPDATE t_responden_mahasiswa rm
            JOIN m_survey s ON s.survey_id = rm.survey_id
            JOIN m_user u ON u.user_id = s.user_id
            SET 
                rm.responden_nama = '$responden_nama',
                u.username = '$username',
                u.password = '$password',
                rm.responden_email = '$responden_email',
                rm.responden_prodi = '$responden_prodi',
                rm.responden_hp = '$responden_hp',
                rm.tahun_masuk = '$tahun_masuk'
                WHERE responden_nim = '$responden_nim'";

    $res = mysqli_query($kon, $sql);
    
    if($res == 1) {
        // Jika penyimpanan berhasil, arahkan kembali ke halaman profil
        header("Location: profil-user.php");
        exit(); // Pastikan tidak ada kode yang dieksekusi setelah header
    } else {
        // Jika gagal, tampilkan pesan error
        echo "Gagal melakukan update data: " . mysqli_error($kon);
    }
}

?>
