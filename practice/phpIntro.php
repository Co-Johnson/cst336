<!DOCTYPE html>
<html>
    <head>
        <title>PHP Hands-on Practice</title>
    </head>
    <body>
        <?php
        
            $n = 20943;
            $n = number_format($n,2); 
            echo $n  . "<br><br>";
            
            $n = rand(5,15);   
            echo $n  . "<br><br>";
            
            $n = "hElLo WoRlD!             ";
            echo strtoupper($n)  .  "<br><br>";
            
            echo strtolower($n)  .  "<br><br>";
            
            echo ucfirst(strtolower($n))  .  "<br><br>";
            
            echo strtolower($n)  .  "<br><br>";
            
            echo ucwords(strtolower($n))  .  "<br><br>";
            
            echo trim($n)  .  "<br><br>";
            
            echo "<table>";
            
            
            for($x = 0; $x < 9; $x++)
            {
                $rand = rand(1,100);
                echo "<tr>";
                echo "<td>" . $rand . "</td>";
                echo "<td>";
                echo  ($rand % 2 == 0)?"even":"odd";
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";


        ?>
    </body>
</html>