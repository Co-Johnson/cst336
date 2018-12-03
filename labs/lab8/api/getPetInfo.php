<?php
    
    include '../inc/dbConnection.php';
    $conn = getDatabaseConnection("pets");
    
    $sql = "SELECT *, YEAR(CURDATE()) - yob age
            FROM pets
            WHERE id = :id";
            
    $stmt = $conn->prepare($sql);
    $stmt->execute(array("id"=>$_GET['id']));
    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($results);

?>