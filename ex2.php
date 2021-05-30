<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .container {
        width: 80vw;
        margin: 0 auto;
    }

    .ctx-center {
        margin-top: 50px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .btn {
        margin-top: 10px;
        border: none;
        cursor: pointer;
        color: white;
        background-color: #28A744;
        padding: 5px 30px 5px 30px;
        border-radius: 3px;
        border-bottom: 2px solid #04691a;
    }

    .form-data {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    #result {
        margin-top: 2rem;
    }

    #result>h4 {
        text-align: center;
    }

    .label {
        display: block;
        margin-bottom: 15px;
    }

    .links {
        text-align: center;
        display: block;
        margin-bottom: 3rem;
    }

    .links>a {
        text-decoration: none;
    }
    </style>
</head>
<?php 
        $file = isset($_FILES['sequence']) ? $_FILES['sequence'] : null;
        $data = null;
        if($file != null || !empty($file['tmp_name'])) {
            $content = json_decode(file_get_contents($_FILES['sequence']['tmp_name']), true); 
            
            include_once 'core/statsSequence.php';

            $elements = $content['sequence'];
            $firstElement = $content['firstElement'];
            $ratio = $content['ratio'];
            $type = $content['type'];
            $data = [
                'firstElement' => $content['firstElement'],
                'ratio' => $content['ratio'],
                'type' => $type == 'pa' ? 'Progressão Artitmética' : 'Progressão Geométrica',
                'elements' => $elements,
                'sum' => sum($elements, $type),
                'average' => average($elements, $type),
                'median' => median($elements)
            ];
        }
    ?>

<body>
    <div class="links">
        <a href="index.html">Voltar para o menu</a>
    </div>
    <div class="container">
        <div class="ctx-center">
            <form class="form-data" method="POST" action="ex2.php" enctype="multipart/form-data">
                <label class="label" for="sequence">Arquivo da progressão:</label>
                <input type="file" name="sequence">
                <button class="btn" type="submit">Enviar</button>
            </form>
            <?php 
                if($data != null) {
                    $firstElement = $data['firstElement'];
                    $ratio = $data['ratio'];
                    $sum = $data['sum'];
                    $type = $data['type'];
                    $average = $data['average'];
                    $elements = implode(',', $content['sequence']);
                    $median = $data['median'];
                    echo '<div id="result">';
                    echo '<h4>Resultados: </h4>';
                    echo "
                        <ul>
                            <li>Primeiro elemento: $firstElement</li>
                            <li>Tipo: $type</li>
                            <li>Razão: $ratio</li>
                            <li>Elementos: $elements</li>
                            <li>Soma: $sum</li>
                            <li>Média: $average</li>
                            <li>Mediana: $median</li>
                        </ul>
                    ";
                    echo '</div>';
                }
            ?>
        </div>
    </div>

</body>

</html>