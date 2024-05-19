<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ChartJS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
    <h1 class="text-center mb-5">Menampilkan Data Didalam ChartJS</h1>
    <section>
    <div class="row">
        <div class="col">
            <div class="chart-container" style="position: relative; height:40vh; width:40vw; margin:0 auto;">
                <canvas id="myChart"></canvas>
                <div class="chart-legend">
                    <div><span style="background-color: rgb(255, 99, 132);"></span>Male</div>
                    <div><span style="background-color: rgb(54, 162, 235);"></span>Female</div>
                </div>
            </div>
        </div>
        <div class="col">
            <table class="table table-bordered mx-auto" style="width: 400px;">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Gender</th>
                </tr>
                
                <?php

                // Sample data
                $sampleData = [
                    ['John', 'Male'],
                    ['Jane', 'Female'],
                    ['Alex', 'Male']
                ];
                foreach ($sampleData as $key => $data) {
                ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= $data[0] ?></td>
                        <td><?= $data[1] ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</section>

<style>
    .chart-container {
        position: relative;
    }

    .chart-legend {
        position: absolute;
        top: 0;
        right: 0;
        display: flex;
        flex-direction: column;
        margin-top: 20px;
    }

    .chart-legend div {
        display: flex;
        align-items: center;
        margin-bottom: 5px;
    }

    .chart-legend div span {
        display: inline-block;
        width: 10px;
        height: 10px;
        margin-right: 5px;
    }
</style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const data = {
            labels: ['Male', 'Female'],
            datasets: [{
                label: 'My First Dataset',
                data: [2, 1], // Sample data counts
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)'
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
                display: false // Menyembunyikan legenda
            }
        }
    }
};

        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
</body>
</html>
