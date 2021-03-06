<?php
    include 'inc/dbConnection.php';
    
    $conn = getDatabaseConnection();
    
    
    
    function getCategories() {
        global $conn;
        
        $sql = "SELECT catID, catName FROM om_category ORDER BY catName";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($records as $record){
            echo "<option value='" . $record["catId"] . "'>" . $record['catName'] . " </option>";
        }
    }
    
    if(isset($_GET['submitProduct'])){
        $productName = $_GET['productName'];
        $productDescription = $_GET['description'];
        $productImage = $_GET['productImage'];
        $productPrice = $_GET['price'];
        $catId = $_GET['catId'];
        
        $sql = "INSERT INTO om_product
        (productName, productDescription, productImage, price, catId)
        VALUES(:productName, :productDescription, :productImage, :price, :catId)";
        
        $np = array();
        $np[':productName'] = $productName;
        $np[':productDescription'] = $productDescription;
        $np[':productImage'] = $productImage;
        $np[':price'] = $productPrice;
        $np[':catId'] = $catId;
        
        $stmt = $conn->prepare($sql);
        $stmt->execute($np);
        
        $submit = true;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>CST336: OtterMart Product Search</title>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Mukta" rel="stylesheet">
    </head>
    <body>
        <h1> OtterMart Product Search </h1>
        <div id="adminLogin">
            <a class="btn" href="admin.php">Return</a>
            <form class="adminButtons" action="logout.php">
                <input type="submit" id='beginning' value="Logout" />
            </form>
        </div>
        <?php
            if($submit == true){
                echo '<h2 id="addSuccess"> Product Add Succesful </h2>';
            }
              
        ?>
        <div id="search">
            <form id="searchForm">
                <strong>Product name</strong> <input type="text" name="productName"> <br>
                <strong>Description</strong> <textarea name="description"  cols="50" rows="4" ></textarea> <br>
                <strong>Price</strong> <input type="text" name="price"><br>
                <strong>Category</strong> <select name="catId">
                    <option value="">Select One</option>
                    <?php getCategories(); ?>
                </select>
                <br>
                <strong>Set Image Url</strong> <input type="text" name="productImage"><br>
                <input type="submit" name="submitProduct" value="Add Product">
                <br><br>
            </form>
        </div>
        <div id="footer">
            <hr>
            <br /><br />
            <p>
                CST 336 Internet Programming 2018 &copy; Johnson <br />
                This website is for academic purposes only.
                <br /><br />
                <img src="img/logo.png" alt="CSUMB logo">
            </p>
        </div>
       
    </body>
</html>