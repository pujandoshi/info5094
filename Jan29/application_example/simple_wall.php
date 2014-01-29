<!DOCTYPE HTML>
<html>
    <head>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>
            var deletePost = function(postId, $element) {
                $.get("ajax_operations.php?action=delete&postId=" + postId);
                $element.remove();
            };
            
            var addPost = function(response) {
                var $p = $("<p>" + response.postContent 
                        + " <i>--By " + response.posterName + "</i>");
                var $a = $("<a href='#'>Delete</a>").click(function(e) {
                    e.preventDefault();
                    deletePost(response.id, $p);
                });
                
                $p.append($a);
                $("#wall").append($p);
            };
            
            var getAll = function() {
                $("#wall").empty();
                $.get("ajax_operations.php?action=list", function(response) {
                    for (var i = 0; i < response.length; i++) {
                        addPost(response[i]);
                    }
                });
            };
            
            $(document).ready(function() {
                
                $("#wallPostForm").submit(function(e) {                                
                    // We want to POST to ourself to add the new post
                    $.post("ajax_operations.php?action=new", $(this).serialize(), addPost);
                    
                    // prevents the form from submitting as per ususal
                    e.preventDefault();
                });
                
                getAll();
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