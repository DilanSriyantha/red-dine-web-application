<?php
    session_start();
    $user = $_SESSION["user"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="../styles/products.css">
    <link rel="stylesheet" href="../styles/base.css">
    <link rel="stylesheet" href="../styles/home.css">
</head>
<body>
    <div class="w-100 h-100 background">
        <div class="w-100 h-100">
            <div class="w-100 h-100 display-flex flex-d-column page-wrapper">
                <div class="menu">
                    <div class="menu-content-wrapper">
                        <div class="logo-container">
                            <img src="../images/red_logo.png">
                        </div>
                        <div class="menu-wrapper">
                            <div class="menu-container">
                                <div class="menu-strip">
                                    <div class="search-container">
                                        <input type="text" id="search-input">
                                        <button type="button" id="search-button">
                                            <img src="../images/search.svg">
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="options-container">
                            <a class="option" href="../pages/user.php">
                                <img src=<?php echo $user["imagebase64"] ?>>
                            </a>
                            <a class="floating-option" href="../pages/cart.html">
                                <img src="../images/shopping-cart.svg">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="products-wrapper flex-d-column container">
                    <div class="row" id="products-list">
                        
                    </div>
                    <div class="page-footer">
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
    </div>

    <script src="../scripts/productsFunctions/product.js"></script>
    <script src="../scripts/productsFunctions/products-functions.js"></script>
</body>
</html>