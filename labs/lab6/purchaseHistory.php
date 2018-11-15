<!DOCTYPE html>
<html>
    <head>
        <title>CST336: OtterMart Product Search</title>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Mukta" rel="stylesheet">
    </head>
    <body>
        <h1>OtterMart Product Search</h1>
        <h3>Product History: </h3>
        <div id="history">
        <?php
            include 'inc/dbConnection.php';
            
            $conn = getDatabaseConnection();
            
            $productId = $_GET['productId'];
            
            $sql = "SELECT *
                    FROM om_product
                    NATURAL JOIN om_purchase
                    WHERE productID = :pId";
                    
            $np = array();
            $np[":pId"] = $productId;
            
            $stmt = $conn->prepare($sql);
            $stmt->execute($np);
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if(count($records) == 0){
                echo "No product History";
            }
            else{
                echo $records[0]['productName'] . "<br />";
                echo "<img src='" . $records[0]['productImage'] . "' width='200'/><br />";
                
                foreach($records as $record){
                    
                    echo "Purchase Date: " . $record["purchaseDate"] . "<br/>";
                    echo "Unit Price: " . $record["unitPrice"] . "<br />";
                    echo "Quantity: " . $record["quantity"] . "<br/>";
                }
            }
            
        ?>
        </div>
    </body>
</html>
