<?php
    include "../utils/image_uploader.php";

    $categoryId = $_POST["categoryId"];
    $name = $_POST["item-name"];
    $description = $_POST["item-description"];
    $price = $_POST["price"];
    $imageUrl = $_POST["item-image-url"];
    $categoryId = $_GET["categoryId"];
    $categoryName = $_GET["categoryName"];
    $veg = isset($_POST["veg"]) ? true : false;

    // foreach($_POST as $key => $value){
    //     echo "$key: $value<br>";
    // }

    if($_FILES["imageFile"]["size"] > 0){
        $imageUploader = new ImageUploader($_FILES["imageFile"]);
        $imageUrl = $imageUploader->uploadToFirebaseStorage("prod_img_");
    }

    $sql_connection = mysqli_connect("localhost", "root", "", "red-dine", 3306);
    if(mysqli_connect_errno()){
        echo "Database connection refused";
        header("Location: web-master-products.php", true);
        die();
    }

    $query = "INSERT INTO `product` (`categoryId`, `productName`, `productDescription`, `productPrice`, `productImage`, `veg`) VALUE ('$categoryId', '$name', '$description', '$price', '$imageUrl', '$veg')";

    echo $query;

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