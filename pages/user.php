<?php 
    session_start();
    $user = null;
    if(isset($_SESSION["user"]))
    {
        $user = $_SESSION["user"];
    }else{
        unset($user);
    }

    function getUserAttr($key){
        if(isset($user)){
            return $user[$key];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <link rel="stylesheet" href="../styles/base.css" type="text/css">
    <link rel="stylesheet" href="../styles/user.css" type="text/css">
    <link rel="stylesheet" href="../styles/home.css" type="text/css">
</head>

<body>
    <div class="w-100 h-100 background">
        <div class="w-100 h-100">
            <div class="w-100 h-100 display-flex flex-d-column">
                <div class="w-100 flex-d-column container">
                    <div class="content-wrapper">
                        <div class="acc-info-container">
                            <h1>Account Info</h1>
                            <form hidden>
                                <input type="file" accept="image/*" id="prof-pic-input">
                            </form>
                            <div class="prof-pic-container">
                                <img src=
                                <?php 
                                    if(isset($user)){
                                        echo getUserAttr("imagebase64");
                                    }else{
                                        echo "https://surgassociates.com/wp-content/uploads/610-6104451_image-placeholder-png-user-profile-placeholder-image-png.jpg";
                                    }
                                ?> style="height: 120px" id="prof-pic-preview">
                                <a class="edit-prof-pic" id="edit-prof-pic">
                                    <img src="../images/edit-2.svg">
                                </a>
                            </div>
                            <h3>Basic Info</h3>
                            <div class="basic-info-container">
                                <div class="element">
                                    <span>Name</span>
                                    <?php echo getUserAttr("name") ?>
                                </div>
                                <hr>
                                <div class="element">
                                    <span>Phone number</span>
                                    <?php echo getUserAttr("contactNumber") ?>
                                </div>
                                <hr>
                                <div class="element">
                                    <span>Email</span>
                                    <?php echo getUserAttr("email") ?>
                                </div>
                                <hr>
                                <div class="element">
                                    <span>Address</span>
                                    <?php echo getUserAttr("address") ?>
                                </div>
                                <hr>
                                <div class="element">
                                    <a type="button" href="logoutHandler.php
                                    ">Logout</a>
                                </div>
                                <div class="element pt-10">
                                    <a href="../pages/privacy-policy.html">Privacy Policy</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="page-footer">
                        <div class="page-footer-content">
                            <h3>Red Dine</h3>
                            <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti porro molestiae nisi
                                repudiandae quod rerum repellendus? A eligendi temporibus voluptatem.</span>
                            <div class="icons-container">
                                <img src="../images/facebook.svg">
                                <img src="../images/twitter.svg">
                                <img src="../images/instagram.svg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="../scripts/utils.js"></script>
<script>
    const profPicInput = document.getElementById("prof-pic-input");
    const editProfPic = document.getElementById("edit-prof-pic");
    const profPicPreview = document.getElementById("prof-pic-preview");

    editProfPic.addEventListener("click", (e) => {
        profPicInput.click();
    });

    profPicInput.addEventListener("input", async (e) => {
        const base64 = await Utils.compressImage(e.target.files[0]);
        if (base64) {
            profPicPreview.src = base64;
        }
    });
</script>
</html>