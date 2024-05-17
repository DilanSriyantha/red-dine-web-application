<?php
session_start();

if(!isset($_POST["btnConfirm"])) die("Unexpected request");

$user = isset($_SESSION["user"]) ? $_SESSION["user"] : [];
$cart = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];

$order_query = "INSERT INTO `orders` (`userid`, `utensils`, `subtotal`) VALUES (" . $user["id"] . ", " . $_GET["utensils"] . ", " . $_GET["subtotal"] .  ");";

$con = mysqli_connect("localhost", "root", "", "red-dine", 3306);
if(mysqli_connect_errno()) die("Database connection refused!");

$result = mysqli_query($con, $order_query);
if($result){
    $last_id = mysqli_insert_id($con);
    
    $order_items_query = "";
    foreach($cart as $item){
        $order_items_query .= "INSERT INTO `orderitems` (`productId`, `orderId`, `productName`, `qty`, `unitCost`, `total`) VALUE (" . $item["productId"] . ", " . $last_id  . ", '" . $item["productName"] . "', " . $item["qty"] . ", " . $item["unitCost"] . ", " . $item["total"] . ");";
    }

    $res = mysqli_multi_query($con, $order_items_query);
    if($res){
        $_SESSION["cart"] = null;

        header("Location: ../index.php", true);
        die();
    }

}
?>