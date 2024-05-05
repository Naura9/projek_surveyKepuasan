<?php
include '../koneksi.php';

if(isset($_POST['simpan'])){
    $soal_id = $_GET['id']; // Mendapatkan ID pertanyaan dari URL

    // Mengambil nilai yang diperbarui dari form
    $soal_nama = $_POST['soal_nama'];
    $jawaban = $_POST['question1'];

    // Query untuk memperbarui pertanyaan dan jawaban dalam database
    $query = "UPDATE m_survey_soal SET soal_nama='$soal_nama', jawaban='$jawaban' WHERE soal_id=$soal_id";
    $result = mysqli_query($kon, $query);

    // Periksa apakah query berhasil dieksekusi
    if($result){
        echo "<script>alert('Perubahan berhasil disimpan'); window.location.href='soal-fasilitas.php';</script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($kon);
    }
}
?>
