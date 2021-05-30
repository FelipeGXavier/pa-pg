<?php 

function generateSequence($a1, $size, $ratio, $type) {
    $result = [];
    $callback = getProgressionType($type);
    for($i = 1; $i <= $size; $i++) {
        $element = call_user_func($callback, $a1, $i, $ratio);
        array_push($result, $element);
    }
    return $result;
}

function getProgressionType($type) {
    switch($type) {
        case 'pa':
            return 'generalRulePa';
            break;
        case 'pg':
            return 'generalRulePg';
            break;
    }
}

function generalRulePa($a1, $index, $ratio) {
    return $a1 + ($index - 1) * $ratio;
}

function generalRulePg($a1, $index, $ratio) {
    return $a1 * pow($ratio, $index - 1);
}