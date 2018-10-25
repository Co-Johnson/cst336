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
            
            // load array with random numbers from 1 - 15
            $tileArray = array();
            for($x = 0; $x < 200; $x++)
            {
                $tileArray[] = rand(0,15);
            }
            
            $tileArray = array_unique($tileArray);
            $tileArray = array_values($tileArray);
            
            echo "<table>\r\n";
            echo "<tr>\r\n";
            echo "<td><img src='img/$tileArray[0].png'></td>\r\n";
            echo "<td><img src='img/$tileArray[1].png'></td>\r\n";
            echo "<td><img src='img/$tileArray[2].png'></td>\r\n";
            echo "<td><img src='img/$tileArray[3].png'></td>\r\n";
            echo "</tr>\r\n";
            echo "<tr>\r\n";
            echo "<tr>\r\n";
            echo "<td><img src='img/$tileArray[4].png'></td>\r\n";
            echo "<td><img src='img/$tileArray[5].png'></td>\r\n";
            echo "<td><img src='img/$tileArray[6].png'></td>\r\n";
            echo "<td><img src='img/$tileArray[7].png'></td>\r\n";
            echo "</tr>\r\n";
            echo "<tr>\r\n";
            echo "<tr>\r\n";
            echo "<td><img src='img/$tileArray[8].png'></td>\r\n";
            echo "<td><img src='img/$tileArray[9].png'></td>\r\n";
            echo "<td><img src='img/$tileArray[10].png'></td>\r\n";
            echo "<td><img src='img/$tileArray[11].png'></td>\r\n";
            echo "</tr>\r\n";
            echo "<tr>\r\n";
            echo "<tr>\r\n";
            echo "<td><img src='img/$tileArray[12].png'></td>\r\n";
            echo "<td><img src='img/$tileArray[13].png'></td>\r\n";
            echo "<td><img src='img/$tileArray[14].png'></td>\r\n";
            echo "<td><img src='img/$tileArray[15].png'></td>\r\n";
            echo "</tr>\r\n";
            echo "<tr>\r\n";
            echo "</table>\r\n";
            
               
            ?>
            
            <form>
                <input type="submit" value="Spin!"/>
            </form>
        </div>
    </body>
</html>