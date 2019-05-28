<?php
require("includes/functions.php");
require("includes/db_functions.php");

$connection = dbConnect();

$products = getAllProducts($connection);
$categories = getAllCategories($connection);

/*Spara produkt */

if(isset($_POST['isnew']) && $_POST['isnew'] == 1){
	$saveProduct = saveProduct($connection);

	header("Location: index.php");
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
					<p>A simple web-app to manage your inventory </p>
        </div>
      </div>
    </section>
    <!--Hero slutar-->

    <nav class="navbar is-light" role="navigation" aria-label="main navigation">
      <a href="index.php" class="navbar-item">
  Add products
</a>
<a href="read_products.php" class="navbar-item">
  Inventory
</a>
<a href="about.php" class="navbar-item">
  About
</a>
</nav>

<section class="section">
<div class="columns">

<div class="column">
  <table class="table">

    <thead>
<tr>
<th>Product</th>
<th>ID</th>
<th>In Stock</th>
<th>Price</th>
<th>Price without VAT</th>
<th>Category</th>

</tr>
    </thead>
    <tbody>

			<?php
          while($row = mysqli_fetch_array($products)){
      ?>

<td><?php echo $row['productName']; ?> </td>
<td><?php echo $row['productId']; ?></td>
<td><?php echo $row['productQuantity']; ?></td>
<td><?php echo $row['productPrice'] ?></td>
<td><?php echo $row['productPrice']*0.75; ?></td> <!-- Pris utan skatt -->
<td><?php echo $row['categoryName'] ?></td>

<td></td>
<td><a href="update_products.php?editid=<?php echo $row['productId'];?>" class="button is-small is-danger">Edit</a></td>
<td><a href="delete_products.php?deleteid=<?php echo $row['productId'];?>" class="button is-small is-danger">Delete</a></td>
<td></td>

</tbody>
<?php
	}
?>
</table>

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
