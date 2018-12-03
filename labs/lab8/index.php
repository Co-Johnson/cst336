<?php
    include 'inc/header.php';
    
        function getPetList(){
        include 'inc/dbConnection.php';
        $conn = getDatabaseConnection("pets");
        
        $sql = "SELECT *
                FROM pets";
                
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $records;
    }
    
    $pets = getPetList();
?>

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="width: 300px; margin: 0px auto;">
        <!-- Indicators Here -->
        <ol class="carousel-indicators">
            <?php
                for($i = 0; $i < count($pets); $i++){
                    echo "<li data-target='#carouselExampleIndicators' data-slide-to='$i'";
                    echo ($i == 0)?" class='active'": "";
                    echo "></li>\r\n";
                }
            ?>
        </ol>
        
        <!-- Wrapper for Images -->
        <div class="carousel-inner">
    <?php 
        $i=0;
        foreach($pets as $pet){

            echo '<div class="carousel-item';
            echo ($i == 0)?" active": "";
            echo '">';
            echo '<img class="d-block w-100" src="img/' . $pet['pictureURL'] . '">';
            echo "<div class='carousel-caption'></div>";
            echo '</div>';
            //unset($imageURLs[$randomIndex]);
            $i++;
        }
    ?>
        </div>
        
        <!-- Controls Here -->
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
         
        
    </div>
            
      
    
    <br /><br />
    <a class="btn btn-outline-primary" href="pets.php" role="button">Adopt Now!</a>
    
    <br /><br />
    <hr>

<?php
    include 'inc/footer.php';
?>