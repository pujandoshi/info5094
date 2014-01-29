<?php

// If the action parameter is set, we assume that this is an AJAX request
if (isset($_GET['action'])) {
    // Set the header so that the client knows that we are communicating with JSON 
    header("Content-Type: application/json");
    
    // Make the database connection and die if it doesn't connect
    $connection = mysqli_connect(MYSQL_HOST, MYSQL_USER, 
        MYSQL_PASSWORD, MYSQL_DATABASE) 
        or die("Could not connect to MySQL database: {$connection->connect_error}");
    
    /*
     * For each of the following, implement the necessary logic.
     * It is recommended to create a class or a separate file to store the logic
     * of each of these operation (similar to the controller in Project #2 of 
     * INFO-3106). You are free to fill the logic directly here, however.
     */
    if ($_GET['action'] == 'list'
            && $_SERVER['REQUEST_METHOD'] == 'GET') {
        // List all tasks (REQ1)
        // Don't forget to parse sortBy and includeCompleted
        
        
        
    }
    else if ($_GET['action'] == 'delete'
            && $_SERVER['REQUEST_METHOD'] == 'POST') {
        // Delete a task (REQ2)
        // Don't forget to parse taskId
        
        
        
    }
    else if ($_GET['action'] == 'complete'
            && $_SERVER['REQUEST_METHOD'] == 'POST') {
        // Complete a task (REQ3)
        // Don't forget to parse taskId
        
        
        
    }
    else if ($_GET['action'] == 'new'
            && $_SERVER['REQUEST_METHOD'] == 'POST') {
        // Create a new task (REQ4)
        // Don't forget to parse taskDescription and priority
        // Also, don't forget to return the JSON object as defined
        // in Table 1 of the specificaion. It must include the ID
        // of the object and the date it was created too.
        
        
    }
    
    mysqli_close($connection);
}
// If it's not an AJAX request, then return the main page
else {
    include('views/mainpage.php');
}

?>
