<?php
    include "inc/functions.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>CST336: Homework 2 - Corey Johnson</title>
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
        <div id="footer">
            CST 336 Internet Programming: 2018 &copy; Johnson <br />
            This website is for academic purposes only.
            <br />
            <img src="img/csumb.png" alt="CSUMB logo">
        </div>
    </body>
</html>