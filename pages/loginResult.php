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
                    <div class='form-header' style='flex-direction: column;'>
                        <div style='border: 1px solid #da3c1f; border-radius: 100px; width: 50px; height: 50px; display: flex; justify-content: center; align-items: center;'>
                            <h1>❌</h1>
                        </div>
                        <h3>Login Failed</h3>
                    </div>
                    <div class='display-flex' style='justify-content: center; align-items: center;'>
                        <p>You will be redirected to login page in <span id='timeout'>0</span></p>
                    </div>
                    <!-- <hr> -->
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
    <script>
        const timeout = document.getElementById("timeout");
        i = 0;
        setInterval(() => {
            timeout.innerText = (i++);
            if (i > 5) {
                location.replace("login.php");
            }
        }, 1000);
    </script>
</body>

</html>