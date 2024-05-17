<?php
session_start();

if (!isset($_GET["action"]))
    die("Unexpected request");
if (!isset($_GET["productId"]))
    die("Unexpected request!");

if ($_GET["action"] == "add")
    addToCart();
else if ($_GET["action"] == "remove")
    removeFromCart();
else if ($_GET["action"] == "update")
    updateCart();
else if($_GET["action"] == "getTotal")
    getTotal();

function getTotal() {
    $cart = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];
    
    $total = 0;
    foreach ($cart as $item) {
        $total += $item["total"];
    }

    echo $total;
}

function updateCart()
{
    $cart = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];

    $updated_cart = array_map(function ($item) {
        $productId = $_GET["productId"];
        $qty = $_GET["qty"];
        if ($item["productId"] == $productId) {
            $item["qty"] = $qty;
            $item["total"] = $qty * $item["unitCost"];

            echo "
                <div class='item-details-container' id='item-details-container-$productId'>
                    <span style='font-weight: bold;'>" . $item["productName"] . "</span>
                    <small>LKR " . $item["unitCost"] . " x <span id='statement-qty-$productId'>" . $item["qty"] . "</span></small>
                    <span id='total-$productId'>LKR " . $item["total"] . "</span>
                </div>
            ";

            return $item;
        }
        return $item;
    }, $cart);

    $_SESSION["cart"] = $updated_cart;
}

function removeFromCart()
{
    $cart = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];

    $updated_cart = array_filter($cart, function ($item) {
        $productId = $_GET["productId"];
        return $item["productId"] != $productId;
    });

    $cart = array_values($updated_cart);

    print_r($cart);

    $_SESSION["cart"] = $cart;
    die();
}

function addToCart()
{
    $productId = $_GET["productId"];
    $qty = $_POST["txtQty"];
    $cart = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];

    $con = mysqli_connect("localhost", "root", "", "red-dine", 3306);
    if (mysqli_connect_errno())
        die("Database connection refused!");

    $query = "SELECT * FROM `product` WHERE `productId`=$productId;";

    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $productId = $row["productId"];
            $image = $row["productImage"];
            $productName = $row["productName"];
            $price = $row["productPrice"];
            $total = (float) ($qty * $price);

            $item = array(
                "productId" => $productId,
                "productImage" => $image,
                "productName" => $productName,
                "qty" => $qty,
                "unitCost" => $price,
                "total" => $total
            );

            array_push($cart, $item);
        }
    }
    $_SESSION["cart"] = $cart;
    header("Location: ./item-details.php?item_id=$productId", true);
    die();
}

?>