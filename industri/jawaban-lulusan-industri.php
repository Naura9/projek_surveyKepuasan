<?php
include '../koneksi.php'; // Menghubungkan ke file koneksi.php
session_start(); // Mulai sesi

// Periksa apakah tombol 'Simpan' diklik
if(isset($_POST['simpan'])) {
    // Ambil informasi responden saat login
    $username = $_SESSION['username']; // Ambil username dari sesi, sesuaikan dengan mekanisme login Anda
    $nama = $_SESSION['nama']; // Ambil nama dari sesi, sesuaikan dengan mekanisme login Anda
    // Lakukan query untuk mendapatkan informasi responden dengan nama yang sesuai
    $query_responden = "SELECT responden_industri_id FROM t_responden_industri WHERE responden_nama = '$nama'";
    $result_responden = mysqli_query($kon, $query_responden);
    if(mysqli_num_rows($result_responden) > 0) {
        $data_responden = mysqli_fetch_assoc($result_responden);
        $responden_industri_id = $data_responden['responden_industri_id'];
    } else {
        // Jika tidak ada data responden yang sesuai, lakukan penanganan yang sesuai.
        echo "Data responden tidak ditemukan.";
        exit; // Hentikan proses lebih lanjut
    }

    // Ambil daftar soal_id
    $query_soal_id = "SELECT m_survey_soal.soal_id
                      FROM m_survey_soal
                      JOIN m_survey ON m_survey_soal.survey_id = m_survey.survey_id
                      JOIN m_kategori ON m_survey_soal.kategori_id = m_kategori.kategori_id
                      JOIN m_user ON m_survey.user_id = m_user.user_id
                      WHERE m_kategori.kategori_id = 4
                      AND m_user.role = 'industri'";
    $result_soal_id = mysqli_query($kon, $query_soal_id);

    // Loop melalui setiap soal_id untuk menyimpan jawaban
    while ($row = mysqli_fetch_assoc($result_soal_id)) {
        $soal_id = $row['soal_id'];
        $jawaban = mysqli_real_escape_string($kon, $_POST['jawaban_' . $soal_id]);

        // Siapkan kueri SQL untuk menyimpan jawaban ke database
        $query_insert_jawaban = "INSERT INTO t_jawaban_industri (responden_industri_id, soal_id, jawaban) 
                                 VALUES ('$responden_industri_id', '$soal_id', '$jawaban')";
        
        // Lakukan eksekusi kueri SQL
        $result = mysqli_query($kon, $query_insert_jawaban);
        
        
        // Periksa apakah eksekusi kueri berhasil
        if (!$result) {
            // Jika gagal, tampilkan pesan kesalahan
            echo "Gagal menyimpan jawaban untuk soal $soal_id: " . mysqli_error($kon);
        }
    }
    $query_update_tanggal = "UPDATE t_responden_industri SET responden_tanggal = CURDATE() WHERE responden_industri_id = '$responden_industri_id'";
    $result_update_tanggal = mysqli_query($kon, $query_update_tanggal);

    $query_update_tanggal_survey = "UPDATE m_survey SET survey_tanggal = CURDATE() WHERE survey_id = '$survey_id'";
    $result_update_tanggal_survey = mysqli_query($kon, $query_update_tanggal_survey);


    // Setelah semua jawaban disimpan, Anda dapat mengarahkan pengguna ke halaman lain atau menampilkan pesan sukses.
    // Misalnya:
    header("Location: dashboard-industri.php");
    exit;
}


// Jika tombol 'Simpan' tidak diklik, pengguna mungkin telah mengakses file ini secara langsung tanpa mengisi survei,
// Anda dapat menangani kasus ini dengan menampilkan pesan atau mengarahkan pengguna ke halaman lain.
?>
