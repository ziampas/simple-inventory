<?php
require("includes/functions.php");
require("includes/db_functions.php");

$connection = dbConnect();

/* Lägg till */

if(isset($_POST['isnew']) && $_POST['isnew'] == 1){
	$saveProduct = saveProduct($connection);

	header("Location: read_products.php");
}

$categories = getAllCategories($connection);

/* Objektorienterad programmering */

class Admin {
  private $userName;
  public function __construct($userName)
  {
      $this->username = $userName;
  }

  public function setUserName($userName)
  {
      $this->username = $userName;
  }
  public function getUserName()
  {
      return $this->username;
  }

}

class Message extends Admin {

private $message;

public function __construct($userName,$message)
{
    $this->message = $message;
    parent::__construct($userName);
}

public function setMessage($message)
{
    $this->message = $message;
}
public function getMessage()
{
    return $this->message;
}
}

$a = new Message('Kristian',' You are logged in as an admin');

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
    <!--Hero slutar-->
		<p style="margin-top: 1rem; margin-left: 1rem;">Welcome <?php echo $a->getUserName(); ?> <br>
		<?php echo $a->getMessage(); ?></p>

<section class="section">
<div class="columns">
  <div class="column is-half">

		<h1 class="title is-4">Add products to inventory</h1>

    <form action="index.php" method="post">
     <input type="hidden" name="isnew" id="isnew" value="1">

        <div class="control">

          <label class="label">Product name</label><input class="input" type="text" name="productname" placeholder="">
          <label class="label">Quantity</label><input class="input" type="text" name="productquantity" placeholder="">
          <label class="label">Price</label><input class="input" type="text" name="productprice" placeholder="">

<p style="padding-top: 1rem;">

					<select class="select" name="categoryid">
						<?php
								while($row = mysqli_fetch_array($categories)){
						?>
					<option value="<?php echo $row['categoryId']; ?>"><?php echo $row['categoryName']; ?></option>
					<?php } ?>
				</select>

				</p>

        </div>
        <p style="padding-top: 1rem;"><button class="button is-success" type="submit">Add</button></p>
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
