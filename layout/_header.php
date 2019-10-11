<?php  $host = '//'.$_SERVER['HTTP_HOST'].'/';?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $page_title; ?></title>

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo $host;?>lib/css/bootstrap.min.css" />
 
    <!-- our custom CSS -->
    <link rel="stylesheet" href="<?php echo $host;?>lib/css/custom.css" />
 
</head>
<body>

    <!-- container -->
    <div class="container">

		<?php
		// show page header
		echo "<div class='page-header'>
				<h1>{$page_title}</h1>
			</div>";
		?>