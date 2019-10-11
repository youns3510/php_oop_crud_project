<?php
// get ID of the product to be edited
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
 
// include database and object files
include_once (__Dir__.'/../config/database.php');
include_once (__Dir__.'/../objects/product.php');
include_once (__Dir__.'/../objects/category.php');
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare objects
$product = new Product($db);
$category = new Category($db);
 
// set ID property of product to be edited
$product->id = $id;
 
// read the details of product to be edited
$product->readOne();
 
?>
<!-- post code will be here -->
<?php 
// if the form was submitted
if($_POST){
 
    // set product property values
    $product->name = $_POST['name'];
    $product->price = $_POST['price'];
    $product->description = $_POST['description'];
    $product->category_id = $_POST['category_id'];
 
    // update the product
    if($product->update()){
        echo "<div class='alert alert-success alert-dismissable'>";
            echo "Product was updated.";
        echo "</div>";
    }
 
    // if unable to update the product, tell the user
    else{
        echo "<div class='alert alert-danger alert-dismissable'>";
        echo "Unable to update product.";
        echo "</div>";
    }
}

// set page header
$page_title = "Update Product";
include_once(__DIR__."/../layout/_header.php");
 
echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-default pull-right'>Read Products</a>";
echo "</div>";
 
?> 


<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
 
        <tr>
            <td>Name</td>
            <td><input type='text' name='name' value='<?php echo $product->name; ?>' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Price</td>
            <td><input type='text' name='price' value='<?php echo $product->price; ?>' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Description</td>
            <td><textarea name='description' class='form-control'><?php echo $product->description; ?></textarea></td>
        </tr>
 
        <tr>
            <td>Category</td>
            <td>
            <?php
$stmt = $category->read();
 
// put them in a select drop-down
echo "<select class='form-control' name='category_id'>";
 
    echo "<option>Please select...</option>";
    while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)){
        $category_id=$row_category['id'];
        $category_name = $row_category['name'];
 
        // current category of the product must be selected
        if($product->category_id==$category_id){
            echo "<option value='$category_id' selected>";
        }else{
            echo "<option value='$category_id'>";
        }
 
        echo "$category_name</option>";
    }
echo "</select>";
?>
            </td>
        </tr>
 
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Update</button>
            </td>
        </tr>
 
    </table>
</form>
<?php
 

// set page footer
include_once(__DIR__."/../layout/_footer.php");
?>