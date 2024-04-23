<?php
    $name = $_POST["category-name"];
    $imageURL = $_POST["category-image-url"];

    // foreach($_POST as $key => $value){
    //     echo "$key: $value<br>";
    // }

    $sql_connection = mysqli_connect("localhost", "root", "", "red-dine", 3306);
    if(mysqli_connect_errno()){
        echo "Database connection refused!";
        mysqli_close($sql_connection);
        header("Location: web-master-dashboard.php", true);
        die();
    }

    $query = "INSERT INTO category (`name`, `imagebase64`) VALUES ('$name', '$imageURL')";

    if($result = mysqli_query($sql_connection, $query)){
        echo "Category created.";
        mysqli_close($sql_connection);
        header("Location: web-master-dashboard.php", true);
        die();
    }
?>