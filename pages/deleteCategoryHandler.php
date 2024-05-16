<?php
if(!isset($_GET["categoryId"])) die("Unexpected request");

$categoryId = $_GET["categoryId"];

$query = "DELETE FROM `product` WHERE `categoryId`=$categoryId; 
DELETE FROM `category` WHERE `categoryId`=$categoryId;";

$con = mysqli_connect("localhost", "root", "", "red-dine", 3306);
if(mysqli_connect_errno()) die("Database connection refused!");

$result = mysqli_multi_query($con, $query);
if($result){
    echo "Successful";
    return;
}
echo "Failed";
?>