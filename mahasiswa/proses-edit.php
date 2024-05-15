<?php  
include '../koneksi.php';

if(isset($_POST['simpan'])){
    // Ambil data dari form
    $responden_nim     = $_POST['responden_nim'];
    $responden_nama    = $_POST['responden_nama'];
    $username          = $_POST['username'];
    $responden_email   = $_POST['responden_email'];
    $responden_prodi   = $_POST['responden_prodi'];
    $responden_hp      = $_POST['responden_hp'];
    $tahun_masuk       = $_POST['tahun_masuk'];

    // Perbarui data berdasarkan NIM
    // Buat query untuk memperbarui data responden
    $sql_responden = "UPDATE t_responden_mahasiswa 
                      SET 
                        responden_nama = '$responden_nama',
                        responden_email = '$responden_email',
                        responden_prodi = '$responden_prodi',
                        responden_hp = '$responden_hp',
                        tahun_masuk = '$tahun_masuk'
                      WHERE responden_nim = '$responden_nim'";

    // Jalankan query untuk memperbarui data responden
    $res_responden = mysqli_query($kon, $sql_responden);

    // Jika pengguna memasukkan password baru, update password
    if (!empty($_POST['password'])) {
        $password = $_POST['password'];
        // Hash password baru
        $password_hashed = md5($password);
        
        // Buat query untuk memperbarui password pada tabel pengguna
        $sql_password = "UPDATE m_user 
                         SET password = '$password_hashed'
                         WHERE username = '$username'";

        // Jalankan query untuk memperbarui password
        $res_password = mysqli_query($kon, $sql_password);
        
        // Periksa apakah perbaruan password berhasil
        if (!$res_password) {
            // Jika gagal, tampilkan pesan error
            echo "Gagal memperbarui password: " . mysqli_error($kon);
            exit(); // Keluar dari skrip untuk mencegah eksekusi kode lebih lanjut
        }
    }

    // Periksa apakah kedua perubahan berhasil
    if($res_responden && ($res_password || empty($_POST['password']))) {
        // Jika penyimpanan berhasil, arahkan kembali ke halaman profil
        header("Location: profil.php");
        exit(); // Pastikan tidak ada kode yang dieksekusi setelah header
    } else {
        // Jika salah satu perubahan gagal, tampilkan pesan error
        echo "Gagal melakukan update data: " . mysqli_error($kon);
    }
}

?>


