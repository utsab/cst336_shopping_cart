
<?php


function getDatabaseConnection() {
    $host = "localhost";
    $username = "oculus";
    $password = "cst336";
    $dbname = "shopping_cart_cst336_sp_2018"; 
    
    // Create connection
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $dbConn; 
}


function insertItemsIntoDB($items) {
    if (!$items) return; 
    
    $db = getDatabaseConnection(); 
    
    foreach ($items as $item) {
        $itemName = $item['name']; 
        $itemPrice = $item['salePrice']; 
        $itemImage = $item['thumbnailImage']; 
        
        $sql = "INSERT INTO item (item_id, name, price, image_url) VALUES (NULL, :itemName, :itemPrice, :itemURL)";
        $statement = $db->prepare($sql); 
        $statement->execute(array(
            itemName => $itemName, 
            itemPrice => $itemPrice, 
            itemURL => $itemImage
            ));
    }
}


function getMatchingItems($query) {
    $db = getDatabaseConnection(); 
    
    $sql = "SELECT * FROM item WHERE name LIKE '%$query%'"; 
    
    $statement = $db->prepare($sql); 
    
    $statement->execute(); 
    
    $records = $statement->fetchAll(); 
    
    foreach ($records as $record) {
        echo $record["name"] . "<br/>"; 
    }
}

function addCategoriesForItems($itemStart, $itemEnd, $category_id) {
    $db = getDatabaseConnection(); 
    
    for ($i = $itemStart; $i <= $itemEnd; $i++) {
        $sql = "INSERT INTO item_category (grouping_id, item_id, category_id) VALUES (NULL, '$i', '$category_id')";
        $db->exec($sql);
    }
        
}


?>


