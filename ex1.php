<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/main.css">
    <title>Document</title>
    <style>
    #quantityElements~label {
        display: block;
        margin-top: 5px;
    }
    </style>
</head>
<?php 
    $written = false;
    $filename = md5(uniqid(rand(), true)) . ".json";
    
    $firstElement = isset($_POST['a1']) ? $_POST['a1'] : null;
    $ratio = isset($_POST['ratio']) ? $_POST['ratio'] : null;
    $quantityElements = isset($_POST['quantityElements']) ? $_POST['quantityElements'] : null;
    $progressionType = isset($_POST['type']) ? $_POST['type'] : null;

    if($firstElement == null || $ratio == null || $quantityElements == null || $progressionType == null) {
        
    }else {
        include_once 'core/generateSequence.php';
        $result = generateSequence($firstElement, $quantityElements, $ratio, $progressionType);
        
        $file = fopen('bin/' . $filename, 'w');
        $data = [
            'type' => $progressionType,
            'firstElement' => $firstElement,
            'ratio' => $ratio,
            'sequence' => $result
        ];
        fwrite($file, json_encode($data));
        $written = true;
    }
?>

<body>
    <div class="links">
        <a href="index.html">Voltar para o menu</a>
    </div>
    <div class="container">
        <div class="ctx-center">
            <fieldset>
                <form action="ex1.php" method="POST" class="form-data">
                    <label class="label" for="a1">Primeiro elemento: </label>
                    <input type="text" name="a1" id="a1">
                    <label class="label" for="ratio">Razão: </label>
                    <input type="text" name="ratio" id="ratio">
                    <label class="label" for="quantityElements">Quantidade de elementos: </label>
                    <input type="text" name="quantityElements" id="quantityElements">
                    <label for="type">Tipo de progessão: </label>
                    <div>
                        <label for="pa">PA: </label>
                        <input type="radio" id="pa" name="type" value="pa">
                        <label for="pg">PG: </label>
                        <input type="radio" name="type" value="pg">
                    </div>
                    <button class="btn" type="submit">Gerar</button>
                </form>

            </fieldset>
            <?php if($written) {
            echo "<div id='result'>Arquivo gerado com nome <b>$filename</b></div>";
        }?>
        </div>
    </div>
</body>

</html>