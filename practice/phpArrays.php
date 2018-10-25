<!DOCTYPE html>
<html>
    <head>
        <title>PHP Hands-on Practice</title>
    </head>
    <body>
        <?php
        
            $my_array = array(1,2,3,4,5);
            var_dump($my_array);
            echo "<br>";
            $weekdays = array("M","T","W","R","F");
            
            var_dump($weekdays);
            echo "<br>";
            $weekdays = array();
            
            print_r($weekdays);
            echo "<br>";
            $weekdays[] = "M";
            print_r($weekdays);
            echo "<br>";
            $weekdays[] = "T"; // $weekdays has 2 elements
            print_r($weekdays);
            echo "<br>";
            array_push($weekdays,"W","R","F");  // $weekdays has 5 elements
            print_r($weekdays);
            echo "<br>";
            
            
            for($x = 0; $x < count($weekdays); $x++)
            {
                echo $weekdays[$x] . " ";
            }
            echo "<br><br>";

            foreach ($weekdays as $day) 
            {
            	echo "<br><br> $day";
            } 

            echo "<br><br>";

            $weekdays = "M, T, W, R, F";   // Commas are separating the items
            $weekdaysArray =  explode(",", $weekdays); 
            print_r($weekdaysArray);  // It will display 5 elements
            
            echo "<br><br>";
            
            $weekdaysArray = array("M","T", "W", "R", "F");   // creates new array
            $weekdays =  implode("-*-", $weekdaysArray); 
            print($weekdays);  // It will display M-*-T-*-W-*-R-*-F
            
            
            
            echo count($my_array);
            echo "<br><br>";
            
            echo is_array($my_array);
            echo "<br><br>";
            
            sort($weekdaysArray);
            print_r($weekdaysArray);
            echo "<br><br>";
            
            rsort($weekdaysArray);
            print_r($weekdaysArray);
            echo "<br><br>";
            
            echo array_rand($my_array);
            echo "<br><br>";
            
            $my_array = array(1,7,6,8,2,0);
            print_r($my_array);
            echo "<br><br>";
            
            print_r(array_values($weekdaysArray));
            echo "<br><br>";
            
            echo array_sum($my_array);
            echo "<br><br>";
            
            $my_array = array(5,5,4,4,3,3,2,2,1,1);
            print_r($my_array);
            echo "<br><br>";
            
            $new_array = array_unique($my_array);
            print_r($new_array);
            echo "<br><br>";
            
            

        ?>
    </body>
</html>