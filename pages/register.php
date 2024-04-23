<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../styles/base.css" type="text/css">
    <link rel="stylesheet" href="../styles/login.css" type="text/css">
    <link rel="stylesheet" href="../styles/home.css" type="text/css">
</head>
<body>
    <div class="h-100 background">
        <div class="container">
            <div class="top-bar">
                <img loading="lazy" src="../images/red_logo.png">
            </div>
            <div class="login-form-wrapper">
                <div class="login-form-container">
                    <div class="form-header">
                        <h3>Register</h3>
                    </div>
                    <!-- <hr> -->
                    <form class="login-form" id="login-form" action="registerHandler.php" method="post">
                        <div class="prof-pic-container" style="display: flex; justify-content: center; align-items: center;">
                            <div style=" position: relative;">
                                <img loading="lazy"id="prof-pic-preview" style="width: 8rem; height: 8rem; border-radius: 100px; object-fit: cover;" src="https://surgassociates.com/wp-content/uploads/610-6104451_image-placeholder-png-user-profile-placeholder-image-png.jpg">
                                <a style="position: absolute; bottom: 0; right: 0; background-color: gray; border-radius: 100px; padding: 5px; width: 25px; height: 25px;" id="edit-pic">
                                    <img src="../images/edit-2.svg">
                                </a>
                            </div>
                        </div>
                        <input type="file" accept="image/*" id="prof-pic-input" name="imageFile" hidden>
                        <input type="text" name="imagebase64" id="imagebase64" style="display: none;"> 
                        <input type="text" id="user-name-input" placeholder="Username" name="name" required>
                        <input type="password" id="user-password-input" placeholder="Password" name="password" required>
                        <input type="password" id="user-password-input-2" placeholder="Confirm Password" name="password2" required>
                        <input type="email" id="user-email-input" placeholder="E-mail" name="email" required>
                        <input type="text" id="user-address-input" placeholder="Address" name="address" required>
                        <input type="tel" id="user-telephone-input" placeholder="Contact number" name="contactNumber" required>
                        <!-- <div>
                            <hr>
                        </div> -->
                        <div class="form-footer">
                            <div class="btn-container">
                                <input class="btn-submit m-0" type="submit" value="Register"></input>
                            </div>
                            <p>Do you already have an account? <a href="../pages/login.php">Login</a></p>
                        </div>
                    </form>
                </div>
            </div>
            <div class="page-footer" style="background-color: #1d1d1dda;">
                <div class="page-footer-content">
                    <h3>Red Dine</h3>
                    <span>Copyright© 2023-2024 Red Dine Foodworks</span>
                    <div class="icons-container">
                        <img src="../images/facebook.svg">
                        <img src="../images/twitter.svg">
                        <img src="../images/instagram.svg">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../scripts/utils.js"></script>
    <script>
        const prof_pic_preview = document.getElementById("prof-pic-preview");
        const prof_pic_input = document.getElementById("prof-pic-input");
        const edit_pic = document.getElementById("edit-pic");
        const imagebase64 = document.getElementById("imagebase64");

        prof_pic_input.addEventListener("input", async (e) => {
            console.log();
            try{
                const base64 = await Utils.compressImage(e.target.files[0]);
                if(base64){
                    prof_pic_preview.src = base64;
                    imagebase64.value = base64;
                    console.log(base64);
                }
            }catch(err){
                console.error(err);
            }
        });
        
        edit_pic.addEventListener("click", (e) => {
            prof_pic_input.click();
        });
    </script>
</body>
</html>