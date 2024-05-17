<?php
session_start();

if(!isset($_POST["btnReorder"]) && !isset($_GET["orderItems"])) die("Unexpected request!");

$cart = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];
$orderItems = json_decode($_GET["orderItems"], true);

foreach( $orderItems as $item ){
    array_push($cart, $item);
}

$_SESSION["cart"] = $cart;

header("Location: ../index.php#tab-orders", true);
?>