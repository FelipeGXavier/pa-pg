<?php 

include_once 'generateSequence.php';

/**
 * Gera um array de razões para P.A e P.G, utiliza a razão mais frequente como a principal
 * A partir da razão principal calcula a porcentagem da presença dela na série 
 */
function diff($elements) {
    $elementsRatioPa = getRatioPa($elements);
    $elementsRatioPg = getRatioPg($elements);
    
    $ratioFrequencyPa = getMostCommonElement($elementsRatioPa);
    $ratioFrequencyPg = getMostCommonElement($elementsRatioPg);

    if($ratioFrequencyPa['count'] > $ratioFrequencyPg['count']) {
        $realSequence = generateSequence($elements[0], count($elements), $ratioFrequencyPa['element'], 'pa');
        $result = [
            'type' => 'Progressão Aritmética',
            'percent' => getRatioDistribuition($realSequence, $elements),
        ];
    }else if($ratioFrequencyPg['count'] > $ratioFrequencyPa['count']) {
        $realSequence = generateSequence($elements[0], count($elements), $ratioFrequencyPg['element'], 'pg');
        $result = [
            'type' => 'Progressão Geométrica',
            'percent' => getRatioDistribuition($realSequence, $elements),
        ];
    }else {
        $result = [
            'type' => 'Distribuição igual ou indefinida',
            'percent' => 'Indefinido',
        ];
    }
    return $result;
}

function getRatioPa($elements) {
    $result = [];
    for($i = 1; $i < count($elements); $i++) {
        array_push($result, $elements[$i] - $elements[$i - 1]);
    }
    return $result;
}

function getRatioPg($elements) {
    $result = [];
    for($i = 1; $i < count($elements); $i++) {
        array_push($result, $elements[$i]/$elements[$i - 1]);
    }
    return $result;
}

function getMostCommonElement($arr) {
    $tmp = array_map('strval', $arr);
    $values = array_count_values($tmp);
    arsort($values);
    $firstKey = array_keys($values)[0];
    $result = ['element' => $firstKey, 'count' => $values[$firstKey]];
    return $result;
}

function getRatioDistribuition($real, $elements) {
    $equals = 0;
    for($i = 0; $i < count($elements); $i++) {
        if(isset($real[$i]) && isset($elements[$i]) && $elements[$i] == $real[$i]) {
            $equals++;
        }
    }
    $totalRatio = count($elements);
    $result = ($equals * 100) / $totalRatio;
    return $result;
}