<?php
// QUESTION 3: Validate the content of the form being submitted in the html_example directory from January 17th 
// (E.g., no empty inputs, the name must be less than 100 characters, etc.).

// See client side error handling below. If it doesn't make too much sense
// (there's some specific jQuery used), don't worry. The point of this exercise
// is to make sure you know where to put the form validation as it helps
// you understand where and when AJAX requests are processed.
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
                // --------------------------------------------
                // If the posterName isn't filled out, where 
                // input[name = 'posterName'] is the CSS selector for that
                // particular field.
                if ($("input[name='posterName']").val().length <= 0) {
                    alert('Please specifiy a poster name! ');
                }
                else if ($("textarea[name='postContent']").val().length <= 0) {
                    alert('Please specify some content');
                }
                // If everything is OK
               else {
                    $.post("ajax_post.php", $(this).serialize(),
                        onNewPost);
                }
                // ------------------------------------------------
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