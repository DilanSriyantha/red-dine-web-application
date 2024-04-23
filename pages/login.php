<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
                        <h3>Login</h3>
                    </div>
                    <!-- <hr> -->
                    <form class="login-form" id="login-form" action="loginHandler.php" method="post">
                        <input type="email" id="user-email-input" placeholder="E-mail" name="email" required>
                        <input type="password" name="password" id="user-password-input" placeholder="Password" required>
                        <!-- <div>
                            <hr>
                        </div> -->
                        <div class="form-footer">
                            <div class="btn-container">
                                <input class="btn-submit m-0" type="submit" value="Login"></input>
                            </div>
                            <p>Don't have an account? <a href="../pages/register.php">Register</a></p>
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
    </div>
</body>
<script src="../scripts/login-functions.js"></script>

</html>