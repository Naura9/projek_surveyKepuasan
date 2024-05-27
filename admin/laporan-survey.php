<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../login/login.php");
    exit(); 
}

$username = $_SESSION['username'];
$role = $_SESSION['role'];
$nama = $_SESSION['nama'];

$query_kategori_1 = "SELECT jawaban, COUNT(*) AS total
                    FROM (
                        SELECT j.jawaban 
                        FROM t_jawaban_mahasiswa j
                        JOIN m_survey_soal s ON j.soal_id = s.soal_id
                        WHERE s.kategori_id = 1
                        UNION ALL
                        SELECT j.jawaban 
                        FROM t_jawaban_dosen j
                        JOIN m_survey_soal s ON j.soal_id = s.soal_id
                        WHERE s.kategori_id = 1
                        AND j.jawaban IN ('kurang', 'cukup', 'baik', 'sangat_baik')
                        UNION ALL
                        SELECT j.jawaban 
                        FROM t_jawaban_tendik j
                        JOIN m_survey_soal s ON j.soal_id = s.soal_id
                        WHERE s.kategori_id = 1
                        AND j.jawaban IN ('kurang', 'cukup', 'baik', 'sangat_baik')
                        UNION ALL
                        SELECT j.jawaban 
                        FROM t_jawaban_ortu j
                        JOIN m_survey_soal s ON j.soal_id = s.soal_id
                        WHERE s.kategori_id = 1
                        AND j.jawaban IN ('kurang', 'cukup', 'baik', 'sangat_baik')
                        UNION ALL
                        SELECT j.jawaban 
                        FROM t_jawaban_industri j
                        JOIN m_survey_soal s ON j.soal_id = s.soal_id
                        WHERE s.kategori_id = 1
                        AND j.jawaban IN ('kurang', 'cukup', 'baik', 'sangat_baik')
                        UNION ALL
                        SELECT j.jawaban 
                        FROM t_jawaban_alumni j
                        JOIN m_survey_soal s ON j.soal_id = s.soal_id
                        WHERE s.kategori_id = 1
                        AND j.jawaban IN ('kurang', 'cukup', 'baik', 'sangat_baik')
                    ) AS combined_tables
                    GROUP BY jawaban
                    ORDER BY total DESC
                    LIMIT 1;
                    ";

$query_kategori_2 = "SELECT jawaban, COUNT(*) AS total
                    FROM (
                        SELECT j.jawaban 
                        FROM t_jawaban_mahasiswa j
                        JOIN m_survey_soal s ON j.soal_id = s.soal_id
                        WHERE s.kategori_id = 2
                        AND j.jawaban IN ('kurang', 'cukup', 'baik', 'sangat_baik')
                        UNION ALL
                        SELECT j.jawaban 
                        FROM t_jawaban_dosen j
                        JOIN m_survey_soal s ON j.soal_id = s.soal_id
                        WHERE s.kategori_id = 2
                        AND j.jawaban IN ('kurang', 'cukup', 'baik', 'sangat_baik')
                        UNION ALL
                        SELECT j.jawaban 
                        FROM t_jawaban_tendik j
                        JOIN m_survey_soal s ON j.soal_id = s.soal_id
                        WHERE s.kategori_id = 2
                        AND j.jawaban IN ('kurang', 'cukup', 'baik', 'sangat_baik')
                        UNION ALL
                        SELECT j.jawaban 
                        FROM t_jawaban_ortu j
                        JOIN m_survey_soal s ON j.soal_id = s.soal_id
                        WHERE s.kategori_id = 2
                        AND j.jawaban IN ('kurang', 'cukup', 'baik', 'sangat_baik')
                        UNION ALL
                        SELECT j.jawaban 
                        FROM t_jawaban_industri j
                        JOIN m_survey_soal s ON j.soal_id = s.soal_id
                        WHERE s.kategori_id = 2
                        AND j.jawaban IN ('kurang', 'cukup', 'baik', 'sangat_baik')
                        UNION ALL
                        SELECT j.jawaban 
                        FROM t_jawaban_alumni j
                        JOIN m_survey_soal s ON j.soal_id = s.soal_id
                        WHERE s.kategori_id = 2
                        AND j.jawaban IN ('kurang', 'cukup', 'baik', 'sangat_baik')
                    ) AS combined_tables
                    GROUP BY jawaban
                    ORDER BY total DESC
                    LIMIT 1;
                    ";

$query_kategori_3 = "SELECT jawaban, COUNT(*) AS total
                    FROM (
                        SELECT j.jawaban 
                        FROM t_jawaban_mahasiswa j
                        JOIN m_survey_soal s ON j.soal_id = s.soal_id
                        WHERE s.kategori_id = 3
                        AND j.jawaban IN ('kurang', 'cukup', 'baik', 'sangat_baik')
                        UNION ALL
                        SELECT j.jawaban 
                        FROM t_jawaban_dosen j
                        JOIN m_survey_soal s ON j.soal_id = s.soal_id
                        WHERE s.kategori_id = 3
                        AND j.jawaban IN ('kurang', 'cukup', 'baik', 'sangat_baik')
                        UNION ALL
                        SELECT j.jawaban 
                        FROM t_jawaban_alumni j
                        JOIN m_survey_soal s ON j.soal_id = s.soal_id
                        WHERE s.kategori_id = 3
                        AND j.jawaban IN ('kurang', 'cukup', 'baik', 'sangat_baik')
                        UNION ALL
                        SELECT j.jawaban 
                        FROM t_jawaban_tendik j
                        JOIN m_survey_soal s ON j.soal_id = s.soal_id
                        WHERE s.kategori_id = 3
                        AND j.jawaban IN ('kurang', 'cukup', 'baik', 'sangat_baik')
                        UNION ALL
                        SELECT j.jawaban 
                        FROM t_jawaban_industri j
                        JOIN m_survey_soal s ON j.soal_id = s.soal_id
                        WHERE s.kategori_id = 3
                        AND j.jawaban IN ('kurang', 'cukup', 'baik', 'sangat_baik')
                        UNION ALL
                        SELECT j.jawaban 
                        FROM t_jawaban_ortu j
                        JOIN m_survey_soal s ON j.soal_id = s.soal_id
                        WHERE s.kategori_id = 3
                        AND j.jawaban IN ('kurang', 'cukup', 'baik', 'sangat_baik')
                    ) AS combined_tables
                    GROUP BY jawaban
                    ORDER BY total DESC
                    LIMIT 1;
                    ";

$query_kategori_4 = "SELECT jawaban, COUNT(*) AS total
                    FROM (
                        
                        SELECT j.jawaban 
                        FROM t_jawaban_mahasiswa j
                        JOIN m_survey_soal s ON j.soal_id = s.soal_id
                        WHERE s.kategori_id = 4
                        AND j.jawaban IN ('kurang', 'cukup', 'baik', 'sangat_baik')
                        UNION ALL
                        SELECT j.jawaban 
                        FROM t_jawaban_dosen j
                        JOIN m_survey_soal s ON j.soal_id = s.soal_id
                        WHERE s.kategori_id = 4
                        AND j.jawaban IN ('kurang', 'cukup', 'baik', 'sangat_baik')
                        UNION ALL
                        SELECT j.jawaban 
                        FROM t_jawaban_tendik j
                        JOIN m_survey_soal s ON j.soal_id = s.soal_id
                        WHERE s.kategori_id = 4
                        AND j.jawaban IN ('kurang', 'cukup', 'baik', 'sangat_baik')
                        UNION ALL
                        SELECT j.jawaban 
                        FROM t_jawaban_ortu j
                        JOIN m_survey_soal s ON j.soal_id = s.soal_id
                        WHERE s.kategori_id = 4
                        AND j.jawaban IN ('kurang', 'cukup', 'baik', 'sangat_baik')
                        UNION ALL
                        SELECT j.jawaban 
                        FROM t_jawaban_industri j
                        JOIN m_survey_soal s ON j.soal_id = s.soal_id
                        WHERE s.kategori_id = 4
                        AND j.jawaban IN ('kurang', 'cukup', 'baik', 'sangat_baik')
                        UNION ALL
                        SELECT j.jawaban 
                        FROM t_jawaban_alumni j
                        JOIN m_survey_soal s ON j.soal_id = s.soal_id
                        WHERE s.kategori_id = 4
                        AND j.jawaban IN ('kurang', 'cukup', 'baik', 'sangat_baik')
                    ) AS combined_tables
                    GROUP BY jawaban
                    ORDER BY total DESC
                    LIMIT 1;
                    ";

$result_kategori_1 = mysqli_query($kon, $query_kategori_1);
$result_kategori_2 = mysqli_query($kon, $query_kategori_2);
$result_kategori_3 = mysqli_query($kon, $query_kategori_3);
$result_kategori_4 = mysqli_query($kon, $query_kategori_4);

if ($result_kategori_1 && $result_kategori_2 && $result_kategori_3 && $result_kategori_4) {
    $row_kategori_1 = mysqli_fetch_assoc($result_kategori_1);
    $rata_rata_kategori_1 = $row_kategori_1 ? $row_kategori_1['jawaban'] : "";
    // Jika hasil adalah "sangat_baik", ganti menjadi "sangat baik"
    $rata_rata_kategori_1 = ($rata_rata_kategori_1 === "sangat_baik") ? "sangat baik" : $rata_rata_kategori_1;

    $row_kategori_2 = mysqli_fetch_assoc($result_kategori_2);
    $rata_rata_kategori_2 = $row_kategori_2 ? $row_kategori_2['jawaban'] : "";
    // Jika hasil adalah "sangat_baik", ganti menjadi "sangat baik"
    $rata_rata_kategori_2 = ($rata_rata_kategori_2 === "sangat_baik") ? "sangat baik" : $rata_rata_kategori_2;

    $row_kategori_3 = mysqli_fetch_assoc($result_kategori_3);
    $rata_rata_kategori_3 = $row_kategori_3 ? $row_kategori_3['jawaban'] : "";
    // Jika hasil adalah "sangat_baik", ganti menjadi "sangat baik"
    $rata_rata_kategori_3 = ($rata_rata_kategori_3 === "sangat_baik") ? "sangat baik" : $rata_rata_kategori_3;

    $row_kategori_4 = mysqli_fetch_assoc($result_kategori_4);
    $rata_rata_kategori_4 = $row_kategori_4 ? $row_kategori_4['jawaban'] : "";
    // Jika hasil adalah "sangat_baik", ganti menjadi "sangat baik"
    $rata_rata_kategori_4 = ($rata_rata_kategori_4 === "sangat_baik") ? "sangat baik" : $rata_rata_kategori_4;

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/96cfbc074b.js" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="../header.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js" integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        .survey-container {
            display: flex;
            margin-bottom: 50px;
            margin-top: 20px;
        }

        .survey-box {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 10px 20px 10px 20px;
            display: flex;
            width: 400px;
            height: 345px;
            flex-direction: column;
        }

        .survey-box.left {
            margin-right: 50px;
            align-items: flex-start;
        }

        .survey-box.right {
            margin-left: 20px;
        }

        .icon {
            display: flex;
            align-items: center;
            font-size: 60px;
        }

        .icon .fa-solid {
            font-size: 40px;
            margin-right: 20px;
        }

        .icon .text {
            font-size: 20px; 
            font-weight: bold;
            flex-direction: column;
        }

        .ratarata {
            font-size: 14px;
            background-color: #2d1b6b;
            border-radius: 15px;
            color: white;
            text-align: center;
            font-weight: none;
            display: inline-block;
            padding: 6px;
        }

        .chart {
            margin-top: 20px;
            display: flex;
        }

        .pie {
            display: block;
            margin: 0 auto;
            height: 3px;
            width: 3px;
        }

        .chart-legend {
            top: 0;
            right: 0;
            font-size: 12px;
            margin-top: 115px;
            margin-right: 20px;
            text-align: center;
        }

        .chart-legend div {
            display: flex;
            margin: 10px 20px 0px 0px;
        }

        .chart-legend div span {
            display: inline-block;
            width: 10px;
            height: 10px;
            margin-right: 5px;
            margin-top: 5px;
        }

        .content {
            height: 930px;
            background-color: #ececed;

        }
    </style>
</head>

<body>
<?php include 'Header.php'; ?>
    <section>
        <div class="content">
            <h2 style="font-weight: bold;">Laporan Survey</h2>
            <div class="survey-container">
                <div class="survey-box left">
                    <div class="atas">
                        <div class="icon">
                            <i class="fa-solid fa-medal"></i>
                            <div class="text">Kualitas Pendidikan Polinema<br><div class="ratarata">Rata-rata <?php echo $rata_rata_kategori_1; ?></div></div>                    
                        </div>
                    </div>
                    <div class="chart">
                        <div class="chart-legend">
                            <div><span style="background-color: #574989;"></span>Kurang</div>
                            <div><span style="background-color: #537085;"></span>Cukup</div>
                            <div><span style="background-color: #ED9346;"></span>Baik</div>
                            <div><span style="background-color: #F9D357;"></span>Sangat Baik</div>
                        </div>
                        <canvas class="pie" id="myChart"></canvas>
                    </div>
                </div>

                <div class="survey-box right">
                    <div class="atas">
                        <div class="icon">
                            <i class="fa-solid fa-layer-group"></i>
                            <div class="text">Fasilitas Polinema<br><div class="ratarata">Rata-rata <?php echo $rata_rata_kategori_2; ?></div></div>                    
                        </div>
                    </div>
                    <div class="chart">
                        <div class="chart-legend">
                            <div><span style="background-color: #574989;"></span>Kurang</div>
                            <div><span style="background-color: #537085;"></span>Cukup</div>
                            <div><span style="background-color: #ED9346;"></span>Baik</div>
                            <div><span style="background-color: #F9D357;"></span>Sangat Baik</div>
                        </div>
                        <canvas class="pie" id="myChart2"></canvas>
                    </div>
                </div>
            </div>
            <div class="survey-container">
                <div class="survey-box left">
                    <div class="atas">
                        <div class="icon">
                            <i class="fa-solid fa-handshake"></i>
                            <div class="text">Pelayanan Polinema<br><div class="ratarata">Rata-rata <?php echo $rata_rata_kategori_3; ?></div></div>                    
                        </div>
                    </div>
                    <div class="chart">
                        <div class="chart-legend">
                            <div><span style="background-color: #574989;"></span>Kurang</div>
                            <div><span style="background-color: #537085;"></span>Cukup</div>
                            <div><span style="background-color: #ED9346;"></span>Baik</div>
                            <div><span style="background-color: #F9D357;"></span>Sangat Baik</div>
                        </div>
                        <canvas class="pie" id="myChart3"></canvas>
                    </div>
                </div>

                <div class="survey-box right">
                    <div class="atas">
                        <div class="icon">
                            <i class="fa-solid fa-graduation-cap"></i>
                            <div class="text">Lulusan Polinema<br><div class="ratarata">Rata-rata <?php echo $rata_rata_kategori_4; ?></div></div>                    
                        </div>
                    </div>
                    <div class="chart">
                        <div class="chart-legend">
                            <div><span style="background-color: #574989;"></span>Kurang</div>
                            <div><span style="background-color: #537085;"></span>Cukup</div>
                            <div><span style="background-color: #ED9346;"></span>Baik</div>
                            <div><span style="background-color: #F9D357;"></span>Sangat Baik</div>
                        </div>
                        <canvas class="pie" id="myChart4"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const data = {
            labels: ['Kurang', 'Cukup', 'Baik', 'Sangat Baik'],
            datasets: [{
                label: '',
                data: [
                    <?php
                        $qry_kurang = $kon->query("SELECT jawaban FROM t_jawaban_mahasiswa WHERE jawaban='kurang' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 1)
                            UNION ALL
                            SELECT jawaban FROM t_jawaban_alumni WHERE jawaban='kurang' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 1)
                            UNION ALL
                            SELECT jawaban FROM t_jawaban_tendik WHERE jawaban='kurang' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 1)
                            UNION ALL
                            SELECT jawaban FROM t_jawaban_dosen WHERE jawaban='kurang' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 1)
                            UNION ALL
                            SELECT jawaban FROM t_jawaban_ortu WHERE jawaban='kurang' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 1)
                            UNION ALL
                            SELECT jawaban FROM t_jawaban_industri WHERE jawaban='kurang' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 1)");
                        $resF_kurang = $qry_kurang->num_rows;
                        echo $resF_kurang;
                    ?>,
                    <?php
                        $qry_cukup = $kon->query("SELECT jawaban FROM t_jawaban_mahasiswa WHERE jawaban='cukup' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 1)
                                                UNION ALL
                                                SELECT jawaban FROM t_jawaban_alumni WHERE jawaban='cukup' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 1)
                                                UNION ALL
                                                SELECT jawaban FROM t_jawaban_tendik WHERE jawaban='cukup' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 1)
                                                UNION ALL
                                                SELECT jawaban FROM t_jawaban_dosen WHERE jawaban='cukup' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 1)
                                                UNION ALL
                                                SELECT jawaban FROM t_jawaban_ortu WHERE jawaban='cukup' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 1)
                                                UNION ALL
                                                SELECT jawaban FROM t_jawaban_industri WHERE jawaban='cukup' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 1)");
                        $resF_cukup = $qry_cukup->num_rows;
                        echo $resF_cukup;
                    ?>,
                    <?php
                        $qry_baik = $kon->query("SELECT jawaban FROM t_jawaban_mahasiswa WHERE jawaban='baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 1)
                                                UNION ALL
                                                SELECT jawaban FROM t_jawaban_alumni WHERE jawaban='baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 1)
                                                UNION ALL
                                                SELECT jawaban FROM t_jawaban_tendik WHERE jawaban='baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 1)
                                                UNION ALL
                                                SELECT jawaban FROM t_jawaban_dosen WHERE jawaban='baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 1)
                                                UNION ALL
                                                SELECT jawaban FROM t_jawaban_ortu WHERE jawaban='baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 1)
                                                UNION ALL
                                                SELECT jawaban FROM t_jawaban_industri WHERE jawaban='baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 1)");
                        $resF_baik = $qry_baik->num_rows;
                        echo $resF_baik;
                    ?>,
                    <?php
                        $qry_sangat_baik = $kon->query("SELECT jawaban FROM t_jawaban_mahasiswa WHERE jawaban='sangat_baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 1)
                                                        UNION ALL
                                                        SELECT jawaban FROM t_jawaban_alumni WHERE jawaban='sangat_baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 1)
                                                        UNION ALL
                                                        SELECT jawaban FROM t_jawaban_tendik WHERE jawaban='sangat_baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 1)
                                                        UNION ALL
                                                        SELECT jawaban FROM t_jawaban_dosen WHERE jawaban='sangat_baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 1)
                                                        UNION ALL
                                                        SELECT jawaban FROM t_jawaban_ortu WHERE jawaban='sangat_baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 1)
                                                        UNION ALL
                                                        SELECT jawaban FROM t_jawaban_industri WHERE jawaban='sangat_baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 1)");
                        $resF_sangat_baik = $qry_sangat_baik->num_rows;
                        echo $resF_sangat_baik;
                    ?>
                ], 
                backgroundColor: [
                    '#574989',
                    '#537085',
                    '#ED9346',
                    '#F9D357'
                ],
                hoverOffset: 4
            }]
        };

        const data2 = {
            labels: ['Kurang', 'Cukup', 'Baik', 'Sangat Baik'],
            datasets: [{
                label: '',
                data: [
                    <?php
                        $qry_kurang = $kon->query("SELECT jawaban FROM t_jawaban_mahasiswa WHERE jawaban='kurang' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 2)
                            UNION ALL
                            SELECT jawaban FROM t_jawaban_alumni WHERE jawaban='kurang' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 2)
                            UNION ALL
                            SELECT jawaban FROM t_jawaban_tendik WHERE jawaban='kurang' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 2)
                            UNION ALL
                            SELECT jawaban FROM t_jawaban_dosen WHERE jawaban='kurang' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 2)
                            UNION ALL
                            SELECT jawaban FROM t_jawaban_ortu WHERE jawaban='kurang' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 2)
                            UNION ALL
                            SELECT jawaban FROM t_jawaban_industri WHERE jawaban='kurang' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 2)");
                        $resF_kurang = $qry_kurang->num_rows;
                        echo $resF_kurang;
                    ?>,
                    <?php
                        $qry_cukup = $kon->query("SELECT jawaban FROM t_jawaban_mahasiswa WHERE jawaban='cukup' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 2)
                                                UNION ALL
                                                SELECT jawaban FROM t_jawaban_alumni WHERE jawaban='cukup' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 2)
                                                UNION ALL
                                                SELECT jawaban FROM t_jawaban_tendik WHERE jawaban='cukup' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 2)
                                                UNION ALL
                                                SELECT jawaban FROM t_jawaban_dosen WHERE jawaban='cukup' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 2)
                                                UNION ALL
                                                SELECT jawaban FROM t_jawaban_ortu WHERE jawaban='cukup' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 2)
                                                UNION ALL
                                                SELECT jawaban FROM t_jawaban_industri WHERE jawaban='cukup' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 2)");
                        $resF_cukup = $qry_cukup->num_rows;
                        echo $resF_cukup;
                    ?>,
                    <?php
                        $qry_baik = $kon->query("SELECT jawaban FROM t_jawaban_mahasiswa WHERE jawaban='baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 2)
                                                UNION ALL
                                                SELECT jawaban FROM t_jawaban_alumni WHERE jawaban='baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 2)
                                                UNION ALL
                                                SELECT jawaban FROM t_jawaban_tendik WHERE jawaban='baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 2)
                                                UNION ALL
                                                SELECT jawaban FROM t_jawaban_dosen WHERE jawaban='baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 2)
                                                UNION ALL
                                                SELECT jawaban FROM t_jawaban_ortu WHERE jawaban='baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 2)
                                                UNION ALL
                                                SELECT jawaban FROM t_jawaban_industri WHERE jawaban='baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 2)");
                        $resF_baik = $qry_baik->num_rows;
                        echo $resF_baik;
                    ?>,
                    <?php
                        $qry_sangat_baik = $kon->query("SELECT jawaban FROM t_jawaban_mahasiswa WHERE jawaban='sangat_baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 2)
                                                        UNION ALL
                                                        SELECT jawaban FROM t_jawaban_alumni WHERE jawaban='sangat_baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 2)
                                                        UNION ALL
                                                        SELECT jawaban FROM t_jawaban_tendik WHERE jawaban='sangat_baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 2)
                                                        UNION ALL
                                                        SELECT jawaban FROM t_jawaban_dosen WHERE jawaban='sangat_baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 2)
                                                        UNION ALL
                                                        SELECT jawaban FROM t_jawaban_ortu WHERE jawaban='sangat_baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 2)
                                                        UNION ALL
                                                        SELECT jawaban FROM t_jawaban_industri WHERE jawaban='sangat_baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 2)");
                        $resF_sangat_baik = $qry_sangat_baik->num_rows;
                        echo $resF_sangat_baik;
                    ?>
                ],
                backgroundColor: [
                    '#574989',
                    '#537085',
                    '#ED9346',
                    '#F9D357'
                ],
                hoverOffset: 4
            }]
        };

        const data3 = {
            labels: ['Kurang', 'Cukup', 'Baik', 'Sangat Baik'],
            datasets: [{
                label: '',
                data: [
                    <?php
                        $qry_kurang = $kon->query("SELECT jawaban FROM t_jawaban_mahasiswa WHERE jawaban='kurang' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 3)
                            UNION ALL
                            SELECT jawaban FROM t_jawaban_alumni WHERE jawaban='kurang' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 3)
                            UNION ALL
                            SELECT jawaban FROM t_jawaban_tendik WHERE jawaban='kurang' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 3)
                            UNION ALL
                            SELECT jawaban FROM t_jawaban_dosen WHERE jawaban='kurang' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 3)
                            UNION ALL
                            SELECT jawaban FROM t_jawaban_ortu WHERE jawaban='kurang' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 3)
                            UNION ALL
                            SELECT jawaban FROM t_jawaban_industri WHERE jawaban='kurang' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 3)");
                        $resF_kurang = $qry_kurang->num_rows;
                        echo $resF_kurang;
                    ?>,
                    <?php
                        $qry_cukup = $kon->query("SELECT jawaban FROM t_jawaban_mahasiswa WHERE jawaban='cukup' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 3)
                                                UNION ALL
                                                SELECT jawaban FROM t_jawaban_alumni WHERE jawaban='cukup' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 3)
                                                UNION ALL
                                                SELECT jawaban FROM t_jawaban_tendik WHERE jawaban='cukup' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 3)
                                                UNION ALL
                                                SELECT jawaban FROM t_jawaban_dosen WHERE jawaban='cukup' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 3)
                                                UNION ALL
                                                SELECT jawaban FROM t_jawaban_ortu WHERE jawaban='cukup' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 3)
                                                UNION ALL
                                                SELECT jawaban FROM t_jawaban_industri WHERE jawaban='cukup' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 3)");
                        $resF_cukup = $qry_cukup->num_rows;
                        echo $resF_cukup;
                    ?>,
                    <?php
                        $qry_baik = $kon->query("SELECT jawaban FROM t_jawaban_mahasiswa WHERE jawaban='baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 3)
                                                UNION ALL
                                                SELECT jawaban FROM t_jawaban_alumni WHERE jawaban='baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 3)
                                                UNION ALL
                                                SELECT jawaban FROM t_jawaban_tendik WHERE jawaban='baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 3)
                                                UNION ALL
                                                SELECT jawaban FROM t_jawaban_dosen WHERE jawaban='baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 3)
                                                UNION ALL
                                                SELECT jawaban FROM t_jawaban_ortu WHERE jawaban='baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 3)
                                                UNION ALL
                                                SELECT jawaban FROM t_jawaban_industri WHERE jawaban='baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 3)");
                        $resF_baik = $qry_baik->num_rows;
                        echo $resF_baik;
                    ?>,
                    <?php
                        $qry_sangat_baik = $kon->query("SELECT jawaban FROM t_jawaban_mahasiswa WHERE jawaban='sangat_baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 3)
                                                        UNION ALL
                                                        SELECT jawaban FROM t_jawaban_alumni WHERE jawaban='sangat_baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 3)
                                                        UNION ALL
                                                        SELECT jawaban FROM t_jawaban_tendik WHERE jawaban='sangat_baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 3)
                                                        UNION ALL
                                                        SELECT jawaban FROM t_jawaban_dosen WHERE jawaban='sangat_baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 3)
                                                        UNION ALL
                                                        SELECT jawaban FROM t_jawaban_ortu WHERE jawaban='sangat_baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 3)
                                                        UNION ALL
                                                        SELECT jawaban FROM t_jawaban_industri WHERE jawaban='sangat_baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 3)");
                        $resF_sangat_baik = $qry_sangat_baik->num_rows;
                        echo $resF_sangat_baik;
                    ?>
                ],
                backgroundColor: [
                    '#574989',
                    '#537085',
                    '#ED9346',
                    '#F9D357'
                ],
                hoverOffset: 4
            }]
        };

        const data4 = {
            labels: ['Kurang', 'Cukup', 'Baik', 'Sangat Baik'],
            datasets: [{
                label: '',
                data: [
                    <?php
                        $qry_kurang = $kon->query("SELECT jawaban FROM t_jawaban_mahasiswa WHERE jawaban='kurang' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 4)
                            UNION ALL
                            SELECT jawaban FROM t_jawaban_alumni WHERE jawaban='kurang' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 4)
                            UNION ALL
                            SELECT jawaban FROM t_jawaban_tendik WHERE jawaban='kurang' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 4)
                            UNION ALL
                            SELECT jawaban FROM t_jawaban_dosen WHERE jawaban='kurang' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 4)
                            UNION ALL
                            SELECT jawaban FROM t_jawaban_ortu WHERE jawaban='kurang' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 4)
                            UNION ALL
                            SELECT jawaban FROM t_jawaban_industri WHERE jawaban='kurang' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 4)");
                        $resF_kurang = $qry_kurang->num_rows;
                        echo $resF_kurang;
                    ?>,
                    <?php
                        $qry_cukup = $kon->query("SELECT jawaban FROM t_jawaban_mahasiswa WHERE jawaban='cukup' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 4)
                                                UNION ALL
                                                SELECT jawaban FROM t_jawaban_alumni WHERE jawaban='cukup' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 4)
                                                UNION ALL
                                                SELECT jawaban FROM t_jawaban_tendik WHERE jawaban='cukup' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 4)
                                                UNION ALL
                                                SELECT jawaban FROM t_jawaban_dosen WHERE jawaban='cukup' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 4)
                                                UNION ALL
                                                SELECT jawaban FROM t_jawaban_ortu WHERE jawaban='cukup' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 4)
                                                UNION ALL
                                                SELECT jawaban FROM t_jawaban_industri WHERE jawaban='cukup' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 4)");
                        $resF_cukup = $qry_cukup->num_rows;
                        echo $resF_cukup;
                    ?>,
                    <?php
                        $qry_baik = $kon->query("SELECT jawaban FROM t_jawaban_mahasiswa WHERE jawaban='baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 4)
                                                UNION ALL
                                                SELECT jawaban FROM t_jawaban_alumni WHERE jawaban='baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 4)
                                                UNION ALL
                                                SELECT jawaban FROM t_jawaban_tendik WHERE jawaban='baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 4)
                                                UNION ALL
                                                SELECT jawaban FROM t_jawaban_dosen WHERE jawaban='baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 4)
                                                UNION ALL
                                                SELECT jawaban FROM t_jawaban_ortu WHERE jawaban='baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 4)
                                                UNION ALL
                                                SELECT jawaban FROM t_jawaban_industri WHERE jawaban='baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 4)");
                        $resF_baik = $qry_baik->num_rows;
                        echo $resF_baik;
                    ?>,
                    <?php
                        $qry_sangat_baik = $kon->query("SELECT jawaban FROM t_jawaban_mahasiswa WHERE jawaban='sangat_baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 4)
                                                        UNION ALL
                                                        SELECT jawaban FROM t_jawaban_alumni WHERE jawaban='sangat_baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 4)
                                                        UNION ALL
                                                        SELECT jawaban FROM t_jawaban_tendik WHERE jawaban='sangat_baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 4)
                                                        UNION ALL
                                                        SELECT jawaban FROM t_jawaban_dosen WHERE jawaban='sangat_baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 4)
                                                        UNION ALL
                                                        SELECT jawaban FROM t_jawaban_ortu WHERE jawaban='sangat_baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 4)
                                                        UNION ALL
                                                        SELECT jawaban FROM t_jawaban_industri WHERE jawaban='sangat_baik' AND soal_id IN (SELECT soal_id FROM m_survey_soal WHERE kategori_id = 4)");
                        $resF_sangat_baik = $qry_sangat_baik->num_rows;
                        echo $resF_sangat_baik;
                    ?>
                ],
                backgroundColor: [
                    '#574989',
                    '#537085',
                    '#ED9346',
                    '#F9D357'
                ],
                hoverOffset: 4
            }]
        };


        const config = {
            type: 'pie',
            data: data,
            options: {
                plugins: {
                    legend: {
                        display: false 
                    }
                }
            }        
        };

        const config2 = {
            type: 'pie',
            data: data2,
            options: {
                plugins: {
                    legend: {
                        display: false 
                    }
                }
            }
        };

        const config3 = {
            type: 'pie',
            data: data3,
            options: {
                plugins: {
                    legend: {
                        display: false 
                    }
                }
            }
        };

        const config4 = {
            type: 'pie',
            data: data4,
            options: {
                plugins: {
                    legend: {
                        display: false 
                    }
                }
            }
        };

        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
        const myChart2 = new Chart(
            document.getElementById('myChart2'),
            config2
        );

        const myChart3 = new Chart(
            document.getElementById('myChart3'),
            config3
        );

        const myChart4 = new Chart(
            document.getElementById('myChart4'),
            config4
        );
    </script>

</body>
</html>
<?php
} else {
    echo "Gagal mengambil data dari database";
}