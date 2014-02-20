<?php
// Write another PHP file that will query for every ticket class in the 
// database and return them in a JSON format containing a list of 
// JSON objects with id, name, price, and capacity fields

header('Content-Type: application/json');

$connection = mysqli_connect('localhost', 'lamp', 'lamp', 'class_examples')
                    or die("Failed to make connection");


$ticketClasses = array();

$query = "SELECT id, name, price, capacity FROM ticketclass";
$results = mysqli_query($connection, $query) or die("Query failed");
while ($row = mysqli_fetch_array($results)) {
    array_push($ticketClasses, array(
        "id" => $row['id'],
        "name" => $row['name'],
        "price" => $row['price'],
        "capacity" => $row['capacity']
    ));
}

echo json_encode($ticketClasses);

?>