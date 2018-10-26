<?php

function displayGrid(&$gridArray){
    echo "<form action='index.php' method='get'>\r\n";
    echo "<table>\r\n";
    echo "<tr>\r\n";
    echo "<td><a href='index.php?gridClick=0'><img src='img/$gridArray[0].png'></a></td>\r\n";
    echo "<td><a href='index.php?gridClick=1'><img src='img/$gridArray[1].png'></a></td>\r\n";
    echo "<td><a href='index.php?gridClick=2'><img src='img/$gridArray[2].png'></a></td>\r\n";
    echo "<td><a href='index.php?gridClick=3'><img src='img/$gridArray[3].png'></a></td>\r\n";
    echo "</tr>\r\n";
    echo "<tr>\r\n";
    echo "<tr>\r\n";
    echo "<td><a href='index.php?gridClick=4'><img src='img/$gridArray[4].png'></a></td>\r\n";
    echo "<td><a href='index.php?gridClick=5'><img src='img/$gridArray[5].png'></a></td>\r\n";
    echo "<td><a href='index.php?gridClick=6'><img src='img/$gridArray[6].png'></a></td>\r\n";
    echo "<td><a href='index.php?gridClick=7'><img src='img/$gridArray[7].png'></a></td>\r\n";
    echo "</tr>\r\n";
    echo "<tr>\r\n";
    echo "<tr>\r\n";
    echo "<td><a href='index.php?gridClick=8'><img src='img/$gridArray[8].png'></a></td>\r\n";
    echo "<td><a href='index.php?gridClick=9'><img src='img/$gridArray[9].png'></a></td>\r\n";
    echo "<td><a href='index.php?gridClick=10'><img src='img/$gridArray[10].png'></a></td>\r\n";
    echo "<td><a href='index.php?gridClick=11'><img src='img/$gridArray[11].png'></a></td>\r\n";
    echo "</tr>\r\n";
    echo "<tr>\r\n";
    echo "<tr>\r\n";
    echo "<td><a href='index.php?gridClick=12'><img src='img/$gridArray[12].png'></a></td>\r\n";
    echo "<td><a href='index.php?gridClick=13'><img src='img/$gridArray[13].png'></a></td>\r\n";
    echo "<td><a href='index.php?gridClick=14'><img src='img/$gridArray[14].png'></a></td>\r\n";
    echo "<td><a href='index.php?gridClick=15'><img src='img/$gridArray[15].png'></a></td>\r\n";
    echo "</tr>\r\n";
    echo "<tr>\r\n";
    echo "</table>\r\n";
    echo "<a href='index.php?gridClick=16'><img src='img/playagain.png'></a>";
    echo "</form>\r\n";
}

function loadGrid(&$gridArray){
    // load array with random numbers from 1 - 15
    
    for($x = 0; $x < 200; $x++)
    {
        $gridArray[] = rand(0,15);
    }
    
    $gridArray = array_unique($gridArray);
    $gridArray = array_values($gridArray);
}

function checkCookie(&$gridArray){
    $cookie_name = "tileGameCookie";
    if(!isset($_COOKIE[$cookie_name])){
        loadGrid($gridArray);
        $cookieValue = implode("_", $gridArray);
        setcookie("tileGameCookie", $cookieValue, time() + (86400), "/");
    }
    else{
        $gridArray = explode("_", $_COOKIE[$cookie_name]);
    }
}

function updateCookie(&$gridArray){
    $cookieValue = implode("_", $gridArray);
    setcookie("tileGameCookie", $cookieValue, time() + (86400), "/");
}

function newGame(&$gridArray){
    $gridArray = array();
    loadGrid($gridArray);
    updateCookie($gridArray);
}

function checkPostData(&$gridArray){
    $value = $_GET['gridClick'];
    if(isset($value)){
        switch($value){
            case 0:
                if($gridArray[1] == 0){
                    $gridArray[1] = $gridArray[0];
                    $gridArray[0] = 0;
                }
                else if($gridArray[4] == 0){
                    $gridArray[4] = $gridArray[0];
                    $gridArray[0] = 0;
                }
                break;
            case 1:
                if($gridArray[0] == 0){
                    $gridArray[0] = $gridArray[1];
                    $gridArray[1] = 0;
                }
                else if($gridArray[2] == 0){
                    $gridArray[2] = $gridArray[1];
                    $gridArray[1] = 0;
                }
                else if($gridArray[5] == 0){
                    $gridArray[5] = $gridArray[1];
                    $gridArray[1] = 0;
                }
                break;
            case 2:
                if($gridArray[1] == 0){
                    $gridArray[1] = $gridArray[2];
                    $gridArray[2] = 0;
                }
                else if($gridArray[3] == 0){
                    $gridArray[3] = $gridArray[2];
                    $gridArray[2] = 0;
                }
                else if($gridArray[6] == 0){
                    $gridArray[6] = $gridArray[2];
                    $gridArray[2] = 0;
                }
                break;
            case 3:
                if($gridArray[2] == 0){
                    $gridArray[2] = $gridArray[3];
                    $gridArray[3] = 0;
                }
                else if($gridArray[7] == 0){
                    $gridArray[7] = $gridArray[3];
                    $gridArray[3] = 0;
                }
                break;
            case 4:
                if($gridArray[0] == 0){
                    $gridArray[0] = $gridArray[4];
                    $gridArray[4] = 0;
                }
                else if($gridArray[5] == 0){
                    $gridArray[5] = $gridArray[4];
                    $gridArray[4] = 0;
                }
                else if($gridArray[8] == 0){
                    $gridArray[8] = $gridArray[4];
                    $gridArray[4] = 0;
                }
                break;
            case 5:
                if($gridArray[1] == 0){
                    $gridArray[1] = $gridArray[5];
                    $gridArray[5] = 0;
                }
                else if($gridArray[4] == 0){
                    $gridArray[4] = $gridArray[5];
                    $gridArray[5] = 0;
                }
                else if($gridArray[6] == 0){
                    $gridArray[6] = $gridArray[5];
                    $gridArray[5] = 0;
                }
                else if($gridArray[9] == 0){
                    $gridArray[9] = $gridArray[5];
                    $gridArray[5] = 0;
                }
                break;    
            case 6:
                if($gridArray[2] == 0){
                    $gridArray[2] = $gridArray[6];
                    $gridArray[6] = 0;
                }
                else if($gridArray[5] == 0){
                    $gridArray[5] = $gridArray[6];
                    $gridArray[6] = 0;
                }
                else if($gridArray[7] == 0){
                    $gridArray[7] = $gridArray[6];
                    $gridArray[6] = 0;
                }
                else if($gridArray[10] == 0){
                    $gridArray[10] = $gridArray[6];
                    $gridArray[6] = 0;
                }
                break;    
            case 7:
                if($gridArray[3] == 0){
                    $gridArray[3] = $gridArray[7];
                    $gridArray[7] = 0;
                }
                else if($gridArray[6] == 0){
                    $gridArray[6] = $gridArray[7];
                    $gridArray[7] = 0;
                }
                else if($gridArray[11] == 0){
                    $gridArray[11] = $gridArray[7];
                    $gridArray[7] = 0;
                }
                break;
            case 8:
                if($gridArray[4] == 0){
                    $gridArray[4] = $gridArray[8];
                    $gridArray[8] = 0;
                }
                else if($gridArray[9] == 0){
                    $gridArray[9] = $gridArray[8];
                    $gridArray[8] = 0;
                }
                else if($gridArray[12] == 0){
                    $gridArray[12] = $gridArray[8];
                    $gridArray[8] = 0;
                }
                break;
            case 9:
                if($gridArray[5] == 0){
                    $gridArray[5] = $gridArray[9];
                    $gridArray[9] = 0;
                }
                else if($gridArray[8] == 0){
                    $gridArray[8] = $gridArray[9];
                    $gridArray[9] = 0;
                }
                else if($gridArray[10] == 0){
                    $gridArray[10] = $gridArray[9];
                    $gridArray[9] = 0;
                }
                else if($gridArray[13] == 0){
                    $gridArray[13] = $gridArray[9];
                    $gridArray[9] = 0;
                }
                break;    
            case 10:
                if($gridArray[6] == 0){
                    $gridArray[6] = $gridArray[10];
                    $gridArray[10] = 0;
                }
                else if($gridArray[9] == 0){
                    $gridArray[9] = $gridArray[10];
                    $gridArray[10] = 0;
                }
                else if($gridArray[11] == 0){
                    $gridArray[11] = $gridArray[10];
                    $gridArray[10] = 0;
                }
                else if($gridArray[14] == 0){
                    $gridArray[14] = $gridArray[10];
                    $gridArray[10] = 0;
                }
                break;    
            case 11:
                if($gridArray[7] == 0){
                    $gridArray[7] = $gridArray[11];
                    $gridArray[11] = 0;
                }
                else if($gridArray[10] == 0){
                    $gridArray[10] = $gridArray[11];
                    $gridArray[11] = 0;
                }
                else if($gridArray[15] == 0){
                    $gridArray[15] = $gridArray[11];
                    $gridArray[11] = 0;
                }
                break;
            case 12:
                if($gridArray[8] == 0){
                    $gridArray[8] = $gridArray[12];
                    $gridArray[12] = 0;
                }
                else if($gridArray[13] == 0){
                    $gridArray[13] = $gridArray[12];
                    $gridArray[12] = 0;
                }
                break;
            case 13:
                if($gridArray[9] == 0){
                    $gridArray[9] = $gridArray[13];
                    $gridArray[13] = 0;
                }
                else if($gridArray[12] == 0){
                    $gridArray[12] = $gridArray[13];
                    $gridArray[13] = 0;
                }
                else if($gridArray[14] == 0){
                    $gridArray[14] = $gridArray[13];
                    $gridArray[13] = 0;
                }
                break;
            case 14:
                if($gridArray[10] == 0){
                    $gridArray[10] = $gridArray[14];
                    $gridArray[14] = 0;
                }
                else if($gridArray[13] == 0){
                    $gridArray[13] = $gridArray[14];
                    $gridArray[14] = 0;
                }
                else if($gridArray[15] == 0){
                    $gridArray[15] = $gridArray[14];
                    $gridArray[14] = 0;
                }
                break;
            case 15:
                if($gridArray[11] == 0){
                    $gridArray[11] = $gridArray[15];
                    $gridArray[15] = 0;
                }
                else if($gridArray[14] == 0){
                    $gridArray[14] = $gridArray[15];
                    $gridArray[15] = 0;
                }
                break;
            case 16:
                newGame($gridArray);
                break;
        }
        updateCookie($gridArray);
    }
    
   
}

function checkWin($gridArray){
    $testArray = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 0);
    if($gridArray == $testArray){
        echo "<h1>You Win!</h1>";
        deleteCookie();
    }
}

function deleteCookie(){
    $cookieValue = 0;
    setcookie("tileGameCookie", $cookieValue, time() - (3600), "/");
}
    
?>