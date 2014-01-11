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

// Process a POST; that is, the insertion of a new post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
}

// Note that there isn't an else statement here. Why? Because even if we have
// received a POST and have done something with it (i.e., insert a post to the
// database), we still need to display some content. In this case, that is the
// wall with the form at the bottom. If we didn't continue here after processing
// the form, then the user would receive a blank white page.

// Alternatively, we could also redirect the user to the same page again using
// header('Location: simple_wall.php');
// This would force a GET request on the same page so that when a user presses
// refresh it doesn't ask them to repost the same values thus causing the same
// post to happen twice.


?>
<html>
    <body>
        <h1>The Wall</h1>
        
        <?php
        // Retrieve all values
        $result = mysqli_query($connection, "SELECT posterName, postContent FROM wallpost")
                    or die("Error executing query");
        
        // Loop through each result and output them
        // Note that $result acts as an iterator that moves to the next row
        // after each execution. On the last execution it returns NULL which
        // causes the while loop to stop
        while ($row = mysqli_fetch_array($result)) {
            echo "
            <p>{$row['postContent']} <i>--By {$row['posterName']}</i></p>
            ";
        }
        ?>
        
        <hr/>
        <form action="simple_wall.php" method="post">
            <label for="posterName">Your name: </label>
            <input type="text" name="posterName"/><br/>
            
            <label for='postContent'>Post content:</label>
            <textarea name='postContent'></textarea><br/>
            
            <input type="submit"/>
        </form>
    </body>
</html>