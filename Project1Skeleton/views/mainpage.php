<!DOCTYPE HTML>
<html>
    <head>
        <title>TODO List</title>
        <script src="js/jquery.min.js"></script>
        <script>
            // The following functions are only recommendations. 
            // You are free to structure your logic as you wish. 
            // It is recommended that you start with you UI code 
            // without AJAX (i.e., a static representation of what 
            // the application would like like after some use) and then
            // start phasing in functionality.
            
            /**
             * Adds a task to the DOM. This function will take a JSON object
             * like the one from Table 1 in the specification and create a task
             * in the HTML document. Consequently, this function may be divided
             * into two steps:
             *  1/ Convert the JSON object (task) into an HTML element
             *  2/ Insert that HTML element somewhere on the DOM
             * @param {type} task The object described in the JSON column of Table 1
             */
            var addTask = function(task) {
                
            };
            
            /**
             * Retrieves all tasks
             */
            var getAll = function() {
                // Basic steps of this function:
                // 
                // 1/ Empty all entries from the DOM  -- E.g., $("#list").empty();
                // 2/ Create the url. This may require querying some DOM elements
                //  for their current value (e.g., using values in a dropdown 
                //  box to determine current sorting and filtering preferences)
                // 3/ Execute the GET query. For each task in the response, call
                //  addTask
                
            };
            
            /**
             * Sends a request to the server to complete the specified task
             * @param {Number} id The id of the task to complete
             */
            var complete = function(id) {
                            
            };
            
            /**
             * Sends a request to the server to delete the specified task
             * @param {Number} id The id of the task to complete
             */
            var deleteTask = function(id) {
                // This is provided to help you out. Notice that we are POSTing
                // with an action of delete which will be interpreted by the 
                // router as a delete operation. The taskId=XX is used in the 
                // router to determine which task to delete.
                $.post('index.php?action=delete', "taskId=" + id, function() {
                    // Refresh the task list
                    getAll();
                });                
            };
            
            $(document).ready(function() {
                // Start the application by getting all
                getAll();
                
                // You will also need to intercept your new task form so that the
                // request is done using AJAX.
                
                // You may also need to intercept other events and refresh the
                // list with getAll()
            });
        </script>
    </head>
    <body>
        <p><strong>TODO:</strong> Write TODO list.</p>
    </body>
</html>
