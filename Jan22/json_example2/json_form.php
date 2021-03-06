<!DOCTYPE HTML>
<html>
    <head>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>
        var onNewPost = function(response) {
            $("#wall").append("<p>" + response.postContent 
                        + " <i>--By " + response.posterName + "</i></p>");
        }; 
        
        $(document).ready(function() {
            $("#wallPostForm").submit(function(e) {
                $.post("json_form_ajax.php", $(this).serialize(),
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