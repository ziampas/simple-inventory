<?php
require("includes/functions.php");
require("includes/db_functions.php");

$connection = dbConnect();

$products = getAllProducts($connection);

/* Uppdatera produkt */
if(isset($_GET['editid']) && $_GET['editid'] > 0 ){
	$productData = getProductInfo($connection,$_GET['editid']);
}

// Skall kunden uppdateras?
if(isset($_POST['updateid']) && $_POST['updateid'] > 0){
	updateProduct($connection);

	header("Location: read_products.php");
}

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inventory</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css">
  </head>
  <body>
    <!-- Hero börjar här -->
    <section class="hero is-success">
      <div class="hero-body">
        <div class="container">
					<h1 class="title">
						Webtory
					</h1>
					<p>A simple web-app to manage your inventory</p>
        </div>
      </div>
    </section>
    <!--Hero slutar-->

<section class="section">
<div class="columns">
  <div class="column is-half">

		<h1 class="title is-5">Update: <?php echo $productData['productName']; ?></h1>

<form action="update_products.php" method="post">
   	<input type="hidden" name="updateid" value="<?php echo $productData['productId']; ?>">

    <label class="label">Product name:</label>
    <p><input class="input" type="text" name="productname" value="<?php echo $productData['productName']; ?>"></p>

		<label class="label">Quantity:</label>
    <p><input class="input" type="text" name="productquantity" value="<?php echo $productData['productQuantity']; ?>"></p>

    <label class="label">Price:</label>
    <p><input class="input" type="text" name="productprice" value="<?php echo $productData['productPrice']; ?>"></p>

    <p style="margin-top: 1rem;"><button class="button is-danger" type="submit">Update</button>
		<a href="read_products.php" class="button is-danger" type="submit">Go back</a></p>
</form>

</div>

</div>
<!-- Här slutar column -->

</div>
<!-- Här slutar columns -->
</section>

<?php
dbDisconnect($connection);
?>
  </body>
</html>
