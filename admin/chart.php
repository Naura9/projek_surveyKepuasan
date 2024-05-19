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
                <canvas id="myChart" style="height:40vh; width:40vw; margin:0 auto;"></canvas>
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
        };
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
</body>
</html>
