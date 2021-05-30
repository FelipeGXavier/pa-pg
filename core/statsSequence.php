<?php

function median($elements) {
    $size = count($elements); 
    $middle = floor(($size-1)/2); 
    if($size % 2) { 
        $median = $elements[$middle];
    } else { 
        $start = $elements[$middle];
        $end = $elements[$middle+1];
        $median = ($start+$end)/2;
    }
    return $median;
}

function getProgressionType($type) {
    switch($type) {
        case 'pa':
            return 'sumElementsPa';
            break;
        case 'pg':
            return 'sumElementsPg';
            break;
    }
}

function sumElementsPa($elements) {
    $size = count($elements);
    $last = $elements[$size - 1];
    $firstElement = $elements[0];
    $sum = (($firstElement + $last) * $size) / 2;
    return $sum;
}

function sumElementsPg($elements) {
    $ratio = $elements[1] / $elements[0];
    $size = count($elements);
    $firstElement = $elements[0];
    $sum = ($firstElement * (1 - pow($ratio, $size))) / (1 - $ratio);
    return $sum;
}

function average($elements, $type) {
    $sum = sum($elements, $type);
    return $sum / count($elements);
}

function sum($elements, $type) {
    $callback = getProgressionType($type);
    $sum = call_user_func($callback, $elements);
    return $sum;
}