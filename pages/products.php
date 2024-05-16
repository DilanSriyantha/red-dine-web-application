<?php
session_start();
$user = null;
if (isset($_SESSION["user"])) {
    $user = $_SESSION["user"];
}

$sql_connection = mysqli_connect("localhost", "root", "", "red-dine", 3306);
if (mysqli_connect_errno()) {
    echo "Database connection refused";
    die();
}

$categoryId = $_GET["categoryId"];

$query = "SELECT * FROM (SELECT * FROM `product` AS Rel_Prods WHERE categoryId=$categoryId) AS Prods INNER JOIN `category` ON Prods.categoryId=category.categoryId";
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
                        <a class="logo-container" href="../index.php">
                            <img src="../images/red_logo.png">
                        </a>
                        <div class="menu-wrapper">
                            <div class="menu-container">
                                <div class="menu-strip">
                                    <form class="search-container">
                                        <input type="text" id="search-input">
                                        <button type="button" id="search-button">
                                            <img src="../images/search.svg">
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="options-container">
                            <a class="option" href="../pages/user.php">
                                <img src=<?php
                                if ($user) {
                                    echo $user["image"];
                                } else {
                                    echo "https://surgassociates.com/wp-content/uploads/610-6104451_image-placeholder-png-user-profile-placeholder-image-png.jpg";
                                } ?>>
                            </a>
                            <a class="floating-option" href="../pages/cart.html">
                                <img src="../images/shopping-cart.svg">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="products-wrapper flex-d-column container">
                    <h1>
                        <?php
                        $category = $_GET["categoryName"];
                        $category[0] = strtoupper($category[0]);
                        echo $category;
                        ?>
                    </h1>
                    <div class="row" id="products-list">
                        <?php
                        if ($result = mysqli_query($sql_connection, $query)) {
                            if ($result->num_rows > 0) {
                                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                    $imageUrl = $row["productImage"];
                                    $name = $row["productName"];
                                    $category = $row["categoryName"];
                                    $price = $row["productPrice"];
                                    echo "
                                        <a class='col col-lg product-item-container' href='../pages/item-details.php?item_id=5115315395' id='5115315395'>
                                            <div class='product-item'>
                                                <div class='product-item-thumbnail'>
                                                    <img loading='lazy' src='$imageUrl'>
                                                </div>
                                                <div class='product-item-details-container'>
                                                    <h4 class='p-0 m-0'>$name</h4>
                                                    <small>$category</small>
                                                    <h2>$ $price</h2>
                                                </div>
                                            </div>
                                        </a>";
                                }
                            } else {
                                echo "<img src='../images/empty.png'>";
                            }
                        }
                        ?>
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
    <!-- <script src="../scripts/productsFunctions/products-functions.js"></script> -->
</body>

</html>