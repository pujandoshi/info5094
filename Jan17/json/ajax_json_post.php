<?php

$response = array(
    'posterName' => $_POST['posterName'],
    'postContent' => $_POST['postContent'],
    'id' => 123
);

header('Content-Type: application/json');
echo json_encode($response);

?>
