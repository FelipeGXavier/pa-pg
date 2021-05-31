<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/main.css">
    <title>Document</title>
</head>

<body>
    <div class="links">
        <a href="index.html">Voltar para o menu</a>
    </div>
    <div class="container">
        <div class="ctx-center">
            <fieldset>
                <form class="form-data" action="POST" enctype="multipart/form-data">
                    <label class="label" for="sequence">Arquivo de entrada: </label>
                    <input name="sequence" id="sequence" type="file">
                    <button class="btn" id="btn-chart">Gerar</button>
                </form>
            </fieldset>
        </div>
        <div id="chart_div"></div>
    </div>
</body>

<script>
const btnChart = document.getElementById('btn-chart');
btnChart.addEventListener('click', (e) => {

    e.preventDefault();
    google.charts.load('current', {
        'packages': ['corechart']
    });

    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        const input = document.getElementById('sequence');
        const form = new FormData()
        const file = input.files[0];
        form.append('sequence', file);
        fetch('core/chartSequence.php', {
            method: 'POST',
            body: form
        }).then(
            response => response.json()
        ).then(
            success => {
                var data = new google.visualization.DataTable();
                data.addColumn('number', 'X');
                data.addColumn('number', 'Progressão');
                data.addRows(success);
                var options = {
                    hAxis: {
                        title: 'X'
                    },
                    vAxis: {
                        title: 'Y'
                    }
                };
                var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
                chart
                    .draw(data, options);
            }
        ).catch(
            error => console.log(error)
        );
    }

})
</script>

</html>