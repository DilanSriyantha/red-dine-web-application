<?php
session_start();
$user = null;

if (isset($_SESSION["user"]))
    $user = $_SESSION["user"];

$cart = [];
if (isset($_SESSION["cart"]))
    $cart = $_SESSION["cart"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="../styles/base.css" type="text/css">
    <link rel="stylesheet" href="../styles/cart.css" type="text/css">
    <link rel="stylesheet" href="../styles/home.css" type="text/css">
</head>

<body>
    <div class="w-100 h-100 background">
        <div class="w-100 h-100">
            <div class="w-100 h-100 display-flex flex-d-column">
                <div class="menu">
                    <div class="menu-content-wrapper">
                        <a class="logo-container" href="../index.php">
                            <img src="../images/red_logo.png">
                        </a>
                        <div class="menu-wrapper">
                            <div class="menu-container">
                                <div class="options-container">
                                    <a class="option" href=<?php
                                    if ($user) {
                                        echo "./user.php";
                                    } else {
                                        echo "./login.php";
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-100 h-100 container">
                    <div class="content-wrapper">
                        <form action="./checkout.php" method="post" class="cart-content-container">
                            <div class="title-container">
                                <h1>Your Cart</h1>
                            </div>
                            <div class="order-header-container">
                                <h3>Order ID</h3>
                            </div>
                            <div class="order-items-list" id="order-items-list">
                                <?php
                                foreach ($cart as $item) {
                                    $productId = $item["productId"];
                                    echo "
                                        <div class='order-item-container' id='order-item-container-$productId'>
                                            <div class='order-item'>
                                                <div class='order-item-content'>
                                                    <div class='item-left'>
                                                        <div class='item-image-container'>
                                                            <img loading='lazy' src='" . $item["productImage"] . "'>
                                                        </div>
                                                        <div class='item-details-container' id='item-details-container-$productId'>
                                                            <span style='font-weight: bold;'>" . $item["productName"] . "</span>
                                                            <small>LKR " . $item["unitCost"] . " x <span id='statement-qty-$productId'>" . $item["qty"] . "</span></small>
                                                            <span id='total-$productId'>LKR " . number_format((float)$item["total"], 2) . "</span>
                                                        </div>
                                                    </div>
                                                    <div class='item-options-container'>
                                                        <div class='item-options-element'>
                                                            <button type='button' class='minus-button' id='btn-minus-$productId' data-product-id=$productId>-</button>
                                                            <div class='count-container'>
                                                                <span id='spanQty-$productId'>" . $item["qty"] . "</span>
                                                            </div>
                                                            <button type='button' class='plus-button' id='btn-plus-$productId' data-product-id=$productId>+</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    ";
                                }
                                ?>
                            </div>
                            <hr>
                            <div class="additions-container">
                                <div class="addition-element">
                                    <div class="caption-container">
                                        <img src="../images/utensils.svg">
                                        <span style="font-weight: bold;">Utensils straws, etc</span>
                                    </div>
                                    <div class="action-container">
                                        <input type="checkbox" name="utensils">
                                    </div>
                                </div>
                                <!-- <div class="addition-element">
                                    <div class="caption-container">
                                        <img src="../images/file-text.svg">
                                        <span style="font-weight: bold;">Add note</span>
                                    </div>
                                    <div class="action-container">
                                        <img src="../images/chevron-right.svg">
                                    </div>
                                </div> -->
                            </div>
                            <hr>
                            <div class="sub-total-container">
                                <div class="sub-total-element">
                                    <h3>Subtotal</h3>
                                    <?php
                                    $total = 0.00;
                                    foreach ($cart as $item) {
                                        $total += $item["total"];
                                    }
                                    echo "<h3 id='subtotal'>LKR " . number_format((float)$total, 2) . "/=</h3>";
                                    ?>
                                </div>
                            </div>
                            <div class="checkout-btn-container">
                                <button class="checkout-button">Go to checkout</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const plusBtns = document.getElementsByClassName("plus-button");
        const minusBtns = document.getElementsByClassName("minus-button");

        for (var i = 0; i < plusBtns.length; i++) {
            const btn = plusBtns.item(i);
            btn.addEventListener("click", (e) => {
                const corresponding_span = document.getElementById("spanQty-" + btn.getAttribute("data-product-id"));
                const itemDetailsContainer = document.getElementById("item-details-container-" + btn.getAttribute("data-product-id"));
                var current_qty = parseInt(corresponding_span.innerText);

                corresponding_span.innerText = current_qty + 1;
                notifyUpdate(itemDetailsContainer, btn.getAttribute("data-product-id"), (current_qty + 1));
            });
        }

        for (var i = 0; i < minusBtns.length; i++) {
            const btn = minusBtns.item(i);
            btn.addEventListener("click", (e) => {
                const corresponding_span = document.getElementById("spanQty-" + btn.getAttribute("data-product-id"));
                const itemDetailsContainer = document.getElementById("item-details-container-" + btn.getAttribute("data-product-id"));
                var current_qty = parseInt(corresponding_span.innerText);
                if (current_qty > 1)
                {
                    corresponding_span.innerText = current_qty - 1;
                    notifyUpdate(itemDetailsContainer, btn.getAttribute("data-product-id"), (current_qty - 1));
                    return;
                }
                notifyRemoval(btn.getAttribute("data-product-id"));
            });
        }

        const notifyRemoval = async (productId) => {
            try {
                const res = await fetch("./cartHandler.php?action=remove&productId=" + productId, {
                    method: "GET"
                });
                if (res) {
                    location.reload();
                }
            } catch (err) {
                console.log(err);
            }
        };  

        const notifyUpdate = async (itemDetailsContainer, productId, qty) => {
            try{
                const res = await fetch("./cartHandler.php?action=update&productId=" + productId + "&qty=" + qty, {
                    method: "GET",
                });
                if(res){
                    itemDetailsContainer.outerHTML = await res.text();
                    updateSubTotal(productId);
                }
            }catch(err){    
                console.log(err);
            }
        };

        const updateSubTotal = async (productId) => {
            try{
                const res = await fetch("./cartHandler.php?action=getTotal&productId=" + productId, {
                    method: "GET",
                });
                if(res){
                    document.getElementById("subtotal").innerHTML = "LKR " + await res.text() + "/=";
                }
            }catch(err){    
                console.log(err);
            }
        };
    </script>
</body>

</html>