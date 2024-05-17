<?php 
if(!isset($_GET["productId"])) die("Unexpected request!");

$productId = $_GET["productId"];
$categoryId = $_POST["categoryId"];
$name = $_POST["item-name"];
$description = $_POST["item-description"];
$price = $_POST["price"];
$imageUrl = $_POST["item-image-url"];
$categoryId = $_GET["categoryId"];
$categoryName = $_GET["categoryName"];
$veg = isset($_POST["veg"]) ? 1 : 0;
$popular = isset($_POST["popular"]) ? 1 : 0;
$featured = isset( $_POST["featured"]) ? 1 : 0;

$con = mysqli_connect("localhost","root","","red-dine", 3306);
if(mysqli_connect_errno()){
    die("Database connection refused!");
}

$query = "UPDATE `product` SET `productName` = '$name', `productDescription` = '$description', `productPrice`=$price, `productImage` = '$imageUrl', `veg` = $veg, `popular` = $popular, `featured` = $featured WHERE `product`.`productId` = $productId;";

echo $query;

$result = mysqli_query($con, $query);
if($result){
    header("Location: ./web-master-products.php?categoryId=$categoryId&categoryName=$categoryName", true);
    die();
}
die("Something went wrong!");
?>