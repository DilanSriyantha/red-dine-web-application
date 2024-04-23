<?php
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $address = $_POST["address"];
    $contactNumber = $_POST["contactNumber"];
    $imagebase64 = $_POST["imagebase64"];
    
    $sql_connection = mysqli_connect("localhost", "root", "", "red-dine", 3306);
    if(mysqli_connect_errno()){
        echo "Database connection refused: " . mysqli_connect_error();
    }

    $query = "INSERT INTO `user` (`name`, `email`, `password`, `address`, `contactNumber`, `imagebase64`) VALUES ('$name', '$email', '$password', '$address', '$contactNumber', '$imagebase64')";
    if($result = mysqli_query($sql_connection, $query)){
        echo "User created!";
        mysqli_close($sql_connection);
        header("Location: registerResult.php?status=success", true);
        die();
    }
    mysqli_close($sql_connection);
    header("Location: registerResult.php?status=failed", true);
    die();
?>