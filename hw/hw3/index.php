<?php
    include 'inc/dbConnection.php';

    $conn = getDatabaseConnection();
    
    function insertData(){
        global $conn;
        
        $sql = "INSERT INTO survey (surveyGender, surveyAge, surveyPoke, surveyIngress, surveyArrrrrgh, surveyTTH, surveySitP, surveySubjectOne, surveyOther, surveyType, surveyPhone, surveyAR)";
        $sql .= "VALUES(:surveyGender, :surveyAge, :surveyPoke, :surveyIngress, :surveyArrrrrgh, :surveyTTH, :surveySitP, :surveySubjectOne, :surveyOther, :surveyType, :surveyPhone, :surveyAR)";
        $np = array();
        $np[":surveyGender"] = $_POST['surveyGender'];
        $np[":surveyAge"] = $_POST['age'];
        if(isset($_POST['game1'])){
            $np[":surveyPoke"] = true;
        }
        else{
            $np[":surveyPoke"] = false;
        }
        if(isset($_POST['game2'])){
            $np[":surveyIngress"] = true;
        }
        else{
            $np[":surveyIngress"] = false;
        }
        if(isset($_POST['game3'])){
            $np[":surveyArrrrrgh"] = true;
        }
        else{
            $np[":surveyArrrrrgh"] = false;
        }
        if(isset($_POST['game4'])){
            $np[":surveyTTH"] = true;
        }
        else{
            $np[":surveyTTH"] = false;
        }
        if(isset($_POST['game5'])){
            $np[":surveySitP"] = true;
        }
        else{
            $np[":surveySitP"] = false;
        }
        if(isset($_POST['game6'])){
            $np[":surveySubjectOne"] = true;
        }
        else{
            $np[":surveySubjectOne"] = false;
        }
        if(isset($_POST['game7'])){
            $np[":surveyOther"] = true;
        }
        else{
            $np[":surveyOther"] = false;
        }
        $np[":surveyType"] = $_POST['type'];
        $np[":surveyPhone"] = $_POST['cellphone'];
        
        if($_POST['ar']=="true"){
           $np[":surveyAR"] = true; 
        }
        else{
            $np[":surveyAR"] = false;
        }
        
        $stmt = $conn->prepare($sql);
        $stmt->execute($np);
    }
    
    function getResults(){
        global $conn;
        
        echo '<div id="results">';
        
        $sql = "SELECT count(surveyGender) ";
        $sql .= "FROM survey ";
        $sql .= 'WHERE surveyGender = "Male"';
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        $male = $stmt->fetchALL(PDO::FETCH_ASSOC);
        
        $sql = "SELECT count(surveyGender) ";
        $sql .= "FROM survey ";
        $sql .= 'WHERE surveyGender = "Female"';
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        $female = $stmt->fetchALL(PDO::FETCH_ASSOC);
        
        echo "<h2>Survey Results</h2>";
        echo "<h3>Gender</h3>";
        echo "Male: " . $male[0]['count(surveyGender)'] . " <br>";
        echo "Female: " . $female[0]['count(surveyGender)'] . " <br>";
        
        
        $sql = "SELECT surveyAge, count(surveyAge) ";
        $sql .= "FROM survey ";
        $sql .= "GROUP BY surveyAge ";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        $ageRange = $stmt->fetchALL(PDO::FETCH_ASSOC);
        echo "<h3>Age</h3>";
        for($i=0; $i < count($ageRange); $i++){
            echo $ageRange[$i]['surveyAge'] . ": " . $typeResults[$i]['count(surveyAge)'] . "<br>";    
        }
       
        $sql = "SELECT sum(surveyPoke), sum(surveyIngress), sum(surveyArrrrrgh), sum(surveyTTH), sum(surveySitP), sum(surveySubjectOne), sum(surveyOther) ";
        $sql .= "FROM survey ";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $playedResults = $stmt->fetchALL(PDO::FETCH_ASSOC);
        
        echo "<h3>Have Played</h3>";
        echo "Pokemon Go: " . $playedResults[0]['sum(surveyPoke)'] . " <br>";
        echo "Ingress: " . $playedResults[0]['sum(surveyIngress)'] . " <br>";
        echo "ARrrrrgh: " . $playedResults[0]['sum(surveyArrrrrgh)'] . " <br>";
        echo "Temple Treasure Hunt: " . $playedResults[0]['sum(surveyTTH)'] . " <br>";
        echo "Sharks in the Park: " . $playedResults[0]['sum(surveySitP)'] . " <br>";
        echo "dARK: Subject One: " . $playedResults[0]['sum(surveySubjectOne)'] . " <br>";
        echo "None: " . $playedResults[0]['sum(surveyOther)'] . " <br>";
        
        
        $sql = "SELECT surveyType, count(surveyType) ";
        $sql .="FROM survey ";
        $sql .="GROUP BY surveyType";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $typeResults = $stmt->fetchALL(PDO::FETCH_ASSOC);
        
        echo "<h3>Type</h3>";
        for($i=0; $i < count($typeResults); $i++){
            echo $typeResults[$i]['surveyType'] . ": " . $typeResults[$i]['count(surveyType)'] . "<br>";    
        }
        
        $sql = "SELECT DISTINCT surveyPhone, surveyAR ";
        $sql .= "FROM survey ";
        $sql .= "WHERE surveyAR=true";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $phoneResults = $stmt->fetchALL(PDO::FETCH_ASSOC);
        
        echo "<h3>Augmented Reality Cellphones</h3>";
        for($i=0; $i < count($phoneResults); $i++){
            echo $phoneResults[$i]['surveyPhone'];
            echo "<br>";    
        }
        
        echo "</div>";
    }
    
    $errorMsg = "";
        
    if(isset($_POST['surveyGender']) and !empty($_POST['surveyGender'])){
        $gender = true;
        $genderValue = $_POST['surveyGender'];
    }
    else{
        $errorMsg .= "<li>Please select a gender! </li>";
    }
    if(isset($_POST['age'])){
        $age = true;
        switch($_POST['age']){
            case "13-17":
                
                $age1317 = true;
                break;
            case "18-24":
                $age1824 = true;
                break;
            case "25-34":
                $age2534 = true;
                break;
            case "35+":
                $age35 = true;
                break;
        }
    }
    else{
         $errorMsg .= "<li>Please select an age range! </li>";
    }
    if(isset($_POST['game1']) or isset($_POST['game2']) or isset($_POST['game3']) or isset($_POST['game4']) or isset($_POST['game5']) or isset($_POST['game6']) or isset($_POST['game7'])){
        $game = true;
    }
    else{
        $errorMsg .= "<li>Please select at least one Augmented Reality game you have played or select None! </li>";
    }
    if(isset($_POST['type']) and !empty($_POST['type'])){
        $type = true;
        $typeValue = $_POST['type'];
    }
    else{
        $errorMsg .= "<li>Please select a game type! </li>";
    }
    if(isset($_POST['cellphone']) and !empty($_POST['cellphone'])){
        $phone = true;
        $phoneValue = $_POST['cellphone'];
    }
    else{
        $errorMsg .= "<li>Please enter your cellphone model! </li>";
    }
    if(isset($_POST['ar'])){
        $ar = true;
        $arValue = $_POST['ar'];
    }
    else{
        $errorMsg .= "<li>Please select if your cellphone suports Augmented Reality! </li>";
    }
    
    if($gender and $age and $game and $type and $phone and $ar){
        insertData();
        $showResults = true;
    }
    else{
        $showResults = false;
    }
    
    
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Augmented Reality Survey</title>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=KoHo" rel="stylesheet">
    </head>
    <body>
        <h1>Augmented Reality Survey</h1>
         <div id="survey">
            <form method="post">
                Gender:
                <select name = "surveyGender">
                    <option value= "">Select One</option>
                    <?php
                        echo '<option value = "Male"';
                        if($genderValue == 'Male'){
                            echo 'selected="selected"';
                        }
                        echo '>Male</option>';
                        echo '<option value = "Female"';
                        if($genderValue == 'Female'){
                            echo 'selected="selected"';
                        }
                        echo '>Female</option>';
                    ?>
                </select>
                <br>
                
                Age: 
                <br>
                <input type="radio" name="age" id="age1" value="13-17" <?php echo $age1317?'checked="checked"':''; ?>/> <label for="age1">13 - 17 </label> <br>
                <input type="radio" name="age" id="age2" value="18-24" <?php echo $age1824?'checked="checked"':''; ?>/> <label for="age2"> 18 - 24 </label> <br>
                <input type="radio" name="age" id="age3" value="25-34" <?php echo $age2534?'checked="checked"':''; ?>/> <label for="age3"> 25 - 34 </label> <br>
                <input type="radio" name="age" id="age4" value="35+" <?php echo $age35?'checked="checked"':''; ?>/> <label for="age4"> 35 + </label> <br>
                <br>
                
                Have you tried any of the following Augmented Reality games?
                <br>
                <input type="checkbox" name="game1" id="game1" value="pokemonGo"  <?php echo isset($_POST['game1'])?'checked="checked"':''; ?>> <label for="game1"> Pokemon Go<br></label>
                <input type="checkbox" name="game2" id="game2" value="ingress" <?php echo isset($_POST['game2'])?'checked="checked"':''; ?>> <label for="game2"> Ingress<br></label>
                <input type="checkbox" name="game3" id="game3" value="arrrrrgh" <?php echo isset($_POST['game3'])?'checked="checked"':''; ?>> <label for="game3"> ARrrrrgh<br></label>
                <input type="checkbox" name="game4" id="game4" value="tth" <?php echo isset($_POST['game4'])?'checked="checked"':''; ?>> <label for="game4"> Temple Treasure Hunt<br></label>
                <input type="checkbox" name="game5" id="game5" value="sp" <?php echo isset($_POST['game5'])?'checked="checked"':''; ?>> <label for="game5"> Sharks in the Park<br></label>
                <input type="checkbox" name="game6" id="game6" value="subjectOne" <?php echo isset($_POST['game6'])?'checked="checked"':''; ?>> <label for="game6"> dARK: Subject One<br></label>
                <input type="checkbox" name="game7" id="game7" value="none" <?php echo isset($_POST['game7'])?'checked="checked"':''; ?>> <label for="game7"> None<br></label>
                <br>
                
                What is your favorite type of game?
                <select name = "type">
                    <option value= "">Select One</option>
                    <option value = "Adventure" <?php echo $typeValue=="Adventure"?'selected="selected"': ""; ?>>Adventure</option>
                    <option value = "Action" <?php echo $typeValue=="Action"?'selected="selected"': ""; ?>>Action</option>
                    <option value = "Arcade" <?php echo $typeValue=="Arcade"?'selected="selected"': ""; ?>>Arcade</option>
                    <option value = "FPS" <?php echo $typeValue=="FPS"?'selected="selected"': ""; ?>>First Person Shooter</option>
                    <option value = "MOBA" <?php echo $typeValue=="MOBA"?'selected="selected"': ""; ?>>Multiplayer Online Battle Arena</option>
                    <option value = "MMORPG" <?php echo $typeValue=="MMORPG"?'selected="selected"': ""; ?>>Massively Multiplayer Online Role Playing Game</option>
                    <option value = "Puzzle" <?php echo $typeValue=="Puzzle"?'selected="selected"': ""; ?>>Puzzle</option>
                    <option value = "RPG" <?php echo $typeValue=="RPG"?'selected="selected"': ""; ?>>Role Playing Game</option>
                    <option value = "Simulator" <?php echo $typeValue=="Simulator"?'selected="selected"': ""; ?>>Simulator</option>
                    <option value = "Sports" <?php echo $typeValue=="Sports"?'selected="selected"': ""; ?>>Sports</option>
                    <option value = "Strategy" <?php echo $typeValue=="Strategy"?'selected="selected"': ""; ?>>Strategy</option>
                </select>
                <br>
                <br>
                What model is your cellphone? 
                
                <input type="text" name="cellphone" <?php echo $phone?"value='$phoneValue'":''; ?>>
                <br>
                
                Does your phone support Augmented Reality?
                <br>
                <input type="radio" name="ar" id="ar1" value="true" <?php echo $arValue=='true'?'checked="checked"':''; ?> /> <label for="ar1"> Yes </label> <br>
                <input type="radio" name="ar" id="ar2" value="false" <?php echo $arValue=='false'?'checked="checked"':''; ?> /> <label for="ar1"> No </label> <br>
                <br>
                
                <input type="submit" value="Submit" name="submitSurvey" />
            </form>
            
            <br />
        </div>
        
            
            <?php 
                if(!empty($_POST) and !empty($errorMsg)){
                    echo '<div id="error">';
                    echo "<ul>";
                    echo $errorMsg; 
                    echo "</ul>";
                    echo '</div>';
                }
               
            ?>
            
            
        
    
        <?php
            if($showResults == true){
                getResults();    
            }
        ?>
    
    </body>
</html>