<?php
header('Content-Type: application/json');

$response = array(
    'posterName' => $_POST['posterName'],
    'postContent' => $_POST['postContent'],
    'id' => 123
);

echo json_encode($response);

?>
