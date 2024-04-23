<?php
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql_connection = mysqli_connect("localhost", "root", "", "red-dine", 3306);
    if(mysqli_connect_errno()){
        echo "Login failed!";
        mysqli_close($sql_connection);
        header("Location: loginResult.php", true);
        die();
    }

    $query = "SELECT * FROM `user` WHERE `email`='$email'";
    $user_exists = false;
    $user = null;
    
    if($result = mysqli_query($sql_connection, $query)){
        while($row = mysqli_fetch_row($result)){
            if($row[3] === $password){
                $user = array(
                    "id" => $row[0],
                    "name" => $row[1],
                    "email" => $row[2],
                    "password" => $row[3],
                    "address" => $row[4],
                    "contactNumber" => $row[5],
                    "imagebase64" => $row[6]
                );
                $user_exists = true;
                echo "Login successfull";
            }
            else{
                $user_exists = false;
                echo "Password incorrect";
            }
        }
        mysqli_free_result($result);
    }else{
        $user_exists = false;
        echo "Login failed: No account bound with the given email.";
    }

    mysqli_close($sql_connection);

    if($user_exists){
        session_start();
        $_SESSION["user"] = $user;

        header("Location: index.php", true);
        die();
    }else{
        header("Location: loginResult.php", true);
        die();
    }
?>