<?php

/*
 * Use the following MySQL table for this example:

CREATE TABLE wallpost(
    id BIGINT NOT NULL AUTO_INCREMENT,
    posterName VARCHAR(100),
    postContent VARCHAR(1000),
    PRIMARY KEY(id)
);

 */

// Define the MySQL configuration
define('MYSQL_HOST', 'localhost');
define('MYSQL_DATABASE', 'class_examples');
define('MYSQL_USER', 'lamp');
define('MYSQL_PASSWORD', 'lamp');

// Make the database connection and die if it doesn't connect
$connection = mysqli_connect(MYSQL_HOST, MYSQL_USER, 
    MYSQL_PASSWORD, MYSQL_DATABASE) 
    or die("Could not connect to MySQL database: {$connection->connect_error}");

// Set the proper content type
header('Content-Type: application/json');
    
function ajax_list($connection) {
    $posts = array();
    
    $query = "SELECT id,posterName,postContent FROM wallpost";    
    $results = mysqli_query($connection, $query) or die('error executing query');
    
    while ($row = mysqli_fetch_array($results)) {
        array_push($posts, array(
            "posterName" => $row['posterName'],
            "postContent" => $row['postContent'],
            "id" => $row['id']
        ));
    }
    
    echo json_encode($posts);
}

function ajax_new($connection) {
    // If we wanted to validate the form, it would happen here
    
    // Write the SQL query as a string:
    // Take note that $_POST contains the values in the fields that were submitted
    // and that each of those values are in single quotes in order to make the
    // SQL query valid.
    $query = "INSERT INTO wallpost (posterName, postContent) 
        VALUES ('{$_POST['posterName']}', '{$_POST['postContent']}')";
    
    // Execute the query string over the connection we established at
    // the beginning of this file. If it fails, then die.
    mysqli_query($connection, $query) or die("Error inserting new post");
    $id = mysqli_insert_id($connection);
    
    // Since this is an AJAX request, we return JSON
    $response = array(
        'posterName' => $_POST['posterName'],
        'postContent' => $_POST['postContent'],
        'id' => $id
    );
    
    echo json_encode($response);
}
    
function ajax_delete($connection) {
    $query = "DELETE FROM wallpost WHERE id = ".$_GET['postId'];
    mysqli_query($connection, $query) or die ('query failed');
    echo "{}";
}

// If action is set, then we have an AJAX request to process
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'list'
            && $_SERVER['REQUEST_METHOD'] == 'GET') {
        ajax_list($connection);
    }
    else if ($_GET['action'] == 'new' 
            && $_SERVER['REQUEST_METHOD'] == 'POST') {
        ajax_new($connection);
    }
    else if ($_GET['action'] == 'delete' 
            && $_SERVER['REQUEST_METHOD'] == 'GET') {
        ajax_delete($connection);
    }    
}

mysqli_close($connection);

?>
