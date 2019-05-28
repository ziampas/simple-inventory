<?php

/*Lägg till produkt */

function saveProduct($conn){
    $name = $_POST['productname'];
    $quantity = $_POST['productquantity'];
    $price = $_POST['productprice'];
    $category = $_POST['categoryid'];
    $query = "INSERT INTO inventory
			(productName,productQuantity,productPrice,productCategory)
			VALUES('$name','$quantity','$price', $category)";

    $result = mysqli_query($conn,$query) or die("Query failed: $query");

    $insId = mysqli_insert_id($conn);

    return $insId;
}

/*HÄMTAR ALLA PRODUKTER */

function getAllProducts($conn){
    $query = "SELECT * FROM category INNER JOIN inventory ON category.categoryId = inventory.productCategory
    ORDER BY productName ASC";

    $result = mysqli_query($conn,$query) or die("Query failed: $query");

    return $result;
}

/*Hämtar kategorier */

function getAllCategories($conn){
    $query = "SELECT * FROM category ORDER BY categoryName ASC";

    $result = mysqli_query($conn,$query) or die("Query failed: $query");

    return $result;
}

/* HÄMTAR PRODUKT */

function getProductInfo($conn,$customerId){
    $query = "SELECT * FROM inventory
			WHERE productId=".$customerId;

    $result = mysqli_query($conn,$query) or die("Query failed: $query");

    $row = mysqli_fetch_assoc($result);

    return $row;
}


/* Uppdatera */

function updateProduct($conn){
  $name = $_POST['productname'];
  $quantity = $_POST['productquantity'];
  $price = $_POST['productprice'];
  $editid = $_POST['updateid'];

    $query = "UPDATE inventory
			SET productName='$name', productQuantity='$quantity', productPrice='$price'
			WHERE productId=". $editid;

    $result = mysqli_query($conn,$query) or die("Query failed: $query");
}


/* Ta bort produkt */

function deleteProduct($conn,$productId){
    $query = "DELETE FROM inventory WHERE productId=". $productId;

    $result = mysqli_query($conn,$query) or die("Query failed: $query");
}
?>
