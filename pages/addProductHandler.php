<?php
    $categoryId = $_POST["categoryId"];
    $name = $_POST["item-name"];
    $price = $_POST["price"];
    $imageUrl = $_POST["item-image-url"];
    $categoryId = $_GET["categoryId"];
    $categoryName = $_GET["categoryName"];

    foreach($_POST as $key => $value){
        echo "$key: $value<br>";
    }

    $sql_connection = mysqli_connect("localhost", "root", "", "red-dine", 3306);
    if(mysqli_connect_errno()){
        echo "Database connection refused";
        header("Location: web-master-products.php", true);
        die();
    }

    $query = "INSERT INTO `product` (`categoryId`, `productName`, `price`, `productImage`) VALUE ('$categoryId', '$name', '$price', '$imageUrl')";

    if($result = mysqli_query($sql_connection, $query)){
        echo "Product created!";
        mysqli_close($sql_connection);
        header("Location: web-master-products.php?categoryId=$categoryId&categoryName=$categoryName", true);
        die();
    }
    echo "Error occurred!";
    mysqli_close($sql_connection);
    header("Location: web-master-products.php", true);
    die();
?>