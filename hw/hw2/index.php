<?php
    include "inc/functions.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <style>
            @import url("css/styles.css");
        </style>
    </head>
    <body>
        <div id="main">
            <?php
            
            $gridArray = array();
            checkCookie($gridArray);
            checkPostData($gridArray);
            displayGrid($gridArray);
               
            ?>
        </div>
    </body>
</html>