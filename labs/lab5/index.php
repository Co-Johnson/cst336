<?php
    
    include 'inc/dbConnection.php';
    
    $conn = getDatabaseConnection();
    
    
    function displayCategories(){
        global $conn;
        
        $sql = "SELECT catID, catName from om_category ORDER BY catName";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($records as $record){
            echo "<option value='".$record["catID"]."' >" . $record["catName"] . "</option>";
        }
    }
    
    function displaySearchResults(){
        global $conn;
        
        //checks whether user has submitted the form
        if(isset($_GET['searchForm'])){
            echo "<h3>Products Found: </h3>";
            
            $namedParameters = array();
            
            $sql = "SELECT * FROM om_product WHERE 1";
            
            if(!empty($_GET['product'])){
                $sql .= " AND (productName LIKE :productName ";
                $sql .= " OR productDescription LIKE :productDescription )";
                $namedParameters[":productName"] = "%" . $_GET['product'] . "%";
                $namedParameters[":productDescription"] = "%" . $_GET['product'] . "%";
            }
            
            if(!empty($_GET['category'])){
                $sql .= " AND catID = :categoryID";
                $namedParameters[":categoryID"] = $_GET['category'];
            }
            
            if(!empty($_GET['priceFrom'])){
                $sql .= " AND price >= :priceFrom";
                $namedParameters[":priceFrom"] = $_GET['priceFrom'];
            }
            
            if(!empty($_GET['priceTo'])){
                $sql .= " AND price <= :priceTo";
                $namedParameters[":priceTo"] = $_GET['priceTo'];
            }
            
            if(isset($_GET['orderBy'])){
                if($_GET['orderBy'] == "price"){
                    $sql .= " ORDER BY price";
                }
                else{
                    $sql .= " ORDER BY productName";
                }
            }
            
            $stmt = $conn->prepare($sql);
            $stmt->execute($namedParameters);
            $records = $stmt->fetchALL(PDO::FETCH_ASSOC);
            
            foreach($records as $record){
                echo "<a href=\"purchaseHistory.php?productId=".$record['productId']. "\" > History </a>";
                echo $record["productName"] . " " . $record["productDescription"] . 
                     " $" . $record["price"] . "<br /> <br />";
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>CST336: OtterMart Product Search</title>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        
        <div>
            <h1> OtterMart Product Search </h1>
            
            <form>
                Product: <input type="text" name="product" />
                <br>
                Category:
                    <select name="category">
                        <option value="">Select One</option>
                        <?=displayCategories() ?>
                    </select>
                <br />
                Price: From <input type="text" name="priceForm" size="7" />
                       To   <input type="text" name="priceTo" size="7" />
                <br />
                Order result by:
                <br />
                
                <input type="radio" name="orderBy" value="price" /> Price <br>
                <input type="radio" name="orderBy" value="name" /> Name
                
                <br /><br />
                <input type="submit" value="Search" name="searchForm" />
            </form>
            
            <br />
            
            
        </div>
        
        <hr>
        <?=displaySearchResults() ?>
        
    </body>
</html>