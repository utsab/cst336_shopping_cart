<?php


function connectToDB() {
    $host = 'localhost';
    $db   = 'shopping_cart';
    $user = 'root';
    $pass = 'cst336';
    $charset = 'utf8mb4';
    
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, $user, $pass, $opt);
    return $pdo; 
}


function saveResultsToDB($items, $category) {
     echo "******category: <br/>"; 
    // //print_r($items); 
     echo $category; 
     echo "<br/> ";
    // echo "<br/> ";
    // echo "<br/> ";
    $db = connectToDB(); 
    
    foreach ($items as $item) {
        $itemName = $item['name']; 
        $itemPrice = $item['salePrice']; 
        $itemImage = $item['thumbnailImage']; 
        $itemId = $item['itemId']; 
        
        $sql = "INSERT INTO item (item_id, name, price, image_url) VALUES (NULL, '$itemName', '$itemPrice', '$itemImage');";
        $db->exec($sql); 
        $itemID = $db->lastInsertId(); 
        
        $sql = "INSERT INTO category (name) VALUES ('$category');";
        echo "$sql <br/>"; 
        $db->exec($sql); 
        $categoryID =  $db->lastInsertId();
        
        //echo "itemID: $itemID, categoryID: $categoryID <br/>"; 
    }
    
     
}


?>