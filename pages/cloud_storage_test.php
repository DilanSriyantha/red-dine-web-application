<?php

include "../firebase_config.php";

if (isset($_POST["btnSubmit"])) {
    // print_r($_FILES["imageFile"]);

    $check = getimagesize($_FILES["imageFile"]["tmp_name"]);
    if($check){
        echo "File is an image - " . $check["mime"] . ".";
    }else{
        echo "File is not an image";
    }

    $file_name = rand(1111, 9999) . "_usr_img_" . $_FILES["imageFile"]["name"];

    $obj = $bucket->upload(
        file_get_contents($_FILES["imageFile"]["tmp_name"]),
        [
            "name" => $file_name
        ]
    );

    $obj_r = $bucket->object($file_name);
    $obj_r->update(
        ["acl" => []],
        ["predifinedAcl" => "PUBLICREAD"]
    );

    $link = "https://firebasestorage.googleapis.com/v0/b/red-dine-webapp.appspot.com/o/" . $file_name . "?alt=media";

    echo "<img src='" . $link . "' loading='lazy'>";
}else{
    echo "error";
}
?>