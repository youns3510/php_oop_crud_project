<?php
// core.php holds pagination variables
include_once (__Dir__.'/../config/core.php');
 
// include database and object files
include_once (__Dir__.'/../config/database.php');
include_once (__Dir__.'/../objects/product.php');
include_once (__Dir__.'/../objects/category.php');
 
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
$product = new Product($db);
$category = new Category($db);
 
// get search term
$search_term=isset($_GET['s']) ? $_GET['s'] : '';
 
$page_title = "You searched for \"{$search_term}\"";
include_once(__DIR__."/../layout/_header.php");
 
// query products
$stmt = $product->search($search_term, $from_record_num, $records_per_page);
 
// specify the page where paging is used
$page_url="search.php?s={$search_term}&";
 
// count total rows - used for pagination
$total_rows=$product->countAll_BySearch($search_term);
 
 
// read_template.php controls how the product list will be rendered
include_once(__DIR__."/read_template.php");
 
// layout_footer.php holds our javascript and closing html tags
include_once(__DIR__."/../layout/_footer.php");
?>