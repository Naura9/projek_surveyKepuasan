<?php
// Include file koneksi
include '../koneksi.php';

if(isset($_GET['id'])) {
    $soal_id = $_GET['id'];

    // Query untuk mengambil kalimat yang akan dihapus
    $query_select = "SELECT soal_nama FROM m_survey_soal WHERE soal_id = $soal_id";
    $result_select = mysqli_query($kon, $query_select);

    if($result_select) {
        $data = mysqli_fetch_assoc($result_select);
        $soal_nama_hapus = $data['soal_nama'];

        // Query untuk menghapus semua data yang mengandung kalimat yang akan dihapus
        $query_delete = "DELETE FROM m_survey_soal WHERE soal_nama LIKE '%$soal_nama_hapus%'";
        $result_delete = mysqli_query($kon, $query_delete);

        if($result_delete) {
            echo "Pertanyaan dengan kalimat \"$soal_nama_hapus\" berhasil dihapus.";
        } else {
            echo "Gagal menghapus pertanyaan.";
        }
    } else {
        echo "Gagal mengambil data pertanyaan yang akan dihapus.";
    }
} else {
    echo "ID parameter is not set.";
}
header("Location: soal-pendidikan.php");
    exit();
// Tutup koneksi database
mysqli_close($kon);
?>
