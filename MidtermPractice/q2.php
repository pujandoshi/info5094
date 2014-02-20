<?php
// Write a PHP file that will query for every event in the database 
// and return them in a JSON format 

header('Content-Type: application/json');

$connection = mysqli_connect('localhost', 'lamp', 'lamp', 'class_examples')
                    or die("Failed to make connection");

$events = array();

$query = "SELECT id, title, description, date FROM event";
$results = mysqli_query($connection, $query) or die("Query failed");
while ($row = mysqli_fetch_array($results)) {
    array_push($events, array(
        "id" => $row['id'],
        "title" => $row['title'],
        "description" => $row['description'],
        "date" => $row['date']
    ));
}

echo json_encode($events);

?>
