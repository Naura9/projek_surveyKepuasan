<?php
include '../koneksi.php';

if(isset($_POST['simpan'])){
    // Mendapatkan ID pertanyaan dari URL
    $soal_id = $_GET['id']; 

    // Mengambil nilai yang diperbarui dari form
    $soal_nama_baru = $_POST['soal_nama'];

    // Query untuk mendapatkan soal_nama sebelumnya
    $query_get_old = "SELECT soal_nama FROM m_survey_soal WHERE soal_id = $soal_id";
    $result_get_old = mysqli_query($kon, $query_get_old);
    $row = mysqli_fetch_assoc($result_get_old);
    $soal_nama_lama = $row['soal_nama'];

    // Query untuk memperbarui pertanyaan dalam database
    $query_update = "UPDATE m_survey_soal SET soal_nama=? WHERE soal_nama LIKE ?";

    // Persiapkan dan eksekusi statement untuk memperbarui pertanyaan yang sesuai
    $stmt = $kon->prepare($query_update);

    // Bind parameter ke statement
    $stmt->bind_param("ss", $soal_nama_baru, $soal_nama_lama);

    // Eksekusi statement
    $stmt->execute();

    // Periksa apakah query berhasil dieksekusi
    if($stmt->affected_rows > 0) {
        echo "Pertanyaan dengan nama \"$soal_nama_lama\" berhasil diperbarui menjadi \"$soal_nama_baru\" untuk semua survey_id <br>";
    } else {
        echo "Gagal memperbarui pertanyaan dengan nama \"$soal_nama_lama\" <br>";
    }

    // Tutup statement
    $stmt->close();

    // Jika penyimpanan berhasil, arahkan kembali ke halaman soal-fasilitas.php
    header("Location: soal-pendidikan.php");
    exit(); // Pastikan tidak ada kode yang dieksekusi setelah header
}

// Tutup koneksi database
$kon->close();
?>
