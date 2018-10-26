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
            <h1>Sliding Puzzle</h1>
            <?php
            
            $gridArray = array();
            checkCookie($gridArray);
            checkPostData($gridArray);
            displayGrid($gridArray);
            checkWin($gridArray);
               
            ?>
        </div>
    </body>
</html>