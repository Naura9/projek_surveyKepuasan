<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../login/login.php");
    exit();
}

class Survey {
    public function getSurveyQuestions($kategori_id) {
        $kon = mysqli_connect("localhost", "root", "", "tp_survey");
        
        $query = "SELECT m_survey_soal.soal_id, m_survey_soal.soal_nama
            FROM m_survey_soal
            JOIN m_survey ON m_survey_soal.survey_id = m_survey.survey_id
            JOIN m_kategori ON m_survey_soal.kategori_id = m_kategori.kategori_id
            JOIN m_user ON m_survey.user_id = m_user.user_id
            WHERE m_kategori.kategori_id = $kategori_id
            AND (m_survey_soal.soal_nama, m_survey_soal.soal_id) IN (
                SELECT soal_nama, MIN(soal_id)
                FROM m_survey_soal
                JOIN m_survey ON m_survey_soal.survey_id = m_survey.survey_id
                JOIN m_kategori ON m_survey_soal.kategori_id = m_kategori.kategori_id
                JOIN m_user ON m_survey.user_id = m_user.user_id
                WHERE m_kategori.kategori_id = $kategori_id
                GROUP BY soal_nama
            )";
        $result = mysqli_query($kon, $query);

        $questions = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $questions[] = $row;
        }

        // Close the database connection
        mysqli_close($kon);

        return $questions;
    }

    public function hapusPertanyaan($soal_id) {
        $kon = mysqli_connect("localhost", "root", "", "tp_survey");

        $query_get_soal_nama = "SELECT soal_nama FROM m_survey_soal WHERE soal_id = $soal_id";
        $result_soal_nama = mysqli_query($kon, $query_get_soal_nama);
        
        if ($result_soal_nama && mysqli_num_rows($result_soal_nama) > 0) {
            $row = mysqli_fetch_assoc($result_soal_nama);
            $soal_nama = $row['soal_nama'];
            
            $query_delete = "DELETE FROM m_survey_soal WHERE soal_nama = '$soal_nama'";
            $result_delete = mysqli_query($kon, $query_delete);
        
            if($result_delete) {
                mysqli_close($kon);
                return "Semua pertanyaan dengan kalimat \"$soal_nama\" berhasil dihapus.";
            } else {
                mysqli_close($kon);
                return "Gagal menghapus pertanyaan.";
            }
        } else {
            mysqli_close($kon);
            return "Gagal mendapatkan soal_nama.";
        }
    }
    
    public function renderSurveyQuestions($questions, $kategori_id, $edit_soal, $hapus_soal) {
        foreach ($questions as $question) {
            echo '<div class="survey-question">';
            echo '<form action="' . $hapus_soal . '?id=' . $question['soal_id'] . '" method="POST">';
    
            echo '<h3>' . $question['soal_nama'] . '</h3>';
            echo '<div class="rating">';
            echo '<input type="radio" id="jawaban_' . $question['soal_id'] . '_kurang" name="jawaban_' . $question['soal_id'] . '" value="kurang" class="label-kurang">';
            echo '<label for="jawaban_' . $question['soal_id'] . '_kurang"> Kurang</label>';
            echo '<input type="radio" id="jawaban_' . $question['soal_id'] . '_baik" name="jawaban_' . $question['soal_id'] . '" value="baik" class="label-baik">';
            echo '<label for="jawaban_' . $question['soal_id'] . '_baik"> Baik</label>';
            echo '</div>';
            
            echo '<div class="rating2">';
            echo '<input type="radio" id="jawaban_' . $question['soal_id'] . '_cukup" name="jawaban_' . $question['soal_id'] . '" value="cukup" class="label-cukup">';
            echo '<label for="jawaban_' . $question['soal_id'] . '_cukup"> Cukup</label>';
            echo '<input type="radio" id="jawaban_' . $question['soal_id'] . '_sangat_baik" name="jawaban_' . $question['soal_id'] . '" value="sangat_baik" class="label-sangat-baik">';
            echo '<label for="jawaban_' . $question['soal_id'] . '_sangat_baik"> Sangat Baik</label>';
            echo '<input type="hidden" name="soal_id" value="' . $question['soal_id'] . '">';
            echo '<input type="submit" class="button-hapus" name="hapus" value="Hapus" onclick="return confirm(\'Apakah Anda yakin ingin menghapus?\');">';
            echo '<a href="' . $edit_soal . '?id=' . $question['soal_id'] . '&kategori_id=' . $kategori_id . '" class="button-edit">Edit</a>';
            echo '</div>';
            
            echo '<hr>';
            echo '</form>';
    
            echo '</div>';
        }
    }
}
?>
