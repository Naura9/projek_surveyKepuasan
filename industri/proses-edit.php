<?php  
include '../koneksi.php';

if(isset($_POST['simpan'])){
    // Ambil data dari form
$responden_nama      = $_POST['responden_nama'];
$responden_jabatan   = $_POST['responden_jabatan'];
$responden_perusahaan = $_POST['responden_perusahaan'];
$responden_email     = $_POST['responden_email'];
$responden_hp        = $_POST['responden_hp'];
$responden_kota      = $_POST['responden_kota'];

// Perbarui data berdasarkan nama responden
// Buat query untuk memperbarui data responden
$sql_responden = "UPDATE t_responden_industri
                  SET 
                    responden_jabatan = '$responden_jabatan',
                    responden_perusahaan = '$responden_perusahaan',
                    responden_email = '$responden_email',
                    responden_hp = '$responden_hp',
                    responden_kota = '$responden_kota'
                  WHERE responden_nama = '$responden_nama'";


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


