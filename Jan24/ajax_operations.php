<?php
/*
 * THIS VERSION IN INCOMPLETE. PLEASE SEE THE NEXT LECTURE DAY FOR COMPLETE
 * VERSION
 */
$connection = mysqli_connect("localhost", "lamp", "lamp", "class_examples");

header("Content-Type: application/json");

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'list' 
            && $_SERVER['REQUEST_METHOD'] == 'GET') {
        // list all posts
        $posts = array();
        
        $query = "SELECT id,posterName,postContent FROM wallpost";
        $results = mysqli_query($connection, $query) 
                or die('error executing query');
        
        while ($row = mysqli_fetch_array($results)) {
            array_push($posts, array(
               'posterName'  => $row['posterName'],
                'postContent' => $row['postContent'],
                'id' => $row['id']
            ));
        }
        
        echo json_encode($posts);
    }
    
    else if ($_GET['action'] == 'new'
            && $_SERVER['REQUEST_METHOD'] == 'POST') {
        // create a new post
        $query = "INSERT INTO wallpost (posterName, postContent) 
            VALUES ('{$_POST['posterName']}', '{$_POST['postContent']}')";
        mysqli_query($connection, $query) or die ('query failed');
        $id = mysqli_insert_id($connection);
        
        $response = array(
            'posterName' => $_POST['posterName'],
            'postContent' => $_POST['postContent'],
            'id' => $id
        );
        
        echo json_encode($response);
    }
    
    else if ($_GET['action'] == 'delete'
            && $_SERVER['REQUEST_METHOD'] == 'GET') {
        // delete a post
        
    }
}

?>
