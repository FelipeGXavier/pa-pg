<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
.container {
    width: 80vw;
    margin: 0 auto;
}

.form-data {
    display: flex;
    flex-direction: column;
    align-items: center;
}

#result {
    display: block;
    margin-top: 20px;
    text-align: center;
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
        <form action="ex1.php" method="POST" class="form-data">
            <label for="a1">Primeiro elemento: </label>
            <input type="text" name="a1">
            <label for="ratio">Razão: </label>
            <input type="text" name="ratio">
            <label for="quantityElements">Quantidade de elementos: </label>
            <input type="text" name="quantityElements">
            <label for="type">Tipo de progessão: </label>
            <div>
                <label for="pa">PA: </label>
                <input type="radio" id="pa" name="type" value="pa">
                <label for="pg">PG: </label>
                <input type="radio" name="type" value="pg">
            </div>
            <button type="submit">Gerar</button>
        </form>
        <?php if($written) {
            echo "<div id='result'>Arquivo gerado com nome <b>$filename</b></div>";
        }?>
    </div>
</body>

</html>