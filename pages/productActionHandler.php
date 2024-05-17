<?php
if (!isset($_GET["productId"]))
    die("Unexpected request!");

if (isset($_POST["btnDelete"]))
    deleteProduct();
else
    editProduct();

function deleteProduct()
{
    $id = $_GET["productId"];
    $categoryId = $_GET["categoryId"];
    $categoryName = $_GET["categoryName"];

    $con = mysqli_connect("localhost", "root", "", "red-dine", 3306);
    if (mysqli_connect_errno()) {
        header("Location: ./web-master-products.php?categoryId=$categoryId&categoryName=$categoryName", true);
        die("Database connection refused!");
    }

    $query = "DELETE FROM `product` WHERE `productId`=$id";
    $result = mysqli_query($con, $query);
    if ($result) {
        header("Location: ./web-master-products.php?categoryId=$categoryId&categoryName=$categoryName", true);
        die();
    }
}

function editProduct()
{
    $id = $_GET["productId"];
    $categoryId = $_GET["categoryId"];
    $categoryName = $_GET["categoryName"];

    $con = mysqli_connect("localhost", "root", "", "red-dine", 3306);
    if (mysqli_connect_errno())
        die("Database connection refused!");

    $query = "SELECT * FROM `product` WHERE `productId`=$id";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $productId = $row["productId"];
            $productName = $row["productName"];
            $productDescription = $row["productDescription"];
            $productPrice = $row["productPrice"];
            $productImage = $row["productImage"];
            $veg = $row["veg"] ? "checked" : "";
            $featured = $row["featured"] ? "checked" : "";
            $popular = $row["popular"] ? "checked" : "";

            echo "
            <form class='add-popular-form form' id='login-form' action='updateProductHandler.php?categoryId=$categoryId&categoryName=$categoryName&productId=$productId' method='post' enctype='multipart/form-data'>
                <div class='form-header'>
                    Edit Product
                    <div class='close-btn-container'>
                        <button class='close-btn' type='button'>x</button>
                    </div>
                </div>
                <div style='display: flex; margin: 10px;'>
                    <button type='button' class='image-option-button image-option-button-selected' id='image-option-file'
                        style='border-top-left-radius: 10px; border-bottom-left-radius: 10px;'>File</button>
                    <button type='button' class='image-option-button' id='image-option-url'
                        style='border-top-right-radius: 10px; border-bottom-right-radius: 10px;'>URL</button>
                </div>
                <div style='display: flex; justify-content: center;'>
                    <img src='$productImage'
                        style='width: 100px; height: 100px; object-fit: cover; border-radius: 10px; cursor: pointer;'
                        id='item-image-preview'>
                </div>
                <input type='file' id='item-image-input' placeholder='item Image' accept='image/*' style='display: none;' name='imageFile'>
                <input type='url' id='item-image-url' placeholder='URL' name='item-image-url' value='$productImage' required hidden>
                <input type='text' id='item-caption' placeholder='Item Caption' name='item-name' value='$productName' required>
                <input type='textarea' id='item-description' placeholder='Item Description' name='item-description' value='$productDescription'>
                <input type='number' id='price-input' placeholder='Price' name='price' value='$productPrice' required>
                <div style='color: #ececec; display: flex; flex-direction: row; gap: 10px; align-items: center; margin-left: 12px;'>
                    <label for='veg'>Veg?</label>
                    <input type='checkbox' id='veg' name='veg' $veg>
                </div>
                <div style='color: #ececec; display: flex; flex-direction: row; gap: 10px; align-items: center; margin-left: 12px;'>
                    <label for='featured'>Featured?</label>
                    <input type='checkbox' id='featured' name='featured' $featured>
                </div>
                <div style='color: #ececec; display: flex; flex-direction: row; gap: 10px; align-items: center; margin-left: 12px;'>
                    <label for='popular'>Popular?</label>
                    <input type='checkbox' id='popular' name='popular' $popular>
                </div>
                <input type='text' value='$categoryId' name='categoryId' hidden>
                <!-- <div>
                    <hr>
                </div> -->
                <div class='form-footer'>
                    <div class='btn-container'>
                        <input class='btn-submit m-0' type='submit' id='popup-form-submit' value='Confirm'></input>
                    </div>
                </div>
            </form>
            ";
        }
    }
}
?>