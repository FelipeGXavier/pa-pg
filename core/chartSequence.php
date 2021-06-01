<?php 

header('Content-type: application/json');

$file = isset($_FILES['sequence']) ? $_FILES['sequence'] : null;

if($file != null && !empty($_FILES['sequence']['tmp_name'])) {
    $content = json_decode(file_get_contents($_FILES['sequence']['tmp_name']), true); 
    $progression = $content['sequence'];
    $result = array_map(function($el) {
        return [$el, $el];
    }, $progression);
    echo json_encode($result);
}else{
    echo json_encode([]);
}