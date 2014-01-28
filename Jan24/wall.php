<?php
/*
 * THIS VERSION IN INCOMPLETE. PLEASE SEE THE NEXT LECTURE DAY FOR COMPLETE
 * VERSION
 */
?>
<!DOCTYPE HTML>
<html>
    <head>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>
            
            var addPost = function(response) {
                var $p = $("<p>" + response.postContent
                            + "<i>--By " + response.posterName + "</i></p>");
                
                $("#wall").append($p);
            };
            
            var getAll = function() {
                //$("#wall").empty();
                $.get("ajax_operations.php?action=list", function(response) {
                    for (var i = 0; i < response.length; i++) {
                        addPost(response[i]);
                    }
                });
            };
            
            $(document).ready(function() {
                getAll();
                $("#wallPostForm").submit(function(event) {
                    event.preventDefault();
                    $.post("ajax_operations.php?action=new",
                            $(this).serialize(),
                            addPost);
                });
            });
            
        </script>
    </head>
    <body>
        <h1>The Wall</h1>
        
        <div id="wall">
        </div>
        
        <hr/>
        <form id="wallPostForm">
            <label for="posterName">Your name: </label>
            <input type="text" name="posterName"/><br/>
            
            <label for='postContent'>Post content:</label>
            <textarea name='postContent'></textarea><br/>
            
            <input type="submit"/>
        </form>
    </body>
</html>