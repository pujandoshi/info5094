<?php
// Connect the two previous questions together so that retrieving all 
// events also includes their ticket classes

header('Content-Type: application/json');

$connection = mysqli_connect('localhost', 'lamp', 'lamp', 'class_examples')
                    or die("Failed to make connection");

$events = array();

$query = "SELECT id, title, description, date FROM event";
$results = mysqli_query($connection, $query) or die("Query failed");
while ($row = mysqli_fetch_array($results)) {
    // NOTE: We need to setup an empty array for ticketClasses
    $event = array(
        "id" => $row['id'],
        "title" => $row['title'],
        "description" => $row['description'],
        "date" => $row['date'],
        "ticketClasses" => array()
    );
    
    $query2 = "SELECT id, name, price, capacity FROM ticketclass WHERE parentEventId = ".$row['id'];
    $result2 = mysqli_query($connection, $query2) or die("query 2 failed");
    while ($row2 = mysqli_fetch_array($result2)) {
        // Notice how we push to ticket classes array of the current event.
        array_push($event['ticketClasses'], array(
            "id" => $row2['id'],
            "name" => $row2['name'],
            "price" => $row2['price'],
            "capacity" => $row2['capacity']
        ));
    }
    
    array_push($events, $event);
}

echo json_encode($events);

?>
