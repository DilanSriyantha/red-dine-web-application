<?php
session_start();

if(!isset($_GET["productId"])) die("Unexpected request!");

$productId = $_GET["productId"];
$qty = $_POST["txtQty"];
$cart = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];

$con = mysqli_connect("localhost","root","","red-dine", 3306);
if(mysqli_connect_errno()) die("Database connection refused!");

$query = "SELECT * FROM `product` WHERE `productId`=$productId;";

$result = mysqli_query($con,$query);
if(mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result)){
        $productId = $row["productId"];
        $image = $row["productImage"];
        $productName = $row["productName"];
        $price = $row["productPrice"];
        $total =  (float)($qty * $price);

        $item = array(
            "productId" => $productId,
            "productImage" => $image,
            "productName" => $productName,
            "qty" => $qty,
            "unitCost" => $price,
            "total" => $total
        );

        array_push($cart, $item);
    }
}
$_SESSION["cart"] = $cart;
header("Location: ./item-details.php?item_id=$productId", true);
die();
?>