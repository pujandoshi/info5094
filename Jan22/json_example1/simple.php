<!DOCTYPE HTML>
<html>
    <head>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>
        var handleJson = function(response) {
            var formattedString = response.posterName + " said: " + response.postContent;
            alert(formattedString);
        };
        
        var requestJson = function() {
            $.get("simple_ajax.php", handleJson);
        };
        </script>
    </head>
    <body>
        <button onclick="requestJson();">Click me</button>
    </body>
</html>