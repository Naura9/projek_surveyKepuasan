<?php
// Include file koneksi
include '../koneksi.php';

// Data untuk disimpan ke dalam tabel m_survey_soal
$soal_nama = $_POST['question']; // Ambil pertanyaan dari formulir
$kategori_id = 1; 
$soal_jenis = "skala"; // Jenis pertanyaan

// Persiapkan query SQL untuk mendapatkan semua survey_id yang ada di tabel m_survey_soal
$sql_survey_ids = "SELECT DISTINCT survey_id FROM m_survey_soal";

// Eksekusi query untuk mendapatkan semua survey_id
$result_survey_ids = mysqli_query($kon, $sql_survey_ids);

// Periksa apakah query berhasil dieksekusi
if ($result_survey_ids) {
    // Loop melalui setiap survey_id
    while ($row_survey_id = mysqli_fetch_assoc($result_survey_ids)) {
        $survey_id = $row_survey_id['survey_id'];

        // Ambil nilai no_urut terakhir untuk survey_id ini
        $sql_last_no_urut = "SELECT MAX(no_urut) AS last_no_urut FROM m_survey_soal WHERE survey_id = ?";
        $stmt_last_no_urut = $kon->prepare($sql_last_no_urut);
        $stmt_last_no_urut->bind_param("i", $survey_id);
        $stmt_last_no_urut->execute();
        $result_last_no_urut = $stmt_last_no_urut->get_result();

        if ($row_last_no_urut = $result_last_no_urut->fetch_assoc()) {
            $no_urut = $row_last_no_urut['last_no_urut'] + 1;
        } else {
            $no_urut = 1; // Jika belum ada pertanyaan untuk survey_id ini
        }

        // Persiapkan statement SQL untuk menyimpan pertanyaan
        $sql = "INSERT INTO m_survey_soal (survey_id, kategori_id, no_urut, soal_jenis, soal_nama) 
                VALUES (?, ?, ?, ?, ?)";

        // Persiapkan dan eksekusi statement
        if ($stmt = $kon->prepare($sql)) {
            // Bind parameter ke statement
            $stmt->bind_param("iiiss", $survey_id, $kategori_id, $no_urut, $soal_jenis, $soal_nama);

            // Eksekusi statement
            if ($stmt->execute()) {
                echo "Pertanyaan kualitas pendidikan berhasil ditambahkan untuk survey_id: $survey_id <br>";
            } else {
                echo "Gagal menambahkan pertanyaan kualitas pendidikan untuk survey_id: $survey_id <br>";
            }

            // Tutup statement
            $stmt->close();
        } else {
            echo "Error: " . $kon->error;
        }
    }

    header("Location: soal-pendidikan.php");
    exit();
} else {
    // Jika query untuk mendapatkan survey_id gagal, tampilkan pesan error
    echo "Error: " . mysqli_error($kon);
}

// Tutup koneksi database
$kon->close();
?>
