<?php
require("includes/functions.php");
require("includes/db_functions.php");

$connection = dbConnect();

$products = getAllProducts($connection);

/* Ta bort produkt */
if(isset($_GET['deleteid']) && $_GET['deleteid'] > 0 ){
  $productData = getProductInfo($connection,$_GET['deleteid']);
    $isDeleteid = $_GET['deleteid'];
}

// Skall kunden raderas?
if(isset($_POST['isdeleteid']) && $_POST['isdeleteid'] > 0){
    deleteProduct($connection,$_POST['isdeleteid']);

    // Skickar tillbaka till sidan som visar alla kunder
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
            Inventory
          </h1>
        </div>
      </div>
    </section>
    <!--Hero slutar-->

<section class="section">
<div class="columns">


	<form action="delete_products.php" method="post">
	    <input type="hidden" name="isdeleteid" value="<?php echo $isDeleteid; ?>">

<h1 class="title is-4">Are you sure you wanna delete <?php echo $productData['productName']; ?>?</h1>

<p><button class="button is-danger" type="submit">Yes</button>
<a  href="read_products.php" class="button is-danger">Go back</a></p>

	</form>





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
