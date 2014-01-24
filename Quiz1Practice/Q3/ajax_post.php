<?php
// QUESTION 3: Validate the content of the form being submitted in the html_example directory from January 17th 
// (E.g., no empty inputs, the name must be less than 100 characters, etc.).

// This is where the server-side form validation would take place.
// Here, we will check the submission and if it's correct, we'll return
// as usual, otherwise we'll return nothing. A better way is to use a failure
// HTTP status code and have Javascript do something with this; but this will
// be fine for now. 

if (isset($_POST['postContent']) && !empty($_POST['postContent'])
        && isset($_POST['posterName']) && !empty($_POST['posterName'])) {

?>

<p><?php echo $_POST['postContent']; ?>
    <i>--By <?php echo $_POST['posterName']; ?></p>

<?php
}
?>