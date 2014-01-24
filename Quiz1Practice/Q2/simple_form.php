<?php

// QUESTION #2: Merge the two files in the html_example 
// directory from January 17th into a single PHP file.


// Since the AJAX request is only sent for POST, you simple need to check
// for this case and respond as ajax_post.php did. You can either use an else
// statement or 'exit' as I did here.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "<p>{$_POST['postContent']}
    <i>--By {$_POST['posterName']}</p>";
    exit;
}
// ALSO: Don't forget to change where we POST to  below!
// (That is, $.post must reference this file now not a separate
// ajax_post.php)
?>
<!DOCTYPE HTML>
<html>
    <head>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>
        var onNewPost = function(response) {
            $("#wall").append(response);
        }; 
        
        $(document).ready(function() {
            $("#wallPostForm").submit(function(e) {
                // Notice that we changed this!
                $.post("simple_form.php", $(this).serialize(),
                    onNewPost);
                e.preventDefault();
            });
        });
        </script>
    </head>
    <body>
        <div id="wall">
        </div>
        <!-- This is from the wall post -->
        <form id="wallPostForm">
            <label for="posterName">Your name: </label>
            <input type="text" name="posterName"/><br/>

            <label for='postContent'>Post content:</label>
            <textarea name='postContent'></textarea><br/>

            <input type="submit"/>
        </form>
    </body>
</html>