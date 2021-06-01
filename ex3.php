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
<?php 
        $result = [];
        $file = isset($_FILES['sequence']) ? $_FILES['sequence'] : null;
        $data = null;
        if($file != null && !empty($file['tmp_name'])) {
            $content = json_decode(file_get_contents($_FILES['sequence']['tmp_name']), true); 
            
            include_once 'core/diffSequence.php';

            $elements = $content['sequence'];
            $result = diff($elements);
            
        }
    ?>

<body>
    <div class="links">
        <a href="index.html">Voltar para o menu</a>
    </div>
    <div class="container">
        <div class="ctx-center">
            <fieldset>
                <form class="form-data" action="ex3.php" method="POST" enctype="multipart/form-data">
                    <label class="label" for="sequence">Arquivo de entrada: </label>
                    <input name="sequence" id="sequence" type="file">
                    <button class="btn" id="btn-chart">Gerar</button>
                </form>
            </fieldset>
            <?php 
                if($result != null && count($result) > 0) {
                    $type = $result['type'];
                    $change = $result['percent'];
                    echo '<div id="result">';
                    echo '<h4>Resultados: </h4>';
                    echo "<div>Tipo da progressão encontrada na sequência: <b>$type</b>";
                    echo "<div>Porcentagem da progressão encontrada: <b>$change%</b>";
                    echo '</div>';
                }
            ?>
        </div>
    </div>
</body>

</html>