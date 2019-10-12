<?php
// include database and object files
include_once (__Dir__.'/../config/database.php');
include_once (__Dir__.'/../objects/product.php');
include_once (__Dir__.'/../objects/category.php');

// get database connection
$database = new Database();
$db = $database->getConnection();

// pass connection to objects
$product = new Product($db);
$category = new Category($db);


// set page headers
$page_title = "Create Product";
include_once(__DIR__."/../layout/_header.php");

echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-default pull-right'>Read Products</a>";
echo "</div>";

?>
  <?php 
// if the form was submitted - PHP OOP CRUD Tutorial
if($_POST){
 
    // set product property values
    $product->name = $_POST['name'];
    $product->price = $_POST['price'];
    $product->description = $_POST['description'];
    $product->category_id = $_POST['category_id'];
    $image=!empty($_FILES["image"]["name"])
		? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"]) : "";
$product->image = $image;
 
    // create the product
    if($product->create()){
        echo "<div class='alert alert-success'>Product was created.</div>";
        // try to upload the submitted file
// uploadPhoto() method will return an error message, if any.
echo $product->uploadPhoto();
    }
      // if unable to create the product, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to create product.</div>";
    }
}
?>

    <!-- HTML form for creating a product -->
    <form action="create.php" method="post" enctype="multipart/form-data">

        <table class='table table-hover table-responsive table-bordered'>

            <tr>
                <td>Name</td>
                <td><input type='text' name='name' class='form-control' /></td>
            </tr>

            <tr>
                <td>Price</td>
                <td><input type='text' name='price' class='form-control' placeholder="00.00"/></td>
            </tr>

            <tr>
                <td>Description</td>
                <td><textarea name='description' class='form-control'></textarea></td>
            </tr>

            <tr>
                <td>Category</td>
                <td>
                    <?php
                    // read the product categories from the database
                    $stmt = $category->read();

                    // put them in a select drop-down
                    echo "<select class='form-control' name='category_id'>";
                    echo "<option>Select category...</option>";

                    while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)){
                        extract($row_category);
                        echo "<option value='{$id}'>{$name}</option>";
                    }

                    echo "</select>";
                    ?>

                </td>
            </tr>
            <tr>
	<td>Photo</td>
	<td><input type="file" name="image" /></td>
</tr>

            <tr>
                <td></td>
                <td>
                    <button type="submit" class="btn btn-primary">Create</button>
                </td>
            </tr>

        </table>
    </form>

<?php

// footer
include_once (__DIR__."/../layout/_footer.php");
?>