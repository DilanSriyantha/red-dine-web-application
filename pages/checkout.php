<?php
session_start();
$user = null;

if (isset($_SESSION["user"]))
    $user = $_SESSION["user"];

$cart = [];
if (isset($_SESSION["cart"]))
    $cart = $_SESSION["cart"];

$utensils = isset($_GET["utensils"]) ? 1 : 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="../styles/base.css" type="text/css">
    <link rel="stylesheet" href="../styles/user.css" type="text/css">
    <link rel="stylesheet" href="../styles/home.css" type="text/css">
    <link rel="stylesheet" href="../styles/checkout.css" type="text/css">
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
                                    <div class="option" href=<?php
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-100 flex-d-column container">
                    <div class="content-wrapper">
                        <div class="acc-info-container">
                            <h1>Checkout</h1>
                            <div class="subtotal-card">
                                <div class="subtotal-card-content">
                                    <h5 class="p-0 m-0">Subtotal</h5>
                                    <hr style="margin-left: 0px; margin-right: 0px;">
                                    <?php 
                                    $subtotal = 0;
                                    foreach($cart as $item){
                                        $subtotal += $item["total"];
                                    }
                                    echo "<h4 class='p-0 m-0'>LKR " . number_format((float)$subtotal, 2, '.', '') . "</h4>";
                                    ?>
                                </div>
                            </div>
                            <div class="input-form-card">
                                <form action="<?php echo "./checkoutHandler.php?utensils=$utensils&subtotal=$subtotal" ?>" method="post">
                                    <div class="payment-method-container">
                                        <h5 class="m-0 p-0">Payment Method</h5>
                                        <input class="payment-method-input" type="radio" name="payment-method"
                                            id="payment-method-card" value="card" required>
                                        <label class="payment-method-label" for="payment-method-card" >
                                            <div
                                                style="display: flex; justify-content: flex-start; align-items: center; gap: 10px;">
                                                <div style="display: block;">
                                                    <img src="../images/card.png">
                                                </div>
                                                <span>Card</span>
                                            </div>
                                        </label>
                                        <hr>
                                        <input class="payment-method-input" type="radio" name="payment-method"
                                            id="payment-method-cash-on-delivery" value="cash-on-delivery" required>
                                        <label class="payment-method-label" for="payment-method-cash-on-delivery">
                                            <div
                                                style="display: flex; justify-content: flex-start; align-items: center; gap: 10px;">
                                                <div style="display: block;">
                                                    <img src="../images/cash-on-delivery.png">
                                                </div>
                                                <span>Cash on delivery</span>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="other-inputs-container">
                                        <div class="contact-info-container">
                                            <h5 class="p-0 m-0">Contact Information</h5>
                                            <input type="email" id="user-email-input" placeholder="E-mail" name="email" value="<?php echo $user["email"] ?>"
                                                required>
                                            <input type="tel" id="user-telephone-input" placeholder="Telephone" value="<?php echo $user["contactNumber"] ?>"
                                                name="telephone" required>
                                        </div>
                                        <div class="shipping-info-container">
                                            <h5 class="p-0 m-0">Shipping Information</h5>
                                            <input type="text" id="user-name-input" placeholder="Name" name="name" value="<?php echo $user["name"] ?>"
                                                required>
                                            <input type="text" id="user-address-input" placeholder="Address" name="name" value="<?php echo $user["address"] ?>"
                                                required>
                                        </div>
                                    </div>
                                    <div class="confirm-btn-container">
                                        <button type="submit" class="btn-confirm" name="btnConfirm">Confirm</button>
                                    </div>
                                </form>
                            </div>
                        </div>
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