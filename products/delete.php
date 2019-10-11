<?php
// check if value was posted
if($_POST){
 
    // include database and object file
    include_once (__Dir__.'/../config/database.php');
    include_once (__Dir__.'/../objects/product.php');
   
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
 
    // prepare product object
    $product = new Product($db);
     
    // set product id to be deleted
    $product->id = $_POST['object_id'];
     
    // delete the product
    if($product->delete()){
        echo "Object was deleted.";
    }
     
    // if unable to delete the product
    else{
        echo "Unable to delete object.";
    }
}
?>