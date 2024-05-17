<?php
session_start();
$user = null;

if (isset($_SESSION["user"]))
    $user = $_SESSION["user"];

$sql_connection = mysqli_connect("localhost", "root", "", "red-dine", 3306);
if (mysqli_connect_errno()) {
    mysqli_close($sql_connection);
    die("Database connection refused!");
}

if (!isset($_GET["item_id"]))
    die("Unexpected request!");
$id = $_GET["item_id"];

$query = "SELECT * FROM `product` WHERE `productId`=$id";
$result = mysqli_query($sql_connection, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Details</title>
    <link rel="stylesheet" href="../styles/base.css" type="text/css">
    <link rel="stylesheet" href="../styles/home.css" type="text/css">
    <link rel="stylesheet" href="../styles/item-details.css" type="text/css">
</head>

<body>
    <div class="w-100 h-100 background">
        <div class="w-100 h-100">
            <div class="w-100 h-100 display-flex flex-d-column content-wrapper">
                <div class="menu">
                    <div class="menu-content-wrapper">
                        <a class="logo-container" href=<?php if($user["master"]) echo "./web-master-dashboard.php"; else echo "../index.php" ?>>
                            <img src="../images/red_logo.png">
                        </a>
                        <div class="menu-wrapper">
                            <div class="menu-container">
                                <div class="options-container">
                                    <a class="option" href=<?php
                                    if ($user) {
                                        echo "../pages/user.php";
                                    } else {
                                        echo "../pages/login.php";
                                    }
                                    ?>>
                                        <img src=<?php
                                        if ($user) {
                                            echo $user["image"];
                                        } else {
                                            echo "https://surgassociates.com/wp-content/uploads/610-6104451_image-placeholder-png-user-profile-placeholder-image-png.jpg";
                                        }
                                        ?>>
                                    </a>
                                    <?php
                                    if(!$user["master"]){
                                        echo 
                                            "<a class='floating-option' href='../pages/cart.php'>
                                                <img src='../images/shopping-cart.svg'>"
                                                . (isset($_SESSION["cart"]) ? "
                                                <div class='cart-label-container'>
                                                    <span id='cart-label'>" . count($_SESSION["cart"]) . "</span>
                                                </div>
                                                " : "") .
                                            "</a>";
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-100 flex-d-column container">
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        $item = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        $image = $item["productImage"];
                        $name = $item["productName"];
                        $price = $item["productPrice"];
                        $veg = $item["veg"];
                        $description = $item["productDescription"];

                        echo (
                            "<div class='cruisine-type-container'>
                                <img src=" . ($veg ? '../images/veg.svg' : '../images/non-veg.svg') . ">
                                <span>" . ($veg ? 'VEG' : 'NON - VEG') . "</span>
                            </div>
                            <div class='top-cover-container'>
                                <img loading='lazy' src='$image'>
                            </div>
                            <div class='name-container'>
                                <h2 class='p-0 m-0 price-tag'>LKR $price</h2>
                                <h2 class='p-0 m-0'>$name</h2>
                            </div>
                            <div class='content-container display-flex flex-d-row'>
                                <div class='description-container'>
                                    <p>$description</p>
                                </div>
                                
                            </div>"
                        );
                    }
                    ?>
                    <?php 
                    if(!$user["master"]) echo 
                    "<div class='specs-container'>
                        <form action='cartHandler.php?action=add&productId=$id' method='post' class='specs-wrapper'>
                            <div class='add-to-cart-option-container'>
                                <button type='button' class='minus-one-button' id='btn-minus-one'>-</button>
                                <input type='number' value=1 id='txtQty' name='txtQty'>
                                <button type='button' class='plus-one-button' id='btn-plus-one'>+</button>
                            </div>
                            <button type='submit' class='add-to-cart-button' id='btn-add-to-cart'>+ Add to cart</button>
                        </form>
                    </div>";
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        const btnPlus = document.getElementById("btn-plus-one");
        const btnMinus = document.getElementById("btn-minus-one");
        const txtQty = document.getElementById("txtQty");
        const btnAddToCart = document.getElementById("btn-add-to-cart");

        let qty = 1;

        const addQty = () => {
            qty++;
            txtQty.value = qty;
        };

        const subtractQty = () => {
            if (parseInt(txtQty.value) <= 0) return;
            qty--;
            txtQty.value = qty;
        };

        const addToCart = async () => {
            try {
                const res = await fetch(
                    "./addToCartHandler.php",
                    {
                        method: "POST",
                        body: JSON.stringify({ a: 1, b: 'Textual content' })
                    }
                );
                if (res) {
                    console.log(res);
                }
            } catch (err) {
                console.log(err);
            }
        };

        btnPlus.addEventListener("click", (e) => {
            addQty();
        });

        btnMinus.addEventListener("click", (e) => {
            subtractQty();
        });

        btnAddToCart.addEventListener("click", (e) => {
            addToCart();
        }); 
    </script>
</body>

</html>