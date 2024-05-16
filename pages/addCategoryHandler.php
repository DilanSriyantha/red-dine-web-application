<?php
    include "../utils/image_uploader.php";

    $name = $_POST["category-name"];

    echo $_FILES["imageFile"]["size"] > 0 ? "true" : "false";

    $imageUrl = $_POST["category-image-url"];
    if($_FILES["imageFile"]["size"] > 0){
        $imageUploader = new ImageUploader($_FILES["imageFile"]);
        $imageUrl = $imageUploader->uploadToFirebaseStorage("cat_img_");
    }

    $sql_connection = mysqli_connect("localhost", "root", "", "red-dine", 3306);
    if(mysqli_connect_errno()){
        echo "Database connection refused!";
        mysqli_close($sql_connection);
        header("Location: web-master-dashboard.php", true);
        die();
    }

    $query = "INSERT INTO category (`categoryName`, `categoryImage`) VALUES ('$name', '$imageUrl')";

    if($result = mysqli_query($sql_connection, $query)){
        echo "Category created.";
        mysqli_close($sql_connection);
        header("Location: web-master-dashboard.php", true);
        die();
    }
?>