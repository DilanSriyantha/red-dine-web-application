<?php
if(!isset($_POST["action"]) || !isset($_GET["orderId"])) die("Unexpected request!");

$status = $_POST["action"];
$orderId = $_GET["orderId"];
$scrollTop = $_GET["scrollTop"];

$con = mysqli_connect("localhost", "root", "", "red-dine", 3306);
if(mysqli_connect_errno()) die("Database connection refused!");

$query = "UPDATE `orders` SET `status`='$status' WHERE `orderId`=$orderId;";

$result = mysqli_query($con,$query);
if($result){
    header("Location: ./web-master-dashboard.php#tab-orders&$scrollTop", false);
    die();
}
?>